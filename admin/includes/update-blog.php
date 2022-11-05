<!-- Till i feels in this code there is bug in title and path section -->
<?php

require "dbConnection.php";
session_start();

date_default_timezone_set('Asia/Kolkata');

if (isset($_POST['update-blog'])) {

    $blogId = $_POST['blog-id'];
    $blog_title = $_POST['blog-title'];
    $blog_meta_title = $_POST['blog-meta-title'];
    $blog_category = $_POST['blog-category'];
    $blog_summary = $_POST['blog-summary'];
    $blog_content = $_POST['blog-content'];
    $blog_tags = $_POST['blog-tags'];
    $blog_path = $_POST['blog-path'];
    $blog_hpp = $_POST['radio-btn']; //Home Page Placement

    $date = date('Y-m-d');
    $time = date('H:i:s');

    if (empty($blog_hpp)) {
        $blog_hpp = 0;
    }

    $sqlCheckTitle = "SELECT v_post_title FROM blog_post_master WHERE v_post_title = '$blog_title' AND v_post_title != '$blog_title' AND f_post_status != '2'";
    $queryCheckTitle = mysqli_query($conn, $sqlCheckTitle);

    $sqlCheckPath = "SELECT v_post_path FROM blog_post_master WHERE v_post_path = '$blog_path' AND v_post_path != '$blog_path' AND f_post_status != '2'";
    $queryCheckPath = mysqli_query($conn, $sqlCheckPath);

    if (mysqli_num_rows($queryCheckTitle) > 0) {
        formError("title_being_used");
    } else if (mysqli_num_rows($queryCheckPath) > 0) {
        formError("path_being_used");
    }



    $sqlCheck_HPP = "SELECT * FROM blog_post_master WHERE n_home_page_placement = '$blog_hpp' AND f_post_status != '2'";
    $queryCheck_HPP = mysqli_query($conn, $sqlCheck_HPP);

    if (mysqli_num_rows($queryCheck_HPP) > 0) {
        $sqlUpdate_HPP = "UPDATE blog_post_master SET n_home_page_placement = '0' WHERE n_home_page_placement='$blog_hpp' AND f_post_status != '2'";

        if (mysqli_query($conn, $sqlUpdate_HPP)) {
            formError("homepageplacementerror");
        }
    }

    $mainImgURL = uploadImage($_FILES["main-image"]["name"], "main-image", "main", "v_main_image_url");
    $altImgURL = uploadImage($_FILES["alternate-image"]["name"], "alternate-image", "alt", "v_alternate_image_url");

    if ($mainImgURL == "noupdate") {
        if ($altImgURL == "noupdate") {
            $sqlUpdateBlog = "UPDATE blog_post_master SET n_category_id = '$blog_category', v_post_title = '$blog_title', v_post_meta_title = '$blog_meta_title', v_post_path = '$blog_path', v_post_summary = '$blog_summary', v_post_content = '$blog_content', n_home_page_placement = '$blog_hpp', d_date_updated = '$date', d_time_updated = '$time' WHERE n_blog_post_id = '$blogId'";
        } else {
            $sqlUpdateBlog = "UPDATE blog_post_master SET n_category_id = '$blog_category', v_post_title = '$blog_title', v_post_meta_title = '$blog_meta_title', v_post_path = '$blog_path', v_post_summary = '$blog_summary', v_post_content = '$blog_content', v_alternate_image_url = '$altImgURL', n_home_page_placement = '$blog_hpp', d_date_updated = '$date', d_time_updated = '$time' WHERE n_blog_post_id = '$blogId'";
        }
    } else if ($altImgURL == "noupdate") {
        if ($mainImgURL != "noupdate") {
            $sqlUpdateBlog = "UPDATE blog_post_master SET n_category_id = '$blog_category', v_post_title = '$blog_title', v_post_meta_title = '$blog_meta_title', v_post_path = '$blog_path', v_post_summary = '$blog_summary', v_post_content = '$blog_content', v_main_img_url = '$mainImgURL', n_home_page_placement = '$blog_hpp', d_date_updated = '$date', d_time_updated = '$time' WHERE n_blog_post_id = '$blogId'";
        }
    } else {
        $sqlUpdateBlog = "UPDATE blog_post_master SET n_category_id = '$blog_category', v_post_title = '$blog_title', v_post_meta_title = '$blog_meta_title', v_post_path = '$blog_path', v_post_summary = '$blog_summary', v_post_content = '$blog_content', v_main_img_url = '$mainImgURL', v_alternate_image_url = '$altImgURL', n_home_page_placement = '$blog_hpp', d_date_updated = '$date', d_time_updated = '$time' WHERE n_blog_post_id = '$blogId'";
    }

    $sqlUpdateBlogTags = "UPDATE blog_tags SET v_tag = '$blog_tags' WHERE n_blog_post_id = '$blogId'";

    if (mysqli_query($conn, $sqlUpdateBlog) && mysqli_query($conn, $sqlUpdateBlogTags)) {
        formSuccess();

        //WARNING added by me
        // $sqlWarnath = "SELECT v_post_path FROM blog_post_master WHERE v_post_path = '$blog_path'";
        // $queryWarnPath = mysqli_query($conn, $sqlCheckPath);

        // if(mysqli_num_rows($queryWarnPath) > 0){
        //     header("Location: ../blog-post.php?addblog=success_warningpath");
        // }

    } else {
        formError("sqlError");
    }
} else {
    header("Location: ../index.php");
    exit();
}

