<?php
  include "../conn.php";
  include "../process_admin.php";
  if(isset($_SESSION['session_admin'])){
    $admin_ID = $_SESSION['session_admin'];
    $check_admin_info = mysqli_query($conn, "SELECT * FROM `admin` WHERE `id` = '$admin_ID'");
    $fetch_admin_info = mysqli_fetch_assoc($check_admin_info);
    $session_admin_fname = $fetch_admin_info['first_name'];
    $session_admin_lname = $fetch_admin_info['last_name'];
    //picture
    $check_admin_pic = mysqli_query($conn, "SELECT `admin_pic_path` FROM `admin_pic` WHERE `id` = '$admin_ID'");
    if($fetch_admin_pic = mysqli_fetch_assoc($check_admin_pic)){
      $session_admin_pic = "../assets/img/admin_img/" . $fetch_admin_pic['admin_pic_path'];
    }else{
      $session_admin_pic = "../assets/img/default.jpg";
    }
    ?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title> UI-ALPerf | Admin | Archive View </title>
        <link href="../assets/img/ui.png" rel="icon">
        <!----=======-- Vendor CSS Files --=======---->
        <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <!----=======-- Main CSS File --=======---->
        <link href="../assets/css/admin.css" rel="stylesheet">
      </head>
      <body>
        <!----=======-- HEADER --=======---->
        <?php include "../includes/admin_header.php"; ?>
        <!----=======-- SIDEBAR --=======---->
        <?php include "../includes/admin_sidebar.php"; ?>

        <!----=======-- MAIN --=======---->
        <main id="main" class="main">
          <!----=======-- PAGE TITLE --=======---->
          <div class="pagetitle">
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin_home.php">Admin</a></li>
                <li class="breadcrumb-item active">Archive View</li>
              </ol>
            </nav>
          </div><!-- END PAGE TITLE -->
          <section class="section archive_view">
            <div class="row">
              <div class="col-xl-12 rrr">
                <div class="card">
                  <?php
                    if(isset($_GET['report_info_id'])){     
                      $info_id = $_GET['report_info_id'];
                      $select_report_info = mysqli_query($conn, "SELECT * FROM `class_report_info` WHERE `report_info_id` = '$info_id'");
                      $reports_info = mysqli_fetch_assoc($select_report_info);
                      ?>
                        <div class="card-header archive-card">
                          <div class="row">
                            <div class="nnn col-lg-3 col-md-6 col-sm-6"> Section: <strong> <?php echo $reports_info['section'] ?> </strong> </div>
                            <div class="nnn col-lg-3 col-md-6 col-sm-6"> Instructor: <strong> <?php echo $reports_info['instructor'] ?> </strong> </div>
                            <div class="nnn col-lg-3 col-md-6 col-sm-6"> Subject: <strong> <?php echo $reports_info['subject'] ?> </strong> </div>
                            <div class="nnn col-lg-3 col-md-6 col-sm-6"> Date: <strong> <?php echo date('M j, Y', strtotime($reports_info['date'])); ?> </strong> </div>
                            <div class="nnn col-lg-3 col-md-6 col-sm-6"> School Year: <strong> <?php echo $reports_info['school_year'] ?> </strong> </div>
                            <div class="nnn col-lg-3 col-md-6 col-sm-6"> Semester: <strong> <?php echo $reports_info['semester'] ?> </strong> </div>
                            <div class="nnn col-lg-3 col-md-6 col-sm-6"> Observer Name: <strong> <?php echo $reports_info['observer_name'] ?> </strong> </div>
                          </div>
                        </div>
                      <?php
                    }else{
                      echo"No data";
                    }
                  ?>
                  <div class="card-body">
                    <div class="row">
                      <?php
                        if(isset($_GET['report_stu_id']) && isset($_GET['report_ins_id'])){
                          $stu_id = $_GET['report_stu_id'];
                          $ins_id = $_GET['report_ins_id'];
                          $select_stu_pts = mysqli_query($conn, "SELECT * FROM `class_report_stu` WHERE `report_stu_id` = '$stu_id' AND `admin_id` = '$admin_ID'");
                          if(mysqli_num_rows($select_stu_pts) > 0){
                            while($stu_row = mysqli_fetch_assoc($select_stu_pts)){
                              $stu_l_2 = $stu_row['s_l_2'];   $stu_ind_2 = $stu_row['s_ind_2'];   $stu_wg_2 = $stu_row['s_wg_2'];   $stu_anq_2 = $stu_row['s_anq_2'];   $stu_sq_2 = $stu_row['s_sq_2'];   $stu_wc_2 = $stu_row['s_wc_2'];   $stu_sp_2 = $stu_row['s_sp_2'];   $stu_tq_2 = $stu_row['s_tq_2'];   $stu_w_2 = $stu_row['s_w_2'];   $stu_o_2 = $stu_row['s_o_2'];
                              $stu_l_4 = $stu_row['s_l_4'];   $stu_ind_4 = $stu_row['s_ind_4'];   $stu_wg_4 = $stu_row['s_wg_4'];   $stu_anq_4 = $stu_row['s_anq_4'];   $stu_sq_4 = $stu_row['s_sq_4'];   $stu_wc_4 = $stu_row['s_wc_4'];   $stu_sp_4 = $stu_row['s_sp_4'];   $stu_tq_4 = $stu_row['s_tq_4'];   $stu_w_4 = $stu_row['s_w_4'];   $stu_o_4 = $stu_row['s_o_4'];
                              $stu_l_6 = $stu_row['s_l_6'];   $stu_ind_6 = $stu_row['s_ind_6'];   $stu_wg_6 = $stu_row['s_wg_6'];   $stu_anq_6 = $stu_row['s_anq_6'];   $stu_sq_6 = $stu_row['s_sq_6'];   $stu_wc_6 = $stu_row['s_wc_6'];   $stu_sp_6 = $stu_row['s_sp_6'];   $stu_tq_6 = $stu_row['s_tq_6'];   $stu_w_6 = $stu_row['s_w_6'];   $stu_o_6 = $stu_row['s_o_6'];
                              $stu_l_8 = $stu_row['s_l_8'];   $stu_ind_8 = $stu_row['s_ind_8'];   $stu_wg_8 = $stu_row['s_wg_8'];   $stu_anq_8 = $stu_row['s_anq_8'];   $stu_sq_8 = $stu_row['s_sq_8'];   $stu_wc_8 = $stu_row['s_wc_8'];   $stu_sp_8 = $stu_row['s_sp_8'];   $stu_tq_8 = $stu_row['s_tq_8'];   $stu_w_8 = $stu_row['s_w_8'];   $stu_o_8 = $stu_row['s_o_8'];
                              $stu_l_10 = $stu_row['s_l_10']; $stu_ind_10 = $stu_row['s_ind_10']; $stu_wg_10 = $stu_row['s_wg_10']; $stu_anq_10 = $stu_row['s_anq_10']; $stu_sq_10 = $stu_row['s_sq_10']; $stu_wc_10 = $stu_row['s_wc_10']; $stu_sp_10 = $stu_row['s_sp_10']; $stu_tq_10 = $stu_row['s_tq_10']; $stu_w_10 = $stu_row['s_w_10']; $stu_o_10 = $stu_row['s_o_10'];
                              $stu_l_12 = $stu_row['s_l_12']; $stu_ind_12 = $stu_row['s_ind_12']; $stu_wg_12 = $stu_row['s_wg_12']; $stu_anq_12 = $stu_row['s_anq_12']; $stu_sq_12 = $stu_row['s_sq_12']; $stu_wc_12 = $stu_row['s_wc_12']; $stu_sp_12 = $stu_row['s_sp_12']; $stu_tq_12 = $stu_row['s_tq_12']; $stu_w_12 = $stu_row['s_w_12']; $stu_o_12 = $stu_row['s_o_12'];
                              $stu_l_14 = $stu_row['s_l_14']; $stu_ind_14 = $stu_row['s_ind_14']; $stu_wg_14 = $stu_row['s_wg_14']; $stu_anq_14 = $stu_row['s_anq_14']; $stu_sq_14 = $stu_row['s_sq_14']; $stu_wc_14 = $stu_row['s_wc_14']; $stu_sp_14 = $stu_row['s_sp_14']; $stu_tq_14 = $stu_row['s_tq_14']; $stu_w_14 = $stu_row['s_w_14']; $stu_o_14 = $stu_row['s_o_14'];
                              $stu_l_16 = $stu_row['s_l_16']; $stu_ind_16 = $stu_row['s_ind_16']; $stu_wg_16 = $stu_row['s_wg_16']; $stu_anq_16 = $stu_row['s_anq_16']; $stu_sq_16 = $stu_row['s_sq_16']; $stu_wc_16 = $stu_row['s_wc_16']; $stu_sp_16 = $stu_row['s_sp_16']; $stu_tq_16 = $stu_row['s_tq_16']; $stu_w_16 = $stu_row['s_w_16']; $stu_o_16 = $stu_row['s_o_16'];
                              $stu_l_18 = $stu_row['s_l_18']; $stu_ind_18 = $stu_row['s_ind_18']; $stu_wg_18 = $stu_row['s_wg_18']; $stu_anq_18 = $stu_row['s_anq_18']; $stu_sq_18 = $stu_row['s_sq_18']; $stu_wc_18 = $stu_row['s_wc_18']; $stu_sp_18 = $stu_row['s_sp_18']; $stu_tq_18 = $stu_row['s_tq_18']; $stu_w_18 = $stu_row['s_w_18']; $stu_o_18 = $stu_row['s_o_18'];
                              $stu_l_20 = $stu_row['s_l_20']; $stu_ind_20 = $stu_row['s_ind_20']; $stu_wg_20 = $stu_row['s_wg_20']; $stu_anq_20 = $stu_row['s_anq_20']; $stu_sq_20 = $stu_row['s_sq_20']; $stu_wc_20 = $stu_row['s_wc_20']; $stu_sp_20 = $stu_row['s_sp_20']; $stu_tq_20 = $stu_row['s_tq_20']; $stu_w_20 = $stu_row['s_w_20']; $stu_o_20 = $stu_row['s_o_20'];
                              $stu_l_22 = $stu_row['s_l_22']; $stu_ind_22 = $stu_row['s_ind_22']; $stu_wg_22 = $stu_row['s_wg_22']; $stu_anq_22 = $stu_row['s_anq_22']; $stu_sq_22 = $stu_row['s_sq_22']; $stu_wc_22 = $stu_row['s_wc_22']; $stu_sp_22 = $stu_row['s_sp_22']; $stu_tq_22 = $stu_row['s_tq_22']; $stu_w_22 = $stu_row['s_w_22']; $stu_o_22 = $stu_row['s_o_22'];
                              $stu_l_24 = $stu_row['s_l_24']; $stu_ind_24 = $stu_row['s_ind_24']; $stu_wg_24 = $stu_row['s_wg_24']; $stu_anq_24 = $stu_row['s_anq_24']; $stu_sq_24 = $stu_row['s_sq_24']; $stu_wc_24 = $stu_row['s_wc_24']; $stu_sp_24 = $stu_row['s_sp_24']; $stu_tq_24 = $stu_row['s_tq_24']; $stu_w_24 = $stu_row['s_w_24']; $stu_o_24 = $stu_row['s_o_24'];
                              $stu_l_26 = $stu_row['s_l_26']; $stu_ind_26 = $stu_row['s_ind_26']; $stu_wg_26 = $stu_row['s_wg_26']; $stu_anq_26 = $stu_row['s_anq_26']; $stu_sq_26 = $stu_row['s_sq_26']; $stu_wc_26 = $stu_row['s_wc_26']; $stu_sp_26 = $stu_row['s_sp_26']; $stu_tq_26 = $stu_row['s_tq_26']; $stu_w_26 = $stu_row['s_w_26']; $stu_o_26 = $stu_row['s_o_26'];
                              $stu_l_28 = $stu_row['s_l_28']; $stu_ind_28 = $stu_row['s_ind_28']; $stu_wg_28 = $stu_row['s_wg_28']; $stu_anq_28 = $stu_row['s_anq_28']; $stu_sq_28 = $stu_row['s_sq_28']; $stu_wc_28 = $stu_row['s_wc_28']; $stu_sp_28 = $stu_row['s_sp_28']; $stu_tq_28 = $stu_row['s_tq_28']; $stu_w_28 = $stu_row['s_w_28']; $stu_o_28 = $stu_row['s_o_28'];
                              $stu_l_30 = $stu_row['s_l_30']; $stu_ind_30 = $stu_row['s_ind_30']; $stu_wg_30 = $stu_row['s_wg_30']; $stu_anq_30 = $stu_row['s_anq_30']; $stu_sq_30 = $stu_row['s_sq_30']; $stu_wc_30 = $stu_row['s_wc_30']; $stu_sp_30 = $stu_row['s_sp_30']; $stu_tq_30 = $stu_row['s_tq_30']; $stu_w_30 = $stu_row['s_w_30']; $stu_o_30 = $stu_row['s_o_30'];

                              //ACTIVE LEARNING STUDENTS
                              $ACTIVE_stu_2 =  $stu_ind_2  + $stu_wg_2  + $stu_anq_2  + $stu_sq_2  + $stu_wc_2  + $stu_sp_2  + $stu_tq_2;
                              $ACTIVE_stu_4 =  $stu_ind_4  + $stu_wg_4  + $stu_anq_4  + $stu_sq_4  + $stu_wc_4  + $stu_sp_4  + $stu_tq_4;
                              $ACTIVE_stu_6 =  $stu_ind_6  + $stu_wg_6  + $stu_anq_6  + $stu_sq_6  + $stu_wc_6  + $stu_sp_6  + $stu_tq_6;
                              $ACTIVE_stu_8 =  $stu_ind_8  + $stu_wg_8  + $stu_anq_8  + $stu_sq_8  + $stu_wc_8  + $stu_sp_8  + $stu_tq_8;                                             
                              $ACTIVE_stu_10 = $stu_ind_10 + $stu_wg_10 + $stu_anq_10 + $stu_sq_10 + $stu_wc_10 + $stu_sp_10 + $stu_tq_10;
                              $ACTIVE_stu_12 = $stu_ind_12 + $stu_wg_12 + $stu_anq_12 + $stu_sq_12 + $stu_wc_12 + $stu_sp_12 + $stu_tq_12;
                              $ACTIVE_stu_14 = $stu_ind_14 + $stu_wg_14 + $stu_anq_14 + $stu_sq_14 + $stu_wc_14 + $stu_sp_14 + $stu_tq_14;
                              $ACTIVE_stu_16 = $stu_ind_16 + $stu_wg_16 + $stu_anq_16 + $stu_sq_16 + $stu_wc_16 + $stu_sp_16 + $stu_tq_16;
                              $ACTIVE_stu_18 = $stu_ind_18 + $stu_wg_18 + $stu_anq_18 + $stu_sq_18 + $stu_wc_18 + $stu_sp_18 + $stu_tq_18;
                              $ACTIVE_stu_20 = $stu_ind_20 + $stu_wg_20 + $stu_anq_20 + $stu_sq_20 + $stu_wc_20 + $stu_sp_20 + $stu_tq_20;
                              $ACTIVE_stu_22 = $stu_ind_22 + $stu_wg_22 + $stu_anq_22 + $stu_sq_22 + $stu_wc_22 + $stu_sp_22 + $stu_tq_22;
                              $ACTIVE_stu_24 = $stu_ind_24 + $stu_wg_24 + $stu_anq_24 + $stu_sq_24 + $stu_wc_24 + $stu_sp_24 + $stu_tq_24;
                              $ACTIVE_stu_26 = $stu_ind_26 + $stu_wg_26 + $stu_anq_26 + $stu_sq_26 + $stu_wc_26 + $stu_sp_26 + $stu_tq_26;
                              $ACTIVE_stu_28 = $stu_ind_28 + $stu_wg_28 + $stu_anq_28 + $stu_sq_28 + $stu_wc_28 + $stu_sp_28 + $stu_tq_28;
                              $ACTIVE_stu_30 = $stu_ind_30 + $stu_wg_30 + $stu_anq_30 + $stu_sq_30 + $stu_wc_30 + $stu_sp_30 + $stu_tq_30;

                              $stu_total_ACTIVE = $ACTIVE_stu_2 + $ACTIVE_stu_4 + $ACTIVE_stu_6 + $ACTIVE_stu_8 + $ACTIVE_stu_10 + 
                                                  $ACTIVE_stu_12 + $ACTIVE_stu_14 + $ACTIVE_stu_16 + $ACTIVE_stu_18 + $ACTIVE_stu_20 +
                                                  $ACTIVE_stu_22 + $ACTIVE_stu_24 + $ACTIVE_stu_26 + $ACTIVE_stu_28 + $ACTIVE_stu_30;

                              //CHART VAR FOR ACTIVE LEARNING STUDENTS
                              $s_percent_ind = $stu_ind_2 + $stu_ind_4 + $stu_ind_6 + $stu_ind_8 + $stu_ind_10 + $stu_ind_12 + $stu_ind_14 + $stu_ind_16 + $stu_ind_18 + $stu_ind_20 + $stu_ind_22 + $stu_ind_24 + $stu_ind_26 + $stu_ind_28 + $stu_ind_30;
                              $s_percent_wg =  $stu_wg_2  + $stu_wg_4  + $stu_wg_6  + $stu_wg_8  + $stu_wg_10  + $stu_wg_12  + $stu_wg_14  + $stu_wg_16  + $stu_wg_18  + $stu_wg_20  + $stu_wg_22  + $stu_wg_24  + $stu_wg_26  + $stu_wg_28  + $stu_wg_30;
                              $s_percent_anq = $stu_anq_2 + $stu_anq_4 + $stu_anq_6 + $stu_anq_8 + $stu_anq_10 + $stu_anq_12 + $stu_anq_14 + $stu_anq_16 + $stu_anq_18 + $stu_anq_20 + $stu_anq_22 + $stu_anq_24 + $stu_anq_26 + $stu_anq_28 + $stu_anq_30;
                              $s_percent_sq =  $stu_sq_2  + $stu_sq_4  + $stu_sq_6  + $stu_sq_8  + $stu_sq_10  + $stu_sq_12  + $stu_sq_14  + $stu_sq_16  + $stu_sq_18  + $stu_sq_20  + $stu_sq_22  + $stu_sq_24  + $stu_sq_26  + $stu_sq_28  + $stu_sq_30;
                              $s_percent_wc =  $stu_wc_2  + $stu_wc_4  + $stu_wc_6  + $stu_wc_8  + $stu_wc_10  + $stu_wc_12  + $stu_wc_14  + $stu_wc_16  + $stu_wc_18  + $stu_wc_20  + $stu_wc_22  + $stu_wc_24  + $stu_wc_26  + $stu_wc_28  + $stu_wc_30;
                              $s_percent_sp =  $stu_sp_2  + $stu_sp_4  + $stu_sp_6  + $stu_sp_8  + $stu_sp_10  + $stu_sp_12  + $stu_sp_14  + $stu_sp_16  + $stu_sp_18  + $stu_sp_20  + $stu_sp_22  + $stu_sp_24  + $stu_sp_26  + $stu_sp_28  + $stu_sp_30;
                              $s_percent_tq =  $stu_tq_2  + $stu_tq_4  + $stu_tq_6  + $stu_tq_8  + $stu_tq_10  + $stu_tq_12  + $stu_tq_14  + $stu_tq_16  + $stu_tq_18  + $stu_tq_20  + $stu_tq_22  + $stu_tq_24  + $stu_tq_26  + $stu_tq_28  + $stu_tq_30;

                              //PASSIVE STUDENTS
                              $PASSIVE_stu_2 =  $stu_l_2  + $stu_w_2  + $stu_o_2;
                              $PASSIVE_stu_4 =  $stu_l_4  + $stu_w_4  + $stu_o_4;
                              $PASSIVE_stu_6 =  $stu_l_6  + $stu_w_6  + $stu_o_6;
                              $PASSIVE_stu_8 =  $stu_l_8  + $stu_w_8  + $stu_o_8;
                              $PASSIVE_stu_10 = $stu_l_10 + $stu_w_10 + $stu_o_10;
                              $PASSIVE_stu_12 = $stu_l_12 + $stu_w_12 + $stu_o_12;
                              $PASSIVE_stu_14 = $stu_l_14 + $stu_w_14 + $stu_o_14;
                              $PASSIVE_stu_16 = $stu_l_16 + $stu_w_16 + $stu_o_16;
                              $PASSIVE_stu_18 = $stu_l_18 + $stu_w_18 + $stu_o_18;
                              $PASSIVE_stu_20 = $stu_l_20 + $stu_w_20 + $stu_o_20;
                              $PASSIVE_stu_22 = $stu_l_22 + $stu_w_22 + $stu_o_22;
                              $PASSIVE_stu_24 = $stu_l_24 + $stu_w_24 + $stu_o_24;
                              $PASSIVE_stu_26 = $stu_l_26 + $stu_w_26 + $stu_o_26;
                              $PASSIVE_stu_28 = $stu_l_28 + $stu_w_28 + $stu_o_28;
                              $PASSIVE_stu_30 = $stu_l_30 + $stu_w_30 + $stu_o_30;

                              $stu_total_PASSIVE = $PASSIVE_stu_2 + $PASSIVE_stu_4 + $PASSIVE_stu_6 + $PASSIVE_stu_8 + $PASSIVE_stu_10 + 
                                                  $PASSIVE_stu_12 + $PASSIVE_stu_14 + $PASSIVE_stu_16 + $PASSIVE_stu_18 + $PASSIVE_stu_20 +
                                                  $PASSIVE_stu_22 + $PASSIVE_stu_24 + $PASSIVE_stu_26 + $PASSIVE_stu_28 + $PASSIVE_stu_30;
                              
                              //CHART VAR FOR PASSIVE STUDENTS
                              $s_percent_l = $stu_l_2 + $stu_l_4 + $stu_l_6 + $stu_l_8 + $stu_l_10 + $stu_l_12 + $stu_l_14 + $stu_l_16 + $stu_l_18 + $stu_l_20 + $stu_l_22 + $stu_l_24 + $stu_l_26 + $stu_l_28 + $stu_l_30;
                              $s_percent_w = $stu_w_2 + $stu_w_4 + $stu_w_6 + $stu_w_8 + $stu_w_10 + $stu_w_12 + $stu_w_14 + $stu_w_16 + $stu_w_18 + $stu_w_20 + $stu_w_22 + $stu_w_24 + $stu_w_26 + $stu_w_28 + $stu_w_30;
                              $s_percent_o = $stu_o_2 + $stu_o_4 + $stu_o_6 + $stu_o_8 + $stu_o_10 + $stu_o_12 + $stu_o_14 + $stu_o_16 + $stu_o_18 + $stu_o_20 + $stu_o_22 + $stu_o_24 + $stu_o_26 + $stu_o_28 + $stu_o_30;

                              //TOTAL STUDENTS
                              $stu_active_percentage = ($stu_total_ACTIVE / 150) * 100;
                              $stu_passive_percentage = ($stu_total_PASSIVE / 150) * 100;

                              $stu_total_percentage = (($stu_total_ACTIVE + $stu_total_PASSIVE) / 150) * 100;
                              ?>
                                <div class="col-lg-6 mb-2">
                                  <h5 class="mb-4">Your students doing</h5>
                                  <div class="chart">
                                    <canvas id="studentsPieChart" style="max-height: 320px;"></canvas>
                                    <script>
                                      document.addEventListener("DOMContentLoaded", () => {
                                        new Chart(document.querySelector('#studentsPieChart'), {
                                        type: 'pie',                                                
                                          data: {
                                            labels: ["L", "Ind", "WG", "AnQ", "SQ", "WC", "SP", "TQ", "W", "O"],
                                            datasets: [{
                                              label: 'Students',
                                              data: [<?php echo $s_percent_l;?>, <?php echo $s_percent_ind; ?>, <?php echo $s_percent_wg; ?>, <?php echo $s_percent_anq; ?>, <?php echo $s_percent_sq; ?>, <?php echo $s_percent_wc; ?>, <?php echo $s_percent_sp; ?>, <?php echo $s_percent_tq; ?>, <?php echo $s_percent_w; ?>, <?php echo $s_percent_o; ?>],
                                              backgroundColor: ["#A8BBB9", "#7B9977", "#EAE9D9", "#A2AF9F", "#E7F0E5", "#596157", "#BEDDB8", "#596D56", "#D4E3DE", "#B97B6E"],
                                              borderWidth: 0,
                                              hoverOffset: 4
                                            }]
                                          }
                                        });
                                      });
                                    </script>
                                  </div>
                                  <?php
                                    if($stu_total_percentage >= 60){
                                      ?>
                                        <div class="final_reports text-center">
                                          <div class="row">
                                            <div class="col-12 total">Total: <?php echo number_format($stu_total_percentage, 0); ?>%</div>
                                            <!--<div class="col-12 active">Active: <?php //echo number_format($stu_active_percentage, 0); ?>%</div>-->
                                            <!--<div class="col-12 passive">Passive: <?php //echo number_format($stu_passive_percentage, 0); ?>%</div>-->
                                          </div>
                                          <div class="reports_mess">
                                            <div class="active-mess" style="white-space: nowrap;">Active Learning Students</div>
                                          </div>
                                        </div>
                                      <?php
                                    }else{
                                      ?>
                                        <div class="final_reports text-center">
                                          <div class="row">
                                            <div class="col-12 total">Total: <?php echo number_format($stu_total_percentage, 0); ?>%</div>
                                            <!--<div class="col-12 active">Active: <?php //echo number_format($stu_active_percentage, 0); ?>%</div>-->
                                            <!--<div class="col-12 passive">Passive: <?php //echo number_format($stu_passive_percentage, 0); ?>%</div>-->
                                          </div>
                                          <div class="reports_mess">
                                            <div class="passive-mess" style="white-space: nowrap;">Passive Learning Students</div>
                                          </div>
                                        </div>
                                      <?php
                                    }
                                  ?>
                                  <hr>
                                  <div class="row class-code">
                                    <div class="col-md-6 codek">
                                      <p><strong>L</strong> - Listening: <?php echo $s_percent_l; ?></p>
                                      <p><strong>Ind</strong> - Individual thinking: <?php echo $s_percent_ind; ?></p>
                                      <p><strong>WG</strong> - Worksheet group work: <?php echo $s_percent_wg; ?></p>
                                      <p><strong>AnQ</strong> - Answer questions: <?php echo $s_percent_anq; ?></p>
                                      <p><strong>SQ</strong> - Student asks questions: <?php echo $s_percent_sq; ?></p> 
                                    </div>
                                    <div class="col-md-6 codek">
                                      <p><strong>WC</strong> - Whole class discussion: <?php echo $s_percent_wc; ?></p>
                                      <p><strong>SP</strong> - Student presentation: <?php echo $s_percent_sp; ?></p>          
                                      <p><strong>TQ</strong> - Test/quiz: <?php echo $s_percent_tq; ?></p>
                                      <p><strong>W</strong> - Waiting: <?php echo $s_percent_w; ?></p>
                                      <p><strong>O</strong> - Other: -<?php echo $s_percent_o; ?></p>
                                    </div>
                                  </div>
                                  <hr>
                                </div>
                              <?php
                            }
                          }else{
                            echo "No data found.";
                          }
                          $select_ins_pts = mysqli_query($conn, "SELECT * FROM `class_report_ins` WHERE `report_ins_id` = '$ins_id' AND `admin_id` = '$admin_ID'");
                          if(mysqli_num_rows($select_ins_pts) > 0){
                            while($ins_row = mysqli_fetch_assoc($select_ins_pts)){
                              $ins_lec_2 = $ins_row['i_lec_2'];   $ins_rtw_2 = $ins_row['i_rtw_2'];   $ins_fup_2 = $ins_row['i_fup_2'];   $ins_anq_2 = $ins_row['i_anq_2'];   $ins_pq_2 = $ins_row['i_pq_2'];   $ins_mg_2 = $ins_row['i_mg_2'];   $ins_1o1_2 = $ins_row['i_1o1_2'];   $ins_dv_2 = $ins_row['i_dv_2'];   $ins_w_2 = $ins_row['i_w_2'];   $ins_o_2 = $ins_row['i_o_2'];
                              $ins_lec_4 = $ins_row['i_lec_4'];   $ins_rtw_4 = $ins_row['i_rtw_4'];   $ins_fup_4 = $ins_row['i_fup_4'];   $ins_anq_4 = $ins_row['i_anq_4'];   $ins_pq_4 = $ins_row['i_pq_4'];   $ins_mg_4 = $ins_row['i_mg_4'];   $ins_1o1_4 = $ins_row['i_1o1_4'];   $ins_dv_4 = $ins_row['i_dv_4'];   $ins_w_4 = $ins_row['i_w_4'];   $ins_o_4 = $ins_row['i_o_4'];
                              $ins_lec_6 = $ins_row['i_lec_6'];   $ins_rtw_6 = $ins_row['i_rtw_6'];   $ins_fup_6 = $ins_row['i_fup_6'];   $ins_anq_6 = $ins_row['i_anq_6'];   $ins_pq_6 = $ins_row['i_pq_6'];   $ins_mg_6 = $ins_row['i_mg_6'];   $ins_1o1_6 = $ins_row['i_1o1_6'];   $ins_dv_6 = $ins_row['i_dv_6'];   $ins_w_6 = $ins_row['i_w_6'];   $ins_o_6 = $ins_row['i_o_6'];       
                              $ins_lec_8 = $ins_row['i_lec_8'];   $ins_rtw_8 = $ins_row['i_rtw_8'];   $ins_fup_8 = $ins_row['i_fup_8'];   $ins_anq_8 = $ins_row['i_anq_8'];   $ins_pq_8 = $ins_row['i_pq_8'];   $ins_mg_8 = $ins_row['i_mg_8'];   $ins_1o1_8 = $ins_row['i_1o1_8'];   $ins_dv_8 = $ins_row['i_dv_8'];   $ins_w_8 = $ins_row['i_w_8'];   $ins_o_8 = $ins_row['i_o_8']; 
                              $ins_lec_10 = $ins_row['i_lec_10']; $ins_rtw_10 = $ins_row['i_rtw_10']; $ins_fup_10 = $ins_row['i_fup_10']; $ins_anq_10 = $ins_row['i_anq_10']; $ins_pq_10 = $ins_row['i_pq_10']; $ins_mg_10 = $ins_row['i_mg_10']; $ins_1o1_10 = $ins_row['i_1o1_10']; $ins_dv_10 = $ins_row['i_dv_10']; $ins_w_10 = $ins_row['i_w_10']; $ins_o_10 = $ins_row['i_o_10']; 
                              $ins_lec_12 = $ins_row['i_lec_12']; $ins_rtw_12 = $ins_row['i_rtw_12']; $ins_fup_12 = $ins_row['i_fup_12']; $ins_anq_12 = $ins_row['i_anq_12']; $ins_pq_12 = $ins_row['i_pq_12']; $ins_mg_12 = $ins_row['i_mg_12']; $ins_1o1_12 = $ins_row['i_1o1_12']; $ins_dv_12 = $ins_row['i_dv_12']; $ins_w_12 = $ins_row['i_w_12']; $ins_o_12 = $ins_row['i_o_12']; 
                              $ins_lec_14 = $ins_row['i_lec_14']; $ins_rtw_14 = $ins_row['i_rtw_14']; $ins_fup_14 = $ins_row['i_fup_14']; $ins_anq_14 = $ins_row['i_anq_14']; $ins_pq_14 = $ins_row['i_pq_14']; $ins_mg_14 = $ins_row['i_mg_14']; $ins_1o1_14 = $ins_row['i_1o1_14']; $ins_dv_14 = $ins_row['i_dv_14']; $ins_w_14 = $ins_row['i_w_14']; $ins_o_14 = $ins_row['i_o_14']; 
                              $ins_lec_16 = $ins_row['i_lec_16']; $ins_rtw_16 = $ins_row['i_rtw_16']; $ins_fup_16 = $ins_row['i_fup_16']; $ins_anq_16 = $ins_row['i_anq_16']; $ins_pq_16 = $ins_row['i_pq_16']; $ins_mg_16 = $ins_row['i_mg_16']; $ins_1o1_16 = $ins_row['i_1o1_16']; $ins_dv_16 = $ins_row['i_dv_16']; $ins_w_16 = $ins_row['i_w_16']; $ins_o_16 = $ins_row['i_o_16']; 
                              $ins_lec_18 = $ins_row['i_lec_18']; $ins_rtw_18 = $ins_row['i_rtw_18']; $ins_fup_18 = $ins_row['i_fup_18']; $ins_anq_18 = $ins_row['i_anq_18']; $ins_pq_18 = $ins_row['i_pq_18']; $ins_mg_18 = $ins_row['i_mg_18']; $ins_1o1_18 = $ins_row['i_1o1_18']; $ins_dv_18 = $ins_row['i_dv_18']; $ins_w_18 = $ins_row['i_w_18']; $ins_o_18 = $ins_row['i_o_18'];       
                              $ins_lec_20 = $ins_row['i_lec_20']; $ins_rtw_20 = $ins_row['i_rtw_20']; $ins_fup_20 = $ins_row['i_fup_20']; $ins_anq_20 = $ins_row['i_anq_20']; $ins_pq_20 = $ins_row['i_pq_20']; $ins_mg_20 = $ins_row['i_mg_20']; $ins_1o1_20 = $ins_row['i_1o1_20']; $ins_dv_20 = $ins_row['i_dv_20']; $ins_w_20 = $ins_row['i_w_20']; $ins_o_20 = $ins_row['i_o_20'];       
                              $ins_lec_22 = $ins_row['i_lec_22']; $ins_rtw_22 = $ins_row['i_rtw_22']; $ins_fup_22 = $ins_row['i_fup_22']; $ins_anq_22 = $ins_row['i_anq_22']; $ins_pq_22 = $ins_row['i_pq_22']; $ins_mg_22 = $ins_row['i_mg_22']; $ins_1o1_22 = $ins_row['i_1o1_22']; $ins_dv_22 = $ins_row['i_dv_22']; $ins_w_22 = $ins_row['i_w_22']; $ins_o_22 = $ins_row['i_o_22'];       
                              $ins_lec_24 = $ins_row['i_lec_24']; $ins_rtw_24 = $ins_row['i_rtw_24']; $ins_fup_24 = $ins_row['i_fup_24']; $ins_anq_24 = $ins_row['i_anq_24']; $ins_pq_24 = $ins_row['i_pq_24']; $ins_mg_24 = $ins_row['i_mg_24']; $ins_1o1_24 = $ins_row['i_1o1_24']; $ins_dv_24 = $ins_row['i_dv_24']; $ins_w_24 = $ins_row['i_w_24']; $ins_o_24 = $ins_row['i_o_24'];       
                              $ins_lec_26 = $ins_row['i_lec_26']; $ins_rtw_26 = $ins_row['i_rtw_26']; $ins_fup_26 = $ins_row['i_fup_26']; $ins_anq_26 = $ins_row['i_anq_26']; $ins_pq_26 = $ins_row['i_pq_26']; $ins_mg_26 = $ins_row['i_mg_26']; $ins_1o1_26 = $ins_row['i_1o1_26']; $ins_dv_26 = $ins_row['i_dv_26']; $ins_w_26 = $ins_row['i_w_26']; $ins_o_26 = $ins_row['i_o_26'];       
                              $ins_lec_28 = $ins_row['i_lec_28']; $ins_rtw_28 = $ins_row['i_rtw_28']; $ins_fup_28 = $ins_row['i_fup_28']; $ins_anq_28 = $ins_row['i_anq_28']; $ins_pq_28 = $ins_row['i_pq_28']; $ins_mg_28 = $ins_row['i_mg_28']; $ins_1o1_28 = $ins_row['i_1o1_28']; $ins_dv_28 = $ins_row['i_dv_28']; $ins_w_28 = $ins_row['i_w_28']; $ins_o_28 = $ins_row['i_o_28'];       
                              $ins_lec_30 = $ins_row['i_lec_30']; $ins_rtw_30 = $ins_row['i_rtw_30']; $ins_fup_30 = $ins_row['i_fup_30']; $ins_anq_30 = $ins_row['i_anq_30']; $ins_pq_30 = $ins_row['i_pq_30']; $ins_mg_30 = $ins_row['i_mg_30']; $ins_1o1_30 = $ins_row['i_1o1_30']; $ins_dv_30 = $ins_row['i_dv_30']; $ins_w_30 = $ins_row['i_w_30']; $ins_o_30 = $ins_row['i_o_30']; 

                              //ACTIVE LEARNING INSTRUCTOR
                              $ACTIVE_ins_2 =  $ins_rtw_2  + $ins_fup_2  + $ins_anq_2  + $ins_pq_2  + $ins_mg_2  + $ins_1o1_2  + $ins_dv_2;
                              $ACTIVE_ins_4 =  $ins_rtw_4  + $ins_fup_4  + $ins_anq_4  + $ins_pq_4  + $ins_mg_4  + $ins_1o1_4  + $ins_dv_4;
                              $ACTIVE_ins_6 =  $ins_rtw_6  + $ins_fup_6  + $ins_anq_6  + $ins_pq_6  + $ins_mg_6  + $ins_1o1_6  + $ins_dv_6;
                              $ACTIVE_ins_8 =  $ins_rtw_8  + $ins_fup_8  + $ins_anq_8  + $ins_pq_8  + $ins_mg_8  + $ins_1o1_8  + $ins_dv_8;                                             
                              $ACTIVE_ins_10 = $ins_rtw_10 + $ins_fup_10 + $ins_anq_10 + $ins_pq_10 + $ins_mg_10 + $ins_1o1_10 + $ins_dv_10;  
                              $ACTIVE_ins_12 = $ins_rtw_12 + $ins_fup_12 + $ins_anq_12 + $ins_pq_12 + $ins_mg_12 + $ins_1o1_12 + $ins_dv_12;
                              $ACTIVE_ins_14 = $ins_rtw_14 + $ins_fup_14 + $ins_anq_14 + $ins_pq_14 + $ins_mg_14 + $ins_1o1_14 + $ins_dv_14;
                              $ACTIVE_ins_16 = $ins_rtw_16 + $ins_fup_16 + $ins_anq_16 + $ins_pq_16 + $ins_mg_16 + $ins_1o1_16 + $ins_dv_16;
                              $ACTIVE_ins_18 = $ins_rtw_18 + $ins_fup_18 + $ins_anq_18 + $ins_pq_18 + $ins_mg_18 + $ins_1o1_18 + $ins_dv_18;
                              $ACTIVE_ins_20 = $ins_rtw_20 + $ins_fup_20 + $ins_anq_20 + $ins_pq_20 + $ins_mg_20 + $ins_1o1_20 + $ins_dv_20;
                              $ACTIVE_ins_22 = $ins_rtw_22 + $ins_fup_22 + $ins_anq_22 + $ins_pq_22 + $ins_mg_22 + $ins_1o1_22 + $ins_dv_22;
                              $ACTIVE_ins_24 = $ins_rtw_24 + $ins_fup_24 + $ins_anq_24 + $ins_pq_24 + $ins_mg_24 + $ins_1o1_24 + $ins_dv_24;
                              $ACTIVE_ins_26 = $ins_rtw_26 + $ins_fup_26 + $ins_anq_26 + $ins_pq_26 + $ins_mg_26 + $ins_1o1_26 + $ins_dv_26;
                              $ACTIVE_ins_28 = $ins_rtw_28 + $ins_fup_28 + $ins_anq_28 + $ins_pq_28 + $ins_mg_28 + $ins_1o1_28 + $ins_dv_28;
                              $ACTIVE_ins_30 = $ins_rtw_30 + $ins_fup_30 + $ins_anq_30 + $ins_pq_30 + $ins_mg_30 + $ins_1o1_30 + $ins_dv_30;

                              $ins_total_ACTIVE = $ACTIVE_ins_2 + $ACTIVE_ins_4 + $ACTIVE_ins_6 + $ACTIVE_ins_8 + $ACTIVE_ins_10 + 
                                                  $ACTIVE_ins_12 + $ACTIVE_ins_14 + $ACTIVE_ins_16 + $ACTIVE_ins_18 + $ACTIVE_ins_20 +
                                                  $ACTIVE_ins_22 + $ACTIVE_ins_24 + $ACTIVE_ins_26 + $ACTIVE_ins_28 + $ACTIVE_ins_30;

                              //CHART VAR FOR ACTIVE LEARNING INSTRUCTOR
                              $i_percent_rtw = $ins_rtw_2 + $ins_rtw_4 + $ins_rtw_6 + $ins_rtw_8 + $ins_rtw_10 + $ins_rtw_12 + $ins_rtw_14 + $ins_rtw_16 + $ins_rtw_18 + $ins_rtw_20 + $ins_rtw_22 + $ins_rtw_24 + $ins_rtw_26 + $ins_rtw_28 + $ins_rtw_30;
                              $i_percent_fup = $ins_fup_2 + $ins_fup_4 + $ins_fup_6 + $ins_fup_8 + $ins_fup_10 + $ins_fup_12 + $ins_fup_14 + $ins_fup_16 + $ins_fup_18 + $ins_fup_20 + $ins_fup_22 + $ins_fup_24 + $ins_fup_26 + $ins_fup_28 + $ins_fup_30;
                              $i_percent_anq = $ins_anq_2 + $ins_anq_4 + $ins_anq_6 + $ins_anq_8 + $ins_anq_10 + $ins_anq_12 + $ins_anq_14 + $ins_anq_16 + $ins_anq_18 + $ins_anq_20 + $ins_anq_22 + $ins_anq_24 + $ins_anq_26 + $ins_anq_28 + $ins_anq_30;
                              $i_percent_pq =  $ins_pq_2  + $ins_pq_4  + $ins_pq_6  + $ins_pq_8  + $ins_pq_10  + $ins_pq_12  + $ins_pq_14  + $ins_pq_16  + $ins_pq_18  + $ins_pq_20  + $ins_pq_22  + $ins_pq_24  + $ins_pq_26  + $ins_pq_28  + $ins_pq_30;
                              $i_percent_mg =  $ins_mg_2  + $ins_mg_4  + $ins_mg_6  + $ins_mg_8  + $ins_mg_10  + $ins_mg_12  + $ins_mg_14  + $ins_mg_16  + $ins_mg_18  + $ins_mg_20  + $ins_mg_22  + $ins_mg_24  + $ins_mg_26  + $ins_mg_28  + $ins_mg_30;
                              $i_percent_1o1 = $ins_1o1_2 + $ins_1o1_4 + $ins_1o1_6 + $ins_1o1_8 + $ins_1o1_10 + $ins_1o1_12 + $ins_1o1_14 + $ins_1o1_16 + $ins_1o1_18 + $ins_1o1_20 + $ins_1o1_22 + $ins_1o1_24 + $ins_1o1_26 + $ins_1o1_28 + $ins_1o1_30;
                              $i_percent_dv =  $ins_dv_2  + $ins_dv_4  + $ins_dv_6  + $ins_dv_8  + $ins_dv_10  + $ins_dv_12  + $ins_dv_14  + $ins_dv_16  + $ins_dv_18  + $ins_dv_20  + $ins_dv_22  + $ins_dv_24  + $ins_dv_26  + $ins_dv_28  + $ins_dv_30;

                              //PASSIVE INSTRUCTOR
                              $PASSIVE_ins_2 =  $ins_lec_2  + $ins_w_2  + $ins_o_2;
                              $PASSIVE_ins_4 =  $ins_lec_4  + $ins_w_4  + $ins_o_4;
                              $PASSIVE_ins_6 =  $ins_lec_6  + $ins_w_6  + $ins_o_6;
                              $PASSIVE_ins_8 =  $ins_lec_8  + $ins_w_8  + $ins_o_8;
                              $PASSIVE_ins_10 = $ins_lec_10 + $ins_w_10 + $ins_o_10;
                              $PASSIVE_ins_12 = $ins_lec_12 + $ins_w_12 + $ins_o_12;
                              $PASSIVE_ins_14 = $ins_lec_14 + $ins_w_14 + $ins_o_14;
                              $PASSIVE_ins_16 = $ins_lec_16 + $ins_w_16 + $ins_o_16;
                              $PASSIVE_ins_18 = $ins_lec_18 + $ins_w_18 + $ins_o_18;
                              $PASSIVE_ins_20 = $ins_lec_20 + $ins_w_20 + $ins_o_20;
                              $PASSIVE_ins_22 = $ins_lec_22 + $ins_w_22 + $ins_o_22;
                              $PASSIVE_ins_24 = $ins_lec_24 + $ins_w_24 + $ins_o_24;
                              $PASSIVE_ins_26 = $ins_lec_26 + $ins_w_26 + $ins_o_26;
                              $PASSIVE_ins_28 = $ins_lec_28 + $ins_w_28 + $ins_o_28;
                              $PASSIVE_ins_30 = $ins_lec_30 + $ins_w_30 + $ins_o_30;

                              $ins_total_PASSIVE = $PASSIVE_ins_2 + $PASSIVE_ins_4 + $PASSIVE_ins_6 + $PASSIVE_ins_8 + $PASSIVE_ins_10 +
                                                  $PASSIVE_ins_12 + $PASSIVE_ins_14 + $PASSIVE_ins_16 + $PASSIVE_ins_18 + $PASSIVE_ins_20 +
                                                  $PASSIVE_ins_22 + $PASSIVE_ins_24 + $PASSIVE_ins_26 + $PASSIVE_ins_28 + $PASSIVE_ins_30;

                              //CHART VAR FOR PASSIVE INSTRUCTOR
                              $i_percent_lec = $ins_lec_2 + $ins_lec_4 + $ins_lec_6 + $ins_lec_8 + $ins_lec_10 + $ins_lec_12 + $ins_lec_14 + $ins_lec_16 + $ins_lec_18 + $ins_lec_20 + $ins_lec_22 + $ins_lec_24 + $ins_lec_26 + $ins_lec_28 + $ins_lec_30;
                              $i_percent_w =   $ins_w_2   + $ins_w_4   + $ins_w_6   + $ins_w_8   + $ins_w_10   + $ins_w_12   + $ins_w_14   + $ins_w_16   + $ins_w_18   + $ins_w_20   + $ins_w_22   + $ins_w_24   + $ins_w_26   + $ins_w_28   + $ins_w_30;
                              $i_percent_o =   $ins_o_2   + $ins_o_4   + $ins_o_6   + $ins_o_8   + $ins_o_10   + $ins_o_12   + $ins_o_14   + $ins_o_16   + $ins_o_18   + $ins_o_20   + $ins_o_22   + $ins_o_24   + $ins_o_26   + $ins_o_28   + $ins_o_30;

                              //TOTAL INSTRUCTOR
                              $ins_active_percentage = ($ins_total_ACTIVE / 150) * 100;
                              $ins_passive_percentage = ($ins_total_PASSIVE / 150) * 100;

                              $ins_total_percentage = (($ins_total_ACTIVE + $ins_total_PASSIVE) / 150) * 100;
                              ?>
                                <div class="col-lg-6 mb-2">
                                  <h5 class="mb-4">Your doing</h5>
                                  <div class="chart">
                                    <canvas id="instructorPieChart" style="max-height: 320px;"></canvas>
                                    <script>
                                      document.addEventListener("DOMContentLoaded", () => {
                                        new Chart(document.querySelector('#instructorPieChart'), {
                                        type: 'pie',     
                                          data: {
                                            labels: ["Lec", "RtW", "FUp", "AnQ", "PQ", "MG", "1o1", "D/V", "W", "O"],
                                            datasets: [{
                                              label: 'Instructor',
                                              data: [<?php echo $i_percent_lec; ?>, <?php echo $i_percent_rtw; ?>, <?php echo $i_percent_fup; ?>, <?php echo $i_percent_anq; ?>, <?php echo $i_percent_pq; ?>, <?php echo $i_percent_mg; ?>, <?php echo $i_percent_1o1; ?>, <?php echo $i_percent_dv; ?>, <?php echo $i_percent_w; ?>, <?php echo $i_percent_o; ?>,],
                                              backgroundColor: ["#A8BBB9", "#E5E2D9", "#F4F8EF", "#A2AF9F", "#848f70", "#E5EBDE", "#C6CFBC", "#607055", "#D4E3DE", "#B97B6E"],
                                              borderWidth: 0,
                                              hoverOffset: 4
                                            }]
                                          }
                                        });
                                      });
                                    </script>
                                  </div>
                                  <?php
                                    if($ins_total_percentage >= 60){
                                      ?>
                                        <div class="final_reports text-center">
                                          <div class="row">
                                            <div class="col-12 total">Total: <?php echo number_format($ins_total_percentage, 0); ?>%</div>
                                            <!--<div class="col-12 active">Active: <?php //echo number_format($ins_active_percentage, 0); ?>%</div>-->
                                            <!--<div class="col-12 passive">Passive: <?php //echo number_format($ins_passive_percentage, 0); ?>%</div>-->
                                          </div>
                                          <div class="reports_mess">
                                            <div class="active-mess" style="white-space: nowrap;">Active Learning Instructor</div>
                                          </div>
                                        </div>
                                      <?php
                                    }else{
                                      ?>
                                        <div class="final_reports text-center">
                                          <div class="row">
                                            <div class="col-12 total">Total: <?php echo number_format($ins_total_percentage, 0); ?>%</div>
                                            <!--<div class="col-12 active">Active: <?php //echo number_format($ins_active_percentage, 0); ?>%</div>-->
                                            <!--<div class="col-12 passive">Passive: <?php //echo number_format($ins_passive_percentage, 0); ?>%</div>-->
                                          </div>
                                          <div class="reports_mess">
                                            <div class="passive-mess" style="white-space: nowrap;">Passive Learning Instructor</div>
                                          </div>
                                        </div>
                                      <?php
                                    }
                                  ?>
                                  <hr>
                                  <div class="row class-code">
                                    <div class="col-md-6 codek">
                                      <p><strong>Lec</strong> - Lecturing: <?php echo $i_percent_lec; ?></p>
                                      <p><strong>RtW</strong> - Real-time Writing: <?php echo $i_percent_rtw; ?></p>
                                      <p><strong>FUp</strong> - Follow-up: <?php echo $i_percent_fup; ?></p>
                                      <p><strong>AnQ</strong> - Answer questions: <?php echo $i_percent_anq; ?></p>     
                                      <p><strong>PQ</strong> - Pose questions: <?php echo $i_percent_pq; ?></p>          
                                    </div>
                                    <div class="col-md-6 codek">
                                      <p><strong>MG</strong> - Moving/Guiding: <?php echo $i_percent_mg; ?></p>
                                      <p><strong>1o1</strong> - One-on-one: <?php echo $i_percent_1o1; ?></p>
                                      <p><strong>D/V</strong> - Demonstration: <?php echo $i_percent_dv; ?></p>
                                      <p><strong>W</strong> - Waiting: <?php echo $i_percent_w; ?></p>
                                      <p><strong>O</strong> - Other: -<?php echo $i_percent_o; ?></p>
                                    </div>  
                                  </div>
                                  <hr>
                                </div>
                              <?php
                            }
                          }else{
                            echo "No data found.";
                          }
                        }else{
                          echo 'No data provided.';
                        }
                      ?>
                      <?php
                        if(isset($_GET['report_com_id'])){
                          $com_id = $_GET['report_com_id'];
                          $select_com = mysqli_query($conn, "SELECT * FROM `class_report_com` WHERE `report_com_id` = '$com_id' AND `admin_id` = '$admin_ID'");
                          if(mysqli_num_rows($select_com) > 0){
                            while($com_row = mysqli_fetch_assoc($select_com)){
                              ?>
                                <div class="col-12">
                                  <label class="fw-bold">Comments:</label>
                                  <textarea class="form-control" rows="3" disabled><?php echo $com_row['comment'] ?></textarea>
                                </div>
                              <?php
                            }
                          }
                        }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </main><!-- END MAIN -->

        <!----=======-- FOOTER --=======---->
        <footer id="footer" class="footer">
          <div class="copyright">
            &copy; 2023 <strong><span> UI-ALPerf: UI Active Learning Performance </span></strong><br> All Rights Reserved
          </div>
        </footer><!-- END FOOTER -->

        <!----=======-- Vendor JS Files --=======---->
        <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/vendor/chart.js/chart.umd.js"></script>
        <!----=======-- Main JS File --=======---->
        <script src="../assets/js/main.js"></script>
      </body>
      </html>
    <?php
  }else{
    header("Location: ../index.php"); exit;
  }
?>