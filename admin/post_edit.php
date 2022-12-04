
<?php 
session_start();
include('datab.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>THD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
 <h2>Welcome to THD</h2>

</div>

<div class="col-lg-10 m-auto table-responsive pt-4">
  <h5>Recent Torrents</h5>
    <table class="table table-bordered table-hover torrent-list" id="movie_listing">
        <thead>
            <tr class="text-center col-12">
                <td class="col-1">#</td>
                <td class="col-6" >Title</td>
                <td class="col-1">DL</td>
                <td class="col-1">Quality</td>
                <td class="col-1">Size</td>
                <td class="col-1 mob_date">Date</td>
            </tr>
        </thead>
        <tbody>
          <?php
            $query = "SELECT *, movies_data.id as main_id FROM movies_data, quality_data, category_data 
            WHERE movies_data.status = 'Active' 
            AND movies_data.quality_id = quality_data.id
            AND category_data.id = movies_data.category_id";
            $result = mysqli_query($conn, $query);
            while($thd = mysqli_fetch_assoc($result)){
              
          ?>
            <tr>
              <td class="text-center"><?php echo $thd['category'];?></td>
                <td><a class="movie_link" href="post.php?thd=<?php echo $thd['main_id']; ?>"><?php echo $thd['title'];?></a></td>
                <td class="text-center"><i class="fa-solid fa-download"></i> &nbsp; <i class="fa-sharp fa-solid fa-magnet"></i></td>
                <td class="text-center"><?php echo $thd['quality'];?></td>
                <td class="text-center"><?php echo $thd['file_size'];?></td>
                <td class="text-center  mob_date" >26/4/1998</td>
            </tr>
            <?php };?>
        </tbody>

    </table>
</div>
<script>
  $(document).ready(function () {
    $('#example').DataTable();
});
</script>
</body>
</html>


