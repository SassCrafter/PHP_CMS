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
                    $post_query = "SELECT * FROM posts";
                    $posts = mysqli_query($connection, $post_query);

                    while($row = mysqli_fetch_assoc($posts)):?>
                        <?php
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_content = $row['post_content'];
                        ?>

                        <article class='mb-3'>
                            <h2>
                                <a href="#"><?php echo $post_title ?></a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php"><?php echo $post_author ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                            <hr>
                            <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                            <hr>
                            <p><?php echo $post_content ?></p>
                            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                        </article>

                    <?php endwhile ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include_once 'includes/sidebar.php' ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include_once "includes/footer.php" ?>
