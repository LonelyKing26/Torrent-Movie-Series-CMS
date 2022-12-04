
<?php 
session_start();
$post_id = '';
include('datab.php');

if(isset($_GET['thd'])){
  $post_id = $_GET['thd'];
  $sql = mysqli_query($conn, "SELECT * FROM movies_data WHERE id = $post_id");
  $thd = mysqli_fetch_assoc($sql);

  $query = mysqli_query($conn, "SELECT * FROM movies_data, imdb_data 
  WHERE movies_data.id = $post_id
  AND imdb_data.id = movies_data.imdb_data_id");
  $imdb = mysqli_fetch_assoc($query);
  mysqli_query($conn, " UPDATE movies_data SET views = views+1 WHERE id = '$post_id' "); 
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $thd['title'];?> Free Download | TamilHD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
  <link rel="stylesheet" href="<?php echo $path; ?>assets/css/style.css">

</head>
<style>
    html, body, table{
    overflow-x:hidden;
  }
  </style>
<body>
<?php include('header.php');?>
  <div class="container-fluid mt-3">
    <div class="row"> 
      <?php include('left_sidebar.php');?>
      <div class="col-lg-9 pt-4">
      <div class="card panel-default">
        <div class="card-header"><strong> <?php echo $thd['title'];?></strong></div>
        <div class="row card-body m-3">
          <div class="col-lg-4 col-xs-12">
              <div class="poster_img text-center">
                <img src="<?php echo $imdb['poster_url'];?>" alt="" width="220">
              </div>
              <div class="torrent_dl mt-3 mb-3 text-center">
                <a href="torrent/<?php echo $thd['uploader_id'];?>/<?php echo $thd['torrent_file'];?>" id="torrent"><button class="btn btn-success thd_download_counter"><i class="fa-solid fa-download"></i> Torrent</button></a>  
                <a href="<?php echo $thd['magnet_link'];?>"><button class="btn btn-danger thd_download_counter"><i class="fa-sharp fa-solid fa-magnet"></i> Magnet</button></a>
                <?php 
                if($thd['watch_link'] != null){
                  echo '<br /><a href="'.$thd['watch_link'].'" target="_blank"><button class="btn btn-primary mt-2" id="direct_download"><i class="fa-solid fa-download"></i> Direct Download</button></a>';
                }
                ?>
              </div>   
          </div>
          <div class="col-lg-8 col-xs-12">
            <div class="movie_info">
              
              <div class="info_sec ">
                <table class="table table-bordered table-striped table-hover">
                  <tbody>
                    <tr>
                      <td><b>Title</b></td>
                      <td><?php echo $imdb['movie_title'];?></td>
                    </tr>
                    <tr>
                      <td><b>Rated</b></td>
                      <td><?php echo $imdb['rated'];?></td>
                    </tr>
                    <tr>
                      <td><b>Genre</b></td>
                      <td><?php echo $imdb['genre'];?></td>
                    </tr>
                    <tr>
                      <td><b>Release Date</b></td>
                      <td><?php echo $imdb['release_date'];?></td>
                    </tr>
                    <tr>
                      <td><b>Director</b></td>
                      <td><?php echo $imdb['director'];?></td>
                    </tr>
                    <tr>
                      <td><b>Actors</b></td>
                      <td><?php echo $imdb['actor'];?></td>
                    </tr>
                    
                    <tr>
                      <td><b>Rating</b></td>
                      <td><img src="assets/img/icons/imdb.png" alt="imdb" width="30"> <?php echo $imdb['rating'];?></td>
                    </tr>
                    <tr>
                      <td><b>iMDb</b></td>
                      <td><a href="https://www.imdb.com/title/<?php echo $imdb['imdb_id'];?>/" target="_blank"><?php echo $imdb['imdb_id'];?></a></td>
                    </tr>
                    <tr>
                      <td>
                        <b> Stats</b>
                      </td>
                      <td>
                        <small><i>Downloads -</i></small> <span id="counter"><?php echo $thd['downloads'];?></span>
                        <small><span id="views" class="" style="float:right;color: #5a5757;font-size: 14px;"><i class="fa fa-eye"></i> <?php echo $thd['views'];?></span></small>
                      </td>
                      
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <b>Plot :</b> <?php echo $imdb['plot'];?>
        </div>
      </div>
      <div class="card panel-default mt-3 mb-5">
        <div class="card-header"><b>File Info</b></div>
      <?php
        $ottvirus = mysqli_query($conn, "SELECT * FROM movies_data, category_data, quality_data, language_data, type_data, user_data
        WHERE movies_data.id = $post_id
        AND movies_data.category_id = category_data.id
        AND movies_data.quality_id = quality_data.id
        AND movies_data.language_id = language_data.id
        AND movies_data.type_id = type_data.id
        AND movies_data.uploader_id = user_data.id
        ");
      
        $thd_info = mysqli_fetch_assoc($ottvirus);
      ?>
      <div class="card-body">
        <table class="table table-borderless">
          <tbody>
              <tr>
                <td>Type</td>
                <td><?php echo $thd_info['type'];?></td>
                <td >Category</td>
                <td><?php echo $thd_info['category'];?></td>
              </tr>
              <tr>
                <td>Language</td>
                <td><?php echo $thd_info['language'];?></td>
                <td>Size</td>
                <td><?php echo $thd_info['file_size'];?></td>
              </tr>
              <tr>
                <td>Quality</td>
                <td><?php echo $thd_info['quality'];?></td>
                <td>Uploader</td>
                <td><?php echo $thd_info['name'];?></td>
              </tr>
          </tbody>
        </table>
      </div>
      </div>
     
          <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item mb-5">
          <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
              aria-controls="panelsStayOpen-collapseTwo">
              Similar torrents (More Quality)
            </button>
          </h2>
          <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
            aria-labelledby="panelsStayOpen-headingTwo">
            <div class="accordion-body">

              <div class="thd_cell_torrent_list ">
              <?php
                  $imdbid = $imdb['imdb_data_id'];
                
                  $query = "SELECT *, movies_data.id as main_id FROM movies_data, quality_data, category_data
                  WHERE movies_data.status = 'Active' 
                  AND movies_data.quality_id = quality_data.id
                  AND category_data.id = movies_data.category_id
                  AND movies_data.imdb_data_id = $imdbid
                
                  ORDER BY movies_data.id DESC LIMIT 5";
                  $result = mysqli_query($conn, $query);
                  while($thd = mysqli_fetch_assoc($result)){
                    
                ?>
                <div class="thd_torrent col-lg-12 col-xs-12 row">
                  <div class="thd_torrent_left col-lg-8 col-xs-12 row">
                    <div class="thd_category col-lg-2 col-xs-2">
                      <?php echo $thd['category'];?>
                    </div>
                    <div class="thd_torrent_title col-lg-10 col-xs-10">
                      <a href="post.php?thd=<?php echo $thd['main_id']; ?>"><?php echo $thd['title'];?></a>
                    </div>
                  </div>
                  <div class="thd_torrent_details col-lg-4 col-xs-12">
                    <table class="table table-borderless">
                      <tr>
                        
                        <td>Admin</td>
                        
                        <td><?php echo $thd['file_size'];?></td>
                        <td><?php echo date('d-M', strtotime($thd["dateTime"]));?></td>
                        <td><a href="torrent/<?php echo $thd['uploader_id'];?>/<?php echo $thd['torrent_file'];?>"><i
                              class="fa-solid fa-download"></i></a> &nbsp; <a
                            href="<?php echo $thd['magnet_link'];?>"><i class="fa-sharp fa-solid fa-magnet"></i></a>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <?php };?>
              </div>
            </div>
          </div>
        </div>
            </div>    
    </div>
  </div>
                  </div>
  <?php include('footer.php');?>
<input type="text" id="post_id" value="<?php echo $post_id;?>" hidden>
<script>

$('.thd_download_counter').click( function() {
 
    
    $('#counter').html(function(i, val) { return +val+1 });
    var downloads = $('#counter').html();
    var post_id = $('#post_id').val();
    
    var fd = new FormData();

    fd.append("downloads", downloads);
    fd.append("post_id", post_id);
    $.ajax({
                url: 'ajax/downloads_count.php',
                data: fd,
                type:'post',
                contentType: false,
                processData: false,
                success: function(response){
                  console.log('Count Added');
                }
              });
});
  // downloads = $('#counter').val(+val+1);

</script>
</body>

</html>
