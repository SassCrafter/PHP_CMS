<table class='table table-bordered'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Post Title</th>
            <th>Author</th>
            <th>Email</th>
            <th>Comment</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
           
        </tr>
    </thead>
    <tbody>
        <?php
            $all_comments_result = select_all_comments_desc();
            
            while ($comments_row = mysqli_fetch_assoc($all_comments_result)) {
                $comment_id = $comments_row['comment_id'];
                $comment_post_id = $comments_row['comment_post_id'];
                $comment_author = $comments_row['comment_author'];
                $comment_email = $comments_row['comment_email'];
                $comment_content = $comments_row['comment_content'];
                $comment_status = $comments_row['comment_status'];
                $comment_date = $comments_row['comment_date'];

                // Relate comment to the post and get title
                $comment_post_result = select_post_by_id($comment_post_id);
                $comment_post_title = mysqli_fetch_assoc($comment_post_result)['post_title'];

        ?>

                <tr>
                    <td><?php echo $comment_id ?></td>
                    <td>
                        <a href="../post.php?post_id=<?php echo $comment_post_id ?>"><?php echo $comment_post_title ?></a>
                    </td>
                    <td><?php echo $comment_author ?></td>
                    <td><?php echo $comment_email ?></td>
                    <td><?php echo $comment_content ?></td>
                    <td><?php echo $comment_date ?></td>
                    <td><?php echo $comment_status ?></td>
                    <td>
                        <a href="view_all_comments.php?approve=<?php echo $comment_id ?>" class='mb-2 d-block'>Approve</a>
                        <a href="view_all_comments.php?unapprove=<?php echo $comment_id ?>" class='mb-2 d-block'>Unapprove</a>

                        <a href="view_all_comments.php?delete_id=<?php echo $comment_id; ?>" class='text-danger d-block'>Delete</a>
                    </td>
                </tr>   

           <?php } ?>
    </tbody>
</table>