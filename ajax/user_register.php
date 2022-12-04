<?php
include('../datab.php');
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$sql = mysqli_query($conn, "SELECT * FROM user_data WHERE email LIKE '%$email%'");
$ema = mysqli_fetch_assoc($sql);
$today = date("d-m-Y");
if(isset($ema['email']) != null){
    $res['status'] = 'Available';

}
else{
    $enc = md5($password);
    mysqli_query($conn, "INSERT INTO user_data (name, email, password, status, group_id, date) VALUES ('$name', '$email', '$enc', 'Active', '5', '$today')");
    $res['status'] = 'Success';
    $res['remarks'] = 'New User Account Created!';
}


echo json_encode($res);

?>