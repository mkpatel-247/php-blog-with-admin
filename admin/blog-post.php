<?php

require "includes/dbConnection.php";
include "includes/unset-sessions.php";

$sqlBlogs = "SELECT * FROM blog_post_master WHERE f_post_status != '2'";
$queryBlogs = mysqli_query($conn, $sqlBlogs);
$numsBlogs = mysqli_num_rows($queryBlogs);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Blog Post - Blog Dashboard</title>
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
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include "header.php"; ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include "sidebar.php"; ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Blog Post</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Blog</li>
          <li class="breadcrumb-item active">Blog Post</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg">
          <?php
          if (isset($_REQUEST['addblog'])) {
            if ($_REQUEST['addblog'] == "success") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              <i class='bi bi-check-circle me-1'></i>
                <strong>New Blog Added!</strong>
              <form method='POST' action='blog-post.php'>
                <button type='submit' name='button-close' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </form>
            </div>";
            }
          }

          if (isset($_REQUEST['deleteblogpost'])) {
            if ($_REQUEST['deleteblogpost'] == "success") {
              echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
              <i class='bi bi-exclamation-triangle me-1'></i>
                <strong>Blog Post Deleted</strong>
              <form method='POST' action='blog-post.php'>
                <button type='submit' name='button-close' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </form>
            </div>";
            } else if ($_REQUEST['deleteblogpost'] == "error") {
              echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
              <i class='bi bi-info me-1'></i>
                <strong>Blog Post NOT Deleted</strong>
              <form method='POST' action='blog-post.php'>
                <button type='submit' name='button-close' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </form>
            </div>";
            }
          }

          if (isset($_REQUEST['updateblog'])) {
            if ($_REQUEST['updateblog'] == "success") {
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
          <div class="card">
            <div class="card-body">
              <h3 class="card-title">Posts</h3>
              <a href="recycle-page.php">
                <button type="button" class="btn btn-secondary" name="recycle-bin"><i class="bi bi-recycle me-1"></i> Recycle Bin</button>
              </a>
              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Blog Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Views</th>
                    <!-- <th scope="col">Comments</th> -->
                    <th scope="col">Blog Path</th>
                    <th scope="col">Option</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $counter = 0;
                  while ($rowBlogs = mysqli_fetch_assoc($queryBlogs)) {
                    $counter++;
                    $id = $rowBlogs['n_blog_post_id'];
                    $blogTitle = $rowBlogs['v_post_title'];
                    $categoryId = $rowBlogs['n_category_id'];
                    $Views = $rowBlogs['n_blog_post_views'];
                    // $postDate = $rowBlogs['d_date_created'];
                    $blogPath = $rowBlogs['v_post_path'];

                    $sqlGetCategoryName = "SELECT v_category_title FROM blog_category WHERE n_category_id = '$categoryId'";
                    $queryGetCategoryName = mysqli_query($conn, $sqlGetCategoryName);

                    if ($rowGetCategoryName = mysqli_fetch_assoc($queryGetCategoryName)) {
                      $categoryName = $rowGetCategoryName['v_category_title'];
                    }

                  ?>
                    <tr>
                      <th scope="row"><?php echo $counter ?></th>
                      <td><?php echo $blogTitle ?></td>
                      <td><?php echo $categoryName ?></td>
                      <td><?php echo $Views ?></td>
                      <td><?php echo $blogPath ?></td>
                      <td>

                        <button class="btn btn-info btn-sm popup-button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View" onclick="window.open('../single-blog.php?group=<?php echo $blogPath; ?>', '_blank');">
                          <i class="bi bi-info-circle"></i>
                        </button>

                        <button class="btn btn-primary btn-sm popup-button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Update" onclick="location.href = 'edit-blog.php?blogid=<?php echo $id; ?>'">
                          <i class="bx bx-edit-alt"></i>
                        </button>

                        <span data-bs-toggle="modal" data-bs-target="#delete<?php echo $id ?>">
                          <button type="submit" class="btn btn-danger btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
                            <i class="bi bi-trash"></i>
                          </button>
                        </span>
                      </td>
                      <!-- Delete Category Menu -->
                      <form method="POST" action="includes/delete-blog-post.php">
                        <div class="modal fade" id="delete<?php echo $id ?>" tabindex="-1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Delete Blog</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <input type="hidden" name="delete-blog-post-id" value="<?php echo $id; ?>">
                                <!-- Field for Update Category Name -->
                                Are you sure you want to delete <strong><?php echo $blogTitle; ?></strong> Blog Post ?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger" name="delete-blog-post-btn">Delete</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                      <!-- End of field Delete Category Menu -->
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              <!-- End Table with hoverable rows -->

            </div>
          </div>
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
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>