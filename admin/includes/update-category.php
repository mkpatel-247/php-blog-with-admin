<?php

require "dbConnection.php";

date_default_timezone_set('Asia/Kolkata');

if(isset($_POST['update-category-btn'])){
    $id = $_POST['update-category-id'];
    
    $edit_category_title = $_POST['update-category-name'];
    $edit_category_meta_title = $_POST['update-category-meta-title'];
    $edit_category_path = $_POST['update-category-path'];
    $update_date = date('Y-m-d');
    $update_time = date('H:i:s');

    $sqlUpdateCategory = "UPDATE blog_category SET v_category_title='$edit_category_title', v_category_meta_title='$edit_category_meta_title', v_category_path='$edit_category_path', d_date_created='$update_date', d_time_created='$update_time' WHERE n_category_id = '$id'";

    if(mysqli_query($conn, $sqlUpdateCategory)) {
        mysqli_close($conn);
        header("Location: ../blog-categories.php?update-category=success");
        exit();
    }
    else{
        mysqli_close($conn);
        header("Location: ../blog-categories.php?update-category=error");
        exit();
    }

}
else{
    header("Location: ../index.php");
    exit();
}
