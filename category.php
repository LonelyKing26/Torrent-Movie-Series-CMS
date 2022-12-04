
<?php 
session_start();
include('datab.php');
$type_id = '';
if(isset($_GET['id'])){
  $type_id = $_GET['id'];
  $sql = mysqli_query($conn, "SELECT * FROM movies_data, category_data
  WHERE movies_data.category_id = $type_id
  AND movies_data.category_id = category_data.id
  ");
  $type = mysqli_fetch_assoc($sql);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $type['category'];?> | TamilHD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
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
      width: 700px;
  }
  }
a:hover{
  text-decoration: underline;
}
</style>
<body>

<?php include('header.php');?>

<div class="container-fluid mt-3 text-center">
 
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
              Recent <?php echo $type['category'];?> Movies/Series
            </button>
          </h2>
          <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
            aria-labelledby="panelsStayOpen-headingTwo">
            <div class="accordion-body">

              <div class="thd_cell_torrent_list ">
                <?php
                    $query = "SELECT *, movies_data.id as main_id 
                    FROM movies_data, quality_data, category_data, type_data
                    WHERE movies_data.status = 'Active' 
                    AND movies_data.category_id = $type_id
                    AND movies_data.category_id = category_data.id
                    AND movies_data.quality_id = quality_data.id
                    AND type_data.id = movies_data.type_id
                    ORDER BY movies_data.id DESC";
                    
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

</body>

</html>


