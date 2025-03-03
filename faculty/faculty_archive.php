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
        <title> UI-ALPerf | Faculty | Archives </title>
        <link href="../assets/img/ui.png" rel="icon">
        <!----=======-- Vendor CSS Files --=======---->
        <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <!----=======-- Main CSS File --=======---->
        <link href="../assets/css/faculty.css" rel="stylesheet">
      </head>
      <body>
        <!---------------- ======= ALERTS MESSAGES ======= -------------->
        <?php include "../includes/alerts.php"; ?>
        <!----=======-- HEADER --=======---->
        <?php include "../includes/faculty_header.php"; ?>
        <!----=======-- SIDEBAR --=======---->
        <?php include "../includes//faculty_sidebar.php"; ?>

        <!----=======-- MAIN --=======---->
        <main id="main" class="main">
          <!----=======-- PAGE TITLE --=======---->
          <div class="pagetitle d-flex justify-content-between">
            <div>
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="faculty_home.php">Faculty</a></li>
                  <li class="breadcrumb-item active">Archive</li>
                </ol>
              </nav>
            </div>
          </div><!-- END PAGE TITLE -->
          <section class="section report">
            <div class="row">
              <?php
                if(!isset($_GET['faculty_search_archive'])){
                  $class_report = mysqli_query($conn, "SELECT info.*,stu.*,ins.*,com.* 
                  FROM `class_report_info` info 
                  LEFT JOIN `class_report_stu` stu ON info.report_info_id = stu.report_stu_id
                  LEFT JOIN `class_report_ins` ins ON info.report_info_id = ins.report_ins_id
                  LEFT JOIN `class_report_com` com ON info.report_info_id = com.report_com_id
                  WHERE info.faculty_id = '$faculty_ID' AND info.faculty_archive = FALSE ORDER BY info.report_info_id DESC");
                  if(mysqli_num_rows($class_report) > 0){
                    while($row = mysqli_fetch_assoc($class_report)){
                      $admin_ID = $row['admin_id'];
                      $check_admin_pic = mysqli_query($conn, "SELECT `admin_pic_path` FROM `admin_pic` WHERE `id` = '$admin_ID'");
                      if($fetch_admin_pic = mysqli_fetch_assoc($check_admin_pic)){
                        $admin_pic = "../assets/img/admin_img/" . $fetch_admin_pic['admin_pic_path'];
                      }else{
                        $admin_pic = "../assets/img/default.jpg";
                      }
                      ?>
                        <div class="col-md-6 col-lg-4">
                          <div class="card">
                            <div class="card-header archive-card d-flex justify-content-between align-items-start">
                              <div style="overflow: hidden;">
                                <h5> <?php echo $row['section'] ?> </h5>
                              </div>
                              <div class="dropdown">
                                <button type="button" class="dots border-0" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                  <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <li>
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unarchive_class_modal_<?php echo $row['report_info_id'] . '_' . $row['report_stu_id'] . '_' . $row['report_ins_id'] . '_' . $row['report_com_id']; ?>"> Unarchive </button>
                                  </li>
                                </ul>
                              </div>
                            </div>
                            <a href="faculty_archives_view.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>">
                              <div class="card-body">
                                <div class="d-flex align-items-center bods">
                                  <div class="picsur">
                                    <img src="<?php echo $admin_pic; ?>">
                                  </div>
                                  <p class="fw-bold"> <?php echo $row['observer_name'] ?> </p>
                                </div>
                                <p class="fw-bold mt-3 mb-1"> <?php echo date('M j, Y', strtotime($row['date'])); ?></p>
                              </div>
                            </a>
                          </div>
                        </div>
                        <!-----------===============- UNARCHIVE CLASS MODAL -===============------------------>
                        <div class="modal" id="unarchive_class_modal_<?php echo $row['report_info_id'] . '_' . $row['report_stu_id'] . '_' . $row['report_ins_id'] . '_' . $row['report_com_id']; ?>">
                          <div class="modal-dialog modal-dialog-centered" data-bs-backdrop="false">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Unarchive report?</h5>
                              </div>
                              <div class="modal-body fw-bold">
                                <?php echo $row['section'].', '.date('M j Y', strtotime($row['date'])); ?>
                              </div>
                              <div class="modal-footer p-2 delete_class_confirmation">
                                <form action="../process_faculty.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>" method="POST">
                                  <input type="submit" name="unarchive_class_report" value="Unarchive">
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
                        <p>No Archive</p>
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