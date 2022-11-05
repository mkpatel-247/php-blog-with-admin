<?php

require "dbConnection.php";

if(isset($_POST['button-close'])){
    header("Location: ../blog-categories.php");
    exit();
}

if(isset($_POST['delete-category-btn'])){

    $id = $_POST['delete-category-id'];
    $sqlDeleteCategory = "DELETE FROM blog_category WHERE n_category_id = $id";

    if (mysqli_query($conn, $sqlDeleteCategory)) {
        mysqli_close($conn);
        header("Location: ../blog-categories.php?delete-category=success");
        exit();
    } else {
        mysqli_close($conn);
        header("Location: ../blog-categories.php?delete-category=error");
        exit();
    }
}
else{
    header("Location: ../index.php");
    exit();
}
