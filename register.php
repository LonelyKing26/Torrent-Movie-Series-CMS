<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register | 1TamilHD</title>
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
include('header.php');?>
<div class="container mt-3">
    <div class="thd_register">
        <div class="reg_head text-center mt-3">
            <h3>Register New Account</h3>
        </div>
        <div class="reg-body col-lg-4 col-xs-10 m-auto">
            <div class="form_sec_thd form-group mt-3">
                <label for="#name">Name</label>
                <input type="text" name="" id="name" class="form-control" required>
            </div>
            <div class="form_sec_thd form-group mt-3">
                <label for="#email">Email</label>
                <input type="email" name="" id="email" class="form-control">
            </div>
            <div class="form_sec_thd form-group mt-3">
                <label for="#password">Password</label>
                <input type="password" name="" id="password" class="form-control">
            </div>
            <div class="form_sec_thd form-group mt-3">
                <label for="#cpassword">Confirm Password</label>
                <input type="password" name="" id="cpassword" class="form-control">
                <div id="pass_same"></div>
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
            <button class="btn btn-primary mt-4 w-100 mb-5" id="register">Register</button>
        </div>
    </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function(){
    $("#cpassword").keyup('keydown', function(){
        
        var password = $("#password").val();
        var cpassword = $("#cpassword").val();
        if(password != cpassword){
            $("#pass_same").html('Password Not Match!').css("color", "red");
        }
        else if(password == cpassword){
            $("#pass_same").html('Password are same!').css("color", "green");
        }
       
    })
    $("#register").click(function(){
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var cpassword = $('#cpassword').val();

        if(name == ''){
            Swal.fire('Please Fill Your name!')
        }
        else if(email == ''){
            Swal.fire('Please Fill Your Email!')
        }
        else if(password == ''){
            Swal.fire('Please Fill Your Password!')
        }
        else if(cpassword == ''){
            Swal.fire('Please Fill Your Confirm Password!')
        }
        else{
            var fd = new FormData();

            fd.append("name", name);
            fd.append("email", email);
            fd.append("password", password);

            $.ajax({
                url: 'ajax/user_register.php',
                data: fd,
                type:'post',
                contentType: false,
                processData: false,
                success: function(response){
                    data = JSON.parse(response);
                    console.log(data);
                    if(data.status == 'Success'){
                        Swal.fire(
                        'Done!',
                        'Registeration Successfull!',
                        'success'
                        ).then(function(){
                            window.location = "login.php";
                        });
                    }
                    else if(data.status == 'Available'){
                        Swal.fire(
                        'Oops!',
                        'This Email Already Used for Another Account!',
                        'info'
                        )
                    }
                    else{
                        Swal.fire(
                        'Errror!',
                        'Registeration Failed!',
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

