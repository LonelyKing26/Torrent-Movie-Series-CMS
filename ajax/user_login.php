<?php

    include('../datab.php');

 $email = mysqli_real_escape_string($conn, $_POST["email"]);
 $password = mysqli_real_escape_string($conn, $_POST["password"]);

 $enc = md5($password);


 $sql = mysqli_query($conn, "SELECT * FROM user_data WHERE email = '$email' AND password = '$enc'");
 
if($row = mysqli_fetch_assoc($sql)){
    if($row['status'] != 'Active'){
        $res = "Inactive";
    }
    else{
        $res = 'Success'; 
        session_start();
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
    }
 
 }
 else
 {
     $res = 'Failed';
 }

echo json_encode($res);

?>
