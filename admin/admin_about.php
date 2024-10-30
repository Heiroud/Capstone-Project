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
            <title> UI-ALPerf | Admin | About </title>
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
                        <li class="breadcrumb-item"><a href="admin_about.php">Admin</a></li>
                        <li class="breadcrumb-item active">About</li>
                     </ol>
                  </nav>
               </div><!-- END PAGE TITLE -->
               <section class="section about">
                  <div class="row">
                     <div class="col-12 abab">
                        <!----=======-- ABOUT ALPERF CARD --=======---->
                        <div class="card">
                           <div class="card-body">
                              <h5>UI-ALPerf: UI Active Learning Performance</h5>
                              A system for monitoring and evaluating faculty and students performance at PHINMA educational
                              institutions is what this project aims to establish. It attempts to make tracking academic
                              progress for faculty and students simpler and more effective.
                           </div>
                        </div><!-- END ABOUT ALPERF CARD -->
                     </div>
                     <!----=======-- STUDENTS CODES CARD --=======---->
                     <div class="col-md-6 abab">
                        <div class="card">
                           <div class="card-body">
                              <h5>Students Codes</h5>
                              <table class="table">
                                 <tbody>
                                    <tr>
                                       <td><strong>L</strong></td>
                                       <td>Listening</td>
                                    </tr>
                                    <tr>
                                       <td><strong>Ind</strong></td>
                                       <td>Individual thinking</td>
                                    </tr>
                                    <tr>
                                       <td><strong>WG</strong></td>
                                       <td>Worksheet group work</td>
                                    </tr>
                                    <tr>
                                       <td><strong>AnQ</strong></td>
                                       <td>Answer questions</td>
                                    </tr>
                                    <tr>
                                       <td><strong>SQ</strong></td>
                                       <td>Student asks questions</td>
                                    </tr>
                                    <tr>
                                       <td><strong>WC</strong></td>
                                       <td>Whole class discussion</td>
                                    </tr>
                                    <tr>
                                       <td><strong>SP</strong></td>
                                       <td>Student presentation</td>
                                    </tr>
                                    <tr>
                                       <td><strong>TQ</strong></td>
                                       <td>Test/quiz</td>
                                    </tr>
                                    <tr>
                                       <td><strong>W</strong></td>
                                       <td>Waiting</td>
                                    </tr>
                                    <tr>
                                       <td><strong>O</strong></td>
                                       <td>Other</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div><!-- END STUDENTS CODES CARD -->
                     <!----=======-- INSTRUCTOR CODES CARD --=======---->
                     <div class="col-md-6 abab">
                        <div class="card">
                           <div class="card-body">
                              <h5>Instructor Codes</h5>
                              <table class="table">
                                 <tbody>
                                    <tr>
                                       <td><strong>Lec</strong></td>
                                       <td>Lecturing</td>
                                    </tr>
                                    <tr>
                                       <td><strong>RtW</strong></td>
                                       <td>Real-time Writing</td>
                                    </tr>
                                    <tr>
                                       <td><strong>FUp</strong></td>
                                       <td>Follow-up</td>
                                    </tr>
                                    <tr>
                                       <td><strong>AnQ</strong></td>
                                       <td>Answer questions</td>
                                    </tr>
                                    <tr>
                                       <td><strong>PQ</strong></td>
                                       <td>Pose questions</td>
                                    </tr>
                                    <tr>
                                       <td><strong>MG</strong></td>
                                       <td>Moving/Guiding</td>
                                    </tr>
                                    <tr>
                                       <td><strong>1o1</strong></td>
                                       <td>One-on-one</td>
                                    </tr>
                                    <tr>
                                       <td><strong>D/V</strong></td>
                                       <td>Demonstration</td>
                                    </tr>
                                    <tr>
                                       <td><strong>W</strong></td>
                                       <td>Waiting</td>
                                    </tr>
                                    <tr>
                                       <td><strong>O</strong></td>
                                       <td>Other</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div><!-- END INSTRUCTOR CODES CARD -->
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