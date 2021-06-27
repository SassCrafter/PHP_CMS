<?php
    if (isset($_POST['checkboxArray'])) {
        $bulk_option = $_POST['bulk_options'];
        foreach($_POST['checkboxArray'] as $checkboxVal) {
            $query = null;
            switch($bulk_option) {
                case 'published':
                $query = "UPDATE posts SET post_status = 'published' WHERE post_id = $checkboxVal";
                break;
                case 'draft':
                $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = $checkboxVal";
                break;
                case 'delete':
                $query = "DELETE FROM posts WHERE post_id = $checkboxVal";
                break;
                case 'clone':
                $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_user_id, post_date, post_image, post_content, post_tags, post_comment_count, post_status ) SELECT post_category_id, post_title, post_author, post_user_id, post_date, post_image, post_content, post_tags, post_comment_count, post_status FROM posts WHERE post_id = $checkboxVal";
                break;
            }

            if ($query) {
                $result = mysqli_query($connection, $query);
                show_query_error($result);
            }
        }
    }

    if (isset($_GET['user_id'])) {
        $link_to_all_posts = "<a href='./view_all_posts.php' class='btn btn-link'>View all posts</a>";
    } else {
        $link_to_all_posts = NULL;
    }
?>

<form action="" method='post'>
<div class="row mb-2">
    <div class="col-xs-4">
        <select name="bulk_options" id="bulkOptionControl" class="form-control">
            <option value="">Select Option</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
        </select>
    </div>
    <div class="col-xs-8">
        <input type="submit" value="Apply" name='submit' class='btn btn-success'>
        <a href="./view_all_posts.php?source=add_post" class="btn btn-primary">Add New</a>
        <?php echo $link_to_all_posts ?>
    </div>
</div>
<table class='table table-bordered'>
    <thead>
        <tr>
            <th>
                <input type="checkbox" id='selectAllBoxes'>
            </th>
            <th>Title</th>
            <th>Content</th>
            <th>Category</th>
            <th>Author</th>
            <th>User</th>
            <th>Image</th>
            <th>Date</th>
            <th>Comments</th>
            <th>Tags</th>
            <th>Status</th>
            <th>Views</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if (isset($_GET['user_id'])) {
                $user_id = escape_string($_GET['user_id']);
                $get_posts_result = select_all_posts_by_user_id($user_id);
            } else {
                $get_posts_result = select_all_posts();
            }
            while($row = mysqli_fetch_assoc($get_posts_result)){
                    $post_id = escape_string($row['post_id']);
                    $post_title = shorten_string($row['post_title'], 30);
                    $post_content = shorten_string($row['post_content'], 30);
                    $post_category_id = $row['post_category_id'];
                    $post_views_count = $row['post_views_count'];

                    $user_created_result = select_user_by_id($row['post_user_id']);
                    $user_row = mysqli_fetch_array($user_created_result);
                    $user_created = isset($user_row['username']) ? $user_row['username'] : "Unknown";
                ?>
                <tr>
                    <td>
                        <input type="checkbox" class='selectBox' name="checkboxArray[]" value="<?php echo $post_id ?>">
                    </td>
                    <td>
                        <a href="../post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                    </td>
                    <td><?php echo $post_content ?></td>

                    <?php // Get category by id
                    $category_result = select_category_by_id($post_category_id);

                    while ($cat_row = mysqli_fetch_assoc($category_result)) {
                        $post_category = $cat_row['cat_title'];
                    }

                    ?>

                    <td><?php echo $post_category ?></td>


                    <td><?php echo $row['post_author'] ?></td>
                    <td>
                        <a href="./view_posts_by_user.php?user_id=<?php echo $row['post_user_id'] ?>"><?php echo $user_created ?></a>
                    </td>
                    <td>
                        <img width='100' style='max-height: 100px;' src="../images/<?php echo $row['post_image']?>" alt="image">
                    </td>
                    <td><?php echo $row['post_date'] ?></td>
                    <td>
                        <a href="./view_post_comments.php?post_id=<?php echo $post_id ?>"><?php echo count_comments_for_post($post_id); ?></a>
                    </td>
                    <td><?php echo $row['post_tags'] ?></td>
                    <td><?php echo $row['post_status'] ?></td>
                    <td><?php echo $row['post_views_count'] ?></td>
                    <td>
                        <a href="view_all_posts.php?source=edit_post&post_id=<?php echo $post_id ?>" class='mb-2 d-block'>Edit</a>

                        <a onClick="javascript: return confirm('Are you sure you want to reset views?');" href="view_posts_by_user.php?user_id=<?php echo $user_id ?>&reset_id=<?php echo $post_id; ?>" class='text-warning d-block mb-2'>Reset</a>

                        <a onClick="javascript: return confirm('Are you sure you want to delete?');" href="view_all_posts.php?delete_id=<?php echo $post_id; ?>" class='text-danger d-block'>Delete</a>

                    </td>
                </tr>
            <?php } ?>
    </tbody>
</table>
</form>

<script>
    const selectAllCheckbox = document.getElementById('selectAllBoxes');
    const postCheckboxes = document.querySelectorAll('.selectBox');
    
    selectAllBoxes.addEventListener('change', () => {
            postCheckboxes.forEach(el => {
                el.checked = !el.checked;
            });
    })
</script>