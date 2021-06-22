<?php include_once 'includes/header.php' ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include_once 'includes/navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small><?php echo $_SESSION['user']['db_firstname']; ?></small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                <?php include_once './includes/admin_widgets.php'; ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include_once 'includes/footer.php' ?>
