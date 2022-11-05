<?php

require "dbConnection.php";
session_start();

date_default_timezone_set('Asia/Kolkata');

if (isset($_POST['save-draft'])) {

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

    $sqlCheckTitle = "SELECT v_post_title FROM blog_post_master WHERE v_post_title = '$blog_title' AND f_post_status != '2'";
    $queryCheckTitle = mysqli_query($conn, $sqlCheckTitle);

    $sqlCheckPath = "SELECT v_post_path FROM blog_post_master WHERE v_post_path = '$blog_path' AND f_post_status != '2'";
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

    $mainImgURL = uploadImageI($_FILES["main-image"]["name"], "main-image", "main");
    $altImgURL = uploadImageI($_FILES["alternate-image"]["name"], "alternate-image", "alt");

    $sqlInsertBlog = "INSERT INTO blog_post_master (n_category_id, v_post_title, v_post_meta_title, v_post_path, v_post_summary, v_post_content, v_main_image_url, v_alternate_image_url, n_home_page_placement, f_post_status, d_date_created, d_time_created) VALUES ('$blog_category', '$blog_title', '$blog_meta_title', '$blog_path', '$blog_summary', '$blog_content', '$mainImgURL', '$altImgURL', '$blog_hpp', '1', '$date', '$time')";

    if (mysqli_query($conn, $sqlInsertBlog)) {

        $blogPostId = mysqli_insert_id($conn);
        $sqlInsertTags = "INSERT INTO blog_tags (n_blog_post_id, v_tag) VALUES ('$blogPostId', '$blog_tags')";

        if (mysqli_query($conn, $sqlInsertTags)) {
            mysqli_close($conn);

            unset($_SESSION['blogTitle']);
            unset($_SESSION['blogMetaTitle']);
            unset($_SESSION['blogCategory']);
            unset($_SESSION['blogSummary']);
            unset($_SESSION['blogContent']);
            unset($_SESSION['blogTags']);
            unset($_SESSION['blogPath']);
            unset($_SESSION['blogHPP']);

            //WARNING added by me
            // $sqlWarnath = "SELECT v_post_path FROM blog_post_master WHERE v_post_path = '$blog_path'";
            // $queryWarnPath = mysqli_query($conn, $sqlCheckPath);

            // if(mysqli_num_rows($queryWarnPath) > 0){
            //     header("Location: ../blog-post.php?addblog=success_warningpath");
            // }
            header("Location: ../blog-post.php?addblog=success");
            exit();
        } else {
            formError("sqlErrorTags");
        }
    } else {
        formError("sqlError");
    }
} else {
    header("Location: ../index.php");
    exit();
}

function formError($errorCode)
{

    require "dbConnection.php";
    $_SESSION['blogTitle'] = $_POST['blog-title'];
    $_SESSION['blogMetaTitle'] = $_POST['blog-meta-title'];
    $_SESSION['blogCategory'] = $_POST['blog-category'];
    $_SESSION['blogSummary'] = $_POST['blog-summary'];
    $_SESSION['blogContent'] = $_POST['blog-content'];
    $_SESSION['blogTags'] = $_POST['blog-tags'];
    $_SESSION['blogPath'] = $_POST['blog-path'];
    $_SESSION['blogHPP'] = $_POST['radio-btn']; //Home Page Placement

    mysqli_close($conn);

    header("Location: ../blog-editors.php?addblog=" . $errorCode);
    exit();
}

function uploadImageI($img, $imgName, $imgType)
{
    $imgURL = "";
    $validExt = array("jpg", "png", "jpeg", "bmp", "gif");

    if ($img == "") {
        formError("empty" . $imgType . "image");
    } else if ($_FILES[$imgName]["size"] <= 0) {
        formError($imgType . "imageError");
    } else {
        $ext = strtolower(end(explode(".", $img)));
        if (!in_array($ext, $validExt)) {
            formError("invalidtype" . $imgType . "image");
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
