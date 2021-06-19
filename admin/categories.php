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
                            Categories
                            <small>Create category</small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-sm-6">
                    <form action="" class='form-floating'>
                        <div class="form-group">
                            <label for="#cat-title">Category Title</label>
                            <input type="text" id='cat-title' name='cat-title' class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name='submit' value='Add Category' class="btn btn-primary">
                        </div>
                    </form>
                </div>

                <div class="col-sm-6">
                    <h4 style='margin-top:0;'>Current Categories</h4>
                    <table class='table table-bordered table-hover'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $cat_query = 'SELECT * FROM categories';
                                $categories = mysqli_query($connection, $cat_query);

                                while($row = mysqli_fetch_assoc($categories)) {
                                    echo "  
                                        <tr>
                                            <td>$row[cat_id]</td>
                                            <td>$row[cat_title]</td>
                                        </tr>
                                    ";
                                }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
                </div>  

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include_once 'includes/footer.php' ?>
