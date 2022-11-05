<?php

require "admin/includes/dbConnection.php";

?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>TechEbusy</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/styles.css">

    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>
    <script defer src="js/fontawesome/all.min.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">

</head>

<body id="top">


    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader"></div>
    </div>


    <!-- header
    ================================================== -->
    <?php include "header.php"; ?>
    <!-- hero
    ================================================== -->
    <section id="hero" class="s-hero">

        <div class="s-hero__slider">

            <?php
            $sqlGetFirstBlog = "SELECT * FROM blog_post_master INNER JOIN blog_category ON blog_post_master.n_category_id = blog_category.n_category_id WHERE n_home_page_placement = '1' AND f_post_status != '2' LIMIT 1";

            $queryGetFirstBlog = mysqli_query($conn, $sqlGetFirstBlog);
            if ($rowGetFirstBlog = mysqli_fetch_assoc($queryGetFirstBlog)) {
                $firstBlogCategory = $rowGetFirstBlog['v_category_title'];
                $firstBlogCategoryPath = $rowGetFirstBlog['v_category_path'];
                $firstBlogTitle = $rowGetFirstBlog['v_post_title'];
                $firstBlogPath = $rowGetFirstBlog['v_post_path'];
                $firstBlogMainImageURL = $rowGetFirstBlog['v_main_image_url'];
            ?>
                <div class="s-hero__slide">

                    <div class="s-hero__slide-bg" style="background-image: url('<?php echo $firstBlogMainImageURL; ?>');"></div>

                    <div class="row s-hero__slide-content animate-this">
                        <div class="column">
                            <div class="s-hero__slide-meta">
                                <span class="cat-links">
                                    <a href="category.php?group=<?php echo $firstBlogCategoryPath; ?>"><?php echo $firstBlogCategory; ?></a>
                                </span>
                                <span class="byline">
                                    Posted by
                                    <span class="author">
                                        <a href="#">Meet Patel</a>
                                    </span>
                                </span>
                            </div>
                            <h1 class="s-hero__slide-text">
                                <a href="single-blog.php?blog=<?php echo $firstBlogTitle; ?>">
                                    <?php echo $firstBlogTitle; ?>
                                </a>
                            </h1>
                        </div>
                    </div>

                </div> <!-- end s-hero__slide -->
            <?php
            }
            ?>


            <?php
            $sqlGetSecondBlog = "SELECT * FROM blog_post_master INNER JOIN blog_category ON blog_post_master.n_category_id = blog_category.n_category_id WHERE n_home_page_placement = '2' AND f_post_status != '2' LIMIT 1";

            $queryGetSecondBlog = mysqli_query($conn, $sqlGetSecondBlog);
            if ($rowGetSecondBlog = mysqli_fetch_assoc($queryGetSecondBlog)) {
                $secondBlogCategory = $rowGetSecondBlog['v_category_title'];
                $secondBlogCategoryPath = $rowGetSecondBlog['v_category_path'];
                $secondBlogTitle = $rowGetSecondBlog['v_post_title'];
                $secondBlogPath = $rowGetSecondBlog['v_post_path'];
                $secondBlogMainImageURL = $rowGetSecondBlog['v_main_image_url'];
            ?>
                <div class="s-hero__slide">

                    <div class="s-hero__slide-bg" style="background-image: url('<?php echo $secondBlogMainImageURL; ?>');"></div>

                    <div class="row s-hero__slide-content animate-this">
                        <div class="column">
                            <div class="s-hero__slide-meta">
                                <span class="cat-links">
                                    <a href="category.php?group=<?php echo $secondBlogCategoryPath; ?>"><?php echo $secondBlogCategory; ?></a>
                                </span>
                                <span class="byline">
                                    Posted by
                                    <span class="author">
                                        <a href="#">Meet Patel</a>
                                    </span>
                                </span>
                            </div>
                            <h1 class="s-hero__slide-text">
                                <a href="single-blog.php?blog=<?php echo $secondBlogTitle; ?>">
                                    <?php echo $secondBlogTitle; ?>
                                </a>
                            </h1>
                        </div>
                    </div>

                </div> <!-- end s-hero__slide -->
            <?php
            }
            ?>
            <?php
            $sqlGetThirdBlog = "SELECT * FROM blog_post_master INNER JOIN blog_category ON blog_post_master.n_category_id = blog_category.n_category_id WHERE n_home_page_placement = '3' AND f_post_status != '2' LIMIT 1";

            $queryGetThirdBlog = mysqli_query($conn, $sqlGetThirdBlog);
            if ($rowGetThirdBlog = mysqli_fetch_assoc($queryGetThirdBlog)) {
                $thirdBlogCategory = $rowGetThirdBlog['v_category_title'];
                $thirdBlogCategoryPath = $rowGetThirdBlog['v_category_path'];
                $thirdBlogTitle = $rowGetThirdBlog['v_post_title'];
                $thirdBlogPath = $rowGetThirdBlog['v_post_path'];
                $thirdBlogMainImageURL = $rowGetThirdBlog['v_main_image_url'];
            ?>
                <div class="s-hero__slide">

                    <div class="s-hero__slide-bg" style="background-image: url('<?php echo $thirdBlogMainImageURL; ?>');"></div>

                    <div class="row s-hero__slide-content animate-this">
                        <div class="column">
                            <div class="s-hero__slide-meta">
                                <span class="cat-links">
                                    <a href="category.php?group=<?php echo $thirdBlogCategoryPath; ?>"><?php echo $thirdBlogCategory; ?></a>
                                </span>
                                <span class="byline">
                                    Posted by
                                    <span class="author">
                                        <a href="#">Meet Patel</a>
                                    </span>
                                </span>
                            </div>
                            <h1 class="s-hero__slide-text">
                                <a href="single-blog.php?blog=<?php echo $thirdBlogTitle; ?>">
                                    <?php echo $thirdBlogTitle; ?>
                                </a>
                            </h1>
                        </div>
                    </div>

                </div> <!-- end s-hero__slide -->
            <?php
            }
            ?>
            <!-- end s-hero__slide -->

        </div> <!-- end s-hero__slider -->

        <div class="s-hero__social hide-on-mobile-small">
            <p>Follow</p>
            <span></span>
            <ul class="s-hero__social-icons">
                <li><a href="#0"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                <li><a href="#0"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#0"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="#0"><i class="fab fa-dribbble" aria-hidden="true"></i></a></li>
            </ul>
        </div> <!-- end s-hero__social -->

        <div class="nav-arrows s-hero__nav-arrows">
            <button class="s-hero__arrow-prev">
                <svg viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" width="15" height="15">
                    <path d="M1.5 7.5l4-4m-4 4l4 4m-4-4H14" stroke="currentColor"></path>
                </svg>
            </button>
            <button class="s-hero__arrow-next">
                <svg viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" width="15" height="15">
                    <path d="M13.5 7.5l-4-4m4 4l-4 4m4-4H1" stroke="currentColor"></path>
                </svg>
            </button>
        </div> <!-- end s-hero__arrows -->

    </section> <!-- end s-hero -->


    <!-- content
    ================================================== -->
    <section class="s-content s-content--no-top-padding">


        <!-- masonry
        ================================================== -->
        <div class="s-bricks">

            <div class="masonry">
                <div class="bricks-wrapper h-group">

                    <div class="grid-sizer"></div>

                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <?php
                    $sqlGetAllBlogs = "SELECT * FROM blog_post_master WHERE f_post_status = '1' ORDER BY n_blog_post_id DESC";
                    $queryGetAllBlogs = mysqli_query($conn, $sqlGetAllBlogs);

                    while ($rowGetAllBlogs = mysqli_fetch_assoc($queryGetAllBlogs)) {
                        $blogTitle = $rowGetAllBlogs['v_post_title'];
                        $blogPath = $rowGetAllBlogs['v_post_path'];
                        $blogSummary = $rowGetAllBlogs['v_post_summary'];
                        $blogAltImageUrl = $rowGetAllBlogs['v_alternate_image_url'];

                    ?>

                        <article class="brick entry" data-aos="fade-up">

                            <div class="entry__thumb">
                                <a href="single-blog.php?blog=<?php echo $blogPath; ?>" class="thumb-link">
                                    <img src="<?php echo $blogAltImageUrl; ?>" srcset="<?php echo $blogAltImageUrl; ?>" alt="">
                                </a>
                            </div> <!-- end entry__thumb -->

                            <div class="entry__text">
                                <div class="entry__header">
                                    <h1 class="entry__title"><a href="single-blog.php?blog=<?php echo $blogPath; ?>"><?php echo $blogTitle; ?></a></h1>

                                    <div class="entry__meta">
                                        <span class="byline">By:
                                            <span class='author'>
                                                <a href=" #">Meet Patel</a>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="entry__excerpt">
                                    <p>
                                        <?php echo $blogSummary; ?>
                                    </p>
                                </div>
                                <a class="entry__more-link" href="single-blog.php?blog=<?php echo $blogPath; ?>">Read Blog</a>
                            </div> <!-- end entry__text -->

                        </article> <!-- end article -->
                    <?php
                    }
                    ?>

                </div> <!-- end brick-wrapper -->

            </div> <!-- end masonry -->

            <div class="row">
                <div class="column large-12">
                    <nav class="pgn">
                        <ul>
                            <li>
                                <span class="pgn__prev" href="#0">
                                    Prev
                                </span>
                            </li>
                            <li><a class="pgn__num" href="#0">1</a></li>
                            <li><span class="pgn__num current">2</span></li>
                            <li><a class="pgn__num" href="#0">3</a></li>
                            <li><a class="pgn__num" href="#0">4</a></li>
                            <li><a class="pgn__num" href="#0">5</a></li>
                            <li><span class="pgn__num dots">…</span></li>
                            <li><a class="pgn__num" href="#0">8</a></li>
                            <li>
                                <span class="pgn__next" href="#0">
                                    Next
                                </span>
                            </li>
                        </ul>
                    </nav> <!-- end pgn -->
                </div> <!-- end column -->
            </div> <!-- end row -->

        </div> <!-- end s-bricks -->

    </section> <!-- end s-content -->


    <!-- footer
    ================================================== -->
    <footer class="s-footer">

        <div class="s-footer__main">

            <div class="row">

                <div class="column large-3 medium-6 tab-12 s-footer__info">

                    <h5>About Our Site</h5>

                    <p>
                        Lorem ipsum Ut velit dolor Ut labore id fugiat in ut
                        fugiat nostrud qui in dolore commodo eu magna Duis
                        cillum dolor officia esse mollit proident Excepteur
                        exercitation nulla. Lorem ipsum In reprehenderit
                        commodo aliqua irure.
                    </p>

                </div> <!-- end s-footer__info -->

                <div class="column large-2 medium-3 tab-6 s-footer__site-links">

                    <h5>Site Links</h5>

                    <ul>
                        <li><a href="#0">About Us</a></li>
                        <li><a href="#0">Blog</a></li>
                        <li><a href="#0">FAQ</a></li>
                        <li><a href="#0">Terms</a></li>
                        <li><a href="#0">Privacy Policy</a></li>
                    </ul>

                </div> <!-- end s-footer__site-links -->

                <div class="column large-2 medium-3 tab-6 s-footer__social-links">

                    <h5>Follow Us</h5>

                    <ul>
                        <li><a href="#0">Twitter</a></li>
                        <li><a href="#0">Facebook</a></li>
                        <li><a href="#0">Dribbble</a></li>
                        <li><a href="#0">Pinterest</a></li>
                        <li><a href="#0">Instagram</a></li>
                    </ul>

                </div> <!-- end s-footer__social links -->

                <div class="column large-3 medium-6 tab-12 s-footer__subscribe">

                    <h5>Sign Up for Newsletter</h5>

                    <p>Signup to get updates on articles, interviews and events.</p>

                    <div class="subscribe-form">

                        <form id="mc-form" class="group" novalidate="true">

                            <input type="email" value="" name="dEmail" class="email" id="mc-email" placeholder="Your Email Address" required="">

                            <input type="submit" name="subscribe" value="subscribe">

                            <label for="mc-email" class="subscribe-message"></label>

                        </form>

                    </div>

                </div> <!-- end s-footer__subscribe -->

            </div> <!-- end row -->

        </div> <!-- end s-footer__main -->

        <div class="s-footer__bottom">
            <div class="row">
                <div class="column">
                    <div class="ss-copyright">
                        <span>© Copyright Calvin 2020</span>
                        <span>Design by <a href="https://www.styleshout.com/">StyleShout</a></span>
                    </div> <!-- end ss-copyright -->
                </div>
            </div>

            <div class="ss-go-top">
                <a class="smoothscroll" title="Back to Top" href="#top">
                    <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" width="15" height="15">
                        <path d="M7.5 1.5l.354-.354L7.5.793l-.354.353.354.354zm-.354.354l4 4 .708-.708-4-4-.708.708zm0-.708l-4 4 .708.708 4-4-.708-.708zM7 1.5V14h1V1.5H7z" fill="currentColor"></path>
                    </svg>
                </a>
            </div> <!-- end ss-go-top -->
        </div> <!-- end s-footer__bottom -->

    </footer> <!-- end s-footer -->


    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.5.0.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

</body>

</html>