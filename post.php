<?php
    include_once "./includes/db.php";
    include_once './includes/header.php';
?>
<?php
    if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
        $post_result = select_post_by_id($post_id);
        $post_row = mysqli_fetch_assoc($post_result);

        $post_title = $post_row['post_title'];
        $post_author = $post_row['post_author'];
        $post_date = $post_row['post_date'];
        $post_image = $post_row['post_image'];
        $post_content = $post_row['post_content'];
        $post_author = $post_row['post_author'];

        // Create Comment
        create_comment($post_id);

    } else {
        header("Location: index.php");
    }


?>

    <!-- Navigation -->
    <?php include_once './includes/navigation.php' ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-md-8" style='margin-bottom: 20px'>

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $post_title ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $post_author ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="./images/<?php echo $post_image ?>" alt="<?php echo $post_title ?>">

                <hr>

                <!-- Post Content -->
                <p><?php echo $post_content ?></p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method='post'>
                        <div class="form-group">
                            <label for="comment-author">Name</label>
                            <input class='form-control' type="text" name='comment_author' id='comment-author' required>
                        </div>
                        <div class="form-group">
                            <label for="comment-email">Email</label>
                            <input class='form-control' type="email" name='comment_email' id='comment-email' required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name='comment_content'></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name='submit_comment'>Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                   $post_comments = select_comments_by_post_and_approved($post_id);
                   while ($comment_row = mysqli_fetch_assoc($post_comments)) {
                        $comment_author = $comment_row['comment_author'];
                        $comment_date = $comment_row['comment_date'];
                        $comment_content = $comment_row['comment_content'];
                    ?>
                    <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author ?>
                                <small><?php echo $comment_date ?></small>
                            </h4>
                            <p><?php echo $comment_content ?></p>
                        </div>
                    </div>

                <?php } ?>

                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include_once './includes/sidebar.php' ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php include_once './includes/footer.php' ?>
