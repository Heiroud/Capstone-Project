<?php
  include "../conn.php";
  include "../process_admin.php";
  if(isset($_SESSION['session_admin'])){
    $admin_ID = $_SESSION['session_admin'];
    $check_admin_info = mysqli_query($conn, "SELECT * FROM `admin` WHERE `id` = '$admin_ID'");
    $fetch_admin_info = mysqli_fetch_assoc($check_admin_info);
    $session_admin_fname = $fetch_admin_info['first_name'];
    $session_admin_lname = $fetch_admin_info['last_name'];
    $session_admin_email = $fetch_admin_info['email'];
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
        <title> UI-ALPerf | Admin | Profile </title>
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
                <li class="breadcrumb-item active">Profile</li>
              </ol>
            </nav>
          </div><!-- END PAGE TITLE -->

          <section class="section profile">
            <div class="row">
              <!----=======-- Profile Photo --=======---->
              <div class="col-xl-4 ppp">
                <div class="card position-relative">
                  <div class="dropdown" style="position: absolute; top: 10px; right: 10px;">
                    <a class="fs-4" data-bs-toggle="dropdown">
                      <i class="bi bi-three-dots-vertical"></i>
                    </a>
                    <ul class="dropdown-menu">
                      <a class="dropdown-item">
                        <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_photo_modal"> Delete Photo </button>
                      </a>
                    </ul>
                  </div>
                  <div class="card-body profile-card pt-4">
                    <div class="d-flex flex-column align-items-center">
                      <div class="profile-img">
                        <img src="<?php echo $session_admin_pic; ?>" alt="Profile">
                      </div>
                    </div>
                    <div class="text-center">
                      <h2><?php echo $session_admin_fname.' '.$session_admin_lname; ?></h2>
                      <h6><?php echo $session_admin_email; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-8 ppp">
                <div class="card">
                  <div class="card-body pt-3">
                    <!----=======-- BORDERED TABS --=======---->
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                      </li>
                      <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                      </li>
                      <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                      </li>
                    </ul>
                    <div class="tab-content pt-2">
                      <!--------========= Profile  Overview =========--------->
                      <div class="tab-pane fade show active profile-overview" id="profile-overview">
                        <h5 class="card-title">Profile Details</h5>
                        <div class="row">
                          <div class="col-lg-3 col-md-4 label">First Name:</div>
                          <div class="col-lg-9 col-md-8"><?php echo $session_admin_fname; ?></div>
                        </div>
                        <div class="row">
                          <div class="col-lg-3 col-md-4 label ">Last Name:</div>
                          <div class="col-lg-9 col-md-8"><?php echo $session_admin_lname; ?></div>
                        </div>
                        <div class="row">
                          <div class="col-lg-3 col-md-4 label">Email:</div>
                          <div class="col-lg-9 col-md-8"><?php echo $session_admin_email; ?></div>
                        </div>
                      </div><!-- End Profile Overview -->
                      <!--------========= Profile Edit Forms =========--------->
                      <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                        <!-------- Upload and Delete Photo Form --------->
                        <form action="../process_admin.php" method="POST" enctype="multipart/form-data">
                          <div class="row mb-3">
                            <label> Profile Image </label>
                            <div class="w-100 col-md-8 col-lg-9">
                              <div class="edit-img">
                                <img src="<?php echo $session_admin_pic; ?>" alt="Profile">
                              </div>
                              <div class="d-flex pt-2 mb-3 img-uploads">
                                <input type="file" name="admin-pic" accept="image/*" class="img-file" required>
                                <input type="submit" name="uploadAdmin-pic" value="Upload">
                              </div>
                            </div>
                          </div>
                        </form><!-- End Upload and Delete Photo Form -->
                        <!-------- Edit Profile Info Form --------->
                        <form action="../process_admin.php?id=<?php echo $admin_ID; ?>" method="POST">
                          <div class="row mb-3">
                            <label> First Name </label>
                            <div class="col-md-12">
                              <input type="text" name="updateAdmin-fname" value="<?php echo $session_admin_fname; ?>" class="form-control uppp">
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label> Last Name </label>
                            <div class="col-md-12">
                              <input type="text" name="updateAdmin-lname" value="<?php echo $session_admin_lname; ?>" class="form-control uppp">
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label> Email </label>
                            <div class="col-md-12">
                              <input type="email" name="updateAdmin-email" value="<?php echo $session_admin_email; ?>" class="form-control uppp">
                            </div>
                          </div>
                          <div class="text-center">
                            <input type="submit" name="updateAdmin-submit" value="Save Changes" class="save-changes">
                          </div>
                        </form><!-- End Profile Edit Form -->
                      </div>
                      <!--------========= Change Password Form =========--------->
                      <div class="tab-pane fade pt-3" id="profile-change-password">
                        <form action="../process_admin.php" method="POST">
                          <div class="pass-details">
                            <div class="row mb-3">
                              <label> Current Password </label>
                              <div class="col-md-12">
                              <input name="admin-current-password" type="password" class="form-control" required>
                              </div>
                            </div>
                            <div class="mb-3">
                              <small>Password must be 8-20 characters long, contain at least one number, one uppercase and one lowercase letter.</small>
                            </div>
                            <div class="row mb-3">
                              <label> New Password </label>
                              <div class="col-md-12">
                              <input name="admin-new-password" 
                                type="password" 
                                class="form-control" 
                                minlength="8"
                                maxlength="20"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                required>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label> Confirm New Password </label>
                              <div class="col-md-12">
                              <input name="admin-new-password2" 
                                type="password" 
                                class="form-control" 
                                minlength="8"
                                maxlength="20"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                required>
                              </div>
                            </div>
                            <div class="mb-3">
                              <label role="button">
                                <input type="checkbox" id="showPassword"> Show Password
                              </label>
                            </div>
                            <script>
                              const showPasswordCheckbox = document.getElementById("showPassword");
                              const passwordFields = document.querySelectorAll('input[type="password"]');
                              showPasswordCheckbox.addEventListener("change", function () {
                                  const showPassword = this.checked;

                                  passwordFields.forEach(function (field) {
                                    field.type = showPassword ? "text" : "password";
                                  });
                              });
                            </script>
                          </div>
                          <div class="text-center cp-buttons">
                            <input type="submit" name="adminCP-submit" value="Change Password">
                          </div>
                        </form>
                      </div><!-- End Change Password Form -->
                    </div><!-- END BORDERED TABS -->
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

        <!-----------===============- DELETE PHOTO MODAL -===============------------------>
        <div id="delete_photo_modal" class="modal">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">  
              <div class="modal-header">
                <h5 class="modal-title">Delete this photo?</h5>
              </div>
              <div class="modal-body">
                Photo will be permanently deleted
              </div>
              <div class="modal-footer p-2 delete_photo_confirmation">
                <form action="../process_admin.php" method="POST" enctype="multipart/form-data">
                  <input type="submit" name="deleteAdmin-submit" value="Delete">
                </form>
                <button type="button"  data-bs-dismiss="modal">Cancel</button>
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