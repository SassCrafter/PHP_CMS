<?php include_once 'includes/header.php' ?>
<?php delete_post() ?>
<?php reset_post_views_count(); ?>


    <div id="wrapper">

        <!-- Navigation -->
        <?php include_once 'includes/navigation.php' ?>
        <?php
            if (isset($_GET['user_id'])) {
                $user_result = select_user_by_id($_GET['user_id']);
                $user_row = mysqli_fetch_array($user_result);
                $username = isset($user_row['username']) ? $user_row['username'] : '';
            } else {
                header("Location: ./view_all_posts.php");
            }
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php echo $username ?>'s
                            <small>Posts</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                    

                <div class="row">
                    <div class="col-lg-12">
<?php include_once './includes/posts_table.php'?>
                    </div>
                </div>  

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include_once 'includes/footer.php' ?>
