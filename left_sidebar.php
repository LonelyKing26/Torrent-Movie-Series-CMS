<div class="col-lg-3 col-xs-10 pt-4 thd_recent_pics_row">
      <div class="thd_recent_pics row">
        <div class="thd_recent_movies_poster">
          <div class="card">
            <div class="card-header">Recent Movie [HD/Bluray/WEB_DL]</div>
          <div class="card-body col-12 text-center">
            <div class="row">
            <?php
                $sql_slide = "SELECT * FROM imdb_data, movies_data, language_data, quality_data
                WHERE imdb_data.status = 'Active' 
                AND imdb_data.id = movies_data.imdb_data_id
                AND language_data.id = movies_data.language_id
                AND quality_data.id = movies_data.quality_id
                AND movies_data.type_id = 1
                AND quality_data.id != 4
                group by imdb_data.id, movies_data.imdb_data_id
                ORDER BY movies_data.dateTime DESC LIMIT 8 ";
                $thd_slide_sql = mysqli_query($conn, $sql_slide);
                while($thd_slider = mysqli_fetch_assoc($thd_slide_sql)){
                ?>
                <div class="thd_movie_poster col-6 mb-3">
                  <a href="search_result.php?imdb=<?php echo $thd_slider['imdb_id'];?>"><img src="<?php echo $thd_slider['poster_url'];?>" width="120" alt="" /></a>
                  <div class="info_poster"><span><?php echo $thd_slider['language'];?></span></div>
                </div>
                <?php };?>

            </div>
            
            </div>
          </div>
          
        </div>
      </div>
      <div class="thd_recent_pics row mt-3">
        <div class="thd_recent_movies_poster">
          <div class="card">
            <div class="card-header">Recent Series</div>
          <div class="card-body col-12 text-center">
            <div class="row">
            <?php
                $sql_slide = "SELECT * FROM imdb_data, movies_data, language_data, quality_data
                WHERE imdb_data.status = 'Active' 
                AND imdb_data.id = movies_data.imdb_data_id
                AND language_data.id = movies_data.language_id
                AND quality_data.id = movies_data.quality_id
                AND movies_data.type_id = 2
                AND quality_data.id != 4
                group by imdb_data.id, movies_data.imdb_data_id
                ORDER BY imdb_data.id DESC LIMIT 8 ";
                $thd_slide_sql = mysqli_query($conn, $sql_slide);
                while($thd_slider = mysqli_fetch_assoc($thd_slide_sql)){
                ?>
                <div class="thd_movie_poster col-6 mb-3">
                  <a href="search_result.php?imdb=<?php echo $thd_slider['imdb_id'];?>"><img src="<?php echo $thd_slider['poster_url'];?>" width="120" alt="" /></a>
                  <div class="info_poster"><span><?php echo $thd_slider['language'];?></span></div>
                </div>
                <?php };?>

            </div>
            
            </div>
          </div>
          
        </div>
      </div>
       <div class="thd_recent_pics row mt-3">
        <div class="thd_recent_movies_poster">
          <div class="card">
            <div class="card-header">Recent CAMs [Cam/TC/DVDScr]</div>
          <div class="card-body col-12 text-center">
            <div class="row">
            <?php
                $sql_slide = "SELECT * FROM imdb_data, movies_data, language_data, quality_data
                WHERE imdb_data.status = 'Active' 
                AND imdb_data.id = movies_data.imdb_data_id
                AND language_data.id = movies_data.language_id
                AND quality_data.id = movies_data.quality_id
                AND movies_data.type_id = 1
                AND quality_data.id = 4
                ORDER BY imdb_data.id DESC LIMIT 8 ";
                $thd_slide_sql = mysqli_query($conn, $sql_slide);
                while($thd_slider = mysqli_fetch_assoc($thd_slide_sql)){
                ?>
                <div class="thd_movie_poster col-6 mb-3">
                  <a href="search_result.php?imdb=<?php echo $thd_slider['imdb_id'];?>"><img src="<?php echo $thd_slider['poster_url'];?>" width="120" alt="" /></a>
                  <div class="info_poster"><span><?php echo $thd_slider['language'];?></span></div>
                </div>
                <?php };?>

            </div>
            
            </div>
          </div>
          
        </div>
      </div>
      <div class="thd_recent_pics row mt-3">
        <div class="thd_recent_movies_poster">
          <div class="card">
            <div class="card-header">Recent Animes/Cartoons</div>
          <div class="card-body col-12 text-center">
            <div class="row">
            <?php
                $sql_slide = "SELECT * FROM imdb_data, movies_data, language_data, quality_data
                WHERE imdb_data.status = 'Active' 
                AND imdb_data.id = movies_data.imdb_data_id
                AND language_data.id = movies_data.language_id
                AND quality_data.id = movies_data.quality_id
                AND movies_data.type_id = 4
                -- AND quality_data.id = 4
                group by imdb_data.id, movies_data.imdb_data_id
                ORDER BY imdb_data.id DESC LIMIT 8 ";
                $thd_slide_sql = mysqli_query($conn, $sql_slide);
                while($thd_slider = mysqli_fetch_assoc($thd_slide_sql)){
                ?>
                <div class="thd_movie_poster col-6 mb-3">
                  <a href="search_result.php?imdb=<?php echo $thd_slider['imdb_id'];?>"><img src="<?php echo $thd_slider['poster_url'];?>" width="120" alt="" /></a>
                  <div class="info_poster"><span><?php echo $thd_slider['language'];?></span></div>
                </div>
                <?php };?>

            </div>
            
            </div>
          </div>
          
        </div>
      </div>
    </div>