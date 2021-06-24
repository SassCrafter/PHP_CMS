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
                    if (isset($_GET['author_name'])) {
                        $author_name = $_GET['author_name'];
                        $posts = select_all_posts_by_author($author_name);

                        if (mysqli_num_rows($posts) == 0) {
                            echo "<h2>No posts found!</h2>";
                        } else {
                            while($row = mysqli_fetch_assoc($posts)){
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
                    }
                    ?>
                    
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include_once 'includes/sidebar.php' ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include_once "includes/footer.php" ?>
