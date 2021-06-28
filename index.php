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
                

                <!-- Posts -->

                <?php
                	if (is_admin_manager()) {
                        $posts = select_all_posts_per_page();
                        extract(prepare_page_posts(posts_quantity('all')));
                    } else {
                        $posts = select_posts_per_page();
                        extract(prepare_page_posts(posts_quantity()));
                    }
                    
                    if ($page_count == 0) {
                        echo "<h1>No posts available</h1>";
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
                ?>
                <?php $page_url = "./index.php" ?>
                <?php include_once './includes/pager.php' ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include_once 'includes/sidebar.php' ?>

            

        </div>
        <!-- /.row -->

        <hr>

<?php include_once "includes/footer.php" ?>
