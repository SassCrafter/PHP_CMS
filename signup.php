<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    


    
 
    <!-- Page Content -->
    <div class="container">

    
<section id="login" style='min-height: 60vh;'>
    <?php
        if (isset($_POST['submit'])) {
            if (!check_form_fields_empty()) {
                create_user();
            } else {
                $msg = "Form fields can't be empty.";
                show_alert($msg, 'danger');
            }
        }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Signup</h1>
                    <form role="form" action="signup.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="firstname" class="sr-only">firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter Firstname">
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Lastname">
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
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
