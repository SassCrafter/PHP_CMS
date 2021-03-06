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
                            Profile
                            <small>Manage Profile</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
<?php
    $source = '';
    if (isset($_GET['source'])) {
        $source = escape_string($_GET['source']);
    }

    switch($source) {
        case 'edit_profile';
        include_once "./includes/edit_profile.php";
        break;

        default:
        include_once "includes/profile_table.php";
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
