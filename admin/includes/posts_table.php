<table class='table table-bordered'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Content</th>
            <th>Author</th>
            <th>Image</th>
            <th>Date</th>
            <th>Comments</th>
            <th>Tags</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $get_posts_query = "SELECT * FROM posts";
            $get_posts_result = mysqli_query($connection, $get_posts_query);

            if (!$get_posts_result) {
                die("Failed to load posts" . mysqli_error($connection));
            }
            while($row = mysqli_fetch_assoc($get_posts_result)){
                    $post_id = $row['post_id'];
                    $post_title = shorten_string($row['post_title'], 30);
                    $post_content = shorten_string($row['post_content'], 30);
                    
                ?>
                <tr>
                    <td><?php echo $post_id ?></td>
                    <td><?php echo $post_title ?></td>
                    <td><?php echo $post_content ?></td>
                    <td><?php echo $row['post_author'] ?></td>
                    <td>
                        <img width='100' style='max-height: 100px;' src="../images/<?php echo $row['post_image']?>" alt="image">
                    </td>
                    <td><?php echo $row['post_date'] ?></td>
                    <td><?php echo $row['post_comment_count'] ?></td>
                    <td><?php echo $row['post_tags'] ?></td>
                    <td><?php echo $row['post_status'] ?></td>
                    <td>
                        <a href="view_all_posts.php?source=edit_post&post_id=<?php echo $post_id ?>" class='mb-2 d-block'>Edit</a>
                        <a href="view_all_posts.php?delete_id=<?php echo $post_id; ?>" class='text-danger d-block'>Delete</a>
                    </td>
                </tr>
            <?php } ?>
    </tbody>
</table>