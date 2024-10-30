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
        <title> UI-ALPerf | Admin | Home </title>
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
          <div class="pagetitle">
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin_home.php">Admin</a></li>
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
                  $reports = mysqli_query($conn, "SELECT COUNT(*) AS num_reports FROM `class_report_info` WHERE `admin_id` = '$admin_ID' AND `admin_archive` = TRUE AND `school_year` = '$report_year' AND `semester` = '$report_semester'");
                  if($row = mysqli_fetch_assoc($reports)){
                    $num_reports = $row['num_reports'];
                  }else{
                    $num_reports = 0;
                  }
                  ?>
                    <!----=======-- REPORTS CARD --=======---->
                    <div class="col-lg-3 col-6">
                      <a href="admin_report.php">
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
                  $reports = mysqli_query($conn, "SELECT COUNT(*) AS num_reports FROM `class_report_info` WHERE `admin_id` = '$admin_ID' AND `admin_archive` = TRUE");
                  if($row = mysqli_fetch_assoc($reports)){
                    $num_reports = $row['num_reports'];
                  }else{
                    $num_reports = 0;
                  }
                  ?>
                    <!----=======-- REPORTS CARD --=======---->
                    <div class="col-lg-3 col-6">
                      <a href="admin_report.php">
                        <div class="card nav-card reports-card">
                          <div class="card-body cardo">
                            <div class="d-flex align-items-center gap-1">
                              <h5 class="card-title">All Reports</h5>
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
                ?>
                  <!----=======-- ACADEMIC YEAR CARD --=======---->
                  <div class="col-lg-3 col-6">
                    <a href="admin_year.php">
                      <div class="card nav-card faculty-card">
                        <div class="card-body cardo">
                          <h5 class="card-title">Academic Year</h5>
                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-calendar3-range"></i>
                            </div>
                            <div class="ps-3">
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div><!-- END FACULTIES CARD -->
                <?php
                $subjects = mysqli_query($conn, "SELECT COUNT(*) AS num_subjects FROM `subjects`");
                if($row = mysqli_fetch_assoc($subjects)){
                  $num_subjects = $row['num_subjects'];
                }else{
                  $num_subjects = 0;
                }
                ?>
                  <!----=======-- SUBJECT CARD --=======---->
                  <div class="col-lg-3 col-6">
                    <a href="admin_subject.php">
                      <div class="card nav-card subject-card">
                        <div class="card-body cardo">
                          <h5 class="card-title">Subjects</h5>
                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-layout-text-sidebar"></i>
                            </div>
                            <div class="ps-3">
                              <h6><?php echo $num_subjects; ?></h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div><!-- END SUBJECT CARD -->
                <?php
                $archives = mysqli_query($conn, "SELECT COUNT(*) AS num_archives FROM `class_report_info` WHERE `admin_id` = '$admin_ID' AND `admin_archive` = FALSE");
                if($row = mysqli_fetch_assoc($archives)){
                  $num_archives = $row['num_archives'];
                }else{
                  $num_archives = 0;
                }
                ?>
                  <!----=======-- ARCHIVES CARD --=======---->
                  <div class="col-lg-3 col-6">
                    <a href="admin_archive.php">
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
              <!----=======-- REPORTS TABLE CARD --=======---->
              <div class="col-xl-12 hhrr">
                <div class="card reports-table">
                  <div class="card-body">
                    <h4>Reports</h4>
                    <div class="card-table">
                      <table>
                        <tr>
                          <th class="fs-5">Faculty</th>
                          <th class="fs-5">Date</th>
                          <th class="fs-5">Section</th>
                        </tr>
                        <?php
                          if(!isset($_GET['home_search_report'])){
                            $class_report = mysqli_query($conn, "SELECT info.*,stu.*,ins.*,com.*
                            FROM `class_report_info` info 
                            LEFT JOIN `class_report_stu` stu ON info.report_info_id = stu.report_stu_id
                            LEFT JOIN `class_report_ins` ins ON info.report_info_id = ins.report_ins_id
                            LEFT JOIN `class_report_com` com ON info.report_info_id = com.report_com_id
                            WHERE info.admin_id = '$admin_ID' AND info.admin_archive = TRUE ORDER BY info.report_info_id DESC LIMIT 5");
                            if(mysqli_num_rows($class_report) > 0){
                              while($row = mysqli_fetch_assoc($class_report)){
                                ?>
                                  <tr>
                                    <td class="fw-bold"><a href="admin_reports_view.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>"><?php echo $row['instructor']; ?></a></td>
                                    <td class="fw-bold"><a href="admin_reports_view.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>"><?php echo date('M j, Y', strtotime($row['date'])); ?></a></td>
                                    <td class="fw-bold"><a href="admin_reports_view.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>"><?php echo $row['section']; ?></a></td>
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
        <a type="button" data-bs-toggle="modal" data-bs-target="#new_modal" class="new_class_sm d-block d-lg-none d-flex align-items-center justify-content-center"><i class="bi bi-plus-circle"></i></a>

        <!----=======-- Vendor JS Files --=======---->
        <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!----=======-- Main JS File --=======---->
        <script src="../assets/js/main.js"></script>

        <!----=======-- New Modal --=======---->
        <div id="new_modal" class="modal">
          <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content"> 
              <div class="modal-header">
                <h5>New</h5>
                <button type="button" data-bs-dismiss="modal"><i class="bi bi-x"></i></button>
              </div>
              <div class="modal-body d-flex flex-column gap-3 new_modal">
                <button type="button" data-bs-toggle="modal" data-bs-target="#new_class_modal">Create Report</button>
                <hr class="m-0">
                <button type="button" data-bs-toggle="modal" data-bs-target="#new_acad_modal">Add Academic Year</button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#new_sub_modal">Add Subject</button>
              </div>
            </div>
          </div>
        </div>
        <!----=======-- Create Report Modal --=======---->
        <div id="new_class_modal" class="modal">
          <div class="modal-dialog">
            <div class="modal-content"> 
              <div class="modal-header">
                <h5>New Class</h5>
                <button type="button" data-bs-toggle="modal" data-bs-target="#new_modal"><i class="bi bi-x"></i></button>
              </div>
              <div class="modal-body create_class_moday_body">
                <form action="admin_class.php" method="POST">
                  <div class="details row g-2">
                    <div class="col-12">
                      <label> Section </label>
                      <input type="text" name="classInfo-tmpSection" required class="form-control">
                    </div>
                    <div class="col-12">
                      <label> Instructor </label>
                      <select name="classInfo-tmpInstructor" required class="form-select">
                        <option value="">Select Instructor</option>
                        <?php
                          $select_faculty = mysqli_query($conn, "SELECT * FROM `faculty` ORDER BY `last_name`");
                          while($facultyInfoRow = mysqli_fetch_assoc($select_faculty)){
                            ?><option value="<?php echo $facultyInfoRow['last_name'].', '.$facultyInfoRow['first_name']; ?>"><?php echo $facultyInfoRow['last_name'].', '.$facultyInfoRow['first_name']; ?></option><?php
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-12">
                      <label> Subject </label>
                      <select name="classInfo-tmpSubject" required class="form-select">
                        <option value="">Select Subject</option>
                        <?php
                          $select_subject = mysqli_query($conn, "SELECT * FROM `subjects` ORDER BY `sub_desc`");
                          while($sub_row = mysqli_fetch_assoc($select_subject)){
                            ?><option value="<?php echo $sub_row['sub_code']. ' ' .$sub_row['sub_desc'] ?>"><?php echo $sub_row['sub_code']. ' ' .$sub_row['sub_desc'] ?></option><?php
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="text-center mt-3 mb-2 new_class_next">
                    <input type="submit" name="classInfo-next" value="Next">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!----=======-- Add Academic Year Modal --=======---->
        <div id="new_acad_modal" class="modal">
          <div class="modal-dialog">
            <div class="modal-content">  
                <div class="modal-header">
                  <h5>New Academic</h5>
                  <button type="button" data-bs-toggle="modal" data-bs-target="#new_modal"><i class="bi bi-x"></i></button>
                </div>
                <div class="modal-body new_acad_moday_body">
                  <form action="../process_admin.php" method="POST">
                      <div class="details row g-2">
                        <div class="col-md-6">
                            <label> School Year </label>
                            <input type="text" name="new_school_year" placeholder="0000-0000" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label> Semester </label>
                            <select name="new_semester" required class="form-select">
                              <option value="">Select Semester</option>
                              <option value="First Semester">First Semester</option>
                              <option value="Second Semester">Second Semester</option>
                            </select>
                        </div>
                      </div>
                      <div class="text-end mt-3 mb-2 new_acad_save">
                        <input type="submit" name="acad-submit" value="Save">
                      </div>
                  </form>
                </div>
            </div>
          </div>
        </div>
        <!----=======-- Add Subject Modal --=======---->
        <div id="new_sub_modal" class="modal">
          <div class="modal-dialog">
            <div class="modal-content">  
              <div class="modal-header">
                <h5>New Subject</h5>
                <button type="button" data-bs-toggle="modal" data-bs-target="#new_modal"><i class="bi bi-x"></i></button>
              </div>
              <div class="modal-body new_sub_moday_body">
                <form action="../process_admin.php" method="POST">
                  <div class="details row g-2">
                    <div class="col-12">
                      <label> Subject Code </label>
                      <input type="text" name="new_sub_code" class="form-control" required>
                    </div>
                    <div class="col-12">
                      <label> Description </label>
                      <textarea name="new_sub_desc" rows="3" class="form-control" required></textarea>
                    </div>
                  </div>
                  <div class="text-end mt-3 mb-2 new_sub_save">
                    <input type="submit" name="subject-submit" value="Save">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </body>
      </html>
    <?php
  }else{
    header("Location: ../index.php"); exit;
  }
?>