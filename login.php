<?php
session_start();
if(isset($_SESSION['id']))
{
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login | 1TamilHD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>
<body>

   <?php
    include('datab.php');
    include('header.php');
   ?>
<div class="container mt-3">
    <div class="thd_register">
        <div class="reg_head text-center mt-5">
            <h3>Login</h3>
        </div>
        <div class="reg-body col-lg-4 col-xs-10 m-auto">
            
            <div class="form_sec_thd form-group mt-3">
                <label for="#email">Email</label>
                <input type="text" name="" id="email" class="form-control">
            </div>
            <div class="form_sec_thd form-group mt-3">
                <label for="#password">Password</label>
                <input type="password" name="" id="password" class="form-control">
            </div>
            
            <!-- <div class="row bot_test_thd">
                <div class="form_sec_thd form-group mt-3 col-5" >
                    <label for="#cpassword">Solve This Problem</label>
                    <input type="text" name="" id="cpassword" class="form-control" value="10+12" disabled>
                </div>
                <div class="form_sec_thd form-group mt-5 text-center col-1" >
                   <b>=</b> 
                </div>
                <div class="form_sec_thd form-group mt-3 col-6">
                    <label for="#cpassword">Enter Answer</label>
                    <input type="text" name="" id="cpassword" class="form-control">
                </div>
            </div> -->
            <div class="log_btn m-auto">
                <button class="btn btn-primary col-6 mt-4 w-100 mb-5" id="register">Login</button>

            </div>
        </div>
    </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(document).ready(function(){
    $("#register").click(function(){
        var email = $('#email').val();
        var password = $('#password').val();

        if(email == ''){
            Swal.fire('Please Fill Your Email!')
        }
        
        else if(password == ''){
            Swal.fire('Please Fill Your Password!')
        }
        
        else{
            var fd = new FormData();

            fd.append("email", email);
            fd.append("password", password);

            $.ajax({
                url: 'ajax/user_login.php',
                data: fd,
                type:'post',
                contentType: false,
                processData: false,
                success: function(response){
                    data = JSON.parse(response);
                    console.log(data);
                    if(data == 'Success'){
                            window.location = "upload.php";
                    }
                    else if(data == 'Inactive'){
                        Swal.fire(
                        'Oops!',
                        'Your Account Disabled!',
                        'info'
                        )
                    }
                    else{
                        Swal.fire(
                        'Errror!',
                        'Login Failed!',
                        'error'
                        )
                    }
                }
            });
        }
    });
    
  });
</script>
</body>

</html>

