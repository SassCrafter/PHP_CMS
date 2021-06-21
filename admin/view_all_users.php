<?php include_once 'includes/header.php' ?>
<?php delete_user(); ?>



    <div id="wrapper">

        <!-- Navigation -->
        <?php include_once 'includes/navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Users
                            <small>Manage Users</small>
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
        case 'add_user';
        include_once "./includes/add_user.php";
        break;

        case 'edit_user';
        include_once "./includes/edit_user.php";
        break;

        default:
        include_once "includes/users_table.php";
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
