<?php
  include "../conn.php";
  include "../process_faculty.php";
  if(isset($_SESSION['session_faculty'])){
    $faculty_ID = $_SESSION['session_faculty'];
    $check_faculty_info = mysqli_query($conn, "SELECT * FROM `faculty` WHERE `id` = '$faculty_ID'");
    $fetch_faculty_info = mysqli_fetch_assoc($check_faculty_info);
    $session_faculty_fname = $fetch_faculty_info['first_name'];
    $session_faculty_lname = $fetch_faculty_info['last_name'];
    //picture
    $check_faculty_pic = mysqli_query($conn, "SELECT `faculty_pic_path` FROM `faculty_pic` WHERE `id` = '$faculty_ID'");
    if($fetch_faculty_pic = mysqli_fetch_assoc($check_faculty_pic)){
      $session_faculty_pic = "../assets/img/faculty_img/" . $fetch_faculty_pic['faculty_pic_path'];
    }else{
      $session_faculty_pic = "../assets/img/default.jpg";
    }
    ?>
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title> UI-ALPerf | Faculty | Home </title>
        <link href="../assets/img/ui.png" rel="icon">
        <!----=======-- Vendor CSS Files --=======---->
        <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <!----=======-- Main CSS File --=======---->
        <link href="../assets/css/faculty.css" rel="stylesheet">
      </head>
      <body>
        <!----=======-- ALERT --=======---->
        <?php include "../includes/alerts.php"; ?>
        <!----=======-- HEADER --=======---->
        <?php include "../includes/faculty_header.php"; ?>
        <!----=======-- SIDEBAR --=======---->
        <?php include "../includes//faculty_sidebar.php"; ?>

        <!----=======-- MAIN --=======---->
        <main id="main" class="main">
          <!----=======-- PAGE TITLE --=======---->
          <div class="pagetitle">
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="faculty_home.php">Faculty</a></li>
                <li class="breadcrumb-item active">Home</li>
              </ol>
            </nav>
          </div><!-- END PAGE TITLE -->
          <section class="section home">
            <div class="row">
              <?php
                $select_acad = mysqli_query($conn, "SELECT * FROM `academic_year` WHERE `status` = 1");
                if($fetch_acad = mysqli_fetch_assoc($select_acad)){
                  $report_year = $fetch_acad['year'];
                  $report_semester = $fetch_acad['semester'];
                  $reports = mysqli_query($conn, "SELECT COUNT(*) AS num_reports FROM `class_report_info` WHERE `faculty_id` = '$faculty_ID' AND `faculty_archive` = TRUE AND `school_year` = '$report_year' AND `semester` = '$report_semester'");
                  if($reports){
                    $row = mysqli_fetch_assoc($reports);
                    $num_reports = $row['num_reports'];
                  }else{
                    $num_reports = 0;
                  }
                  ?>
                    <!----=======-- REPORTS CARD --=======---->
                    <div class="col-lg-4 col-12">
                      <a href="faculty_report.php">
                        <div class="card nav-card reports-card">
                          <div class="card-body cardo">
                            <div class="d-flex align-items-center gap-1">
                              <h5 class="repa">Reports</h5><small class="mb-1">(<?php echo $report_year ?> <?php echo $report_semester ?>)</small>
                            </div>
                            <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-card-heading"></i>
                              </div>
                              <div class="ps-3">
                                <h6><?php echo $num_reports; ?></h6>
                              </div>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div><!-- END REPORTS CARD -->
                  <?php
                }else{
                  $reports = mysqli_query($conn, "SELECT COUNT(*) AS num_reports FROM `class_report_info` WHERE `faculty_id` = '$faculty_ID' AND `faculty_archive` = TRUE");
                  if($reports){
                    $row = mysqli_fetch_assoc($reports);
                    $num_reports = $row['num_reports'];
                  }else{
                    $num_reports = 0;
                  }
                  ?>
                    <!----=======-- REPORTS CARD --=======---->
                    <div class="col-lg-4 col-12">
                      <a href="faculty_report.php">
                        <div class="card nav-card reports-card">
                          <div class="card-body cardo">
                            <div class="d-flex align-items-center gap-1">
                              <h5 class="repa">All Reports</h5>
                            </div>
                            <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-card-heading"></i>
                              </div>
                              <div class="ps-3">
                                <h6><?php echo $num_reports; ?></h6>
                              </div>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div><!-- END REPORTS CARD -->
                  <?php
                }
                $archives = mysqli_query($conn, "SELECT COUNT(*) AS num_archives FROM `class_report_info` WHERE `faculty_id` = '$faculty_ID' AND `faculty_archive` = FALSE");
                if($archives){
                  $row = mysqli_fetch_assoc($archives);
                  $num_archives = $row['num_archives'];
                }else{
                  $num_archives = 0;
                }
                ?>
                  <!----=======-- ARCHIVES CARD --=======---->
                  <div class="col-lg-4 col-6">
                    <a href="faculty_archive.php">
                      <div class="card nav-card archive-card">
                        <div class="card-body cardo">
                          <h5 class="card-title">Archive</h5>
                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-archive"></i>
                            </div>
                            <div class="ps-3">
                              <h6><?php echo $num_archives; ?></h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div><!-- END ARCHIVES CARD -->
                <?php
              ?>
              <!----=======-- PROFILE CARD --=======---->
              <div class="col-lg-4 col-6">
                <a href="faculty_profile.php">
                  <div class="card nav-card profile-card">
                    <div class="card-body cardo">
                      <h5 class="card-title">Profile</h5>
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-person-circle"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div><!-- END PROFILE CARD -->
              <!----=======-- REPORTS TABLE CARD --=======---->
              <div class="col-xl-12 hhrr">
                <div class="card reports-table">
                  <div class="card-body">
                    <h4>Reports</h4>
                    <div class="card-table">
                      <table>
                        <tr>
                          <th class="fs-5">Section</th>
                          <th class="fs-5">Date</th>
                          <th class="fs-5">Observer</th>
                        </tr>
                        <?php
                          if(!isset($_GET['home_search'])){
                            $class_report = mysqli_query($conn, "SELECT info.*,stu.*,ins.*,com.* 
                            FROM `class_report_info` info 
                            LEFT JOIN `class_report_stu` stu ON info.report_info_id = stu.report_stu_id
                            LEFT JOIN `class_report_ins` ins ON info.report_info_id = ins.report_ins_id
                            LEFT JOIN `class_report_com` com ON info.report_info_id = com.report_com_id
                            WHERE info.faculty_id = '$faculty_ID' AND info.faculty_archive = TRUE ORDER BY info.report_info_id DESC LIMIT 5");
                            if(mysqli_num_rows($class_report) > 0){
                              while($row = mysqli_fetch_assoc($class_report)){
                                ?>
                                  <tr>
                                    <td class="fw-bold"><a href="faculty_reports_view.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>"><?php echo $row['section']; ?></a></td>
                                    <td class="fw-bold"><a href="faculty_reports_view.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>"><?php echo date('M j, Y', strtotime($row['date'])); ?></a></td>
                                    <td class="fw-bold"><a href="faculty_reports_view.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>"><?php echo $row['observer_name']; ?></a></td>
                                  </tr>
                                <?php
                              }
                            }else{
                              ?>
                                <div class="text-center fw-bold pagorflok">
                                  <p>No Report</p>
                                </div>
                              <?php
                            }
                          }else{
                            include "../includes/search.php";
                          }
                        ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div><!-- END REPORTS TABLE CARD -->
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
      </body>
      </html>
    <?php
  }else{
    header("Location: ../index.php"); exit;
  }
?>