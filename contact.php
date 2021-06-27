<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


<?php

?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    


    
 
    <!-- Page Content -->
    <div class="container">

    
<section id="login" style='min-height: 60vh;'>
    <?php
     if (isset($_POST['contact'])) {
        if (!check_form_fields_empty()) {
            $email = escape_string($_POST['email']);
            $subject = escape_string($_POST['subject']);
            $message = escape_string($_POST['message']);

            $send_to = "dima17prohorenko@gmail.com";

            mail($send_to, $subject, $message);
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
                <h1>Contact</h1>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject">
                        </div>
                         <div class="form-group">
                            <label for="message" class="sr-only">Message</label>
                            <textarea name="message" id="message" cols="30" rows="5" placeholder="Enter your message" class="form-control"></textarea>
                        </div>
                
                        <input type="submit" name="contact" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Contact us">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
