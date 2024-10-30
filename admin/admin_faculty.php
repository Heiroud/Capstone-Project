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
        <title> UI-ALPerf | Admin | Faculties </title>
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
                <li class="breadcrumb-item active">Faculties</li>
              </ol>
            </nav>
          </div><!-- END PAGE TITLE -->
          <section class="section faculty">
            <div class="row">
              <div class="col-xl-12 fff">
                <div class="card">
                  <div class="card-body">
                    <div>
                      <h5 class="fw-bold table-title">All Faculties</h5>
                    </div>
                    <div class="card-table">
                      <table>
                        <tr>
                          <th class="text-center"><i class="bi bi-image"></i></th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Email</th>
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

                          $result_count = mysqli_query($conn, "SELECT COUNT(*) AS total_records FROM `faculty`");
                          $records = mysqli_fetch_assoc($result_count);
                          $total_records = $records['total_records'];
                          $total_no_of_pages = ceil($total_records / $total_records_per_page);
                          //END PAGINATION

                          if(!isset($_GET['search_faculty'])){
                            $select_faculties = mysqli_query($conn, "SELECT * FROM `faculty` ORDER BY `last_name` LIMIT $offset, $total_records_per_page");
                            while($faculty_data = mysqli_fetch_assoc($select_faculties)){
                              $faculty_ID = $faculty_data['id'];
                              $check_faculty_pic = mysqli_query($conn, "SELECT `faculty_pic_path` FROM `faculty_pic` WHERE `id` = '$faculty_ID'");
                              if($fetch_faculty_pic = mysqli_fetch_assoc($check_faculty_pic)){
                                $faculty_pic = "../assets/img/faculty_img/" . $fetch_faculty_pic['faculty_pic_path'];
                              }else{
                                $faculty_pic = "../assets/img/default.jpg";
                              }
                              ?>
                                <tr>
                                  <td><a data-bs-toggle="modal" data-bs-target="#faculty_profile_modal_<?php echo $faculty_ID ?>"><div class="piccon"> <div class="pic"> <img src="<?php echo $faculty_pic; ?>"> </div> </div></a></td>
                                  <td class="fw-bold bergs"><a data-bs-toggle="modal" data-bs-target="#faculty_profile_modal_<?php echo $faculty_ID ?>"><?php echo $faculty_data['last_name'] ?></a></td>
                                  <td class="fw-bold bergs"><a data-bs-toggle="modal" data-bs-target="#faculty_profile_modal_<?php echo $faculty_ID ?>"><?php echo $faculty_data['first_name'] ?></a></td>
                                  <td class="fw-bold bergs"><a data-bs-toggle="modal" data-bs-target="#faculty_profile_modal_<?php echo $faculty_ID ?>"><?php echo $faculty_data['email'] ?></a></td>
                                </tr>
                                <!-----------===============- FACULTY PROFILE MODAL -===============------------------>
                                <div class="modal" id="faculty_profile_modal_<?php echo $faculty_ID ?>" data-bs-backdrop="static" tabindex="-1">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header faculty_profile_modal_header">
                                        <h5> Faculty Profile </h5>
                                        <div class="dropdown">
                                          <button type="button" class="dots border-0" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                          </button>
                                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                              <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_faculty_confirmation_<?php echo $faculty_ID ?>"> Delete </button>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                      <div class="modal-body faculty_profile_modal_body">
                                        <div class="faculty_img_modal">
                                          <img src="<?php echo $faculty_pic; ?>" class="mb-3">
                                        </div>
                                        <h6 class="fw-bold">Name: <?php echo $faculty_data['first_name']. ' ' . $faculty_data['last_name']?></h6>
                                        <p class="fw-bold">Email: <?php echo $faculty_data['email'] ?></p>
                                        <div class="text-end mt-3 mb-2 faculty_profile_close">
                                          <button type="button" data-bs-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-----------===============- DELETE FACULTY MODAL CONFIRMATION -===============------------------>
                                <div class="modal" id="delete_faculty_confirmation_<?php echo $faculty_ID ?>">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Delete <?php echo $faculty_data['first_name']. ' ' . $faculty_data['last_name']?>?</h5>
                                      </div>
                                      <div class="modal-body">
                                        Faculty will be permanently deleted
                                      </div>
                                      <div class="modal-footer p-2 delete_faculty_confirmation">
                                        <form action="../process_admin.php?id=<?php echo $faculty_ID; ?>" method="POST">
                                          <input type="submit" name="delete_faculty" value="Delete">
                                        </form>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#faculty_profile_modal_<?php echo $faculty_ID ?>">Cancel</button>
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
      </body>
      </html>
    <?php
  }else{
    header("Location: ../index.php"); exit;
  }
?>