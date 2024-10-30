<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>UI-ALPerf: UI Active Learning Performance</title>
   <link href="assets/img/ui.png" rel="icon">
   <!-----=====---- VENDOR CSS FILES ----======----->
   <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
   <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
   <!-----=======--- TEMPLATE MAIN CSS FILE ---========-->
   <link href="assets/css/index.css" rel="stylesheet">
</head>
<body>
   <!---------------- ======= ALERT MESSAGES ======= -------------->
   <?php include "includes/alerts.php"; ?>
   <!---------------- ======= HOME SECTION ======= -------------->
   <section id="home" class="d-flex align-items-center">
      <div class="container">
         <div class="row">
            <div id="home-content" class="col-lg-7 flex-lg-column pt-3">
               <div>
                  <h1>UI-ALPerf: UI Active Learning Performance</h1>
                  <h3>PHINMA UI's performance tracking for instructors and students.</h3>
               </div>
            </div>
            <div class="col-lg-4 flex-lg-column form">
               <ul class="nav nav-tabs">
                  <li class="nav-item">
                     <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#faculty-login">Faculty</button>
                  </li>
                  <li class="nav-item">
                     <button class="nav-link" data-bs-toggle="tab" data-bs-target="#admin-login">Admin</button>
                  </li>
               </ul>
               <div class="tab-content">
                  <div class="tab-pane fade show active faculty-login" id="faculty-login">
                     <form action="process_faculty.php" method="POST" class="row g-3">
                        <div class="col-md-12">
                           <div class="box">
                              <input type="email" name="flogin-email" class="form-control" placeholder="Faculty Email" required>
                           </div>
                        </div>
                        <div class="col-md-12 mb-2">
                           <div class="box">
                              <input type="password" name="flogin-password" class="form-control mb-2" id="Faculty-Password" placeholder="Password" required>
                           </div>
                           <label class="label-showPassword">
                              <input type="checkbox" id="faculty-show_password"> Show Password
                           </label>
                           <script>
                              const Fpassword = document.getElementById("Faculty-Password");
                              const FshowPasswordCheckbox = document.getElementById("faculty-show_password");
                              FshowPasswordCheckbox.addEventListener("change", function() {
                                 const type = FshowPasswordCheckbox.checked ? "text" : "password";
                                 Fpassword.type = type;
                              });
                           </script>
                        </div>
                        <div class="text-center button">
                           <input type="submit" name="flogin-submit" value="Log In" class="w-100">
                        </div>
                        <a href="" class="text-center">Forgot Password?</a>
                        <hr>
                        <div class="signUp-button">
                           <button type="button" data-bs-toggle="modal" data-bs-target="#CreateAccountModal">Create Account</button>
                        </div>
                     </form>
                  </div>
                  <div class="tab-pane fade admin-login" id="admin-login">
                     <form action="process_admin.php" method="POST" class="row g-3">
                        <div class="col-md-12">
                           <div class="box">
                              <input type="email" name="alogin-email" class="form-control" placeholder="Admin Email" required>
                           </div>
                        </div>
                        <div class="col-md-12 mb-2">
                           <div class="box">
                              <input type="password" name="alogin-password" class="form-control mb-2" id="Admin-Password" placeholder="Password" required>
                           </div>
                           <label role="button" class="label-showPassword">
                              <input type="checkbox" id="admin-show_password"> Show Password
                           </label>
                           <script>
                              const Apassword = document.getElementById("Admin-Password");
                              const AshowPasswordCheckbox = document.getElementById("admin-show_password");
                              AshowPasswordCheckbox.addEventListener("change", function() {
                                 const type = AshowPasswordCheckbox.checked ? "text" : "password";
                                 Apassword.type = type;
                              });
                           </script>
                        </div>
                        <div class="text-center button">
                           <input type="submit" name="alogin-submit" value="Log In" class="w-100">
                        </div>
                        <a href="" class="text-center">Forgot Password?</a>
                        <hr>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section><!-- END HOME -->
   
   <!---------------- ======= FOOTER ======= --------------
   <footer id="footer">
      <div class="container">
         <div class="footer-top">
            <div class="container">
               <div class="row">
                  <div class="col-lg-4 col-md-6 footer-contact">
                     <h3>UI-Alperf</h3>
                     <p>
                        Rizal St. <br>
                        Iloilo City Proper, 5000<br>
                        Philippines <br><br>
                        <strong>Phone:</strong>09167383825<br>
                        <strong>Email:</strong> info@example.com<br>
                     </p>
                  </div>      
               </div>
            </div>
         </div>
         <div class="container py-4 footer-bottom">
            <div class="copyright">
               &copy; 2023 <strong><span> UI-Alperf: Alternative Performance </span></strong>. All Rights Reserved
            </div>
         </div>
      </div>
   </footer>-- END FOOTER -->

   <!---====--- VENDOR JS FILES ---====--->
   <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!---====--- TEMPLATE MAIN JS FILE ---====--->
   <script src="assets/js/main.js"></script>

   <!-----------===============- CREATE FACULTY ACCOUNT MODAL -===============------------------>
   <div id="CreateAccountModal" class="modal">
      <div class="modal-dialog modal-dialog-centered">
         <div id="CreateAccount-Modalcontent" class="modal-content">  
            <div id="CreateAccount-Modalheader" class="modal-header">
               <h2>Sign Up</h2>
               <button type="button"data-bs-dismiss="modal"><i class="bi bi-x"></i></button>
            </div>
            <div id="CreateAccount-Modalbody" class="modal-body">
               <form action="process_faculty.php" method="POST">
                  <div class="user-details row g-2">
                     <div class="col-md-6">
                        <div class="box">
                           <input type="text" name="signup-fname" class="form-control" placeholder="First Name" required>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="box">
                           <input type="text" name="signup-lname" class="form-control" placeholder="Last Name" required>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="box">
                           <input type="email" name="signup-email" class="form-control" placeholder="Email" required>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <small>Password must be 8-20 characters long, contain at least one number, one uppercase and one lowercase letter.</small>
                     </div>
                     <div class="col-md-6">
                        <div class="box">
                           <input type="password" name="signup-password" class="form-control" placeholder="Password" minlength="8" maxlength="20" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="box">
                           <input type="password" name="signup-password2" class="form-control" placeholder="Confirm Password" minlength="8" maxlength="20" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                        </div>
                     </div>
                     <div class="mb-3 signUp-showPass">
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
                  <div class="text-center signUp-submit">
                     <input type="reset" value="Clear">
                     <input type="submit" name="signup-submit" value="Sign Up">
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</body>
</html>