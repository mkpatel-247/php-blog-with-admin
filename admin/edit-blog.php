<?php
require "includes/dbConnection.php";

session_start();

if (isset($_REQUEST['blogid'])) {
    $blogId = $_REQUEST['blogid'];
    if (empty($blogId)) {
        header("Location: blog-post.php");
        exit();
    }

    $_SESSION['editBlogId'] = $_REQUEST['blogid'];
    $sqlGetBlogDetails = "SELECT * FROM blog_post_master WHERE n_blog_post_id = '$blogId'";
    $queryGetBlogDetails = mysqli_query($conn, $sqlGetBlogDetails);

    if ($rowGetBlogDetails = mysqli_fetch_assoc($queryGetBlogDetails)) {
        $_SESSION['editTitle'] = $rowGetBlogDetails['v_post_title'];
        $_SESSION['editMetaTitle'] = $rowGetBlogDetails['v_post_meta_title'];
        $_SESSION['editCategoryId'] = $rowGetBlogDetails['n_category_id'];
        $_SESSION['editSummary'] = $rowGetBlogDetails['v_post_summary'];
        $_SESSION['editContent'] = $rowGetBlogDetails['v_post_content'];
        $_SESSION['editPath'] = $rowGetBlogDetails['v_post_path'];
        $_SESSION['editHomePagePlacement'] = $rowGetBlogDetails['n_home_page_placement'];
    } else {
        header("Location: blog-post.php");
        exit();
    }

    $sqlGetBlogTags = "SELECT * FROM blog_tags WHERE n_blog_post_id = '$blogId'";
    $queryGetBlogTags = mysqli_query($conn, $sqlGetBlogTags);
    if ($rowGetBlogTags = mysqli_fetch_assoc($queryGetBlogTags)) {
        $_SESSION['editTags'] = $rowGetBlogTags['v_tag'];
    } else {
        $_SESSION['editTags'] = null;
    }
} else if (isset($_SESSION['editBlogId'])) {
} else {
    header("Location: blogs.php");
    exit();
}

