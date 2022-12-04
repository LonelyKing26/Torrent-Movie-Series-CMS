<?php
include('../datab.php');
// //Post DB
$post_title = mysqli_escape_string($conn, $_POST['post_title']);
$type = mysqli_escape_string($conn, $_POST['type']);
$category = mysqli_escape_string($conn, $_POST['category']);
$size = mysqli_escape_string($conn, $_POST['size']);
$language = mysqli_escape_string($conn, $_POST['language']);
$quality = mysqli_escape_string($conn, $_POST['quality']);
$magnet = mysqli_escape_string($conn, $_POST['magnet']);
$watch_link = mysqli_escape_string($conn, $_POST['watch_link']);

$user_id = mysqli_escape_string($conn, $_POST['user_id']);

//IMDB DATA
$title = mysqli_escape_string($conn, $_POST['title']);
$year = mysqli_escape_string($conn, $_POST['year']);
$genre = mysqli_escape_string($conn, $_POST['genre']);
$release = mysqli_escape_string($conn, $_POST['release']);
$rated = mysqli_escape_string($conn, $_POST['rated']);
$director = mysqli_escape_string($conn, $_POST['director']);
$actor = mysqli_escape_string($conn, $_POST['actor']);
$runtime = mysqli_escape_string($conn, $_POST['runtime']);
$rating = mysqli_escape_string($conn, $_POST['rating']);
$poster_url = mysqli_escape_string($conn, $_POST['poster_url']);
$plot = mysqli_escape_string($conn, $_POST['plot']);
$imdbid = mysqli_escape_string($conn, $_POST['imdbid']);
$today = date("d-m-Y");
$checkimdb = mysqli_query($conn, "SELECT * FROM imdb_data WHERE imdb_id LIKE '%$imdbid%'");
$imdb_data_thd = mysqli_num_rows($checkimdb);
$myimdb = mysqli_fetch_assoc($checkimdb);
if($imdb_data_thd == 1) {
    $imdb_get_id = $myimdb['id'];
     
} else {

    $query = mysqli_query($conn, "INSERT INTO imdb_data(imdb_id, movie_title, year, release_date, rated, director, actor, runtime, rating, poster_url, plot, status, genre, user_id, date)
                            VALUES ('$imdbid', '$title', '$year', '$release', '$rated', '$director', '$actor', '$runtime', '$rating', '$poster_url', '$plot', 'Active', '$genre', '$user_id', '$today')");
    $imdb_get_id = mysqli_insert_id($conn);
}

// //File Upload

    $filename = $_FILES['torrent_file']['name'];
    $filetype = $_FILES['torrent_file']['type'];
    $filesize = $_FILES['torrent_file']['size'];
    
    if (!file_exists('../attachment/'.$user_id.'/')) {
        mkdir('../attachment/'.$user_id.'/torrents/', 0777, true);
    }
    // else if (!file_exists('../attachment/'.$user_id.'/torrents')) {
    //     mkdir('../torrents/'.$user_id.'/', 0777, true);
    // }
    $path = '../attachment/'.$user_id.'/torrents/';
    $site = mysqli_query($conn, "SELECT * FROM site_data ");
    $domain = mysqli_fetch_assoc($site);
	$thd_torrent = '['.$domain["domain"].'] '.$post_title.''.'.'. pathinfo($_FILES["torrent_file"]["name"] ,PATHINFO_EXTENSION);
    $newFileName = $path .'['.$domain["domain"].'] '.$post_title.''.'.'. pathinfo($_FILES["torrent_file"]["name"] ,PATHINFO_EXTENSION);
    // $newname = '[TamilHD] '.$filename.'.'

    
    if($filetype != 'application/x-bittorrent'){
        $res['fileext'] = 'nontorrent';
    }
    else if($filesize > '100000'){
        $res['filesize'] = 'bigfile';
        
    }
    else{
        if(move_uploaded_file($_FILES["torrent_file"]["tmp_name"], $newFileName)){ 
            $res['file'] = 'File Uploaded';
            
        }else{ 
            $res['file'] = 'FIle NOt Uploaded';
        
        } 
        $res['fileext'] = 'Valid File';
        $sql = mysqli_query($conn, "INSERT INTO movies_data (uploader_id, imdb_data_id, title, type_id, category_id, file_size, language_id, quality_id, status, torrent_file, magnet_link, watch_link, downloads, views, date)
        VALUES ('$user_id', '$imdb_get_id', '$post_title', '$type', '$category', '$size', '$language', '$quality', 'Active', '$thd_torrent', '$magnet', '$watch_link', '0', '1', '$today')");
        $post_get_id = mysqli_insert_id($conn);
    
    
        $res['status'] = 'success';
        $res['id'] = $post_get_id;
    }
    

echo json_encode($res);
?>