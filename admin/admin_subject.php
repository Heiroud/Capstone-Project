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
        <title> UI-ALPerf | Admin | Subjects </title>
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
                <li class="breadcrumb-item active">Subjects</li>
              </ol>
            </nav>
          </div><!-- END PAGE TITLE -->
          <section class="section subjects">
            <div class="row">
              <div class="col-12 subsub">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                      <h5 class="fw-bold table-title">Subjects</h5>
                      <button class="add-button" type="button" data-bs-toggle="modal" data-bs-target="#new_sub_modal"><i class="bi bi-plus-circle-dotted"></i> Add New</button>
                    </div>
                    <div class="card-table">
                      <table>
                        <tr>
                          <th>Subject Code</th>
                          <th>Description</th>
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

                          $result_count = mysqli_query($conn, "SELECT COUNT(*) AS total_records FROM `subjects`");
                          $records = mysqli_fetch_assoc($result_count);
                          $total_records = $records['total_records'];
                          $total_no_of_pages = ceil($total_records / $total_records_per_page);
                          //END PAGINATION

                          if(!isset($_GET['search_subject'])){
                            $sub_query = mysqli_query($conn, "SELECT * FROM `subjects` ORDER BY `sub_desc` LIMIT $offset, $total_records_per_page");
                            while($sub_row = mysqli_fetch_assoc($sub_query)){
                              ?>
                                <tr>
                                  <td class="fw-bold"><a data-bs-toggle="modal" data-bs-target="#update_sub_modal_<?php echo $sub_row['id'] ?>"><?php echo $sub_row['sub_code'] ?></a></td>
                                  <td class="fw-bold"><a data-bs-toggle="modal" data-bs-target="#update_sub_modal_<?php echo $sub_row['id'] ?>"><?php echo $sub_row['sub_desc'] ?></a></td>
                                </tr>
                                <!-----------===============- UPDATE SUBJECT MODAL -===============------------------>
                                <div id="update_sub_modal_<?php echo $sub_row['id'] ?>" class="modal">
                                  <div class="modal-dialog">
                                    <div class="modal-content">  
                                      <div class="modal-header">
                                        <h5>Manage Subject</h5>
                                        <button type="button" data-bs-dismiss="modal"><i class="bi bi-x"></i></button>
                                      </div>
                                      <div class="modal-body new_sub_moday_body">
                                        <form action="../process_admin.php?id=<?php echo $sub_row['id'] ?>" method="POST">
                                          <div class="details row g-2">
                                            <div class="col-12">
                                              <label> Subject Code </label>
                                              <input type="text" name="up_sub_code" value="<?php echo $sub_row['sub_code'] ?>" class="form-control" required>
                                            </div>
                                            <div class="col-12">
                                              <label> Description </label>
                                              <textarea name="up_sub_desc" rows="3" class="form-control" required><?php echo $sub_row['sub_desc'] ?></textarea>
                                            </div>
                                          </div>
                                          <div class="text-end mt-3 mb-2 new_sub_save">
                                            <input type="submit" name="sub-up-submit" value="Update">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#delete_sub_confirmation_<?php echo $sub_row['id'] ?>">Delete</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-----------===============- DELETE SUBJECT CONFIRMATION -===============------------------>
                                <div class="modal" id="delete_sub_confirmation_<?php echo $sub_row['id'] ?>">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Confirmation</h5>
                                      </div>
                                      <div class="modal-body">
                                        Are you sure to delete this subject <strong><?php echo $sub_row['sub_code'] ?></strong>?
                                      </div>
                                      <div class="modal-footer p-2 delete_faculty_confirmation">
                                        <form action="../process_admin.php?id=<?php echo $sub_row['id'] ?>" method="POST">
                                          <input type="submit" name="delete-subject" value="Delete">
                                        </form>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#update_sub_modal_<?php echo $sub_row['id'] ?>">Cancel</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              <?php
                            }
                          }else{
                            include "../includes/search.php";
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

        <!----=======-- Add Subject Modal --=======---->
        <div id="new_sub_modal" class="modal">
          <div class="modal-dialog">
            <div class="modal-content">  
              <div class="modal-header">
                <h5>New Subject</h5>
                <button type="button" data-bs-dismiss="modal"><i class="bi bi-x"></i></button>
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