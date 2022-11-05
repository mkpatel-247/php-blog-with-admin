<?php
require "dbConnection.php";

if (isset($_POST['delete-blog-post-btn'])) {
    $id = $_POST['delete-blog-post-id'];
    $sqlDeleteBlogPost = "UPDATE blog_post_master SET f_post_status = '2' WHERE n_blog_post_id = '$id'";

    if (mysqli_query($conn, $sqlDeleteBlogPost)) {
        mysqli_close($conn);
        header("Location: ../blog-post.php?deleteblogpost=success");
        exit();
    } else {
        mysqli_close($conn);
        header("Location: ../blog-post.php?deleteblogpost=error");
        exit();
    }
}
else{
    header("Location: ../index.php");
    exit();
}
