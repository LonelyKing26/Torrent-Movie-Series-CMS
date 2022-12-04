<?php
include('../datab.php');
$downloads = mysqli_escape_string($conn, $_POST['downloads']);
$post_id = mysqli_escape_string($conn, $_POST['post_id']);
mysqli_query($conn, "UPDATE movies_data SET downloads=$downloads WHERE id = $post_id");
?>