<?php
   $current_page = basename($_SERVER['PHP_SELF']);
?>
<header id="header" class="header fixed-top d-flex align-items-center">
   <!----=======-- LOGO --=======---->
   <div class="d-flex align-items-center justify-content-between">
      <a href="admin_home.php" class="logo d-flex align-items-center">
         <img src="../assets/img/ui.png">
         <span class="d-none d-lg-block"> UI-ALPerf </span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
   </div><!-- END LOGO -->
   <?php
      if($current_page == 'admin_home.php'){
         ?>
            <!----=======-- SEARCH BAR --=======---->
            <div class="search-bar mt-3">
               <form action="" method="GET" class="d-flex align-items-center">
                  <input type="text" name="home_search_report" value="<?php if(isset($_GET['home_search_report'])){ echo $_GET['home_search_report']; } ?>" placeholder="Search reports" class="form-control" required>
                  <button type="submit"><i class="bi bi-search"></i></button>
               </form>
            </div><!-- END SEARCH BAR -->
         <?php
      }elseif($current_page == 'admin_report.php'){
         ?>
            <!----=======-- SEARCH BAR --=======---->
            <div class="search-bar mt-3">
               <form action="" method="GET" class="d-flex align-items-center">
                  <input type="text" name="search_report" value="<?php if(isset($_GET['search_report'])){ echo $_GET['search_report']; } ?>" placeholder="Search reports" class="form-control" required>
                  <button type="submit"><i class="bi bi-search"></i></button>
               </form>
            </div><!-- END SEARCH BAR -->
         <?php
      }elseif($current_page == 'admin_subject.php'){
         ?>
            <!----=======-- SEARCH BAR --=======---->
            <div class="search-bar mt-3">
               <form action="" method="GET" class="d-flex align-items-center">
                  <input type="text" name="search_subject" value="<?php if(isset($_GET['search_subject'])){ echo $_GET['search_subject']; } ?>" placeholder="Search Subject" class="form-control" required>
                  <button type="submit"><i class="bi bi-search"></i></button>
               </form>
            </div><!-- END SEARCH BAR -->
         <?php
      }elseif($current_page == 'admin_archive.php'){
         ?>
            <!----=======-- SEARCH BAR --=======---->
            <div class="search-bar mt-3">
               <form action="" method="GET" class="d-flex align-items-center">
                  <input type="text" name="search_archive" value="<?php if(isset($_GET['search_archive'])){ echo $_GET['search_archive']; } ?>" placeholder="Search archives" class="form-control" required>
                  <button type="submit"><i class="bi bi-search"></i></button>
               </form>
            </div><!-- END SEARCH BAR -->
         <?php
      }elseif($current_page == 'admin_faculty.php'){
         ?>
            <!----=======-- SEARCH BAR --=======---->
            <div class="search-bar mt-3">
               <form action="" method="GET" class="d-flex align-items-center">
                  <input type="text" name="search_faculty" value="<?php if(isset($_GET['search_faculty'])){ echo $_GET['search_faculty']; } ?>" placeholder="Search faculties" class="form-control" required>
                  <button type="submit"><i class="bi bi-search"></i></button>
               </form>
            </div><!-- END SEARCH BAR -->
         <?php
      }
   ?>
   <!----=======-- ICONS NAVIGATION --=======---->
   <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
         <?php
            if($current_page == 'admin_home.php' || $current_page == 'admin_report.php' || $current_page == 'admin_subject.php' || $current_page == 'admin_archive.php' || $current_page == 'admin_faculty.php'){
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
                  <img src="<?php echo $session_admin_pic; ?>" alt="Profile" class="dropdown-toggle">
               </div>
               <span class="dropdown-toggle ps-2 fw-bold">Admin</span>
            </a><!-- END PROFILE IMAGE ICON -->
            <!----=======-- PROFILE DROPDOWN ITEMS --=======---->
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
               <li class="dropdown-header">
                  <h6><?php echo $session_admin_fname.' '.$session_admin_lname; ?></h6>
               </li>
               <li>
                  <a class="dropdown-item d-flex align-items-center" href="admin_profile.php">
                     <i class="bi bi-person"></i>
                     <span>My Profile</span>
                  </a>
               </li>
               <li>
                  <a class="dropdown-item d-flex align-items-center" href="admin_about.php">
                     <i class="bi bi-card-list"></i>
                     <span>About</span>
                  </a>
               </li>
               <li>
                  <form action="../process_admin.php" method="POST">
                     <div class="logout d-flex align-items-center">
                        <i class="bi bi-box-arrow-right"></i>
                        <input type="submit" name="admin-logout" value="Log Out">
                     </div>
                  </form>
               </li>
            </ul><!-- END PROFILE DROPDOWN ITEMS -->
         </li><!-- END PROFILE NAV -->
      </ul>
   </nav><!-- END ICONS NAVIGATION -->
</header><!-- END HEADER -->