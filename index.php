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
  <link rel="stylesheet" href="<?php echo $path; ?>assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body">

  <?php include('header.php');?>
  <div class="thd_noties col-10 m-auto text-center mt-3 mb-3">
    <!-- <h4>Hey Dood, were cool back soon</h4> -->
    <!-- <h5>TamilHD.sbs</h5> -->
    <!-- <p><i class="fa fa-telegram"></i> Join Our <a href="https://telegram.me/+q5cPFCZsdWljN2Zl" target="_blank">Telegram Channel</a> to Get Instant Updates</p> -->
  <!-- <p>Lol : I build this site from scrach bu alone but i Failed in Zoho's <u>HTML</u> Written Test, Skills irunthalum Sila Samayam luck Avasiyam.</p> -->
																												   <b><a style="color:red;" href="live-star1.php">T20 Live</a></b>
  </div>
  <div class="thd_home_torrent_body row">
    <?php include('left_sidebar.php');?>
    <div class="col-lg-9 col-xs-10 pt-4">
      <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
              aria-controls="panelsStayOpen-collapseOne">
              Recent Release
            </button>
          </h2>
          <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
            aria-labelledby="panelsStayOpen-headingOne">
            <div class="accordion-body">
              <?php include('slider.php');?>

              <div class="accordion-item mt-2">
                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseThree">
                    Recent Movies
                  </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show"
                  aria-labelledby="panelsStayOpen-headingThree">
                  <div class="accordion-body">
                    <div class="thd_cell_home">
                      <div class="thd_cell_torrent_box">
                        <div class="thd_box_heading text-center ">
                          <div class="col-lg-12 row">
                            <div class="col-lg-8 row">
                              <div class="col-lg-2">
                                <p>Category</p>
                              </div>
                              <div class="col-lg-10">
                                Title
                              </div>
                            </div>
                            <div class="thd_heading_right col-lg-4">
                              <table class="table table-borderless ">
                                <tr>
                                  <td>DL</td>
                                  <td>Uplaoder</td>
                                  <td>Size</td>
                                  
                                  <td>date</td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="thd_cell_torrent_list">
                          <?php
                              $query = "SELECT *, movies_data.id as main_id FROM movies_data, quality_data, category_data, user_data, imdb_data
                              WHERE movies_data.status = 'Active' 
                              AND movies_data.quality_id = quality_data.id
                              AND category_data.id = movies_data.category_id
                              AND user_data.id = movies_data.uploader_id
                              AND movies_data.imdb_data_id = imdb_data.id
                              AND movies_data.type_id = 1
                              ORDER BY movies_data.id DESC LIMIT 6";
                              $result = mysqli_query($conn, $query);
                             
                              while($thd = mysqli_fetch_assoc($result)){
                                $mytitle = $thd['title'];
                                $str = $mytitle; 
                               $title = str_replace([" ",":","+","[","]"],["-",""],"$str");
                              
                          ?>
                          <div class="thd_torrent col-lg-12 col-xs-12 row">
                            <div class="thd_torrent_left col-lg-8 col-xs-12 row">
                              <div class="thd_category col-lg-2 col-xs-2">
                                <?php echo $thd['category'];?>
                              </div>
                              
                              <div class="thd_torrent_title col-lg-10 col-xs-10">
                               
                                <a href="torrent/<?php echo $thd['main_id']; ?>/<?php echo $title?>"><?php echo $thd['title'];?> <div class="thd_hover_img"> <img src="<?php echo $thd['poster_url'];?>" alt="" width="150" loading="lazy"></div></a>
                              </div>
                            </div>
                            <div class="thd_torrent_details col-lg-4 col-xs-12">
                              <table class="table table-borderless">
                                <tr>
                                  <td><a
                                      href="<?php echo $path;?>attachment/<?php echo $thd['uploader_id'];?>/torrents/<?php echo $thd['torrent_file'];?>"><i
                                        class="fa-solid fa-download"></i></a> &nbsp; <a
                                      href="<?php echo $thd['magnet_link'];?>"><i
                                        class="fa-sharp fa-solid fa-magnet"></i></a></td>
                                  <td><?php echo $thd['name'];?></td>
                                  
                                  <td><?php echo $thd['file_size'];?></td>
                                  <td><?php echo date('d-M', strtotime($thd["dateTime"]));?></td>
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
              <div class="accordion-item mt-2">
                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseThree">
                    Recent Series
                  </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show"
                  aria-labelledby="panelsStayOpen-headingThree">
                  <div class="accordion-body">
                    <div class="thd_cell_home">
                      <div class="thd_cell_torrent_box">
                        <div class="thd_box_heading text-center ">
                          <div class="col-lg-12 row">
                            <div class="col-lg-8 row">
                              <div class="col-lg-2">
                                <p>Category</p>
                              </div>
                              <div class="col-lg-10">
                                Title
                              </div>
                            </div>
                            <div class="thd_heading_right col-lg-4">
                              <table class="table table-borderless ">
                                <tr>
                                  <td>DL</td>
                                  <td>Uplaoder</td>
                                  <td>Size</td>
                                  
                                  <td>date</td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="thd_cell_torrent_list">
                          <?php
                              $query = "SELECT *, movies_data.id as main_id FROM movies_data, quality_data, category_data 
                              WHERE movies_data.status = 'Active' 
                              AND movies_data.quality_id = quality_data.id
                              AND category_data.id = movies_data.category_id
                              AND movies_data.type_id = 2
                              ORDER BY movies_data.id DESC LIMIT 6";
                              $result = mysqli_query($conn, $query);
                              while($thd = mysqli_fetch_assoc($result)){
                                $mytitle = $thd['title'];
                                $str = $mytitle; 
                               $title = str_replace([" ",":","+","[","]"],["-",""],"$str");
                          ?>
                          <div class="thd_torrent col-lg-12 col-xs-12 row">
                            <div class="thd_torrent_left col-lg-8 col-xs-12 row">
                              <div class="thd_category col-lg-2 col-xs-2">
                                <?php echo $thd['category'];?>
                              </div>
                              <div class="thd_torrent_title col-lg-10 col-xs-10">
                                <a href="torrent/<?php echo $thd['main_id']; ?>/<?php echo $title; ?>"><?php echo $thd['title'];?></a>
                              </div>
                            </div>
                            <div class="thd_torrent_details col-lg-4 col-xs-12">
                              <table class="table table-borderless">
                                <tr>
                                  <td><a
                                      href="<?php echo $path;?>attachment/<?php echo $thd['uploader_id'];?>/torrents/<?php echo $thd['torrent_file'];?>"><i
                                        class="fa-solid fa-download"></i></a> &nbsp; <a
                                      href="<?php echo $thd['magnet_link'];?>"><i
                                        class="fa-sharp fa-solid fa-magnet"></i></a></td>
                                  <td>Admin</td>
                                  
                                  <td><?php echo $thd['file_size'];?></td>
                                  <td><?php echo date('d-M', strtotime($thd["dateTime"]));?></td>
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
              <div class="accordion-item mt-2">
                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseThree">
                    Recent Animes
                  </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show"
                  aria-labelledby="panelsStayOpen-headingThree">
                  <div class="accordion-body">
                    <div class="thd_cell_home">
                      <div class="thd_cell_torrent_box">
                        <div class="thd_box_heading text-center ">
                          <div class="col-lg-12 row">
                            <div class="col-lg-8 row">
                              <div class="col-lg-2">
                                <p>Category</p>
                              </div>
                              <div class="col-lg-10">
                                Title
                              </div>
                            </div>
                            <div class="thd_heading_right col-lg-4">
                              <table class="table table-borderless ">
                                <tr>
                                  <td>DL</td>
                                  <td>Uplaoder</td>
                                  <td>Size</td>
                                  
                                  <td>date</td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="thd_cell_torrent_list">
                          <?php
                              $query = "SELECT *, movies_data.id as main_id FROM movies_data, quality_data, category_data 
                              WHERE movies_data.status = 'Active' 
                              AND movies_data.quality_id = quality_data.id
                              AND category_data.id = movies_data.category_id
                              AND movies_data.category_id = 3
                              ORDER BY movies_data.id DESC LIMIT 6";
                              $result = mysqli_query($conn, $query);
                              while($thd = mysqli_fetch_assoc($result)){
                                $mytitle = $thd['title'];
                                $str = $mytitle; 
                               $title = str_replace([" ",":","+","[","]"],["-",""],"$str");
                          ?>
                          <div class="thd_torrent col-lg-12 col-xs-12 row">
                            <div class="thd_torrent_left col-lg-8 col-xs-12 row">
                              <div class="thd_category col-lg-2 col-xs-2">
                                <?php echo $thd['category'];?>
                              </div>
                              <div class="thd_torrent_title col-lg-10 col-xs-10">
                                <a href="torrent/<?php echo $thd['main_id']; ?>/<?php echo $title; ?>"><?php echo $thd['title'];?></a>
                              </div>
                            </div>
                            <div class="thd_torrent_details col-lg-4 col-xs-12">
                              <table class="table table-borderless">
                                <tr>
                                  <td><a
                                      href="<?php echo $path;?>attachment/<?php echo $thd['uploader_id'];?>/torrents/<?php echo $thd['torrent_file'];?>"><i
                                        class="fa-solid fa-download"></i></a> &nbsp; <a
                                      href="<?php echo $thd['magnet_link'];?>"><i
                                        class="fa-sharp fa-solid fa-magnet"></i></a></td>
                                  <td>Admin</td>
                                  
                                  <td><?php echo $thd['file_size'];?></td>
                                  <td><?php echo date('d-M', strtotime($thd["dateTime"]));?></td>
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
        </div>
        <div class="accordion-item mb-5">
          <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
              aria-controls="panelsStayOpen-collapseTwo">
              Recent Torrents
            </button>
          </h2>
          <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
            aria-labelledby="panelsStayOpen-headingTwo">
            <div class="accordion-body">

              <div class="thd_cell_torrent_list ">
                <?php
                    $query = "SELECT *, movies_data.id as main_id FROM movies_data, quality_data, category_data 
                    WHERE movies_data.status = 'Active' 
                    AND movies_data.quality_id = quality_data.id
                    AND category_data.id = movies_data.category_id
                    ORDER BY movies_data.id DESC LIMIT 20";
                    $result = mysqli_query($conn, $query);
                    while($thd = mysqli_fetch_assoc($result)){ 
                      $mytitle = $thd['title'];
                      $str = $mytitle; 
                     $title = str_replace([" ",":","+","[","]"],["-",""],"$str");
                ?>
                <div class="thd_torrent col-lg-12 col-xs-12 row">
                  <div class="thd_torrent_left col-lg-8 col-xs-12 row">
                    <div class="thd_category col-lg-2 col-xs-2">
                      <?php echo $thd['category'];?>
                    </div>
                    <div class="thd_torrent_title col-lg-10 col-xs-10">
                      <a href="torrent/<?php echo $thd['main_id']; ?>/<?php echo $title; ?>"><?php echo $thd['title'];?></a>
                    </div>
                  </div>
                  <div class="thd_torrent_details col-lg-4 col-xs-12">
                    <table class="table table-borderless">
                      <tr>
                        
                        <td>Admin</td>
                        
                        <td><?php echo $thd['file_size'];?></td>
                        <td><?php echo date('d-M', strtotime($thd["dateTime"]));?></td>
                        <td><a href="<?php echo $path;?>attachment/<?php echo $thd['uploader_id'];?>/torrents/<?php echo $thd['torrent_file'];?>"><i
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
  <?php include('footer.php');
 
  ?>
  <script>
    $(document).ready(function () {
      $('#example').DataTable();
    });
  </script>
</body>

</html>