<?php
   $current_page = basename($_SERVER['PHP_SELF']);
?>
<header id="header" class="header fixed-top d-flex align-items-center">
   <!----=======-- LOGO --=======---->
   <div class="d-flex align-items-center justify-content-between">
      <a href="faculty_home.php" class="logo d-flex align-items-center">
         <img src="../assets/img/ui.png">
         <span class="d-none d-lg-block"> UI-ALPerf </span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
      <?php
         if($current_page == 'faculty_home.php'){
            ?>
               <!----=======-- SEARCH BAR --=======---->
               <div class="search-bar mt-3">
                  <form action="" method="GET" class="d-flex align-items-center">
                     <input type="text" name="home_search" value="<?php if(isset($_GET['home_search'])){ echo $_GET['home_search']; } ?>" placeholder="Search reports" class="form-control" required>
                     <button type="submit"><i class="bi bi-search"></i></button>
                  </form>
               </div><!-- END SEARCH BAR -->
            <?php
         }elseif($current_page == 'faculty_report.php'){
            ?>
               <!----=======-- SEARCH BAR --=======---->
               <div class="search-bar mt-3">
                  <form action="" method="GET" class="d-flex align-items-center">
                     <input type="text" name="faculty_search_report" value="<?php if(isset($_GET['faculty_search_report'])){ echo $_GET['faculty_search_report']; } ?>" placeholder="Search reports" class="form-control" required>
                     <button type="submit"><i class="bi bi-search"></i></button>
                  </form>
               </div><!-- END SEARCH BAR -->
            <?php
         }elseif($current_page == 'faculty_archive.php'){
            ?>
               <!----=======-- SEARCH BAR --=======---->
               <div class="search-bar mt-3">
                  <form action="" method="GET" class="d-flex align-items-center">
                     <input type="text" name="faculty_search_archive" value="<?php if(isset($_GET['faculty_search_archive'])){ echo $_GET['faculty_search_archive']; } ?>" placeholder="Search archives" class="form-control" required>
                     <button type="submit"><i class="bi bi-search"></i></button>
                  </form>
               </div><!-- END SEARCH BAR -->
            <?php
         }
      ?>
   </div><!-- END LOGO -->
   <!----=======-- ICONS NAVIGATION --=======---->
   <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
         <?php
            if($current_page == 'faculty_home.php' || $current_page == 'faculty_report.php' || $current_page == 'faculty_archive.php'){
               ?>
                  <!----=======-- SEARCH ICON --=======---->
                  <li class="search-icon nav-item d-block d-xl-none">
                     <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                     </a>
                  </li><!-- END SEARCH ICON -->
               <?php
            }
         ?>
         <!----=======-- PROFILE NAV --=======---->
         <li class="nav-item dropdown pe-3">
            <!----=======-- PROFILE IMAGE ICON --=======---->
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
               <div class="nav-img">
                  <img src="<?php echo $session_faculty_pic; ?>" alt="Profile" class="dropdown-toggle">
               </div>
               <span class="dropdown-toggle ps-2 fw-bold">Faculty</span>
            </a><!-- END PROFILE IMAGE ICON -->
            <!----=======-- PROFILE DROPDOWN ITEMS --=======---->
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
               <li class="dropdown-header">
                  <h6><?php echo $session_faculty_fname.' '.$session_faculty_lname; ?></h6>
               </li>
               <li>
                  <a class="dropdown-item d-flex align-items-center" href="faculty_profile.php">
                     <i class="bi bi-person"></i>
                     <span>My Profile</span>
                  </a>
               </li>
               <li>
                  <a class="dropdown-item d-flex align-items-center" href="faculty_about.php">
                     <i class="bi bi-card-list"></i>
                     <span>About</span>
                  </a>
               </li>
               <li>
                  <form action="../process_faculty.php" method="POST">
                     <div class="logout d-flex align-items-center">
                        <i class="bi bi-box-arrow-right"></i>
                        <input type="submit" name="faculty-logout" value="Log Out">
                     </div>
                  </form>
               </li>
            </ul><!-- END PROFILE DROPDOWN ITEMS -->
         </li><!-- END PROFILE NAV -->
      </ul>
   </nav><!-- END ICONS NAVIGATION -->
</header><!-- END HEADER -->