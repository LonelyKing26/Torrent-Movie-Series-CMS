
<?php 
session_start();
include('datab.php');
if(isset($_GET['query'])){
  $query = $_GET['query'];
  $query_q = "AND movies_data.title LIKE '%$query%'";
  $imdb_q = '';

}
if(isset($_GET['imdb'])){
  $imdb = $_GET['imdb'];
  $imdb_q = "AND imdb_data.imdb_id LIKE '%$imdb%'";
  $query_q = '';
 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Search Result | THD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo $path; ?>assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>
<style>
  html, body, table{
    overflow-x:hidden;
  }
  @media (max-width:540px){
    .mob_date{
      display: none;
    }
  }
  a{
    text-decoration: none;
  }
  @media (min-width:541px){
    a.movie_link{
      display: inline-block;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      width: 600px;
  }
  a.movie_link:after{
    content:'...'

  }
  }
a:hover{
  text-decoration: underline;
}
</style>
<body>

<?php include('header.php');?>

<div class="container-fluid mt-3 text-center">
 <!-- <h2>Welcome to THD</h2> -->

</div>
<div class="thd_home_torrent_body row">
    <?php include('left_sidebar.php');?>
    <div class="col-lg-9 col-xs-10 pt-4">
      <div class="accordion" id="accordionPanelsStayOpenExample">
        
        <div class="accordion-item mb-5">
          <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
              aria-controls="panelsStayOpen-collapseTwo">
              Recent
            </button>
          </h2>
          <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
            aria-labelledby="panelsStayOpen-headingTwo">
            <div class="accordion-body">

              <div class="thd_cell_torrent_list ">
                <?php
                    $query = "SELECT *, movies_data.id as main_id FROM movies_data,imdb_data, quality_data, category_data 
                    WHERE movies_data.status = 'Active' 
                    AND imdb_data.id = movies_data.imdb_data_id
                    $query_q
                    $imdb_q
                    AND movies_data.quality_id = quality_data.id
                    AND category_data.id = movies_data.category_id
                    ORDER BY movies_data.id DESC LIMIT 30";
        
                    $result = mysqli_query($conn, $query);
                    
                    if(mysqli_num_rows($result) > 0){
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
                <?php
                    };
                  }
                    else{
                      echo '<h4 class="text-center">No Result Found!</h4>';
                    }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

</body>
</html>


