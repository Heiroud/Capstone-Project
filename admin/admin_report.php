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
        <title> UI-ALPerf | Admin | Reports </title>
        <link href="../assets/img/ui.png" rel="icon">
        <!----=======-- Vendor CSS Files --=======---->
        <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <!----=======-- Main CSS File --=======---->
        <link href="../assets/css/admin.css" rel="stylesheet">
      </head>
      <body>
        <!----=======-- ALERT --=======---->
        <?php include "../includes/alerts.php"; ?>
        <!----=======-- HEADER --=======---->
        <?php include "../includes/admin_header.php"; ?>
        <!----=======-- SIDEBAR --=======---->
        <?php include "../includes/admin_sidebar.php"; ?>

        <!----=======-- MAIN --=======---->
        <main id="main" class="main">
          <!----=======-- PAGE TITLE --=======---->
          <div class="pagetitle d-flex justify-content-between">
            <div>
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="admin_home.php">Admin</a></li>
                  <li class="breadcrumb-item active">Reports</li>
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
            </div>
            <div class="dropdown">
              <button type="button" class="" id="allreports" data-bs-toggle="dropdown">
                <i class="bi bi-three-dots-vertical"></i>
              </button>
              <ul class="dropdown-menu" aria-labelledby="allreports">
                <li class="dropdown-header position-sticky top-0">
                  <h6>All Reports</h6>
                </li>
                <li>
                  <?php
                    $sy = mysqli_query($conn, "SELECT DISTINCT `school_year` FROM `class_report_info` WHERE `admin_id` = '$admin_ID' AND `admin_archive` = TRUE ORDER BY `school_year` DESC");
                    while($row = mysqli_fetch_assoc($sy)){
                      ?><a class="dropdown-item fw-bold d-flex align-items-center" href="admin_all_reports.php?school_year=<?php echo $row['school_year'] ?>">SY: <?php echo $row['school_year'] ?></a><?php
                    }
                  ?>
                </li>
              </ul>
            </div>
          </div><!-- END PAGE TITLE -->
          <section class="section report">
            <div class="row">
              <?php
                if(!isset($_GET['search_report'])){
                  $select_acad = mysqli_query($conn, "SELECT * FROM `academic_year` WHERE `status` = 1");
                  if($fetch_acad = mysqli_fetch_assoc($select_acad)){
                    $report_year = $fetch_acad['year'];
                    $report_semester = $fetch_acad['semester'];
                    //select report
                    $class_report = mysqli_query($conn, "SELECT info.*,stu.*,ins.*,com.*
                    FROM `class_report_info` info 
                    LEFT JOIN `class_report_stu` stu ON info.report_info_id = stu.report_stu_id
                    LEFT JOIN `class_report_ins` ins ON info.report_info_id = ins.report_ins_id
                    LEFT JOIN `class_report_com` com ON info.report_info_id = com.report_com_id
                    WHERE info.admin_id = '$admin_ID' AND info.admin_archive = TRUE AND info.school_year = '$report_year' AND info.semester = '$report_semester' ORDER BY info.report_info_id DESC");
                    if(mysqli_num_rows($class_report) > 0){
                      while($row = mysqli_fetch_assoc($class_report)){
                        $faculty_ID = $row['faculty_id'];
                        $check_faculty_pic = mysqli_query($conn, "SELECT `faculty_pic_path` FROM `faculty_pic` WHERE `id` = '$faculty_ID'");
                        if($fetch_faculty_pic = mysqli_fetch_assoc($check_faculty_pic)){
                          $faculty_pic = "../assets/img/faculty_img/" . $fetch_faculty_pic['faculty_pic_path'];
                        }else{
                          $faculty_pic = "../assets/img/default.jpg";
                        }
                        ?>
                          <div class="col-md-6 col-lg-4">
                            <div class="card">
                              <div class="card-header d-flex justify-content-between align-items-start">
                                <div class="d-flex align-items-center herds">
                                  <div class="picsur">
                                    <img src="<?php echo $faculty_pic; ?>">
                                  </div>
                                  <h5> <?php echo $row['instructor'] ?> </h5>
                                </div>
                                <div class="dropdown">
                                  <button type="button" class="dots border-0" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                      <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#archive_class_modal_<?php echo $row['report_info_id'] . '_' . $row['report_stu_id'] . '_' . $row['report_ins_id'] . '_' . $row['report_com_id']; ?>"> Archive </button>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                              <a href="admin_reports_view.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>">
                                <div class="card-body">
                                  <p class="fw-bold"><?php echo $row['section'] ?></p>
                                  <p class="fw-bold mb-2"><?php echo date('M j, Y', strtotime($row['date'])); ?></p>
                                </div>
                              </a>
                            </div>
                          </div>
                          <!-----------===============- ARCHIVE CLASS MODAL -===============------------------>
                          <div class="modal" id="archive_class_modal_<?php echo $row['report_info_id'] . '_' . $row['report_stu_id'] . '_' . $row['report_ins_id'] . '_' . $row['report_com_id']; ?>">
                            <div class="modal-dialog modal-dialog-centered" data-bs-backdrop="false">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Archive report?</h5>
                                </div>
                                <div class="modal-body fw-bold">
                                  <?php echo $row['instructor'].', '.date('M j Y', strtotime($row['date'])); ?>
                                </div>
                                <div class="modal-footer p-2 delete_class_confirmation">
                                  <form action="../process_admin.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>" method="POST">
                                    <input type="submit" name="archive_class_report" value="Archive">
                                  </form>
                                  <button type="button" data-bs-dismiss="modal">Cancel</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php
                      }
                    }else{
                      ?>
                        <div class="text-center fw-bold pagorflok">
                          <p>No Report.</p>
                        </div>
                      <?php
                    }
                  }else{
                    ?>
                      <div class="text-center fw-bold pagorflok">
                        <p>Academic year has not yet started.</p>
                      </div>
                    <?php
                  }
                }else{
                  include "../includes/search.php";
                }
              ?>
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