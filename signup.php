<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    


    
 
    <!-- Page Content -->
    <div class="container">

    
<section id="login" style='min-height: 60vh;'>
    <?php
        $errors = signup_user();
        if (isset($errors)) {
            ['username' => $username_error, 'email' => $email_error, 'password' => $password_error] = $errors;
        }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Signup</h1>
                    <form role="form" action="signup.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter Firstname">
                        </div>
                        <div class="form-group">
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Lastname">
                        </div>
                        <div class="form-group">
                            <?php if(!empty($username_error)) show_error_msg($username_error); ?>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <?php if(!empty($email_error)) show_error_msg($email_error); ?>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <?php if(!empty($password_error)) show_error_msg($password_error); ?>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Signup">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
