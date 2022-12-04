<?php
$filename = $_FILES['file']['name'];
$filetype = $_FILES['file']['type'];

$user = '2';

if (!file_exists('../torrent/'.$user.'/')) {
    mkdir('../torrent/'.$user.'/', 0777, true);
}
$path = '../torrent/'.$user.'/';

$target = $path . $filename;

if(move_uploaded_file($_FILES["file"]["tmp_name"], $target)){ 
    $res['status'] = 'success';
}else{ 
    $res['status'] = 'error';

} 


echo json_encode($res);
?>