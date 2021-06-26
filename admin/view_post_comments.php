<?php include_once 'includes/header.php' ?>
<?php
    if(isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];
        $post_result = select_post_title_by_id($post_id);
        $post_title = mysqli_fetch_array($post_result)['post_title'];
    } else {
        header("Location: ./view_all_comments.php");
    }
    $header_url = "view_post_comments.php?post_id=$post_id";
?>
<?php delete_comment($header_url) ?>
<?php unapprove_comment($header_url) ?>
<?php approve_comment($header_url) ?>


    <div id="wrapper">

        <!-- Navigation -->
        <?php include_once 'includes/navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php echo $post_title; ?>
                            <small>Comments</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <?php include_once './includes/post_comments_table.php' ?>
                    </div>
                </div>  

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include_once 'includes/footer.php' ?>