function formSuccess()
{
    require "dbConnection.php";
    mysqli_close($conn);

    unset($_SESSION['editBlogId']);
    unset($_SESSION['editTitle']);
    unset($_SESSION['editMetaTitle']);
    unset($_SESSION['editCategoryId']);
    unset($_SESSION['editSummary']);
    unset($_SESSION['editContent']);
    unset($_SESSION['editPath']);
    unset($_SESSION['editTags']);
    unset($_SESSION['editHPP']);

    header("Location: ../blog-post.php?updateblog=success");
    exit();
}

function formError($errorCode)
{

    require "dbConnection.php";

    $_SESSION['editTitle'] = $_POST['blog-title'];
    $_SESSION['editMetaTitle'] = $_POST['blog-meta-title'];
    $_SESSION['editCategoryId'] = $_POST['blog-category'];
    $_SESSION['editSummary'] = $_POST['blog-summary'];
    $_SESSION['editContent'] = $_POST['blog-content'];
    $_SESSION['editTags'] = $_POST['blog-tags'];
    $_SESSION['editPath'] = $_POST['blog-path'];
    $_SESSION['editHPP'] = $_POST['radio-btn']; //Home Page Placement

    mysqli_close($conn);

    header("Location: ../edit-blog.php?updateblog=" . $errorCode);
    exit();
}

function uploadImage($img, $imgName, $imgType, $imgDbColumn)
{

    require "dbConnection.php";

    $imgURL = "";
    $validExt = array("jpg", "png", "jpeg", "bmp", "gif");

    if ($img == "") {
        return "noupdate";
    } else {
        if ($_FILES[$imgName]["size"] <= 0) {
            formError($imgType . "imageError");
        } else {
            $ext = strtolower(end(explode(".", $img)));
            if (!in_array($ext, $validExt)) {
                formError("invalidtype" . $imgType . "image");
            }

            // Delete existing Image
            $blogId = $_POST['blog-id'];
            $sqlGetOldImage = "SELECT " . $imgDbColumn . " FROM blog_post_master WHERE n_blog_post_id = '$blogId'";
            $queryGetOldImage = mysqli_query($conn, $sqlGetOldImage);

            if ($rowGetOldImage = mysqli_fetch_assoc($queryGetOldImage)) {
                $oldImgURL = $rowGetOldImage[$imgDbColumn];
            }

            if (!empty($oldImgURL)) {
                $oldImgURLArray = explode("/", $oldImgURL);
                $oldImgName = end($oldImgURLArray);
                $oldImgPath = "../images/blog-images/" . $oldImgName;
                unlink($oldImgPath);
            }

            $folder = "../images/blog-images/";
            $imgNewName = rand(10000, 990000) . '_' . time() . '.' . $ext;
            $imgPath = $folder . $imgNewName;

            if (move_uploaded_file($_FILES[$imgName]['tmp_name'], $imgPath)) {
                $imgURL = "http://localhost/Blog/admin/images/blog-images/" . $imgNewName;
            } else {
                formError("Error->ImageUploading..." . $imgType . "image");
            }
        }
        return $imgURL;
    }
}
