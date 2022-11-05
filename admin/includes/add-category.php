<?php

require "dbConnection.php";

date_default_timezone_set('Asia/Kolkata');

if(isset($_POST['add-category-btn'])){
    $category_name = $_POST['category-name'];
    $category_meta_title = $_POST['category-meta-title'];
    $category_path = $_POST['category-path'];
    $date = date('Y-m-d');
    $time = date('H:i:s');

    $sqlAddCategory = "INSERT INTO blog_category (v_category_title, v_category_meta_title, v_category_path, d_date_created, d_time_created) VALUES ('$category_name', '$category_meta_title', '$category_path', '$date', '$time')";

    if(mysqli_query($conn, $sqlAddCategory)){
        mysqli_close($conn);
        header("Location: ../blog-categories.php?addcategory=success");
        exit();
    }
    else{
        mysqli_close($conn);
        header("Location: ../blog-categories.php?addcategory=error");
    }
}
else{
    header("Location: ../index.php");
    exit();
}
