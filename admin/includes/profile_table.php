<?php
    extract($_SESSION['user']);
?>
<table class='table table-bordered'>
    <thead>
        <tr>
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
        <tr>
            <td><?php echo $db_username ?></td>
            <td><?php echo $db_password ?></td>
            <td><?php echo $db_firstname ?></td>
            <td><?php echo $db_lastname ?></td>
            <td><?php echo $db_email ?></td>
            <td>
                <img width='100' style='max-height: 100px;' src="../images/<?php echo ''?>" alt="<?php echo $db_username ?> image">
            </td>
            <td><?php echo $db_user_role ?></td>
            <td>
                <a href="profile.php?source=edit_profile" class='mb-2 d-block'>Edit</a>
                
            </td>
        </tr>
    </tbody>
</table>