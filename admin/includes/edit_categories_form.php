<form action="" method='post'>

                        <div class="form-group">
                            <label for="#cat-edit-title">Edit Title</label>
                            <?php
                            if(isset($_GET["edit"])) {
                                $edit_cat_id = $_GET["edit"];
                                $select_edit_cat_query = "SELECT * FROM categories WHERE cat_id = $edit_cat_id";
                                $select_edit_result = mysqli_query($connection, $select_edit_cat_query);

                                while($row = mysqli_fetch_assoc($select_edit_result)) {
                                    echo $row['cat_title'];
                                    ?>
                                    <input type='text' id='cat-edit-title' name='cat_edit_title' class='form-control' value="<?php if(isset($_GET["edit"])){echo $row['cat_title'];}?>">
                        <?php   }
                            }
                        ?>

                        <?php
                            // Edit category
                            if (isset($_POST['edit'])) {
                                // $new_title = $_POST['cat_edit_title'];
                                $new_title = mysqli_real_escape_string($connection, $_POST['cat_edit_title']);
                                $edit_query = "UPDATE categories SET cat_title = '$new_title' WHERE cat_id = $edit_cat_id";
                                $edit_result = mysqli_query($connection, $edit_query);
                                if(!$edit_result) {
                                    $error = mysqli_error($connection);
                                    // echo $edit_id;
                                    die($error);
                                }
                                header("Location: categories.php");
                            }
                        ?>
                        </div>
                        <div class="form-group">
                            <input type="submit" name='edit' value='Edit Category' class="btn btn-primary">
                        </div>
                    </form>