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
        <title> UI-ALPerf | Admin | Class </title>
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
                <li class="breadcrumb-item active">Class</li>
                <?php
                  $select_acad = mysqli_query($conn, "SELECT * FROM `academic_year` WHERE `status` = 1");
                  if($fetch_acad = mysqli_fetch_assoc($select_acad)){
                    $report_year = $fetch_acad['year'];
                    $report_semester = $fetch_acad['semester'];
                    ?>
                      <li class="breadcrumb-item route">SY: <?php echo $report_year ?> </li>
                      <li class="breadcrumb-item route"><?php echo $report_semester ?> </li>
                    <?php
                  }
                ?>
              </ol>
            </nav>
          </div><!-- END PAGE TITLE -->
          <section class="section class">
            <div class="row">
              <div class="col-xl-12 ccc">
                <div class="card">
                  <div class="card-header">
                    <?php
                      if(isset($_POST['classInfo-next'])){
                        $class_section = mysqli_real_escape_string($conn, $_POST['classInfo-tmpSection']);
                        $class_instructor = mysqli_real_escape_string($conn, $_POST['classInfo-tmpInstructor']);
                        $class_subject = mysqli_real_escape_string($conn, $_POST['classInfo-tmpSubject']);
                        $class_date = date('Y-m-d H:i:s');
                        $select_acad = mysqli_query($conn, "SELECT * FROM `academic_year` WHERE `status` = 1");
                        if($fetch_acad = mysqli_fetch_assoc($select_acad)){
                          $report_year = $fetch_acad['year'];
                          $report_semester = $fetch_acad['semester'];
                          ?>
                            <div class="row">
                              <div class="nnn col-lg-3 col-md-6 col-sm-6"> Section: <strong><?php echo $class_section; ?></strong></div>
                              <div class="nnn col-lg-3 col-md-6 col-sm-6"> Instructor: <strong><?php echo $class_instructor; ?></strong></div>
                              <div class="nnn col-lg-3 col-md-6 col-sm-6"> Subject: <strong><?php echo $class_subject; ?></strong></div>
                              <div class="nnn col-lg-3 col-md-6 col-sm-6"> Date: <strong><?php echo date('M j, Y', strtotime($class_date)); ?></strong></div>
                              <div class="nnn col-lg-3 col-md-6 col-sm-6"> School Year: <strong><?php echo $report_year; ?></strong></div>
                              <div class="nnn col-lg-3 col-md-6 col-sm-6"> Semester: <strong><?php echo $report_semester; ?></strong></div>
                              <div class="nnn col-lg-3 col-md-6 col-sm-6"> Observer Name: <strong><?php echo $session_admin_fname.' '.$session_admin_lname; ?></strong></div>
                            </div>
                          <?php
                        }
                      }
                    ?>
                  </div>
                  <div class="card-body">       
                    <div class="class_timer_container">
                      <div class="class_timer d-flex align-items-center">
                        <div class="timer" id="timer">00:00</div>
                        <div>
                          <button id="toggle" onclick="toggleTimer()"><i id="toggle-icon" class="bi bi-play-fill"></i></button>
                          <button id="restart" onclick="restartTimer()" disabled><i class="bi bi-bootstrap-reboot"></i></button>
                        </div>
                      </div>
                    </div>
                    <script>
                      let timerInterval;
                      let seconds = 0;
                      let minutes = 0;
                      let isTimerRunning = false;
                      function toggleTimer() {
                        if (!isTimerRunning) {
                          startTimer();
                        } else {
                          pauseTimer();
                        }
                      }
                      function startTimer() {
                        // Enable all checkboxes and submit button
                        enableCheckboxes(true);
                        enableSubmitButton(true);
                        document.getElementById("toggle-icon").classList.remove("bi-play-fill");
                        document.getElementById("toggle-icon").classList.add("bi-pause-fill");
                        isTimerRunning = true;
                        document.getElementById("restart").disabled = false;
                        timerInterval = setInterval(updateTimer, 1000);
                      }
                      function updateTimer() {
                        seconds++;
                        if (seconds === 60) {
                          seconds = 0;
                          minutes++;
                        }
                        if (minutes === 30) {
                          pauseTimer();
                        }
                        const formattedTime = pad(minutes) + ':' + pad(seconds);
                        document.getElementById("timer").textContent = formattedTime;
                      }
                      function pauseTimer() {
                        // Enable all checkboxes and submit button
                        enableCheckboxes(true);
                        enableSubmitButton(true);
                        document.getElementById("toggle-icon").classList.remove("bi-pause-fill");
                        document.getElementById("toggle-icon").classList.add("bi-play-fill");
                        isTimerRunning = false;
                        clearInterval(timerInterval);
                      }
                      function restartTimer() {
                        // Disable all checkboxes and submit button
                        enableCheckboxes(false);
                        enableSubmitButton(false);
                        clearInterval(timerInterval);
                        seconds = 0;
                        minutes = 0;
                        document.getElementById("timer").textContent = "00:00";
                        document.getElementById("toggle-icon").classList.remove("bi-pause-fill");
                        document.getElementById("toggle-icon").classList.add("bi-play-fill");
                        isTimerRunning = false;
                        document.getElementById("restart").disabled = true;
                      }
                      function pad(value) {
                        return (value < 10) ? "0" + value : value;
                      }
                      function enableCheckboxes(enable) {
                        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                        checkboxes.forEach(checkbox => {
                          checkbox.disabled = !enable;
                        });
                      }
                      function enableSubmitButton(enable) {
                        const submitButton = document.querySelector('input[name="class-submit"]');
                        submitButton.disabled = !enable;
                      }
                    </script>
                    <hr>
                    <?php
                      $select_acad = mysqli_query($conn, "SELECT * FROM `academic_year` WHERE `status` = 1");
                      if($fetch_acad = mysqli_fetch_assoc($select_acad)){
                        $report_year = $fetch_acad['year'];
                        $report_semester = $fetch_acad['semester'];
                        ?>
                          <form action="../process_admin.php" method="POST">
                            <input type="hidden" name="class_info_section" value="<?php echo $class_section; ?>">
                            <input type="hidden" name="class_info_instructor" value="<?php echo $class_instructor; ?>">
                            <input type="hidden" name="class_info_subject" value="<?php echo $class_subject; ?>">
                            <input type="hidden" name="class_info_date" value="<?php echo $class_date; ?>">
                            <input type="hidden" name="class_info_SY" value="<?php echo $report_year; ?>">
                            <input type="hidden" name="class_info_semester" value="<?php echo $report_semester; ?>">
                            <input type="hidden" name="class_info_observerName" value="<?php echo $session_admin_fname.' '.$session_admin_lname; ?>">
                            <div class="row">
                              <div class="col-md-6 mb-2">
                                <h5>Students doing</h5>
                                <div class="legendary justify-content-between">
                                  <button class="legend mb-2 dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#studentsAbb">Legend</button>
                                </div>
                                <div class="abbre collapse" id="studentsAbb">
                                  <p>
                                    <strong>L</strong> - Listening; <strong>Ind</strong> - Individual thinking; <strong>WG</strong> - Worksheet group work; 
                                    <strong>AnQ</strong>  - Answer questions; <strong>SQ</strong>  - Student asks questions; <strong>WC</strong>  - Whole class discussion; 
                                    <strong>SP</strong>  - Student presentation; <strong>TQ</strong>  - Test/quiz; <strong>W</strong>  - Waiting; <strong>O</strong>  - Other;
                                  </p>
                                </div>
                                <div class="card rounded-0">
                                  <table>
                                    <tr>
                                      <th class="min">min</th>
                                      <th>L</th>
                                      <th>Ind</th>
                                      <th>WG</th>
                                      <th>AnQ</th>
                                      <th>SQ</th>
                                      <th>WC</th>
                                      <th>SP</th>
                                      <th>TQ</th>
                                      <th>W</th>
                                      <th>O</th>
                                    </tr>
                                    <tr>
                                      <td class="min">0-2</td>
                                      <td><input type="checkbox" name="s_l_2" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_ind_2" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wg_2" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_anq_2" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sq_2" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wc_2" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sp_2" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_tq_2" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_w_2" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_o_2" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">2</td>
                                      <td><input type="checkbox" name="s_l_4" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_ind_4" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wg_4" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_anq_4" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sq_4" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wc_4" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sp_4" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_tq_4" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_w_4" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_o_4" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">4</td>
                                      <td><input type="checkbox" name="s_l_6" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_ind_6" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wg_6" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_anq_6" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sq_6" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wc_6" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sp_6" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_tq_6" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_w_6" mvalue="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_o_6" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">6</td>
                                      <td><input type="checkbox" name="s_l_8" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_ind_8" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wg_8" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_anq_8" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sq_8" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wc_8" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sp_8" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_tq_8" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_w_8" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_o_8" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">8-10</td>
                                      <td><input type="checkbox" name="s_l_10" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_ind_10" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wg_10" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_anq_10" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sq_10" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wc_10" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sp_10" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_tq_10" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_w_10" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_o_10" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <th class="min">min</th>
                                      <th>L</th>
                                      <th>Ind</th>
                                      <th>WG</th>
                                      <th>AnQ</th>
                                      <th>SQ</th>
                                      <th>WC</th>
                                      <th>SP</th>
                                      <th>TQ</th>
                                      <th>W</th>
                                      <th>O</th>
                                    </tr>
                                    <tr>
                                      <td class="min">10-12</td>
                                      <td><input type="checkbox" name="s_l_12" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_ind_12" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wg_12" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_anq_12" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sq_12" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wc_12" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sp_12" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_tq_12" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_w_12" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_o_12" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">12</td>
                                      <td><input type="checkbox" name="s_l_14" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_ind_14" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wg_14" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_anq_14" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sq_14" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wc_14" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sp_14" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_tq_14" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_w_14" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_o_14" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">14</td>
                                      <td><input type="checkbox" name="s_l_16" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_ind_16" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wg_16" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_anq_16" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sq_16" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wc_16" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sp_16" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_tq_16" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_w_16" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_o_16" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">16</td>
                                      <td><input type="checkbox" name="s_l_18" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_ind_18" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wg_18" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_anq_18" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sq_18" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wc_18" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sp_18" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_tq_18" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_w_18" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_o_18" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">18-20</td>
                                      <td><input type="checkbox" name="s_l_20" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_ind_20" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wg_20" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_anq_20" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sq_20" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wc_20" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sp_20" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_tq_20" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_w_20" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_o_20" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <th class="min">min</th>
                                      <th>L</th>
                                      <th>Ind</th>
                                      <th>WG</th>
                                      <th>AnQ</th>
                                      <th>SQ</th>
                                      <th>WC</th>
                                      <th>SP</th>
                                      <th>TQ</th>
                                      <th>W</th>
                                      <th>O</th>
                                    </tr>
                                    <tr>
                                      <td class="min">20-22</td>
                                      <td><input type="checkbox" name="s_l_22" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_ind_22" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wg_22" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_anq_22" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sq_22" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wc_22" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sp_22" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_tq_22" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_w_22" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_o_22" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">22</td>
                                      <td><input type="checkbox" name="s_l_24" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_ind_24" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wg_24" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_anq_24" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sq_24" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wc_24" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sp_24" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_tq_24" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_w_24" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_o_24" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">24</td>
                                      <td><input type="checkbox" name="s_l_26" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_ind_26" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wg_26" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_anq_26" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sq_26" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wc_26" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sp_26" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_tq_26" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_w_26" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_o_26" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">26</td>
                                      <td><input type="checkbox" name="s_l_28" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_ind_28" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wg_28" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_anq_28" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sq_28" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wc_28" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sp_28" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_tq_28" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_w_28" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_o_28" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">28-30</td>
                                      <td><input type="checkbox" name="s_l_30" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_ind_30" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wg_30" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_anq_30" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sq_30" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_wc_30" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_sp_30" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_tq_30" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_w_30" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="s_o_30" value="1" class="form-control" disabled></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                              <div class="col-md-6 mb-2">
                                <h5>Instructor doing</h5>
                                <div class="legendary justify-content-between">
                                  <button class="legend mb-2 dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#instructorsAbb">Legend</button>
                                </div>
                                <div class="abbre collapse" id="instructorsAbb">
                                  <p>
                                    <strong>Lec</strong> - Lecturing; <strong>RtW</strong> - Real-time Writing; <strong>FUp</strong> - Follow-up; 
                                    <strong>AnQ</strong>  - Answering questions; <strong>PQ</strong>  - Pose questions; <strong>MG</strong>  - Moving/Guiding; 
                                    <strong>1o1</strong>  - One-on-one; <strong>D/V</strong>  - Demonstration; <strong>W</strong>  - Waiting; <strong>O</strong>  - Other;
                                  </p>
                                </div>
                                <div class="card rounded-0">
                                  <table>
                                    <tr>
                                      <th class="min">min</th>
                                      <th>Lec</th>
                                      <th>RtW</th>
                                      <th>FUp</th>
                                      <th>AnQ</th>
                                      <th>PQ</th>
                                      <th>MG</th>
                                      <th>1o1</th>
                                      <th>D/V</th>
                                      <th>W</th>
                                      <th>O</th>
                                    </tr>
                                    <tr>
                                      <td class="min">0-2</td>
                                      <td><input type="checkbox" name="i_lec_2" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_rtw_2" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_fup_2" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_anq_2" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_pq_2" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_mg_2" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_1o1_2" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_dv_2" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_w_2" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_o_2" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">2</td>
                                      <td><input type="checkbox" name="i_lec_4" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_rtw_4" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_fup_4" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_anq_4" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_pq_4" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_mg_4" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_1o1_4" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_dv_4" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_w_4" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_o_4" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">4</td>
                                      <td><input type="checkbox" name="i_lec_6" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_rtw_6" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_fup_6" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_anq_6" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_pq_6" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_mg_6" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_1o1_6" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_dv_6" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_w_6" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_o_6" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">6</td>
                                      <td><input type="checkbox" name="i_lec_8" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_rtw_8" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_fup_8" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_anq_8" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_pq_8" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_mg_8" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_1o1_8" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_dv_8" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_w_8" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_o_8" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">8-10</td>
                                      <td><input type="checkbox" name="i_lec_10" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_rtw_10" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_fup_10" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_anq_10" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_pq_10" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_mg_10" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_1o1_10" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_dv_10" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_w_10" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_o_10" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <th class="min">min</th>
                                      <th>Lec</th>
                                      <th>RtW</th>
                                      <th>FUp</th>
                                      <th>AnQ</th>
                                      <th>PQ</th>
                                      <th>MG</th>
                                      <th>1o1</th>
                                      <th>D/V</th>
                                      <th>W</th>
                                      <th>O</th>
                                    </tr>
                                    <tr>
                                      <td class="min">10-12</td>
                                      <td><input type="checkbox" name="i_lec_12" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_rtw_12" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_fup_12" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_anq_12" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_pq_12" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_mg_12" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_1o1_12" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_dv_12" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_w_21" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_o_12" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">12</td>
                                      <td><input type="checkbox" name="i_lec_14" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_rtw_14" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_fup_14" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_anq_14" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_pq_14" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_mg_14" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_1o1_14" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_dv_14" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_w_14" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_o_14" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">14</td>
                                      <td><input type="checkbox" name="i_lec_16" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_rtw_16" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_fup_16" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_anq_16" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_pq_16" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_mg_16" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_1o1_16" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_dv_16" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_w_16" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_o_16" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">16</td>
                                      <td><input type="checkbox" name="i_lec_18" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_rtw_18" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_fup_18" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_anq_18" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_pq_18" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_mg_18" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_1o1_18" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_dv_18" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_w_18" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_o_18" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">18-20</td>
                                      <td><input type="checkbox" name="i_lec_20" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_rtw_20" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_fup_20" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_anq_20" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_pq_20" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_mg_20" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_1o1_20" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_dv_20" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_w_20" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_o_20" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <th class="min">min</th>
                                      <th>Lec</th>
                                      <th>RtW</th>
                                      <th>FUp</th>
                                      <th>AnQ</th>
                                      <th>PQ</th>
                                      <th>MG</th>
                                      <th>1o1</th>
                                      <th>D/V</th>
                                      <th>W</th>
                                      <th>O</th>
                                    </tr>
                                    <tr>
                                      <td class="min">20-22</td>
                                      <td><input type="checkbox" name="i_lec_22" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_rtw_22" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_fup_22" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_anq_22" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_pq_22" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_mg_22" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_1o1_22" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_dv_22" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_w_22" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_o_22" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">22</td>
                                      <td><input type="checkbox" name="i_lec_24" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_rtw_24" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_fup_24" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_anq_24" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_pq_24" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_mg_24" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_1o1_24" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_dv_24" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_w_24" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_o_24" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">24</td>
                                      <td><input type="checkbox" name="i_lec_26" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_rtw_26" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_fup_26" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_anq_26" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_pq_26" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_mg_26" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_1o1_26" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_dv_26" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_w_26" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_o_26" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">26</td>
                                      <td><input type="checkbox" name="i_lec_28" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_rtw_28" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_fup_28" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_anq_28" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_pq_28" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_mg_28" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_1o1_28" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_dv_28" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_w_28" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_o_28" value="1" class="form-control" disabled></td>
                                    </tr>
                                    <tr>
                                      <td class="min">28-30</td>
                                      <td><input type="checkbox" name="i_lec_30" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_rtw_30" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_fup_30" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_anq_30" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_pq_30" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_mg_30" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_1o1_30" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_dv_30" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_w_30" value="1" class="form-control" disabled></td>
                                      <td><input type="checkbox" name="i_o_30" value="1" class="form-control" disabled></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                              <div class="col-12 mb-3">
                                <label class="fw-bold">Comments:</label>
                                <textarea class="form-control" name="comments" rows="3" placeholder="Feedback for the instructor"></textarea>
                              </div>
                              <div class="col-xl-6 class-submit">
                                <input type="submit" name="class-submit" value="Submit" id="submitBtn" disabled>
                              </div>
                            </div>
                          </form>
                        <?php
                      }else{
                        ?>
                          <div class="text-center fw-bold pagorflok">
                            <p>Academic year has not yet started.</p>
                          </div>
                        <?php
                      }
                    ?>
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
        <!----=======-- Main JS File --=======---->
        <script src="../assets/js/main.js"></script>

        <!-- Add beforeunload event to detect when leaving the page -->
        <script>
          let isSubmitting = false;
          document.getElementById('submitBtn').addEventListener('click', function() {
            isSubmitting = true;
          });
          window.addEventListener('beforeunload', function (e) {
            if (!isSubmitting) {
              var confirmationMessage = "Are you sure you want to leave this page? Any unsaved changes will be lost.";
              e.returnValue = confirmationMessage; // For older browsers
              return confirmationMessage; // For most modern browsers
            }
          });
        </script>
      </body>
      </html>
    <?php
  }else{
    header("Location: ../index.php"); exit;
  }
?>