$sqlGetImages = "SELECT * FROM blog_post_master WHERE n_blog_post_id = '" . $_SESSION['editBlogId'] . "'";
$queryGetImages = mysqli_query($conn, $sqlGetImages);
if ($rowGetImages = mysqli_fetch_assoc($queryGetImages)) {
    $mainImgUrl = $rowGetImages['v_main_image_url'];
    $altImgUrl = $rowGetImages['v_alternate_image_url'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Edit Blog - Blog Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- SummerNote API -->
    <link href='summernote/summernote.min.css' rel='stylesheet' type='text/css'>
</head>

<body>

    <!-- ======= Header ======= -->
    <?php include 'header.php'; ?>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php include 'sidebar.php'; ?>
    <!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit a blog</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Blog</li>
                    <li class="breadcrumb-item active">Edit Blog</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit: <?php echo $_SESSION['editTitle']; ?></h5>

                    <?php
                    if (isset($_REQUEST['updateblog'])) {
                        if ($_REQUEST['updateblog'] == "title_being_used") {
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <i class='bi bi-exclamation-triangle me-1'></i>
                            <strong>Blog title</strong> is already used.
                            <form method='POST' action='blog-post.php'>
                                <button type='submit' name='button-close' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </form>
                            </div>";
                        } else if ($_REQUEST['updateblog'] == "path_being_used") {
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <i class='bi bi-exclamation-triangle me-1'></i>
                                <strong>Blog Path</strong> is already in used.
                                <form method='POST' action='blog-post.php'>
                                    <button type='submit' name='button-close' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </form>
                            </div>";
                        } else if ($_REQUEST['updateblog'] == "sqlError") {
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <i class='bi bi-exclamation-triangle me-1'></i>
                                <strong>Database Error</strong>
                                <form method='POST' action='blog-post.php'>
                                    <button type='submit' name='button-close' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </form>
                            </div>";
                        } else if ($_REQUEST['updateblog'] == "homepageplacementerror") {
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <i class='bi bi-exclamation-triangle me-1'></i>
                                    <strong>Error!</strong> An unexpected error occured while try to set home page placement. Please try again.
                                <form method='POST' action='blog-post.php'>
                                    <button type='submit' name='button-close' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </form>
                                </div>";
                        } else if ($_REQUEST['updateblog'] == "success") {
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <i class='bi bi-check-circle me-1'></i>
                                    <strong>Blog Saved!</strong>
                                <form method='POST' action='blog-post.php'>
                                    <button type='submit' name='button-close' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </form>
                                </div>";
                        }
                    }
                    ?>

                    <!-- Write a Blog -->
                    <form class="needs-validation" method="POST" action="includes/update-blog.php" enctype="multipart/form-data">

                        <input type="hidden" name="blog-id" value="<?php echo $blogId ?>">
                        <!-- Blog Title Field -->
                        <div class="row mb-3">
                            <label for="blog-title" class="col-sm-2 col-form-label">Blog Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="validationCustom01" name="blog-title" value="<?php echo $_SESSION['editTitle']; ?>" required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                        </div>

                        <!-- Meta Title field -->
                        <div class="row mb-3">
                            <label for="meta-title" class="col-sm-2 col-form-label">Meta Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="blog-meta-title" value="<?php echo $_SESSION['editMetaTitle'] ?>" required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="validationCustom04" name="blog-category" required>
                                    <option selected value="">Select Category</option>
                                    <?php
                                    $sqlCategories = "SELECT * FROM blog_category";
                                    $queryCategories = mysqli_query($conn, $sqlCategories);

                                    $counter = 0;
                                    while ($rowCategories = mysqli_fetch_assoc($queryCategories)) {
                                        $counter++;
                                        $id = $rowCategories['n_category_id'];
                                        $category_title = $rowCategories['v_category_title'];

                                        if ($_SESSION['editCategoryId'] == $id) {
                                            echo "<option value='" . $id . "' selected=''>" . $category_title . " </option>";
                                        } else {
                                            echo "<option value='" . $id . "'> " . $category_title . " </option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- Image -->
                        <div class="row mb-3">
                            <label for="image" class="col-sm-2 col-form-label">Update Main Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="main-image" name="main-image">
                                <?php
                                if (!empty($mainImgUrl)) {
                                    echo "<p style='font-size:inherit;'><a href='' data-bs-toggle='modal' data-bs-target='#existing-main-image' class='popup-button' style='margin-top: 10px;'>View Existing Image</a></p>";
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Alternate Image -->
                        <div class="row mb-3">
                            <label for="alternative-image" class="col-sm-2 col-form-label">Update Alternate Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="alternate-image" name="alternate-image">
                                <?php
                                if (!empty($altImgUrl)) {
                                    echo "<p style='font-size:inherit;'><a href='' data-bs-toggle='modal' data-bs-target='#existing-alt-image' class='popup-button' style='margin-top: 10px;'>View Existing Image</a></p>";
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Summary -->
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Summary</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" style="height: 100px" name="blog-summary" required><?php echo $_SESSION['editSummary']; ?></textarea>
                            </div>
                        </div>

                        <!-- Blog Content -->
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-10 col-form-label">Blog Content</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="summernote" style="height: 400px; widht: 100%" name="blog-content" required><?php echo $_SESSION['editContent']; ?></textarea>
                            </div>
                        </div>

                        <!-- Blog Tags -->
                        <div class="row mb-3">
                            <label for="blog-tag" class="col-sm-5 col-form-label">Blog Tags <strong>(separated by comma)</strong></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="blog-tags" value="<?php echo $_SESSION['editTags']; ?>">
                            </div>
                        </div>

                        <!-- Blog Path -->
                        <div class="input-group mb-3">
                            <label for="blog-path" class="col-sm-2 col-form-label">Blog Path</label>
                            <span class="input-group-text" id="basic-addon3">www.example.com/</span>
                            <input type="text" class="form-control" id="basic-url" name="blog-path" aria-describedby="basic-addon3" value="<?php echo $_SESSION['editPath']; ?>" required>
                        </div>

                        <!-- Date -->
                        <!-- <div class="row mb-3">
                <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control">
                </div> -->
                        <!-- Time -->
                        <!-- <div class="row mb-3"> -->
                        <!-- <label for="inputTime" class="col-sm-1 col-form-label">Time</label>
                    <div class="col-sm-3">
                    <input type="time" class="form-control">
                    </div>
                </div> -->

                        <!-- Home Page Placement -->
                        <fieldset class="row mb-3" required>
                            <legend class="col-form-label col-sm-3 pt-0">Home Page Placement</legend>
                            <div class="col">
                                <!-- <div class="form-check"> -->
                                <input type="radio" class="form-check-input" name="radio-btn" value="1" <?php if (isset($_SESSION['editHomePagePlacement'])) {
                                                                                                            if ($_SESSION['editHomePagePlacement'] == 1) {
                                                                                                                echo "checked=''";
                                                                                                            }
                                                                                                        } ?>> 1 &nbsp;
                                <!-- </div> -->
                                <!-- <div class="form-check"> -->
                                <input type="radio" class="form-check-input" name="radio-btn" value="2" <?php if (isset($_SESSION['editHomePagePlacement'])) {
                                                                                                            if ($_SESSION['editHomePagePlacement'] == 2) {
                                                                                                                echo "checked=''";
                                                                                                            }
                                                                                                        } ?>> 2 &nbsp;
                                <!-- </div> -->
                                <!-- <div class="form-check"> -->
                                <input type="radio" class="form-check-input" name="radio-btn" value="3" <?php if (isset($_SESSION['editHomePagePlacement'])) {
                                                                                                            if ($_SESSION['editHomePagePlacement'] == 3) {
                                                                                                                echo "checked=''";
                                                                                                            }
                                                                                                        } ?>> 3 &nbsp;
                                <!-- </div> -->
                            </div>
                        </fieldset>

                        <!-- <div class="row mb-3">
                  <legend class="col-form-label col-sm-2 pt-0">Checkboxes</legend>
                  <div class="col-sm-10">

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1">
                      <label class="form-check-label" for="gridCheck1">
                        Example checkbox
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck2" checked>
                      <label class="form-check-label" for="gridCheck2">
                        Example checkbox 2
                      </label>
                    </div>

                  </div>
                </div>
                

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Multi Select</label>
                  <div class="col-sm-10">
                    <select class="form-select" multiple aria-label="multiple select example">
                      <option selected>Open this select menu</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                  </div>
                </div> -->

                        <div class="row mb-3">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name='update-blog'>Update Blog</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <!-- <button type="button" class="btn btn-danger">Close</button> -->
                            </div>
                        </div>
                        <?php
                        if (!empty($mainImgUrl)) {
                        ?>
                            <!-- <form method="POST" action="includes/delete-blog-post.php"> -->
                            <div class="modal fade" id="existing-main-image" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Main Image</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="<?php echo $mainImgUrl; ?>" style="max-width: 100%; height: auto;" />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <!-- <button type="submit" class="btn btn-danger" name="delete-blog-post-btn">Delete</button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </form> -->
                        <?php
                        }
                        ?>
                        <?php
                        if (!empty($altImgUrl)) {
                        ?>
                            <!-- <form method="POST" action="includes/delete-blog-post.php"> -->
                            <div class="modal fade" id="existing-alt-image" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Alternate Image</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="<?php echo $altImgUrl; ?>" style="max-width: 100%; height: auto;" />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <!-- <button type="submit" class="btn btn-danger" name="delete-blog-post-btn">Delete</button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- </form> -->
                        <?php } ?>
                    </form><!-- End General Form Elements -->
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include "footer.php"; ?>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.min.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <!-- SummerNote API -->
    <script src="summernote/summernote.min.js"> </script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                minHeight: null,
                maxHeight: null,
                focus: false
            });
        });
    </script>


    <!-- <script>
        // function validateImage() {
        //     var main_img = $("#main-image").val();
        //     var alt_img = $("#alternate-image").val();

        //     var exts = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];

        //     var get_ext_main_img = main_img.split('.');
        //     var get_ext_alt_img = alt_img.split('.');

        //     get_ext_main_img = get_ext_main_img.reverse();
        //     get_ext_alt_img = get_ext_alt_img.reverse();

        //     var main_image_check = false;
        //     var alt_image_check = false;

        //     if (main_img.length > 0) {
        //         if ($.inArray(get_ext_main_img[0].toLowerCase(), exts) >= -1) {
        //             main_image_check = true;
        //         } else {
        //             alert("Error -> Main Image. Upload only jpg, jpeg, png, gif, bmp");
        //             main_image_check = false;
        //         }
        //     } else {
        //         // alert("Error -> Please upload a main image.");
        //         main_image_check = true;
        //     }

        //     if (alt_img.length > 0) {
        //         if ($.inArray(get_ext_alt_img[0].toLowerCase(), exts) >= -1) {
        //             alt_image_check = true;
        //         } else {
        //             alert("Error -> Alternate Image. Upload only jpg, jpeg, png, gif, bmp");
        //             alt_image_check = false;
        //         }
        //     } else {
        //         // alert("Error -> Please upload a Alternate image.");
        //         alt_image_check = true;
        //     }

        //     if (main_image_check == true && alt_image_check == true) {
        //         return true;
        //     } else {
        //         return false;
        //     }

        // }
    </script> -->

</body>

</html>