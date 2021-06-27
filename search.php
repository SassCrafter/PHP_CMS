<?php
    include_once "includes/db.php";
    include_once "includes/header.php";
?>


    <!-- Navigation -->
    <?php include_once "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- Posts -->

                <?php

                    if (isset($_POST['submit'])) {
                        $search = escape_string($_POST['search']);
                        $search_query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                        $search_posts = mysqli_query($connection, $search_query);

                        if (!$search_posts) {
                            echo 'failed';
                            echo "<script>alert('Search Failed" . mysqli_error($connection) . "');</script>";
                        }
                        $row_count = mysqli_num_rows($search_posts);
                        
                        if ($row_count == 0) {
                            echo "<h1>No Results</h1>";
                        } else {

                            while($row = mysqli_fetch_assoc($search_posts)){
                                    $post_id = $row['post_id'];
                                    $post_title = $row['post_title'];
                                    $post_author = $row['post_author'];
                                    $post_date = $row['post_date'];
                                    $post_image = $row['post_image'];
                                    $post_content = $row['post_content'];

                                    include './includes/post_article.php';

                            }
                        }
                    } else {
                        header("Location: index.php");
                    } ?>


                    
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include_once 'includes/sidebar.php' ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include_once "includes/footer.php" ?>
