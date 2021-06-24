<?php include_once 'db.php' ?>
<?php session_start(); ?>


<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./index.php">Blog</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php 
                        $categories_query = 'SELECT * FROM categories LIMIT 6';
                        $categories = mysqli_query($connection, $categories_query);

                        while($row = mysqli_fetch_assoc($categories)) {
                            echo "<li><a href='./view_by_category.php?cat_id=$row[cat_id]'>$row[cat_title]</a></li>";
                        }
                    ?>

                    <!-- Edit post if admin -->
                    <?php
                        if (isset($_SESSION['user']) && $_SESSION['user']['db_user_role'] === 'admin') {
                            echo "
                                <li>
                                    <a href='./admin/index.php'>Admin</a>
                                </li>
                            ";
                            if (isset($_GET['post_id'])) {
                                echo "
                                    <li>
                                        <a href='./admin/view_all_posts.php?source=edit_post&post_id=$_GET[post_id]'>Edit Post</a>
                                    </li>
                                ";
                            }
                        }
                    ?>
                    <?php
                        if(!isset($_SESSION['user'])) {
                            echo "
                                <li>
                                    <a href='./signup.php'>Signup</a>
                                </li>
                            ";
                        } else {
                            echo "
                                <li>
                                    <a href='./includes/logout.php'>Logout</a>
                                </li>
                            ";
                        }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>