    <style>
      
        @media (min-width:480px){
          .ott_virus_reg{
          margin-left:20px;
        }
      }
    </style>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="<?php echo $path; ?>index">THD</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo $path; ?>type/1/movies">Movies</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo $path; ?>type/2/series">Series</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo $path; ?>category/3/animes">Animes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo $path; ?>category/4/english">English</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo $path; ?>upload">Upload</a>
              </li>
            </ul>
            <form class="d-flex" method="get" action="<?php echo $path; ?>search_result">
              <input class="form-control me-2" name="query" type="search" placeholder="Search">
              <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <div class="navbar-nav">
              <?php
                if(isset($_SESSION['id'])){
                  echo '
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle ott_virus_reg" href="#" role="button" data-bs-toggle="dropdown">'.$_SESSION['name'].'</a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="'.$path.'logout">Logout</a></li>
                      
                    </ul>
                  </li>
                  ';
                }
                else{
                  echo '
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle ott_virus_reg" href="#" role="button" data-bs-toggle="dropdown">Guest</a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="'.$path.'Login">Login</a></li>
                      

                      <li><a class="dropdown-item" href="'.$path.'register">Register</a></li>
                    </ul>
                  </li>
                  ';
                }
              ?>
              
              </div>
          </div>
        </div>
    </nav>