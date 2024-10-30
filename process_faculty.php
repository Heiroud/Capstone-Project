<?php
   session_start();
   include "conn.php";

   //==========================================================-- CREATE AND LOGIN ACCOUNTS --===============================================================================================================================================

   //THIS IS FOR FACULTY CREATE ACCOUNT
   if(isset($_POST['signup-submit'])){
      $signup_fname = mysqli_real_escape_string($conn, $_POST['signup-fname']);
      $signup_lname = mysqli_real_escape_string($conn, $_POST['signup-lname']);
      $signup_email = mysqli_real_escape_string($conn, $_POST['signup-email']);
      $signup_password = mysqli_real_escape_string($conn, $_POST['signup-password']);
      $signup_password2 = mysqli_real_escape_string($conn, $_POST['signup-password2']);

      $check_faculty_email = mysqli_query($conn, "SELECT * FROM `faculty` WHERE `email` = '$signup_email'");
      $count_faculty_email = mysqli_num_rows($check_faculty_email);

      if($count_faculty_email == 0){
         if($signup_password == $signup_password2){
            $insert_faculty = mysqli_query($conn, "INSERT INTO `faculty` VALUES('0','$signup_fname','$signup_lname','$signup_email','$signup_password')");

            if($insert_faculty){
               $_SESSION['success_alert'] = "Account created. Please login!";
               header("Location: index.php"); exit;
            }else{
               $_SESSION['danger_alert'] = "Error in Creating";
               header("Location: index.php"); exit;
            }
         }else{
            $_SESSION['danger_alert'] = "Passwords did not match";
            header("Location: index.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Email is already used";
         header("Location: index.php"); exit;
      }
   }

   //THIS IS FOR FACULTY LOGIN
   if(isset($_POST['flogin-submit'])){
      $login_email = mysqli_real_escape_string($conn, $_POST['flogin-email']);
      $login_password = mysqli_real_escape_string($conn, $_POST['flogin-password']);

      $check_faculty_email = mysqli_query($conn, "SELECT * FROM `faculty` WHERE `email` = '$login_email'");
      $count_faculty_email = mysqli_num_rows($check_faculty_email);

      if($count_faculty_email == 1){
         $faculty_data = mysqli_fetch_assoc($check_faculty_email);
         $pass_from_db = $faculty_data['password'];

         if($pass_from_db == $login_password){
            $id_from_db = $faculty_data['id'];
            $_SESSION['session_faculty'] = $id_from_db;

            $_SESSION['success_alert'] = "Welcome Faculty!";
            header("Location: faculty/faculty_home.php"); exit;
         }else{
            $_SESSION['danger_alert'] = "Incorrect Password!";
            header("Location: index.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Email not Found!";
         header("Location: index.php"); exit;
      }
   }

   //==========================================================-- CLASSES REPORTS --===================================================================================================================================================

   //THIS IS FOR FACULTY ARCHIVE CLASS REPORT
   if(isset($_POST['archive_class_report'])){
      if(isset($_SESSION['session_faculty'])){
         $faculty_ID = $_SESSION['session_faculty'];

         if(isset($_GET['report_info_id']) && isset($_GET['report_stu_id']) && isset($_GET['report_ins_id']) && isset($_GET['report_com_id'])){
            $info_id = $_GET['report_info_id'];
            $stu_id = $_GET['report_stu_id'];
            $ins_id = $_GET['report_ins_id'];
            $com_id = $_GET['report_com_id'];

            $select_info = mysqli_query($conn, "SELECT * FROM `class_report_info` WHERE `report_info_id` = '$info_id' AND `faculty_id` = '$faculty_ID'");
            $fetch_info = mysqli_fetch_assoc($select_info);

            $select_stu = mysqli_query($conn, "SELECT * FROM `class_report_stu` WHERE `report_stu_id` = '$stu_id' AND `faculty_id` = '$faculty_ID'");
            $fetch_stu = mysqli_fetch_assoc($select_stu);

            $select_ins = mysqli_query($conn, "SELECT * FROM `class_report_ins` WHERE `report_ins_id` = '$ins_id' AND `faculty_id` = '$faculty_ID'");
            $fetch_ins = mysqli_fetch_assoc($select_ins);

            $select_com = mysqli_query($conn, "SELECT * FROM `class_report_com` WHERE `report_com_id` = '$com_id' AND `faculty_id` = '$faculty_ID'");
            $fetch_com = mysqli_fetch_assoc($select_com);

            if(($fetch_info['faculty_archive'] == TRUE && $fetch_stu['faculty_archive'] == TRUE && $fetch_ins['faculty_archive'] == TRUE && $fetch_com['faculty_archive'] == TRUE)){
               mysqli_query($conn, "UPDATE `class_report_info` SET `faculty_archive` = FALSE WHERE `report_info_id` = '$info_id' AND `faculty_id` = '$faculty_ID'");
               mysqli_query($conn, "UPDATE `class_report_stu` SET `faculty_archive` = FALSE WHERE `report_stu_id` = '$stu_id' AND `faculty_id` = '$faculty_ID'");
               mysqli_query($conn, "UPDATE `class_report_ins` SET `faculty_archive` = FALSE WHERE `report_ins_id` = '$ins_id' AND `faculty_id` = '$faculty_ID'");
               mysqli_query($conn, "UPDATE `class_report_com` SET `faculty_archive` = FALSE WHERE `report_com_id` = '$com_id' AND `faculty_id` = '$faculty_ID'");

               $_SESSION['success_alert'] = "Report Archived";
               header("Location: faculty/faculty_report.php"); exit;
            }else{
               $_SESSION['danger_alert'] = "Error in deleting";
               header("Location: faculty/faculty_report.php"); exit;
            }
         }else{
            $_SESSION['danger_alert'] = "Error";
            header("Location: faculty/faculty_report.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Error";
         header("Location: faculty/faculty_report.php"); exit;
      }
   }

   //THIS IS FOR FACULTY UNARCHIVE CLASS REPORT
   if(isset($_POST['unarchive_class_report'])){
      if(isset($_SESSION['session_faculty'])){
         $faculty_ID = $_SESSION['session_faculty'];

         if(isset($_GET['report_info_id']) && isset($_GET['report_stu_id']) && isset($_GET['report_ins_id']) && isset($_GET['report_com_id'])){
            $info_id = $_GET['report_info_id'];
            $stu_id = $_GET['report_stu_id'];
            $ins_id = $_GET['report_ins_id'];
            $com_id = $_GET['report_com_id'];

            $select_info = mysqli_query($conn, "SELECT * FROM `class_report_info` WHERE `report_info_id` = '$info_id' AND `faculty_id` = '$faculty_ID'");
            $fetch_info = mysqli_fetch_assoc($select_info);

            $select_stu = mysqli_query($conn, "SELECT * FROM `class_report_stu` WHERE `report_stu_id` = '$stu_id' AND `faculty_id` = '$faculty_ID'");
            $fetch_stu = mysqli_fetch_assoc($select_stu);

            $select_ins = mysqli_query($conn, "SELECT * FROM `class_report_ins` WHERE `report_ins_id` = '$ins_id' AND `faculty_id` = '$faculty_ID'");
            $fetch_ins = mysqli_fetch_assoc($select_ins);

            $select_com = mysqli_query($conn, "SELECT * FROM `class_report_com` WHERE `report_com_id` = '$com_id' AND `faculty_id` = '$faculty_ID'");
            $fetch_com = mysqli_fetch_assoc($select_com);

            if(($fetch_info['faculty_archive'] == FALSE && $fetch_stu['faculty_archive'] == FALSE && $fetch_ins['faculty_archive'] == FALSE && $fetch_com['faculty_archive'] == FALSE)){
               mysqli_query($conn, "UPDATE `class_report_info` SET `faculty_archive` = TRUE WHERE `report_info_id` = '$info_id' AND `faculty_id` = '$faculty_ID'");
               mysqli_query($conn, "UPDATE `class_report_stu` SET `faculty_archive` = TRUE WHERE `report_stu_id` = '$stu_id' AND `faculty_id` = '$faculty_ID'");
               mysqli_query($conn, "UPDATE `class_report_ins` SET `faculty_archive` = TRUE WHERE `report_ins_id` = '$ins_id' AND `faculty_id` = '$faculty_ID'");
               mysqli_query($conn, "UPDATE `class_report_com` SET `faculty_archive` = TRUE WHERE `report_com_id` = '$com_id' AND `faculty_id` = '$faculty_ID'");

               $_SESSION['success_alert'] = "Report Archived";
               header("Location: faculty/faculty_archive.php"); exit;
            }else{
               $_SESSION['danger_alert'] = "Error in deleting";
               header("Location: faculty/faculty_archive.php"); exit;
            }
         }else{
            $_SESSION['danger_alert'] = "Error";
            header("Location: faculty/faculty_archive.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Error";
         header("Location: faculty/faculty_archive.php"); exit;
      }
   }

   //==========================================================-- FACULTY EDIT PROFILE --===============================================================================================================================================

   // THIS IS FOR FACULTY UPDATE ACCOUNT 
   if(isset($_POST['updateFaculty-submit'])){
      if(isset($_SESSION['session_faculty'])){
         $faculty_ID = $_SESSION['session_faculty'];

         $update_fname = mysqli_real_escape_string($conn, $_POST['updateFaculty-fname']);
         $update_lname = mysqli_real_escape_string($conn, $_POST['updateFaculty-lname']);
         $update_email = mysqli_real_escape_string($conn, $_POST['updateFaculty-email']);

         $instructor_name = $update_lname . ', ' . $update_fname;

         $current_email_query = mysqli_query($conn, "SELECT `email` FROM `faculty` WHERE `id` = '$faculty_ID'");
         $current_email_row = mysqli_fetch_assoc($current_email_query);
         $current_email = $current_email_row['email'];

         if($update_email !== $current_email) {
            $check_faculty_email = mysqli_query($conn, "SELECT * FROM `faculty` WHERE `email` = '$update_email'");
            $count_faculty_email = mysqli_num_rows($check_faculty_email);
            if($count_faculty_email > 0){
               $_SESSION['primary_alert'] = "Email is already used";
               header("Location: faculty/faculty_profile.php"); exit;
            }
         }
         $update_faculty = mysqli_query($conn, "UPDATE `faculty` SET `first_name` = '$update_fname', `last_name` = '$update_lname', `email` = '$update_email' WHERE `id` = '$faculty_ID'");
         $update_instructor = mysqli_query($conn, "UPDATE `class_report_info` SET `instructor` = '$instructor_name' WHERE `faculty_id` = '$faculty_ID'");
         if($update_faculty && $update_instructor){
            $_SESSION['success_alert'] = "Changes Saved";
            header("Location: faculty/faculty_profile.php"); exit;
         }else{
            $_SESSION['danger_alert'] = "Error in Updating";
            header("Location: faculty/faculty_profile.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Error";
         header("Location: faculty/faculty_profile.php"); exit;
      }
   }

   //THIS IS FOR UPLOAD FACULTY PROFILE PHOTO
   if(isset($_POST['uploadFaculty-pic'])){
      if(isset($_SESSION['session_faculty'])){
         $faculty_ID = $_SESSION['session_faculty'];

         $pic_name = $_FILES['faculty-pic']['name'];
         $pic_tmpname = $_FILES['faculty-pic']['tmp_name'];
         $pic_size = $_FILES['faculty-pic']['size'];
         $pic_dir = 'assets/img/faculty_img/'.$pic_name;

         if($pic_size < 10000000){
            $select_prev_pic = mysqli_query($conn, "SELECT `faculty_pic_path` FROM `faculty_pic` WHERE `id` = '$faculty_ID'");
            if($fetch_prev_pic = mysqli_fetch_assoc($select_prev_pic)){
               $old_pic = 'assets/img/faculty_img/'.$fetch_prev_pic['faculty_pic_path'];

               if(file_exists($old_pic)){
                  unlink($old_pic);
               }
               mysqli_query($conn, "UPDATE `faculty_pic` SET `faculty_pic_path` = '$pic_name' WHERE `id` = '$faculty_ID'");
            }else{
               mysqli_query($conn, "INSERT INTO `faculty_pic` VALUES ('0', '$faculty_ID', '$pic_name')");
            }
            if(move_uploaded_file($pic_tmpname, $pic_dir)){
               $_SESSION['success_alert'] = "Picture is uploaded";
               header("Location: faculty/faculty_profile.php"); exit;
            }else{
               $_SESSION['danger_alert'] = "Error!";
               header("Location: faculty/faculty_profile.php"); exit;
            }
         }else{
            $_SESSION['primary_alert'] = "Less than 10MB required";
            header("Location: faculty/faculty_profile.php"); exit;
         }
      }
   }

   //THIS IS FOR DELETE FACULTY PROFILE PHOTO
   if(isset($_POST['deleteFaculty-submit'])){
      if(isset($_SESSION['session_faculty'])){
         $faculty_ID = $_SESSION['session_faculty'];

         $check_pic = mysqli_query($conn, "SELECT `faculty_pic_path` FROM `faculty_pic` WHERE `id` = '$faculty_ID'");
         $fetch_pic = mysqli_fetch_assoc($check_pic);
         if($fetch_pic){
            $cur_pic = 'assets/img/faculty_img/'.$fetch_pic['faculty_pic_path'];

            if(file_exists($cur_pic)){
               unlink($cur_pic);
            }
            $delete_pic = mysqli_query($conn, "DELETE FROM `faculty_pic` WHERE `id` = '$faculty_ID'");
            if($delete_pic){
               $_SESSION['success_alert'] = "Photo Deleted";
               header("Location: faculty/faculty_profile.php"); exit;
            }else{
               $_SESSION['danger_alert'] = "Error in deleting";
               header("Location: faculty/faculty_profile.php"); exit;
            }
         }else{
            $_SESSION['primary_alert'] = "No photo to delete";
            header("Location: faculty/faculty_profile.php"); exit;
         }
      }
   }

   //THIS IS FOR FACULTY CHANGE PASSWORD
   if(isset($_POST['facultyCP-submit'])){
      if(isset($_SESSION['session_faculty'])){
         $faculty_ID = $_SESSION['session_faculty'];
         
         $current_password = mysqli_real_escape_string($conn, $_POST['faculty-current-password']);
         $new_password = mysqli_real_escape_string($conn, $_POST['faculty-new-password']);
         $new_password2 = mysqli_real_escape_string($conn, $_POST['faculty-new-password2']);
         
         if($new_password == $new_password2){
            $check_password = mysqli_query($conn, "SELECT `password` FROM `faculty` WHERE `id` = '$faculty_ID'");
            $fetch_password = mysqli_fetch_assoc($check_password);

            $password_from_db = $fetch_password['password'];
               
            if($password_from_db == $current_password){
               $change_password = mysqli_query($conn, "UPDATE `faculty` SET `password` = '$new_password' WHERE `id` = $faculty_ID");
               if($change_password){
                  $_SESSION['success_alert'] = "Password Changed";
                  header("Location: faculty/faculty_profile.php"); exit;
               }else{
                  $_SESSION['danger_alert'] = "Error in changing";
                  header("Location: faculty/faculty_profile.php"); exit;
               }
            }else{
               $_SESSION['danger_alert'] = "Current password is incorrect";
               header("Location: faculty/faculty_profile.php"); exit;
            }
         }else{
            $_SESSION['danger_alert'] = "New passwords did not match";
            header("Location: faculty/faculty_profile.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Error";
         header("Location: faculty/faculty_profile.php"); exit;
      }
   }

//==========================================================-- LOGOUT --===============================================================================================================================================

   // THIS IS FOR FACULTY LOGOUT
   if(isset($_POST['faculty-logout'])){
      if(isset($_SESSION['session_faculty'])){
         unset($_SESSION['session_faculty']);
         $_SESSION['success_alert'] = "Log Out Successfully";
         header("Location: index.php"); exit;
      }
   }
?>