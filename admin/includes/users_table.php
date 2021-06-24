<table class='table table-bordered'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Password</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $users_result = select_all_users();
            while($user_row = mysqli_fetch_assoc($users_result)){
                    $user_id = $user_row['user_id'];
                    $username = $user_row['username'];
                    $password = shorten_string($user_row['password'], 20);
                    $firstname = $user_row['firstname'];
                    $lastname = $user_row['lastname'];
                    $email = $user_row['email'];
                    $user_image = $user_row['user_image'];
                    $user_role = $user_row['user_role'];
                    
                ?>
                <tr>
                    <td><?php echo $user_id ?></td>
                    <td><?php echo $username ?></td>
                    <td><?php echo $password ?></td>
                    <td><?php echo $firstname ?></td>
                    <td><?php echo $lastname ?></td>
                    <td><?php echo $email ?></td>
                    <td>
                        <img width='100' style='max-height: 100px;' src="../images/<?php echo $user_image?>" alt="<?php echo $username ?> image">
                    </td>
                    <td><?php echo $user_role ?></td>
                    <td>
                        <a href="view_all_users.php?source=edit_user&user_id=<?php echo $user_id ?>" class='mb-2 d-block'>Edit</a>
                        <a onClick="javascript: return confirm('Are you sure you want to delete?');" href="view_all_users.php?delete_id=<?php echo $user_id; ?>" class='text-danger d-block'>Delete</a>
                    </td>
                </tr>
            <?php } ?>
    </tbody>
</table>