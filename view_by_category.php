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
                    if (isset($_GET['cat_id'])) {
                        $cat_id = $_GET['cat_id'];
                    }
                    $posts = select_post_by_category_id($cat_id);

                    if (mysqli_num_rows($posts) == 0) {
                        echo "<h2>No posts found!</h2>";
                    } else {
                        while($row = mysqli_fetch_assoc($posts)):?>
                        <?php
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];
                        ?>

                        <article class='mb-3'>
                            <h2>
                                <a href="./post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php"><?php echo $post_author ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                            <hr>
                            <img class="img-responsive" src="./images/<?php echo $post_image ?>" alt="">
                            <hr>
                            <p><?php echo shorten_string($post_content, 150) ?></p>
                            <a class="btn btn-primary" href="./post.php?post_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                        </article>

                    <?php endwhile; } ?>

                    
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include_once 'includes/sidebar.php' ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include_once "includes/footer.php" ?>
