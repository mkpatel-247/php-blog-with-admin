<?php
require "includes/dbConnection.php";
include "includes/unset-sessions.php";
$sqlCategories = "SELECT * FROM blog_category";
$queryCategories = mysqli_query($conn, $sqlCategories);
$numCategories = mysqli_num_rows($queryCategories);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Blog Categories - Blog Dashboard</title>
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
      <h1>Blog Categories</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Blog</li>
          <li class="breadcrumb-item active">Blog Categories</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg">
          <?php
          if (isset($_REQUEST['addcategory'])) {
            if ($_REQUEST['addcategory'] == "success") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <i class='bi bi-check-circle me-1'></i>
                  <strong>Success</strong> Category added.
                <form method='POST' action='includes/delete-category.php'>
                  <button type='submit' name='button-close' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </form>
              </div>";
            } else if ($_REQUEST['addcategory'] == "error") {
              echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <i class='bi bi-exclamation-triangle me-1'></i>
                  <strong>Error!</strong> Category not added.
                <form method='POST' action='includes/delete-category.php'>
                  <button type='submit' name='button-close' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </form>
              </div>";
            }
          } else if (isset($_REQUEST['update-category'])) {
            if ($_REQUEST['update-category'] == "success") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <i class='bi bi-check-circle me-1'></i>
                  <strong>Success</strong> Category Updated.
                  <form method='POST' action='includes/delete-category.php'>
                    <button type='submit' name='button-close' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </form>
              </div>";
            } else if ($_REQUEST['update-category'] == "error") {
              echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <i class='bi bi-exclamation-triangle me-1'></i>
                  <strong>Error!</strong> Category is not Updated.
                  <form method='POST' action='includes/delete-category.php'>
                    <button type='submit' name='button-close' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </form>
              </div>";
            }
          } else if (isset($_REQUEST['delete-category'])) {
            if ($_REQUEST['delete-category'] == "success") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <i class='bi bi-check-circle me-1'></i>
                  <strong>Success</strong> Category Deleted.
                <form method='POST' action='includes/delete-category.php'>
                  <button type='submit' name='button-close' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </form>
              </div>";
            } else if ($_REQUEST['delete-category'] == "error") {
              echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <i class='bi bi-exclamation-triangle me-1'></i>
                  <strong>Error!</strong> Category is not Deleted.
                <form method='POST' action='includes/delete-category.php'>
                  <button type='submit' name='button-close' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </form>
              </div>";
            }
          }
          ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Category</h5>

              <!-- Vertical Form -->
              <form class="row g-3" method="POST" action="includes/add-category.php">
                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Category Name</label>
                  <input type="text" class="form-control" id="inputNanme4" name="category-name">
                </div>
                <div class="col-12">
                  <label for="meta-tags" class="form-label">Meta Title</label>
                  <input type="text" class="form-control" id="meta-tags" name="category-meta-title">
                </div>
                <div class="col-12">
                  <label for="category-path" class="form-label">Category Path <strong>(lower case, no spaces)</strong></label>
                  <input type="text" class="form-control" id="category-path" name="category-path">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="add-category-btn">Add Category</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">All Categories</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Blog Categories</th>
                    <th scope="col">Meta Title</th>
                    <th scope="col">Category Path</th>
                    <th scope="col">Edit Date</th>
                    <th scope="col">Edit time</th>
                    <th scope="col">Operation</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $counter = 0;

                  while ($rowCategories = mysqli_fetch_assoc($queryCategories)) {

                    $counter++;

                    $id = $rowCategories['n_category_id'];
                    $category_title = $rowCategories['v_category_title'];
                    $category_meta_title = $rowCategories['v_category_meta_title'];
                    $categoryPath = $rowCategories['v_category_path'];

                    $date = $rowCategories['d_date_created'];
                    $time = $rowCategories['d_time_created'];

                  ?>
                    <tr class="table-light">
                      <th scope="row"><?php echo $counter ?></th>
                      <td><?php echo $category_title ?></td>
                      <td><?php echo $category_meta_title ?></td>
                      <td><?php echo $categoryPath ?></td>
                      <td><?php echo $date ?></td>
                      <td><?php echo $time ?></td>
                      <td>
                        <button class="btn btn-info btn-sm popup-button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View" onclick="window.open('../categories.php?group=<?php echo $categoryPath; ?>', '_blank');">
                          <i class="bi bi-info-circle"></i>
                        </button>
                        <span data-bs-toggle="modal" data-bs-target="#update<?php echo $id ?>">
                          <button type="button" class="btn btn-primary btn-sm popup-button" data-bs-toggle="tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Update">
                            <i class="bx bx-edit-alt"></i>
                          </button>
                        </span>
                        <span data-bs-toggle="modal" data-bs-target="#delete<?php echo $id ?>">
                          <button type="submit" class="btn btn-danger btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
                            <i class="bi bi-trash"></i>
                          </button>
                        </span>
                      </td>
                      <!-- Update Category Menu -->
                      <form method="POST" action="includes/update-category.php">
                        <div class="modal fade" id="update<?php echo $id ?>" tabindex="-1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Update Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body row g-3">
                                <input type="hidden" name="update-category-id" value="<?php echo $id; ?>">
                                <!-- Field for Update Category Name -->
                                <div class="col-12">
                                  <label for="inputNanme4" class="form-label">Category Name</label>
                                  <input type="text" class="form-control" id="inputNanme4" name="update-category-name" value="<?php echo $category_title ?>">
                                </div>
                                <!-- Field for Update Meta Title -->
                                <div class="col-12">
                                  <label for="meta-tags" class="form-label">Meta Title</label>
                                  <input type="text" class="form-control" id="meta-tags" name="update-category-meta-title" value="<?php echo $category_meta_title ?>">
                                </div>
                                <!-- Field for Udpate Category Path -->
                                <div class="col-12">
                                  <label for="category-path" class="form-label">Category Path <strong>(lower case, no spaces)</strong></label>
                                  <input type="text" class="form-control" id="category-path" name="update-category-path" value="<?php echo $categoryPath ?>">
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="update-category-btn">Save changes</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                      <!-- End of Update Category Menu -->

                      <!-- Delete Category Menu -->
                      <form method="POST" action="includes/delete-category.php">
                        <div class="modal fade" id="delete<?php echo $id ?>" tabindex="-1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Delete Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <input type="hidden" name="delete-category-id" value="<?php echo $id; ?>">
                                <!-- Field for Update Category Name -->
                                Are you sure you want to delete <strong><?php echo $category_title; ?></strong> Category ?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger" name="delete-category-btn">Delete</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                      <!-- End of field Delete Category Menu -->
                    </tr>

                  <?php
                  }
                  ?>
                </tbody>
              </table>
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