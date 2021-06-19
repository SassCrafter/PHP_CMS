<?php include_once 'includes/header.php' ?>
<?php delete_category()?>


    <div id="wrapper">

        <!-- Navigation -->
        <?php include_once 'includes/navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Posts
                            <small>Manage posts</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
<?php
    $source = '';
    if (isset($_GET['source'])) {
        $source = $_GET['source'];
    }

    switch($source) {
        case 'add_post';
        include_once "includes/add_post.php";
        break;

        default:
        include_once "includes/posts_table.php";
        break;
    }
?>
                    </div>
                </div>  

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include_once 'includes/footer.php' ?>
