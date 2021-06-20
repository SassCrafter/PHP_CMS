<?php
    include_once "db.php";

    
?>

<div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method='POST'>
                        <div class="input-group">
                        <input type="text" name='search' class="form-control">
                        <span class="input-group-btn">
                        <button class="btn btn-default" name='submit' type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                    </form>
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <?php 
                        $categories_query = 'SELECT * FROM categories';
                        $categories = mysqli_query($connection, $categories_query);
                    ?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <?php
                            $counter = 0;
                            $cat_counter = 0;
                            $row_quantity = mysqli_num_rows($categories);
                            while($row = mysqli_fetch_assoc($categories)) {
                                if ($counter % 4 == 0) {
                                    $cat_counter = 0;
                                    echo "  
                                        <div class='col-md-5'>
                                            <ul class='list-unstyled'>
                                    ";
                                }
                                echo "<li><a href='./view_by_category.php?cat_id=$row[cat_id]'>$row[cat_title] </a></li>";
                               if ($cat_counter == 3 || $counter == $row_quantity - 1) {
                                echo "  
                                        </ul>
                                    </div>
                                ";
                               }
                                $counter++;
                                $cat_counter++;
                            }
                        ?>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"?>

            </div>




