<?php
   $current_page = basename($_SERVER['PHP_SELF']);
?>
<aside id="sidebar" class="sidebar">
   <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
         <h2 class="d-block d-lg-none">UI-ALPerf</h2>
      </li>
      <!----=======-- HOME NAV --=======---->
      <li class="nav-item">
         <a class="nav-link <?php echo ($current_page == 'faculty_home.php') ? '' : 'collapsed'; ?>" href="faculty_home.php">
            <i class="bi bi-house-door"></i>
            <span>Home</span>
         </a>
      </li><!-- END HOME NAV -->
      <li class="nav-heading">Pages</li>
      <!----=======-- REPORTS NAV --=======---->
      <li class="nav-item">
         <a class="nav-link <?php echo ($current_page == 'faculty_report.php') ? '' : 'collapsed'; ?>" href="faculty_report.php">
            <i class="bi bi-card-heading"></i>
            <span>Reports</span>
         </a>
      </li><!-- END REPORTS NAV -->
      <!----=======-- ARCHIVES NAV --=======---->
      <li class="nav-item">
         <a class="nav-link <?php echo ($current_page == 'faculty_archive.php') ? '' : 'collapsed'; ?>" href="faculty_archive.php">
            <i class="bi bi-archive"></i>
            <span>Archive</span>
         </a>
      </li><!-- END ARCHIVES NAV -->
      <!----=======-- ABOUT NAV --=======---->
      <li class="nav-item">
         <a class="nav-link <?php echo ($current_page == 'faculty_about.php') ? '' : 'collapsed'; ?>" href="faculty_about.php">
            <i class="bi bi-card-list"></i>
            <span>About</span>
         </a>
      </li><!-- END ABOUT NAV -->
      <!----=======-- PROFILE PAGE NAV --=======---->
      <li class="nav-item">
         <a class="nav-link <?php echo ($current_page == 'faculty_profile.php') ? '' : 'collapsed'; ?>" href="faculty_profile.php">
            <i class="bi bi-person-circle"></i>
            <span>Profile</span>
         </a>
      </li><!-- END PROFILE PAGE NAV -->
   </ul>
</aside><!-- END SIDEBAR-->