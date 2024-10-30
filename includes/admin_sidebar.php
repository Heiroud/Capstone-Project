<?php
   $current_page = basename($_SERVER['PHP_SELF']);
?>
<aside id="sidebar" class="sidebar">
   <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
         <h2 class="d-block d-lg-none">UI-ALPerf</h2>
      </li>
      <!-- HOME NAV -->
      <li class="nav-item">
         <a class="nav-link <?php echo ($current_page == 'admin_home.php') ? '' : 'collapsed'; ?>" href="admin_home.php">
            <i class="bi bi-house-door"></i>
            <span>Home</span>
         </a>
      </li>
      <li class="nav-heading">Pages</li>
      <!-- NEW NAV - only visible on admin_home.php -->
      <?php 
         if($current_page == 'admin_home.php'){
            ?>
               <li class="nav-item">
                  <a class="nav-link d-none d-lg-block new_class_lg" id="new_lg" data-bs-toggle="modal" data-bs-target="#new_modal">
                     <i class="bi bi-plus-circle" id="i"></i>
                     <span>New</span>
                  </a>
               </li>
            <?php
         }
      ?>
      <!-- REPORTS NAV -->
      <li class="nav-item">
         <a class="nav-link <?php echo ($current_page == 'admin_report.php') ? '' : 'collapsed'; ?>" href="admin_report.php">
            <i class="bi bi-card-heading"></i>
            <span>Reports</span>
         </a>
      </li>
      <!-- ACADEMIC YEAR PAGE NAV -->
      <li class="nav-item">
         <a class="nav-link <?php echo ($current_page == 'admin_year.php') ? '' : 'collapsed'; ?>" href="admin_year.php">
            <i class="bi bi-calendar3-range"></i>
            <span>Academic Year</span>
         </a>
      </li>
      <!-- SUBJECTS PAGE NAV -->
      <li class="nav-item">
         <a class="nav-link <?php echo ($current_page == 'admin_subject.php') ? '' : 'collapsed'; ?>" href="admin_subject.php">
            <i class="bi bi-layout-text-sidebar"></i>
            <span>Subjects</span>
         </a>
      </li>
      <!-- ARCHIVES NAV -->
      <li class="nav-item">
         <a class="nav-link <?php echo ($current_page == 'admin_archive.php') ? '' : 'collapsed'; ?>" href="admin_archive.php">
            <i class="bi bi-archive"></i>
            <span>Archive</span>
         </a>
      </li>
      <!-- FACULTIES PAGE NAV -->
      <li class="nav-item">
         <a class="nav-link <?php echo ($current_page == 'admin_faculty.php') ? '' : 'collapsed'; ?>" href="admin_faculty.php">
            <i class="bi bi-people"></i>
            <span>Faculties</span>
         </a>
      </li>
      <!-- ABOUT NAV -->
      <li class="nav-item">
         <a class="nav-link <?php echo ($current_page == 'admin_about.php') ? '' : 'collapsed'; ?>" href="admin_about.php">
            <i class="bi bi-card-list"></i>
            <span>About</span>
         </a>
      </li>
      <!-- PROFILE PAGE NAV -->
      <li class="nav-item">
         <a class="nav-link <?php echo ($current_page == 'admin_profile.php') ? '' : 'collapsed'; ?>" href="admin_profile.php">
            <i class="bi bi-person-circle"></i>
            <span>Profile</span>
         </a>
      </li>
   </ul>
</aside>
