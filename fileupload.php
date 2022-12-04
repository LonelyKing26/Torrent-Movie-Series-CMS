<?php
session_start ();
if(!isset($_SESSION["name"]))
{
  header("location:login.php");
}
$sid = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Upload Torrent</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body>
  <div class="form-group">
    <input type="file" class="form-control" id="file">
    <input type="button" value="Submit" id="file_upload">
  </div>
</body>
<script>
  $("#file_upload").click(function(){
    var fd = new FormData();
    fd.append('file', $('#file')[0].files[0]);
    $.ajax({
                url: 'ajax/torrent.php',
                data: fd,
                type:'post',
                contentType: false,
                processData: false,
                success: function(response){
                    data = JSON.parse(response);
                    console.log(data);
                    if(data.status=='success'){
                      alert('done');
                    }
                }
    });
  });
</script>
</html>

