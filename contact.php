<?php
require "admin/includes/dbConnection.php";
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Contact - Calvin</title>
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
    <?php include "header-opaque.php"; ?>
    <!-- end s-header -->


    <!-- content
    ================================================== -->
    <section class="s-content">

        <div class="row">
            <div class="column large-12">

                <article class="s-content__entry">

                    <div class="s-content__media">
                        <img src="images/thumbs/contact/contact-1050.jpg" srcset="images/thumbs/contact/contact-2100.jpg 2100w, 
                                        images/thumbs/contact/contact-1050.jpg 1050w, 
                                        images/thumbs/contact/contact-525.jpg 525w" sizes="(max-width: 2100px) 100vw, 2100px" alt="">
                    </div> <!-- end s-content__media -->

                    <div class="s-content__entry-header">
                        <h1 class="s-content__title">Get In Touch With Us.</h1>
                    </div> <!-- end s-content__entry-header -->

                    <div class="s-content__primary">

                        <div class="s-content__page-content">

                            <p class="lead">
                                Lorem ipsum Deserunt est dolore Ut Excepteur nulla occaecat magna occaecat Excepteur nisi esse veniam
                                dolor consectetur minim qui nisi esse deserunt commodo ea enim ullamco non voluptate consectetur minim
                                aliquip Ut incididunt amet ut cupidatat.
                            </p>

                            <p>
                                Duis ex ad cupidatat tempor Excepteur cillum cupidatat fugiat nostrud cupidatat dolor sunt sint sit
                                nisi est eu exercitation incididunt adipisicing veniam velit id fugiat enim mollit amet anim veniam
                                dolor dolor irure velit commodo cillum sit nulla ullamco magna amet magna cupidatat qui labore cillum
                                sit in tempor veniam consequat non laborum adipisicing aliqua ea nisi sint ut quis proident ullamco
                                ut dolore culpa occaecat ut laboris in sit minim cupidatat ut dolor voluptate enim veniam consequat
                                occaecat fugiat in adipisicing in amet Ut nulla nisi non ut enim aliqua laborum mollit quis nostrud sed sed.
                            </p>

                            <br>

                            <div class="row block-large-1-2 block-tab-full s-content__blocks">
                                <div class="column">
                                    <h4>Where to Find Us</h4>
                                    <p>
                                        1600 Amphitheatre Parkway<br>
                                        Mountain View, CA<br>
                                        94043 US
                                    </p>
                                </div>

                                <div class="column">
                                    <h4>Contact Info</h4>
                                    <p>
                                        someone@yourdomain.com<br>
                                        info@yourdomain.com <br>
                                        Phone: (+63) 555 1212
                                    </p>
                                </div>
                            </div> <!-- end s-content__blocks -->

                            <form name="cForm" id="cForm" class="s-content__form" method="post" action="">
                                <fieldset>

                                    <div class="form-field">
                                        <input name="cName" type="text" id="cName" class="h-full-width h-remove-bottom" placeholder="Your Name" value="">
                                    </div>

                                    <div class="form-field">
                                        <input name="cEmail" type="text" id="cEmail" class="h-full-width h-remove-bottom" placeholder="Your Email" value="">
                                    </div>

                                    <div class="form-field">
                                        <input name="cWebsite" type="text" id="cWebsite" class="h-full-width h-remove-bottom" placeholder="Website" value="">
                                    </div>

                                    <div class="message form-field">
                                        <textarea name="cMessage" id="cMessage" class="h-full-width" placeholder="Your Message"></textarea>
                                    </div>

                                    <br>
                                    <button type="submit" class="submit btn btn--primary h-full-width">Submit</button>

                                </fieldset>
                            </form> <!-- end form -->

                        </div> <!-- end s-entry__page-content -->

                    </div> <!-- end s-content__primary -->
                </article> <!-- end entry -->

            </div> <!-- end column -->
        </div> <!-- end row -->

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