<table class='table table-bordered'>
    <thead>
        <tr>
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
            
            if (isset($_GET['post_id'])) {
                $post_id = escape_string($_GET['post_id']);
                $comments = select_comments_for_post($post_id);
            } else {
                echo "<h1>NO post_id</h1>";
                // header("Location: ./view_post_comments.php");
            }
            
            while ($comments_row = mysqli_fetch_assoc($comments)) {
                $comment_id = $comments_row['comment_id'];
                $comment_author = $comments_row['comment_author'];
                $comment_email = $comments_row['comment_email'];
                $comment_content = $comments_row['comment_content'];
                $comment_status = $comments_row['comment_status'];
                $comment_date = $comments_row['comment_date'];

                

        ?>

                <tr>
                    <td><?php echo $comment_author ?></td>
                    <td><?php echo $comment_email ?></td>
                    <td><?php echo $comment_content ?></td>
                    <td><?php echo $comment_date ?></td>
                    <td><?php echo $comment_status ?></td>
                    <td>
                        <a href="view_post_comments.php?post_id=<?php echo $post_id ?>&approve=<?php echo $comment_id ?>" class='mb-2 d-block'>Approve</a>
                        <a href="view_post_comments.php?post_id=<?php echo $post_id ?>&unapprove=<?php echo $comment_id ?>" class='mb-2 d-block'>Unapprove</a>

                        <a href="view_post_comments.php?post_id=<?php echo $post_id ?>&delete_id=<?php echo $comment_id; ?>" class='text-danger d-block'>Delete</a>
                    </td>
                </tr>   

           <?php } ?>
    </tbody>
</table>