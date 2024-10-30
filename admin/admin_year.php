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
            <title> UI-ALPerf | Admin | Academic Year </title>
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
                        <li class="breadcrumb-item active">Academic Year</li>
                     </ol>
                  </nav>
               </div><!-- END PAGE TITLE -->
               <section class="section academic_year">
                  <div class="row">
                     <div class="col-12 ayayay">
                        <div class="card">
                           <div class="card-body">
                              <div class="d-flex justify-content-between mb-2">
                                 <h5 class="fw-bold table-title">Academic Year</h5>
                                 <button class="add-button" type="button" data-bs-toggle="modal" data-bs-target="#new_acad_modal"><i class="bi bi-plus-circle-dotted"></i> Add New</button>
                              </div>
                              <div class="card-table">
                                 <table>
                                    <tr>
                                       <th>Status</th>
                                       <th>Year</th>
                                       <th>Semester</th>
                                    </tr>
                                    <?php
                                       //PAGINATION
                                       if(isset($_GET['page_no']) && $_GET['page_no'] !== ''){
                                          $page_no = $_GET['page_no'];
                                       }else{
                                          $page_no = 1;
                                       }

                                       $total_records_per_page = 10;
                                       $offset = ($page_no - 1) * $total_records_per_page;
                                       $previous_page = $page_no - 1;
                                       $next_page = $page_no + 1;

                                       $result_count = mysqli_query($conn, "SELECT COUNT(*) AS total_records FROM `academic_year`");
                                       $records = mysqli_fetch_assoc($result_count);
                                       $total_records = $records['total_records'];
                                       $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                       //END PAGINATION

                                       $query = mysqli_query($conn, "SELECT * FROM `academic_year` ORDER BY `year` DESC, `semester` DESC LIMIT $offset, $total_records_per_page");
                                       while($row = mysqli_fetch_assoc($query)){
                                          ?>
                                             <tr>
                                                <td>
                                                   <a data-bs-toggle="modal" data-bs-target="#update_acad_modal_<?php echo $row['id'] ?>">
                                                      <?php
                                                         if($row['status'] == 0){
                                                            ?><span class="badge badge_pending">Not yet Started</span><?php
                                                         }elseif($row['status'] == 1){
                                                            ?><span class="badge badge_started">Starting</span><?php
                                                         }elseif($row['status'] == 2){
                                                            ?><span class="badge badge_closed">Closed</span><?php
                                                         }
                                                      ?>
                                                   </a>
                                                </td>
                                                <td class="fw-bold"><a data-bs-toggle="modal" data-bs-target="#update_acad_modal_<?php echo $row['id'] ?>"><?php echo $row['year'] ?></a></td>
                                                <td class="fw-bold"><a data-bs-toggle="modal" data-bs-target="#update_acad_modal_<?php echo $row['id'] ?>"><?php echo $row['semester'] ?></a></td>
                                             </tr>
                                             <!-----------===============- UPDATE ACAD MODAL -===============------------------>
                                             <div id="update_acad_modal_<?php echo $row['id'] ?>" class="modal">
                                                <div class="modal-dialog">
                                                   <div class="modal-content">  
                                                      <div class="modal-header">
                                                         <h5>Manage Academic</h5>
                                                         <button type="button" data-bs-dismiss="modal"><i class="bi bi-x"></i></button>
                                                      </div>
                                                      <div class="modal-body new_acad_moday_body">
                                                         <form action="../process_admin.php?id=<?php echo $row['id'] ?>" method="POST">
                                                            <div class="details row g-2">
                                                               <div class="col-md-6">
                                                                  <label> School Year </label>
                                                                  <input type="text" name="up_school_year" value="<?php echo $row['year'] ?>" class="form-control">
                                                               </div>
                                                               <div class="col-md-6">
                                                                  <label> Semester </label>
                                                                  <select name="up_semester" class="form-select">
                                                                     <option value="First Semester" <?php if($row['semester'] == "First Semester") echo "selected"; ?>>First Semester</option>
                                                                     <option value="Second Semester" <?php if($row['semester'] == "Second Semester") echo "selected"; ?>>Second Semester</option>
                                                                  </select>
                                                               </div>
                                                               <div class="col-12">
                                                                  <label> Status </label>
                                                                  <select name="up_status" class="form-select">
                                                                     <option value="0" <?php if($row['status'] == 0) echo "selected"; ?>>Pending</option>
                                                                     <option value="1" <?php if($row['status'] == 1) echo "selected"; ?>>Start</option>
                                                                     <option value="2" <?php if($row['status'] == 2) echo "selected"; ?>>Close</option>
                                                                  </select>
                                                               </div>
                                                            </div>
                                                            <div class="text-end mt-3 mb-2 new_acad_save">
                                                               <input type="submit" name="acad-up-submit" value="Save">
                                                               <button type="button" data-bs-toggle="modal" data-bs-target="#delete_acad_confirmation_<?php echo $row['id'] ?>">Delete</button>
                                                            </div>
                                                         </form>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <!-----------===============- DELETE ACAD CONFIRMATION -===============------------------>
                                             <div class="modal" id="delete_acad_confirmation_<?php echo $row['id'] ?>">
                                                <div class="modal-dialog modal-dialog-centered">
                                                   <div class="modal-content">
                                                      <div class="modal-header">
                                                         <h5 class="modal-title">Confirmation</h5>
                                                      </div>
                                                      <div class="modal-body">
                                                         Are you sure to delete this academic? <br>
                                                      </div>
                                                      <div class="modal-footer p-2 delete_faculty_confirmation">
                                                         <form action="../process_admin.php?id=<?php echo $row['id'] ?>" method="POST">
                                                            <input type="submit" name="delete-acad" value="Delete">
                                                         </form>
                                                         <button type="button" data-bs-toggle="modal" data-bs-target="#update_acad_modal_<?php echo $row['id'] ?>">Cancel</button>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          <?php
                                       }
                                    ?>
                                 </table>
                              </div>
                              <!-----------===============- PAGINATION -===============------------------>
                              <div>
                                 <nav class="mt-3 d-flex">
                                    <ul class="pagination">
                                       <li class="page-item buttons"><a class="page-link <?php echo ($page_no <= 1) ? 'disabled' : ''; ?>" <?php echo ($page_no > 1) ? 'href="?page_no=' . $previous_page . '"' : ''; ?>><i class='bx bxs-chevrons-left'></i></a></li>
                                       <?php
                                          $num_links_before_after = 1;
                                          for($i = max(1, $page_no - $num_links_before_after); $i <= min($total_no_of_pages, $page_no + $num_links_before_after); $i++){
                                             if((int)$page_no == $i){
                                                ?><li class="page-item pages"><a class="page-link active"><?php echo $i; ?></a></li><?php
                                             }else{
                                                ?><li class="page-item pages"><a class="page-link" href="?page_no=<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
                                             }
                                          }
                                       ?>
                                       <li class="page-item buttons"><a class="page-link <?php echo ($page_no >= $total_no_of_pages) ? 'disabled' : ''; ?>" <?php echo ($page_no < $total_no_of_pages) ? 'href="?page_no=' . $next_page . '"' : ''; ?>><i class='bx bxs-chevrons-right'></i></a></li>
                                    </ul>
                                 </nav>
                                 <div class="buts">
                                    <strong>Page <?php echo $page_no; ?> of <?php echo $total_no_of_pages; ?></strong>
                                 </div>
                              </div><!-----------===============- END PAGINATION -===============------------------>
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

            <!----=======-- Add Academic Year Modal --=======---->
            <div id="new_acad_modal" class="modal">
               <div class="modal-dialog">
                  <div class="modal-content">  
                     <div class="modal-header">
                        <h5>New Academic</h5>
                        <button type="button" data-bs-dismiss="modal"><i class="bi bi-x"></i></button>
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
         </body>
         </html>
      <?php
   }else{
      header("Location: ../index.php"); exit;
   }
?>