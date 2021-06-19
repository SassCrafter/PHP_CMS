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
                            Categories
                            <small>Create category</small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-sm-6">
                        <?php create_category() ?>
                    <form action="" method='post'>
                        <div class="form-group">
                            <label for="#cat-title">Category Title</label>
                            <input type="text" id='cat-title' name='cat_title' class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name='submit' value='Add Category' class="btn btn-primary">
                        </div>
                    </form>

                    <?php
                        if (isset($_GET['edit'])) {
                            include_once "includes/edit_categories_form.php";
                        }
                    ?>
                </div>

                <div class="col-sm-6">
                    <h4 style='margin-top:0;'>Current Categories</h4>
                    <table class='table table-bordered table-hover'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php // Select all categories
                                $categories_rows = select_all_categories();
                                while($row = mysqli_fetch_assoc($categories_rows)) {
                                    echo "  
                                        <tr>
                                            <td>$row[cat_id]</td>
                                            <td>$row[cat_title]</td>
                                            <td>
                                                <a href='categories.php?delete=$row[cat_id]'>Delete</a>
                                                <a href='categories.php?edit=$row[cat_id]'>Edit</a>
                                            </td>
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
