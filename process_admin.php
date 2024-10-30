<?php
   session_start();
   include "conn.php";

   //==========================================================-- LOGIN ADMIN --===============================================================================================================================================

   //THIS IS FOR ADMIN LOGIN
   if(isset($_POST['alogin-submit'])){
      $login_email = mysqli_real_escape_string($conn, $_POST['alogin-email']);
      $login_password = mysqli_real_escape_string($conn, $_POST['alogin-password']);

      $check_admin_email = mysqli_query($conn, "SELECT * FROM `admin` WHERE `email` = '$login_email'");
      $count_admin_email = mysqli_num_rows($check_admin_email);
      if($count_admin_email == 1){
         $admin_data = mysqli_fetch_assoc($check_admin_email);
         $pass_from_db = $admin_data['password'];

         if($pass_from_db == $login_password){
            $id_from_db = $admin_data['id'];
            $_SESSION['session_admin'] = $id_from_db;

            $_SESSION['success_alert'] = "Welcome Admin!";
            header("Location: admin/admin_home.php"); exit;
         }else{
            $_SESSION['danger_alert'] = "Incorrect Password!";
            header("Location: index.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Email not Found!";
         header("Location: index.php"); exit;
      }
   }

   //==========================================================-- CLASS REPORTS --===================================================================================================================================================

   //THIS IS FOR INSERT CLASS REPORT
   if(isset($_POST['class-submit'])){
      if(isset($_SESSION['session_admin'])){
         $admin_ID = $_SESSION['session_admin'];

         $class_section = $_POST['class_info_section'];
         $class_instructor = $_POST['class_info_instructor'];
         $class_subject = $_POST['class_info_subject'];
         $class_date = $_POST['class_info_date'];
         $class_SY = $_POST['class_info_SY'];
         $class_semester = $_POST['class_info_semester'];
         $class_observer_name = $_POST['class_info_observerName'];

         $s_l_2 = isset($_POST['s_l_2']) ? $_POST['s_l_2'] : '';    $s_ind_2 = isset($_POST['s_ind_2']) ? $_POST['s_ind_2'] : '';    $s_wg_2 = isset($_POST['s_wg_2']) ? $_POST['s_wg_2'] : '';    $s_anq_2 = isset($_POST['s_anq_2']) ? $_POST['s_anq_2'] : '';    $s_sq_2 = isset($_POST['s_sq_2']) ? $_POST['s_sq_2'] : '';    $s_wc_2 = isset($_POST['s_wc_2']) ? $_POST['s_wc_2'] : '';    $s_sp_2 = isset($_POST['s_sp_2']) ? $_POST['s_sp_2'] : '';    $s_tq_2 = isset($_POST['s_tq_2']) ? $_POST['s_tq_2'] : '';    $s_w_2 = isset($_POST['s_w_2']) ? $_POST['s_w_2'] : '';    $s_o_2 = isset($_POST['s_o_2']) ? $_POST['s_o_2'] : '';
         $s_l_4 = isset($_POST['s_l_4']) ? $_POST['s_l_4'] : '';    $s_ind_4 = isset($_POST['s_ind_4']) ? $_POST['s_ind_4'] : '';    $s_wg_4 = isset($_POST['s_wg_4']) ? $_POST['s_wg_4'] : '';    $s_anq_4 = isset($_POST['s_anq_4']) ? $_POST['s_anq_4'] : '';    $s_sq_4 = isset($_POST['s_sq_4']) ? $_POST['s_sq_4'] : '';    $s_wc_4 = isset($_POST['s_wc_4']) ? $_POST['s_wc_4'] : '';    $s_sp_4 = isset($_POST['s_sp_4']) ? $_POST['s_sp_4'] : '';    $s_tq_4 = isset($_POST['s_tq_4']) ? $_POST['s_tq_4'] : '';    $s_w_4 = isset($_POST['s_w_4']) ? $_POST['s_w_4'] : '';    $s_o_4 = isset($_POST['s_o_4']) ? $_POST['s_o_4'] : '';
         $s_l_6 = isset($_POST['s_l_6']) ? $_POST['s_l_6'] : '';    $s_ind_6 = isset($_POST['s_ind_6']) ? $_POST['s_ind_6'] : '';    $s_wg_6 = isset($_POST['s_wg_6']) ? $_POST['s_wg_6'] : '';    $s_anq_6 = isset($_POST['s_anq_6']) ? $_POST['s_anq_6'] : '';    $s_sq_6 = isset($_POST['s_sq_6']) ? $_POST['s_sq_6'] : '';    $s_wc_6 = isset($_POST['s_wc_6']) ? $_POST['s_wc_6'] : '';    $s_sp_6 = isset($_POST['s_sp_6']) ? $_POST['s_sp_6'] : '';    $s_tq_6 = isset($_POST['s_tq_6']) ? $_POST['s_tq_6'] : '';    $s_w_6 = isset($_POST['s_w_6']) ? $_POST['s_w_6'] : '';    $s_o_6 = isset($_POST['s_o_6']) ? $_POST['s_o_6'] : '';
         $s_l_8 = isset($_POST['s_l_8']) ? $_POST['s_l_8'] : '';    $s_ind_8 = isset($_POST['s_ind_8']) ? $_POST['s_ind_8'] : '';    $s_wg_8 = isset($_POST['s_wg_8']) ? $_POST['s_wg_8'] : '';    $s_anq_8 = isset($_POST['s_anq_8']) ? $_POST['s_anq_8'] : '';    $s_sq_8 = isset($_POST['s_sq_8']) ? $_POST['s_sq_8'] : '';    $s_wc_8 = isset($_POST['s_wc_8']) ? $_POST['s_wc_8'] : '';    $s_sp_8 = isset($_POST['s_sp_8']) ? $_POST['s_sp_8'] : '';    $s_tq_8 = isset($_POST['s_tq_8']) ? $_POST['s_tq_8'] : '';    $s_w_8 = isset($_POST['s_w_8']) ? $_POST['s_w_8'] : '';    $s_o_8 = isset($_POST['s_o_8']) ? $_POST['s_o_8'] : '';
         $s_l_10 = isset($_POST['s_l_10']) ? $_POST['s_l_10'] : ''; $s_ind_10 = isset($_POST['s_ind_10']) ? $_POST['s_ind_10'] : ''; $s_wg_10 = isset($_POST['s_wg_10']) ? $_POST['s_wg_10'] : ''; $s_anq_10 = isset($_POST['s_anq_10']) ? $_POST['s_anq_10'] : ''; $s_sq_10 = isset($_POST['s_sq_10']) ? $_POST['s_sq_10'] : ''; $s_wc_10 = isset($_POST['s_wc_10']) ? $_POST['s_wc_10'] : ''; $s_sp_10 = isset($_POST['s_sp_10']) ? $_POST['s_sp_10'] : ''; $s_tq_10 = isset($_POST['s_tq_10']) ? $_POST['s_tq_10'] : ''; $s_w_10 = isset($_POST['s_w_10']) ? $_POST['s_w_10'] : ''; $s_o_10 = isset($_POST['s_o_10']) ? $_POST['s_o_10'] : '';
         $s_l_12 = isset($_POST['s_l_12']) ? $_POST['s_l_12'] : ''; $s_ind_12 = isset($_POST['s_ind_12']) ? $_POST['s_ind_12'] : ''; $s_wg_12 = isset($_POST['s_wg_12']) ? $_POST['s_wg_12'] : ''; $s_anq_12 = isset($_POST['s_anq_12']) ? $_POST['s_anq_12'] : ''; $s_sq_12 = isset($_POST['s_sq_12']) ? $_POST['s_sq_12'] : ''; $s_wc_12 = isset($_POST['s_wc_12']) ? $_POST['s_wc_12'] : ''; $s_sp_12 = isset($_POST['s_sp_12']) ? $_POST['s_sp_12'] : ''; $s_tq_12 = isset($_POST['s_tq_12']) ? $_POST['s_tq_12'] : ''; $s_w_12 = isset($_POST['s_w_12']) ? $_POST['s_w_12'] : ''; $s_o_12 = isset($_POST['s_o_12']) ? $_POST['s_o_12'] : '';
         $s_l_14 = isset($_POST['s_l_14']) ? $_POST['s_l_14'] : ''; $s_ind_14 = isset($_POST['s_ind_14']) ? $_POST['s_ind_14'] : ''; $s_wg_14 = isset($_POST['s_wg_14']) ? $_POST['s_wg_14'] : ''; $s_anq_14 = isset($_POST['s_anq_14']) ? $_POST['s_anq_14'] : ''; $s_sq_14 = isset($_POST['s_sq_14']) ? $_POST['s_sq_14'] : ''; $s_wc_14 = isset($_POST['s_wc_14']) ? $_POST['s_wc_14'] : ''; $s_sp_14 = isset($_POST['s_sp_14']) ? $_POST['s_sp_14'] : ''; $s_tq_14 = isset($_POST['s_tq_14']) ? $_POST['s_tq_14'] : ''; $s_w_14 = isset($_POST['s_w_14']) ? $_POST['s_w_14'] : ''; $s_o_14 = isset($_POST['s_o_14']) ? $_POST['s_o_14'] : '';
         $s_l_16 = isset($_POST['s_l_16']) ? $_POST['s_l_16'] : ''; $s_ind_16 = isset($_POST['s_ind_16']) ? $_POST['s_ind_16'] : ''; $s_wg_16 = isset($_POST['s_wg_16']) ? $_POST['s_wg_16'] : ''; $s_anq_16 = isset($_POST['s_anq_16']) ? $_POST['s_anq_16'] : ''; $s_sq_16 = isset($_POST['s_sq_16']) ? $_POST['s_sq_16'] : ''; $s_wc_16 = isset($_POST['s_wc_16']) ? $_POST['s_wc_16'] : ''; $s_sp_16 = isset($_POST['s_sp_16']) ? $_POST['s_sp_16'] : ''; $s_tq_16 = isset($_POST['s_tq_16']) ? $_POST['s_tq_16'] : ''; $s_w_16 = isset($_POST['s_w_16']) ? $_POST['s_w_16'] : ''; $s_o_16 = isset($_POST['s_o_16']) ? $_POST['s_o_16'] : '';
         $s_l_18 = isset($_POST['s_l_18']) ? $_POST['s_l_18'] : ''; $s_ind_18 = isset($_POST['s_ind_18']) ? $_POST['s_ind_18'] : ''; $s_wg_18 = isset($_POST['s_wg_18']) ? $_POST['s_wg_18'] : ''; $s_anq_18 = isset($_POST['s_anq_18']) ? $_POST['s_anq_18'] : ''; $s_sq_18 = isset($_POST['s_sq_18']) ? $_POST['s_sq_18'] : ''; $s_wc_18 = isset($_POST['s_wc_18']) ? $_POST['s_wc_18'] : ''; $s_sp_18 = isset($_POST['s_sp_18']) ? $_POST['s_sp_18'] : ''; $s_tq_18 = isset($_POST['s_tq_18']) ? $_POST['s_tq_18'] : ''; $s_w_18 = isset($_POST['s_w_18']) ? $_POST['s_w_18'] : ''; $s_o_18 = isset($_POST['s_o_18']) ? $_POST['s_o_18'] : '';
         $s_l_20 = isset($_POST['s_l_20']) ? $_POST['s_l_20'] : ''; $s_ind_20 = isset($_POST['s_ind_20']) ? $_POST['s_ind_20'] : ''; $s_wg_20 = isset($_POST['s_wg_20']) ? $_POST['s_wg_20'] : ''; $s_anq_20 = isset($_POST['s_anq_20']) ? $_POST['s_anq_20'] : ''; $s_sq_20 = isset($_POST['s_sq_20']) ? $_POST['s_sq_20'] : ''; $s_wc_20 = isset($_POST['s_wc_20']) ? $_POST['s_wc_20'] : ''; $s_sp_20 = isset($_POST['s_sp_20']) ? $_POST['s_sp_20'] : ''; $s_tq_20 = isset($_POST['s_tq_20']) ? $_POST['s_tq_20'] : ''; $s_w_20 = isset($_POST['s_w_20']) ? $_POST['s_w_20'] : ''; $s_o_20 = isset($_POST['s_o_20']) ? $_POST['s_o_20'] : '';
         $s_l_22 = isset($_POST['s_l_22']) ? $_POST['s_l_22'] : ''; $s_ind_22 = isset($_POST['s_ind_22']) ? $_POST['s_ind_22'] : ''; $s_wg_22 = isset($_POST['s_wg_22']) ? $_POST['s_wg_22'] : ''; $s_anq_22 = isset($_POST['s_anq_22']) ? $_POST['s_anq_22'] : ''; $s_sq_22 = isset($_POST['s_sq_22']) ? $_POST['s_sq_22'] : ''; $s_wc_22 = isset($_POST['s_wc_22']) ? $_POST['s_wc_22'] : ''; $s_sp_22 = isset($_POST['s_sp_22']) ? $_POST['s_sp_22'] : ''; $s_tq_22 = isset($_POST['s_tq_22']) ? $_POST['s_tq_22'] : ''; $s_w_22 = isset($_POST['s_w_22']) ? $_POST['s_w_22'] : ''; $s_o_22 = isset($_POST['s_o_22']) ? $_POST['s_o_22'] : '';
         $s_l_24 = isset($_POST['s_l_24']) ? $_POST['s_l_24'] : ''; $s_ind_24 = isset($_POST['s_ind_24']) ? $_POST['s_ind_24'] : ''; $s_wg_24 = isset($_POST['s_wg_24']) ? $_POST['s_wg_24'] : ''; $s_anq_24 = isset($_POST['s_anq_24']) ? $_POST['s_anq_24'] : ''; $s_sq_24 = isset($_POST['s_sq_24']) ? $_POST['s_sq_24'] : ''; $s_wc_24 = isset($_POST['s_wc_24']) ? $_POST['s_wc_24'] : ''; $s_sp_24 = isset($_POST['s_sp_24']) ? $_POST['s_sp_24'] : ''; $s_tq_24 = isset($_POST['s_tq_24']) ? $_POST['s_tq_24'] : ''; $s_w_24 = isset($_POST['s_w_24']) ? $_POST['s_w_24'] : ''; $s_o_24 = isset($_POST['s_o_24']) ? $_POST['s_o_24'] : '';
         $s_l_26 = isset($_POST['s_l_26']) ? $_POST['s_l_26'] : ''; $s_ind_26 = isset($_POST['s_ind_26']) ? $_POST['s_ind_26'] : ''; $s_wg_26 = isset($_POST['s_wg_26']) ? $_POST['s_wg_26'] : ''; $s_anq_26 = isset($_POST['s_anq_26']) ? $_POST['s_anq_26'] : ''; $s_sq_26 = isset($_POST['s_sq_26']) ? $_POST['s_sq_26'] : ''; $s_wc_26 = isset($_POST['s_wc_26']) ? $_POST['s_wc_26'] : ''; $s_sp_26 = isset($_POST['s_sp_26']) ? $_POST['s_sp_26'] : ''; $s_tq_26 = isset($_POST['s_tq_26']) ? $_POST['s_tq_26'] : ''; $s_w_26 = isset($_POST['s_w_26']) ? $_POST['s_w_26'] : ''; $s_o_26 = isset($_POST['s_o_26']) ? $_POST['s_o_26'] : '';
         $s_l_28 = isset($_POST['s_l_28']) ? $_POST['s_l_28'] : ''; $s_ind_28 = isset($_POST['s_ind_28']) ? $_POST['s_ind_28'] : ''; $s_wg_28 = isset($_POST['s_wg_28']) ? $_POST['s_wg_28'] : ''; $s_anq_28 = isset($_POST['s_anq_28']) ? $_POST['s_anq_28'] : ''; $s_sq_28 = isset($_POST['s_sq_28']) ? $_POST['s_sq_28'] : ''; $s_wc_28 = isset($_POST['s_wc_28']) ? $_POST['s_wc_28'] : ''; $s_sp_28 = isset($_POST['s_sp_28']) ? $_POST['s_sp_28'] : ''; $s_tq_28 = isset($_POST['s_tq_28']) ? $_POST['s_tq_28'] : ''; $s_w_28 = isset($_POST['s_w_28']) ? $_POST['s_w_28'] : ''; $s_o_28 = isset($_POST['s_o_28']) ? $_POST['s_o_28'] : '';
         $s_l_30 = isset($_POST['s_l_30']) ? $_POST['s_l_30'] : ''; $s_ind_30 = isset($_POST['s_ind_30']) ? $_POST['s_ind_30'] : ''; $s_wg_30 = isset($_POST['s_wg_30']) ? $_POST['s_wg_30'] : ''; $s_anq_30 = isset($_POST['s_anq_30']) ? $_POST['s_anq_30'] : ''; $s_sq_30 = isset($_POST['s_sq_30']) ? $_POST['s_sq_30'] : ''; $s_wc_30 = isset($_POST['s_wc_30']) ? $_POST['s_wc_30'] : ''; $s_sp_30 = isset($_POST['s_sp_30']) ? $_POST['s_sp_30'] : ''; $s_tq_30 = isset($_POST['s_tq_30']) ? $_POST['s_tq_30'] : ''; $s_w_30 = isset($_POST['s_w_30']) ? $_POST['s_w_30'] : ''; $s_o_30 = isset($_POST['s_o_30']) ? $_POST['s_o_30'] : '';

         $i_lec_2 = isset($_POST['i_lec_2']) ? $_POST['i_lec_2'] : '';    $i_rtw_2 = isset($_POST['i_rtw_2']) ? $_POST['i_rtw_2'] : '';    $i_fup_2 = isset($_POST['i_fup_2']) ? $_POST['i_fup_2'] : '';    $i_anq_2 = isset($_POST['i_anq_2']) ? $_POST['i_anq_2'] : '';    $i_pq_2 = isset($_POST['i_pq_2']) ? $_POST['i_pq_2'] : '';    $i_mg_2 = isset($_POST['i_mg_2']) ? $_POST['i_mg_2'] : '';    $i_1o1_2 = isset($_POST['i_1o1_2']) ? $_POST['i_1o1_2'] : '';    $i_dv_2 = isset($_POST['i_dv_2']) ? $_POST['i_dv_2'] : '';    $i_w_2 = isset($_POST['i_w_2']) ? $_POST['i_w_2'] : '';    $i_o_2 = isset($_POST['i_o_2']) ? $_POST['i_o_2'] : '';
         $i_lec_4 = isset($_POST['i_lec_4']) ? $_POST['i_lec_4'] : '';    $i_rtw_4 = isset($_POST['i_rtw_4']) ? $_POST['i_rtw_4'] : '';    $i_fup_4 = isset($_POST['i_fup_4']) ? $_POST['i_fup_4'] : '';    $i_anq_4 = isset($_POST['i_anq_4']) ? $_POST['i_anq_4'] : '';    $i_pq_4 = isset($_POST['i_pq_4']) ? $_POST['i_pq_4'] : '';    $i_mg_4 = isset($_POST['i_mg_4']) ? $_POST['i_mg_4'] : '';    $i_1o1_4 = isset($_POST['i_1o1_4']) ? $_POST['i_1o1_4'] : '';    $i_dv_4 = isset($_POST['i_dv_4']) ? $_POST['i_dv_4'] : '';    $i_w_4 = isset($_POST['i_w_4']) ? $_POST['i_w_4'] : '';    $i_o_4 = isset($_POST['i_o_4']) ? $_POST['i_o_4'] : '';
         $i_lec_6 = isset($_POST['i_lec_6']) ? $_POST['i_lec_6'] : '';    $i_rtw_6 = isset($_POST['i_rtw_6']) ? $_POST['i_rtw_6'] : '';    $i_fup_6 = isset($_POST['i_fup_6']) ? $_POST['i_fup_6'] : '';    $i_anq_6 = isset($_POST['i_anq_6']) ? $_POST['i_anq_6'] : '';    $i_pq_6 = isset($_POST['i_pq_6']) ? $_POST['i_pq_6'] : '';    $i_mg_6 = isset($_POST['i_mg_6']) ? $_POST['i_mg_6'] : '';    $i_1o1_6 = isset($_POST['i_1o1_6']) ? $_POST['i_1o1_6'] : '';    $i_dv_6 = isset($_POST['i_dv_6']) ? $_POST['i_dv_6'] : '';    $i_w_6 = isset($_POST['i_w_6']) ? $_POST['i_w_6'] : '';    $i_o_6 = isset($_POST['i_o_6']) ? $_POST['i_o_6'] : '';
         $i_lec_8 = isset($_POST['i_lec_8']) ? $_POST['i_lec_8'] : '';    $i_rtw_8 = isset($_POST['i_rtw_8']) ? $_POST['i_rtw_8'] : '';    $i_fup_8 = isset($_POST['i_fup_8']) ? $_POST['i_fup_8'] : '';    $i_anq_8 = isset($_POST['i_anq_8']) ? $_POST['i_anq_8'] : '';    $i_pq_8 = isset($_POST['i_pq_8']) ? $_POST['i_pq_8'] : '';    $i_mg_8 = isset($_POST['i_mg_8']) ? $_POST['i_mg_8'] : '';    $i_1o1_8 = isset($_POST['i_1o1_8']) ? $_POST['i_1o1_8'] : '';    $i_dv_8 = isset($_POST['i_dv_8']) ? $_POST['i_dv_8'] : '';    $i_w_8 = isset($_POST['i_w_8']) ? $_POST['i_w_8'] : '';    $i_o_8 = isset($_POST['i_o_8']) ? $_POST['i_o_8'] : '';
         $i_lec_10 = isset($_POST['i_lec_10']) ? $_POST['i_lec_10'] : ''; $i_rtw_10 = isset($_POST['i_rtw_10']) ? $_POST['i_rtw_10'] : ''; $i_fup_10 = isset($_POST['i_fup_10']) ? $_POST['i_fup_10'] : ''; $i_anq_10 = isset($_POST['i_anq_10']) ? $_POST['i_anq_10'] : ''; $i_pq_10 = isset($_POST['i_pq_10']) ? $_POST['i_pq_10'] : ''; $i_mg_10 = isset($_POST['i_mg_10']) ? $_POST['i_mg_10'] : ''; $i_1o1_10 = isset($_POST['i_1o1_10']) ? $_POST['i_1o1_10'] : ''; $i_dv_10 = isset($_POST['i_dv_10']) ? $_POST['i_dv_10'] : ''; $i_w_10 = isset($_POST['i_w_10']) ? $_POST['i_w_10'] : ''; $i_o_10 = isset($_POST['i_o_10']) ? $_POST['i_o_10'] : '';
         $i_lec_12 = isset($_POST['i_lec_12']) ? $_POST['i_lec_12'] : ''; $i_rtw_12 = isset($_POST['i_rtw_12']) ? $_POST['i_rtw_12'] : ''; $i_fup_12 = isset($_POST['i_fup_12']) ? $_POST['i_fup_12'] : ''; $i_anq_12 = isset($_POST['i_anq_12']) ? $_POST['i_anq_12'] : ''; $i_pq_12 = isset($_POST['i_pq_12']) ? $_POST['i_pq_12'] : ''; $i_mg_12 = isset($_POST['i_mg_12']) ? $_POST['i_mg_12'] : ''; $i_1o1_12 = isset($_POST['i_1o1_12']) ? $_POST['i_1o1_12'] : ''; $i_dv_12 = isset($_POST['i_dv_12']) ? $_POST['i_dv_12'] : ''; $i_w_12 = isset($_POST['i_w_12']) ? $_POST['i_w_12'] : ''; $i_o_12 = isset($_POST['i_o_12']) ? $_POST['i_o_12'] : '';
         $i_lec_14 = isset($_POST['i_lec_14']) ? $_POST['i_lec_14'] : ''; $i_rtw_14 = isset($_POST['i_rtw_14']) ? $_POST['i_rtw_14'] : ''; $i_fup_14 = isset($_POST['i_fup_14']) ? $_POST['i_fup_14'] : ''; $i_anq_14 = isset($_POST['i_anq_14']) ? $_POST['i_anq_14'] : ''; $i_pq_14 = isset($_POST['i_pq_14']) ? $_POST['i_pq_14'] : ''; $i_mg_14 = isset($_POST['i_mg_14']) ? $_POST['i_mg_14'] : ''; $i_1o1_14 = isset($_POST['i_1o1_14']) ? $_POST['i_1o1_14'] : ''; $i_dv_14 = isset($_POST['i_dv_14']) ? $_POST['i_dv_14'] : ''; $i_w_14 = isset($_POST['i_w_14']) ? $_POST['i_w_14'] : ''; $i_o_14 = isset($_POST['i_o_14']) ? $_POST['i_o_14'] : '';
         $i_lec_16 = isset($_POST['i_lec_16']) ? $_POST['i_lec_16'] : ''; $i_rtw_16 = isset($_POST['i_rtw_16']) ? $_POST['i_rtw_16'] : ''; $i_fup_16 = isset($_POST['i_fup_16']) ? $_POST['i_fup_16'] : ''; $i_anq_16 = isset($_POST['i_anq_16']) ? $_POST['i_anq_16'] : ''; $i_pq_16 = isset($_POST['i_pq_16']) ? $_POST['i_pq_16'] : ''; $i_mg_16 = isset($_POST['i_mg_16']) ? $_POST['i_mg_16'] : ''; $i_1o1_16 = isset($_POST['i_1o1_16']) ? $_POST['i_1o1_16'] : ''; $i_dv_16 = isset($_POST['i_dv_16']) ? $_POST['i_dv_16'] : ''; $i_w_16 = isset($_POST['i_w_16']) ? $_POST['i_w_16'] : ''; $i_o_16 = isset($_POST['i_o_16']) ? $_POST['i_o_16'] : '';
         $i_lec_18 = isset($_POST['i_lec_18']) ? $_POST['i_lec_18'] : ''; $i_rtw_18 = isset($_POST['i_rtw_18']) ? $_POST['i_rtw_18'] : ''; $i_fup_18 = isset($_POST['i_fup_18']) ? $_POST['i_fup_18'] : ''; $i_anq_18 = isset($_POST['i_anq_18']) ? $_POST['i_anq_18'] : ''; $i_pq_18 = isset($_POST['i_pq_18']) ? $_POST['i_pq_18'] : ''; $i_mg_18 = isset($_POST['i_mg_18']) ? $_POST['i_mg_18'] : ''; $i_1o1_18 = isset($_POST['i_1o1_18']) ? $_POST['i_1o1_18'] : ''; $i_dv_18 = isset($_POST['i_dv_18']) ? $_POST['i_dv_18'] : ''; $i_w_18 = isset($_POST['i_w_18']) ? $_POST['i_w_18'] : ''; $i_o_18 = isset($_POST['i_o_18']) ? $_POST['i_o_18'] : '';
         $i_lec_20 = isset($_POST['i_lec_20']) ? $_POST['i_lec_20'] : ''; $i_rtw_20 = isset($_POST['i_rtw_20']) ? $_POST['i_rtw_20'] : ''; $i_fup_20 = isset($_POST['i_fup_20']) ? $_POST['i_fup_20'] : ''; $i_anq_20 = isset($_POST['i_anq_20']) ? $_POST['i_anq_20'] : ''; $i_pq_20 = isset($_POST['i_pq_20']) ? $_POST['i_pq_20'] : ''; $i_mg_20 = isset($_POST['i_mg_20']) ? $_POST['i_mg_20'] : ''; $i_1o1_20 = isset($_POST['i_1o1_20']) ? $_POST['i_1o1_20'] : ''; $i_dv_20 = isset($_POST['i_dv_20']) ? $_POST['i_dv_20'] : ''; $i_w_20 = isset($_POST['i_w_20']) ? $_POST['i_w_20'] : ''; $i_o_20 = isset($_POST['i_o_20']) ? $_POST['i_o_20'] : '';
         $i_lec_22 = isset($_POST['i_lec_22']) ? $_POST['i_lec_22'] : ''; $i_rtw_22 = isset($_POST['i_rtw_22']) ? $_POST['i_rtw_22'] : ''; $i_fup_22 = isset($_POST['i_fup_22']) ? $_POST['i_fup_22'] : ''; $i_anq_22 = isset($_POST['i_anq_22']) ? $_POST['i_anq_22'] : ''; $i_pq_22 = isset($_POST['i_pq_22']) ? $_POST['i_pq_22'] : ''; $i_mg_22 = isset($_POST['i_mg_22']) ? $_POST['i_mg_22'] : ''; $i_1o1_22 = isset($_POST['i_1o1_22']) ? $_POST['i_1o1_22'] : ''; $i_dv_22 = isset($_POST['i_dv_22']) ? $_POST['i_dv_22'] : ''; $i_w_22 = isset($_POST['i_w_22']) ? $_POST['i_w_22'] : ''; $i_o_22 = isset($_POST['i_o_22']) ? $_POST['i_o_22'] : '';
         $i_lec_24 = isset($_POST['i_lec_24']) ? $_POST['i_lec_24'] : ''; $i_rtw_24 = isset($_POST['i_rtw_24']) ? $_POST['i_rtw_24'] : ''; $i_fup_24 = isset($_POST['i_fup_24']) ? $_POST['i_fup_24'] : ''; $i_anq_24 = isset($_POST['i_anq_24']) ? $_POST['i_anq_24'] : ''; $i_pq_24 = isset($_POST['i_pq_24']) ? $_POST['i_pq_24'] : ''; $i_mg_24 = isset($_POST['i_mg_24']) ? $_POST['i_mg_24'] : ''; $i_1o1_24 = isset($_POST['i_1o1_24']) ? $_POST['i_1o1_24'] : ''; $i_dv_24 = isset($_POST['i_dv_24']) ? $_POST['i_dv_24'] : ''; $i_w_24 = isset($_POST['i_w_24']) ? $_POST['i_w_24'] : ''; $i_o_24 = isset($_POST['i_o_24']) ? $_POST['i_o_24'] : '';
         $i_lec_26 = isset($_POST['i_lec_26']) ? $_POST['i_lec_26'] : ''; $i_rtw_26 = isset($_POST['i_rtw_26']) ? $_POST['i_rtw_26'] : ''; $i_fup_26 = isset($_POST['i_fup_26']) ? $_POST['i_fup_26'] : ''; $i_anq_26 = isset($_POST['i_anq_26']) ? $_POST['i_anq_26'] : ''; $i_pq_26 = isset($_POST['i_pq_26']) ? $_POST['i_pq_26'] : ''; $i_mg_26 = isset($_POST['i_mg_26']) ? $_POST['i_mg_26'] : ''; $i_1o1_26 = isset($_POST['i_1o1_26']) ? $_POST['i_1o1_26'] : ''; $i_dv_26 = isset($_POST['i_dv_26']) ? $_POST['i_dv_26'] : ''; $i_w_26 = isset($_POST['i_w_26']) ? $_POST['i_w_26'] : ''; $i_o_26 = isset($_POST['i_o_26']) ? $_POST['i_o_26'] : '';
         $i_lec_28 = isset($_POST['i_lec_28']) ? $_POST['i_lec_28'] : ''; $i_rtw_28 = isset($_POST['i_rtw_28']) ? $_POST['i_rtw_28'] : ''; $i_fup_28 = isset($_POST['i_fup_28']) ? $_POST['i_fup_28'] : ''; $i_anq_28 = isset($_POST['i_anq_28']) ? $_POST['i_anq_28'] : ''; $i_pq_28 = isset($_POST['i_pq_28']) ? $_POST['i_pq_28'] : ''; $i_mg_28 = isset($_POST['i_mg_28']) ? $_POST['i_mg_28'] : ''; $i_1o1_28 = isset($_POST['i_1o1_28']) ? $_POST['i_1o1_28'] : ''; $i_dv_28 = isset($_POST['i_dv_28']) ? $_POST['i_dv_28'] : ''; $i_w_28 = isset($_POST['i_w_28']) ? $_POST['i_w_28'] : ''; $i_o_28 = isset($_POST['i_o_28']) ? $_POST['i_o_28'] : '';
         $i_lec_30 = isset($_POST['i_lec_30']) ? $_POST['i_lec_30'] : ''; $i_rtw_30 = isset($_POST['i_rtw_30']) ? $_POST['i_rtw_30'] : ''; $i_fup_30 = isset($_POST['i_fup_30']) ? $_POST['i_fup_30'] : ''; $i_anq_30 = isset($_POST['i_anq_30']) ? $_POST['i_anq_30'] : ''; $i_pq_30 = isset($_POST['i_pq_30']) ? $_POST['i_pq_30'] : ''; $i_mg_30 = isset($_POST['i_mg_30']) ? $_POST['i_mg_30'] : ''; $i_1o1_30 = isset($_POST['i_1o1_30']) ? $_POST['i_1o1_30'] : ''; $i_dv_30 = isset($_POST['i_dv_30']) ? $_POST['i_dv_30'] : ''; $i_w_30 = isset($_POST['i_w_30']) ? $_POST['i_w_30'] : ''; $i_o_30 = isset($_POST['i_o_30']) ? $_POST['i_o_30'] : '';

         $comments = isset($_POST['comments']) ? $_POST['comments'] : '';

         $selected_instructor = explode(', ', $class_instructor);
         $selected_firstName = $selected_instructor[1];
         $selected_lastName = $selected_instructor[0];

         $select_faculty_id = mysqli_query($conn, "SELECT `id` FROM `faculty` WHERE `first_name` = '$selected_firstName' AND `last_name` = '$selected_lastName'");
         if($fetch_faculty_id = mysqli_fetch_assoc($select_faculty_id)){
            $faculty_ID = $fetch_faculty_id['id'];

            $insert_report_info = mysqli_query($conn, "INSERT INTO `class_report_info` VALUES ('0','$admin_ID', '$faculty_ID', '$class_section','$class_instructor','$class_subject','$class_date','$class_SY','$class_semester','$class_observer_name', TRUE, TRUE)");

            $insert_report_stu = mysqli_query($conn, "INSERT INTO `class_report_stu` VALUES ('0','$admin_ID','$faculty_ID','$s_l_2','$s_ind_2','$s_wg_2','$s_anq_2','$s_sq_2','$s_wc_2','$s_sp_2','$s_tq_2','$s_w_2','$s_o_2','$s_l_4','$s_ind_4','$s_wg_4','$s_anq_4','$s_sq_4','$s_wc_4','$s_sp_4','$s_tq_4','$s_w_4','$s_o_4',
            '$s_l_6','$s_ind_6','$s_wg_6','$s_anq_6','$s_sq_6','$s_wc_6','$s_sp_6','$s_tq_6','$s_w_6','$s_o_6','$s_l_8','$s_ind_8','$s_wg_8','$s_anq_8','$s_sq_8','$s_wc_8','$s_sp_8','$s_tq_8','$s_w_8','$s_o_8','$s_l_10','$s_ind_10','$s_wg_10','$s_anq_10','$s_sq_10','$s_wc_10','$s_sp_10','$s_tq_10','$s_w_10','$s_o_10',
            '$s_l_12','$s_ind_12','$s_wg_12','$s_anq_12','$s_sq_12','$s_wc_12','$s_sp_12','$s_tq_12','$s_w_12','$s_o_12','$s_l_14','$s_ind_14','$s_wg_14','$s_anq_14','$s_sq_14','$s_wc_14','$s_sp_14','$s_tq_14','$s_w_14','$s_o_14','$s_l_16','$s_ind_16','$s_wg_16','$s_anq_16','$s_sq_16','$s_wc_16','$s_sp_16','$s_tq_16',
            '$s_w_16','$s_o_16','$s_l_18','$s_ind_18','$s_wg_18','$s_anq_18','$s_sq_18','$s_wc_18','$s_sp_18','$s_tq_18','$s_w_18','$s_o_18','$s_l_20','$s_ind_20','$s_wg_20','$s_anq_20','$s_sq_20','$s_wc_20','$s_sp_20','$s_tq_20','$s_w_20','$s_o_20','$s_l_22','$s_ind_22','$s_wg_22','$s_anq_22','$s_sq_22','$s_wc_22',
            '$s_sp_22','$s_tq_22','$s_w_22','$s_o_22','$s_l_24','$s_ind_24','$s_wg_24','$s_anq_24','$s_sq_24','$s_wc_24','$s_sp_24','$s_tq_24','$s_w_24','$s_o_24','$s_l_26','$s_ind_26','$s_wg_26','$s_anq_26','$s_sq_26','$s_wc_26','$s_sp_26','$s_tq_26','$s_w_26','$s_o_26','$s_l_28','$s_ind_28','$s_wg_28','$s_anq_28',
            '$s_sq_28','$s_wc_28','$s_sp_28','$s_tq_28','$s_w_28','$s_o_28','$s_l_30','$s_ind_30','$s_wg_30','$s_anq_30','$s_sq_30','$s_wc_30','$s_sp_30','$s_tq_30','$s_w_30','$s_o_30', TRUE, TRUE)");

            $insert_report_ins = mysqli_query($conn, "INSERT INTO `class_report_ins` VALUES ('0','$admin_ID','$faculty_ID','$i_lec_2','$i_rtw_2','$i_fup_2','$i_anq_2','$i_pq_2','$i_mg_2','$i_1o1_2','$i_dv_2','$i_w_2','$i_o_2','$i_lec_4','$i_rtw_4','$i_fup_4','$i_anq_4','$i_pq_4','$i_mg_4','$i_1o1_4','$i_dv_4','$i_w_4',
            '$i_o_4','$i_lec_6','$i_rtw_6','$i_fup_6','$i_anq_6','$i_pq_6','$i_mg_6','$i_1o1_6','$i_dv_6','$i_w_6','$i_o_6','$i_lec_8','$i_rtw_8','$i_fup_8','$i_anq_8','$i_pq_8','$i_mg_8','$i_1o1_8','$i_dv_8','$i_w_8','$i_o_8','$i_lec_10','$i_rtw_10','$i_fup_10','$i_anq_10','$i_pq_10','$i_mg_10','$i_1o1_10','$i_dv_10',
            '$i_w_10','$i_o_10','$i_lec_12','$i_rtw_12','$i_fup_12','$i_anq_12','$i_pq_12','$i_mg_12','$i_1o1_12','$i_dv_12','$i_w_12','$i_o_12','$i_lec_14','$i_rtw_14','$i_fup_14','$i_anq_14','$i_pq_14','$i_mg_14','$i_1o1_14','$i_dv_14','$i_w_14','$i_o_14','$i_lec_16','$i_rtw_16','$i_fup_16','$i_anq_16','$i_pq_16',
            '$i_mg_16','$i_1o1_16','$i_dv_16','$i_w_16','$i_o_16','$i_lec_18','$i_rtw_18','$i_fup_18','$i_anq_18','$i_pq_18','$i_mg_18','$i_1o1_18','$i_dv_18','$i_w_18','$i_o_18','$i_lec_20','$i_rtw_20','$i_fup_20','$i_anq_20','$i_pq_20','$i_mg_20','$i_1o1_20','$i_dv_20','$i_w_20','$i_o_20','$i_lec_22','$i_rtw_22',
            '$i_fup_22','$i_anq_22','$i_pq_22','$i_mg_22','$i_1o1_22','$i_dv_22','$i_w_22','$i_o_22','$i_lec_24','$i_rtw_24','$i_fup_24','$i_anq_24','$i_pq_24','$i_mg_24','$i_1o1_24','$i_dv_24','$i_w_24','$i_o_24','$i_lec_26','$i_rtw_26','$i_fup_26','$i_anq_26','$i_pq_26','$i_mg_26','$i_1o1_26','$i_dv_26','$i_w_26',
            '$i_o_26','$i_lec_28','$i_rtw_28','$i_fup_28','$i_anq_28','$i_pq_28','$i_mg_28','$i_1o1_28','$i_dv_28','$i_w_28','$i_o_28','$i_lec_30','$i_rtw_30','$i_fup_30','$i_anq_30','$i_pq_30','$i_mg_30','$i_1o1_30','$i_dv_30','$i_w_30','$i_o_30', TRUE, TRUE)");

            $insert_report_com = mysqli_query($conn, "INSERT INTO `class_report_com` VALUES ('0','$admin_ID','$faculty_ID','$comments', TRUE, TRUE)");
            
            if($insert_report_info && $insert_report_stu && $insert_report_ins && $insert_report_com){
               $last_id = mysqli_insert_id($conn);

               $_SESSION['success_alert'] = "Report Submitted";
               header("Location: admin/admin_reports_view.php?report_info_id=$last_id&report_stu_id=$last_id&report_ins_id=$last_id&report_com_id=$last_id"); exit;
            }else{
               $_SESSION['danger_alert'] = "Error in submitting";
               header("Location: admin/admin_reports_view.php"); exit;
            }
         }else{
            $_SESSION['danger_alert'] = "Failed to get faculty id";
            header("Location: admin/admin_reports_view.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Error.";
         header("Location: admin/admin_reports_view.php"); exit;
      }
   }

   //THIS IS FOR UPDATE CLASS REPORTS INFO
   if(isset($_POST['update-classInfo'])){
      if(isset($_SESSION['session_admin'])){
         $admin_ID = $_SESSION['session_admin'];

         if(isset($_GET['report_info_id']) && isset($_GET['report_stu_id']) && isset($_GET['report_ins_id']) && isset($_GET['report_com_id'])){
            $info_id = $_GET['report_info_id'];
            $stu_id = $_GET['report_stu_id'];
            $ins_id = $_GET['report_ins_id'];
            $com_id = $_GET['report_com_id'];

            $update_section = mysqli_real_escape_string($conn, $_POST['update-classSection']);

            $update_report_info = mysqli_query($conn, "UPDATE `class_report_info`
            SET `section` = '$update_section' WHERE `admin_id` = '$admin_ID' AND `report_info_id` = '$info_id'");
            if($update_report_info){
               $_SESSION['success_alert'] = "Updated Successfully";
               header("Location: admin/admin_reports_view.php?report_info_id=$info_id&report_stu_id=$stu_id&report_ins_id=$ins_id&report_com_id=$com_id"); exit;
            }else{
               $_SESSION['danger_alert'] = "Error in Updating";
               header("Location: admin/admin_reports_view.php"); exit;
            }
         }else{
            $_SESSION['danger_alert'] = "Error";
            header("Location: admin/admin_reports_view.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Error";
         header("Location: admin/admin_reports_view.php"); exit;
      }
   }

   //THIS IS FOR UPDATE CLASS REPORTS POINTS
   if(isset($_POST['update-classSubmit'])){
      if(isset($_SESSION['session_admin'])){
         $admin_ID = $_SESSION['session_admin'];

         if(isset($_GET['report_info_id']) && isset($_GET['report_stu_id']) && isset($_GET['report_ins_id']) && isset($_GET['report_com_id'])){
            $info_id = $_GET['report_info_id'];
            $stu_id = $_GET['report_stu_id'];
            $ins_id = $_GET['report_ins_id'];
            $com_id = $_GET['report_com_id'];
            
            $pUp_s_l_2 = isset($_POST['up-s_l_2']) ? $_POST['up-s_l_2'] : '';    $pUp_s_ind_2 = isset($_POST['up-s_ind_2']) ? $_POST['up-s_ind_2'] : '';    $pUp_s_wg_2 = isset($_POST['up-s_wg_2']) ? $_POST['up-s_wg_2'] : '';    $pUp_s_anq_2 = isset($_POST['up-s_anq_2']) ? $_POST['up-s_anq_2'] : '';    $pUp_s_sq_2 = isset($_POST['up-s_sq_2']) ? $_POST['up-s_sq_2'] : '';    $pUp_s_wc_2 = isset($_POST['up-s_wc_2']) ? $_POST['up-s_wc_2'] : '';    $pUp_s_sp_2 = isset($_POST['up-s_sp_2']) ? $_POST['up-s_sp_2'] : '';    $pUp_s_tq_2 = isset($_POST['up-s_tq_2']) ? $_POST['up-s_tq_2'] : '';    $pUp_s_w_2 = isset($_POST['up-s_w_2']) ? $_POST['up-s_w_2'] : '';    $pUp_s_o_2 = isset($_POST['up-s_o_2']) ? $_POST['up-s_o_2'] : '';
            $pUp_s_l_4 = isset($_POST['up-s_l_4']) ? $_POST['up-s_l_4'] : '';    $pUp_s_ind_4 = isset($_POST['up-s_ind_4']) ? $_POST['up-s_ind_4'] : '';    $pUp_s_wg_4 = isset($_POST['up-s_wg_4']) ? $_POST['up-s_wg_4'] : '';    $pUp_s_anq_4 = isset($_POST['up-s_anq_4']) ? $_POST['up-s_anq_4'] : '';    $pUp_s_sq_4 = isset($_POST['up-s_sq_4']) ? $_POST['up-s_sq_4'] : '';    $pUp_s_wc_4 = isset($_POST['up-s_wc_4']) ? $_POST['up-s_wc_4'] : '';    $pUp_s_sp_4 = isset($_POST['up-s_sp_4']) ? $_POST['up-s_sp_4'] : '';    $pUp_s_tq_4 = isset($_POST['up-s_tq_4']) ? $_POST['up-s_tq_4'] : '';    $pUp_s_w_4 = isset($_POST['up-s_w_4']) ? $_POST['up-s_w_4'] : '';    $pUp_s_o_4 = isset($_POST['up-s_o_4']) ? $_POST['up-s_o_4'] : '';
            $pUp_s_l_6 = isset($_POST['up-s_l_6']) ? $_POST['up-s_l_6'] : '';    $pUp_s_ind_6 = isset($_POST['up-s_ind_6']) ? $_POST['up-s_ind_6'] : '';    $pUp_s_wg_6 = isset($_POST['up-s_wg_6']) ? $_POST['up-s_wg_6'] : '';    $pUp_s_anq_6 = isset($_POST['up-s_anq_6']) ? $_POST['up-s_anq_6'] : '';    $pUp_s_sq_6 = isset($_POST['up-s_sq_6']) ? $_POST['up-s_sq_6'] : '';    $pUp_s_wc_6 = isset($_POST['up-s_wc_6']) ? $_POST['up-s_wc_6'] : '';    $pUp_s_sp_6 = isset($_POST['up-s_sp_6']) ? $_POST['up-s_sp_6'] : '';    $pUp_s_tq_6 = isset($_POST['up-s_tq_6']) ? $_POST['up-s_tq_6'] : '';    $pUp_s_w_6 = isset($_POST['up-s_w_6']) ? $_POST['up-s_w_6'] : '';    $pUp_s_o_6 = isset($_POST['up-s_o_6']) ? $_POST['up-s_o_6'] : '';
            $pUp_s_l_8 = isset($_POST['up-s_l_8']) ? $_POST['up-s_l_8'] : '';    $pUp_s_ind_8 = isset($_POST['up-s_ind_8']) ? $_POST['up-s_ind_8'] : '';    $pUp_s_wg_8 = isset($_POST['up-s_wg_8']) ? $_POST['up-s_wg_8'] : '';    $pUp_s_anq_8 = isset($_POST['up-s_anq_8']) ? $_POST['up-s_anq_8'] : '';    $pUp_s_sq_8 = isset($_POST['up-s_sq_8']) ? $_POST['up-s_sq_8'] : '';    $pUp_s_wc_8 = isset($_POST['up-s_wc_8']) ? $_POST['up-s_wc_8'] : '';    $pUp_s_sp_8 = isset($_POST['up-s_sp_8']) ? $_POST['up-s_sp_8'] : '';    $pUp_s_tq_8 = isset($_POST['up-s_tq_8']) ? $_POST['up-s_tq_8'] : '';    $pUp_s_w_8 = isset($_POST['up-s_w_8']) ? $_POST['up-s_w_8'] : '';    $pUp_s_o_8 = isset($_POST['up-s_o_8']) ? $_POST['up-s_o_8'] : '';
            $pUp_s_l_10 = isset($_POST['up-s_l_10']) ? $_POST['up-s_l_10'] : ''; $pUp_s_ind_10 = isset($_POST['up-s_ind_10']) ? $_POST['up-s_ind_10'] : ''; $pUp_s_wg_10 = isset($_POST['up-s_wg_10']) ? $_POST['up-s_wg_10'] : ''; $pUp_s_anq_10 = isset($_POST['up-s_anq_10']) ? $_POST['up-s_anq_10'] : ''; $pUp_s_sq_10 = isset($_POST['up-s_sq_10']) ? $_POST['up-s_sq_10'] : ''; $pUp_s_wc_10 = isset($_POST['up-s_wc_10']) ? $_POST['up-s_wc_10'] : ''; $pUp_s_sp_10 = isset($_POST['up-s_sp_10']) ? $_POST['up-s_sp_10'] : ''; $pUp_s_tq_10 = isset($_POST['up-s_tq_10']) ? $_POST['up-s_tq_10'] : ''; $pUp_s_w_10 = isset($_POST['up-s_w_10']) ? $_POST['up-s_w_10'] : ''; $pUp_s_o_10 = isset($_POST['up-s_o_10']) ? $_POST['up-s_o_10'] : '';
            $pUp_s_l_12 = isset($_POST['up-s_l_12']) ? $_POST['up-s_l_12'] : ''; $pUp_s_ind_12 = isset($_POST['up-s_ind_12']) ? $_POST['up-s_ind_12'] : ''; $pUp_s_wg_12 = isset($_POST['up-s_wg_12']) ? $_POST['up-s_wg_12'] : ''; $pUp_s_anq_12 = isset($_POST['up-s_anq_12']) ? $_POST['up-s_anq_12'] : ''; $pUp_s_sq_12 = isset($_POST['up-s_sq_12']) ? $_POST['up-s_sq_12'] : ''; $pUp_s_wc_12 = isset($_POST['up-s_wc_12']) ? $_POST['up-s_wc_12'] : ''; $pUp_s_sp_12 = isset($_POST['up-s_sp_12']) ? $_POST['up-s_sp_12'] : ''; $pUp_s_tq_12 = isset($_POST['up-s_tq_12']) ? $_POST['up-s_tq_12'] : ''; $pUp_s_w_12 = isset($_POST['up-s_w_12']) ? $_POST['up-s_w_12'] : ''; $pUp_s_o_12 = isset($_POST['up-s_o_12']) ? $_POST['up-s_o_12'] : '';
            $pUp_s_l_14 = isset($_POST['up-s_l_14']) ? $_POST['up-s_l_14'] : ''; $pUp_s_ind_14 = isset($_POST['up-s_ind_14']) ? $_POST['up-s_ind_14'] : ''; $pUp_s_wg_14 = isset($_POST['up-s_wg_14']) ? $_POST['up-s_wg_14'] : ''; $pUp_s_anq_14 = isset($_POST['up-s_anq_14']) ? $_POST['up-s_anq_14'] : ''; $pUp_s_sq_14 = isset($_POST['up-s_sq_14']) ? $_POST['up-s_sq_14'] : ''; $pUp_s_wc_14 = isset($_POST['up-s_wc_14']) ? $_POST['up-s_wc_14'] : ''; $pUp_s_sp_14 = isset($_POST['up-s_sp_14']) ? $_POST['up-s_sp_14'] : ''; $pUp_s_tq_14 = isset($_POST['up-s_tq_14']) ? $_POST['up-s_tq_14'] : ''; $pUp_s_w_14 = isset($_POST['up-s_w_14']) ? $_POST['up-s_w_14'] : ''; $pUp_s_o_14 = isset($_POST['up-s_o_14']) ? $_POST['up-s_o_14'] : '';
            $pUp_s_l_16 = isset($_POST['up-s_l_16']) ? $_POST['up-s_l_16'] : ''; $pUp_s_ind_16 = isset($_POST['up-s_ind_16']) ? $_POST['up-s_ind_16'] : ''; $pUp_s_wg_16 = isset($_POST['up-s_wg_16']) ? $_POST['up-s_wg_16'] : ''; $pUp_s_anq_16 = isset($_POST['up-s_anq_16']) ? $_POST['up-s_anq_16'] : ''; $pUp_s_sq_16 = isset($_POST['up-s_sq_16']) ? $_POST['up-s_sq_16'] : ''; $pUp_s_wc_16 = isset($_POST['up-s_wc_16']) ? $_POST['up-s_wc_16'] : ''; $pUp_s_sp_16 = isset($_POST['up-s_sp_16']) ? $_POST['up-s_sp_16'] : ''; $pUp_s_tq_16 = isset($_POST['up-s_tq_16']) ? $_POST['up-s_tq_16'] : ''; $pUp_s_w_16 = isset($_POST['up-s_w_16']) ? $_POST['up-s_w_16'] : ''; $pUp_s_o_16 = isset($_POST['up-s_o_16']) ? $_POST['up-s_o_16'] : '';
            $pUp_s_l_18 = isset($_POST['up-s_l_18']) ? $_POST['up-s_l_18'] : ''; $pUp_s_ind_18 = isset($_POST['up-s_ind_18']) ? $_POST['up-s_ind_18'] : ''; $pUp_s_wg_18 = isset($_POST['up-s_wg_18']) ? $_POST['up-s_wg_18'] : ''; $pUp_s_anq_18 = isset($_POST['up-s_anq_18']) ? $_POST['up-s_anq_18'] : ''; $pUp_s_sq_18 = isset($_POST['up-s_sq_18']) ? $_POST['up-s_sq_18'] : ''; $pUp_s_wc_18 = isset($_POST['up-s_wc_18']) ? $_POST['up-s_wc_18'] : ''; $pUp_s_sp_18 = isset($_POST['up-s_sp_18']) ? $_POST['up-s_sp_18'] : ''; $pUp_s_tq_18 = isset($_POST['up-s_tq_18']) ? $_POST['up-s_tq_18'] : ''; $pUp_s_w_18 = isset($_POST['up-s_w_18']) ? $_POST['up-s_w_18'] : ''; $pUp_s_o_18 = isset($_POST['up-s_o_18']) ? $_POST['up-s_o_18'] : '';
            $pUp_s_l_20 = isset($_POST['up-s_l_20']) ? $_POST['up-s_l_20'] : ''; $pUp_s_ind_20 = isset($_POST['up-s_ind_20']) ? $_POST['up-s_ind_20'] : ''; $pUp_s_wg_20 = isset($_POST['up-s_wg_20']) ? $_POST['up-s_wg_20'] : ''; $pUp_s_anq_20 = isset($_POST['up-s_anq_20']) ? $_POST['up-s_anq_20'] : ''; $pUp_s_sq_20 = isset($_POST['up-s_sq_20']) ? $_POST['up-s_sq_20'] : ''; $pUp_s_wc_20 = isset($_POST['up-s_wc_20']) ? $_POST['up-s_wc_20'] : ''; $pUp_s_sp_20 = isset($_POST['up-s_sp_20']) ? $_POST['up-s_sp_20'] : ''; $pUp_s_tq_20 = isset($_POST['up-s_tq_20']) ? $_POST['up-s_tq_20'] : ''; $pUp_s_w_20 = isset($_POST['up-s_w_20']) ? $_POST['up-s_w_20'] : ''; $pUp_s_o_20 = isset($_POST['up-s_o_20']) ? $_POST['up-s_o_20'] : '';
            $pUp_s_l_22 = isset($_POST['up-s_l_22']) ? $_POST['up-s_l_22'] : ''; $pUp_s_ind_22 = isset($_POST['up-s_ind_22']) ? $_POST['up-s_ind_22'] : ''; $pUp_s_wg_22 = isset($_POST['up-s_wg_22']) ? $_POST['up-s_wg_22'] : ''; $pUp_s_anq_22 = isset($_POST['up-s_anq_22']) ? $_POST['up-s_anq_22'] : ''; $pUp_s_sq_22 = isset($_POST['up-s_sq_22']) ? $_POST['up-s_sq_22'] : ''; $pUp_s_wc_22 = isset($_POST['up-s_wc_22']) ? $_POST['up-s_wc_22'] : ''; $pUp_s_sp_22 = isset($_POST['up-s_sp_22']) ? $_POST['up-s_sp_22'] : ''; $pUp_s_tq_22 = isset($_POST['up-s_tq_22']) ? $_POST['up-s_tq_22'] : ''; $pUp_s_w_22 = isset($_POST['up-s_w_22']) ? $_POST['up-s_w_22'] : ''; $pUp_s_o_22 = isset($_POST['up-s_o_22']) ? $_POST['up-s_o_22'] : '';
            $pUp_s_l_24 = isset($_POST['up-s_l_24']) ? $_POST['up-s_l_24'] : ''; $pUp_s_ind_24 = isset($_POST['up-s_ind_24']) ? $_POST['up-s_ind_24'] : ''; $pUp_s_wg_24 = isset($_POST['up-s_wg_24']) ? $_POST['up-s_wg_24'] : ''; $pUp_s_anq_24 = isset($_POST['up-s_anq_24']) ? $_POST['up-s_anq_24'] : ''; $pUp_s_sq_24 = isset($_POST['up-s_sq_24']) ? $_POST['up-s_sq_24'] : ''; $pUp_s_wc_24 = isset($_POST['up-s_wc_24']) ? $_POST['up-s_wc_24'] : ''; $pUp_s_sp_24 = isset($_POST['up-s_sp_24']) ? $_POST['up-s_sp_24'] : ''; $pUp_s_tq_24 = isset($_POST['up-s_tq_24']) ? $_POST['up-s_tq_24'] : ''; $pUp_s_w_24 = isset($_POST['up-s_w_24']) ? $_POST['up-s_w_24'] : ''; $pUp_s_o_24 = isset($_POST['up-s_o_24']) ? $_POST['up-s_o_24'] : '';
            $pUp_s_l_26 = isset($_POST['up-s_l_26']) ? $_POST['up-s_l_26'] : ''; $pUp_s_ind_26 = isset($_POST['up-s_ind_26']) ? $_POST['up-s_ind_26'] : ''; $pUp_s_wg_26 = isset($_POST['up-s_wg_26']) ? $_POST['up-s_wg_26'] : ''; $pUp_s_anq_26 = isset($_POST['up-s_anq_26']) ? $_POST['up-s_anq_26'] : ''; $pUp_s_sq_26 = isset($_POST['up-s_sq_26']) ? $_POST['up-s_sq_26'] : ''; $pUp_s_wc_26 = isset($_POST['up-s_wc_26']) ? $_POST['up-s_wc_26'] : ''; $pUp_s_sp_26 = isset($_POST['up-s_sp_26']) ? $_POST['up-s_sp_26'] : ''; $pUp_s_tq_26 = isset($_POST['up-s_tq_26']) ? $_POST['up-s_tq_26'] : ''; $pUp_s_w_26 = isset($_POST['up-s_w_26']) ? $_POST['up-s_w_26'] : ''; $pUp_s_o_26 = isset($_POST['up-s_o_26']) ? $_POST['up-s_o_26'] : '';
            $pUp_s_l_28 = isset($_POST['up-s_l_28']) ? $_POST['up-s_l_28'] : ''; $pUp_s_ind_28 = isset($_POST['up-s_ind_28']) ? $_POST['up-s_ind_28'] : ''; $pUp_s_wg_28 = isset($_POST['up-s_wg_28']) ? $_POST['up-s_wg_28'] : ''; $pUp_s_anq_28 = isset($_POST['up-s_anq_28']) ? $_POST['up-s_anq_28'] : ''; $pUp_s_sq_28 = isset($_POST['up-s_sq_28']) ? $_POST['up-s_sq_28'] : ''; $pUp_s_wc_28 = isset($_POST['up-s_wc_28']) ? $_POST['up-s_wc_28'] : ''; $pUp_s_sp_28 = isset($_POST['up-s_sp_28']) ? $_POST['up-s_sp_28'] : ''; $pUp_s_tq_28 = isset($_POST['up-s_tq_28']) ? $_POST['up-s_tq_28'] : ''; $pUp_s_w_28 = isset($_POST['up-s_w_28']) ? $_POST['up-s_w_28'] : ''; $pUp_s_o_28 = isset($_POST['up-s_o_28']) ? $_POST['up-s_o_28'] : '';
            $pUp_s_l_30 = isset($_POST['up-s_l_30']) ? $_POST['up-s_l_30'] : ''; $pUp_s_ind_30 = isset($_POST['up-s_ind_30']) ? $_POST['up-s_ind_30'] : ''; $pUp_s_wg_30 = isset($_POST['up-s_wg_30']) ? $_POST['up-s_wg_30'] : ''; $pUp_s_anq_30 = isset($_POST['up-s_anq_30']) ? $_POST['up-s_anq_30'] : ''; $pUp_s_sq_30 = isset($_POST['up-s_sq_30']) ? $_POST['up-s_sq_30'] : ''; $pUp_s_wc_30 = isset($_POST['up-s_wc_30']) ? $_POST['up-s_wc_30'] : ''; $pUp_s_sp_30 = isset($_POST['up-s_sp_30']) ? $_POST['up-s_sp_30'] : ''; $pUp_s_tq_30 = isset($_POST['up-s_tq_30']) ? $_POST['up-s_tq_30'] : ''; $pUp_s_w_30 = isset($_POST['up-s_w_30']) ? $_POST['up-s_w_30'] : ''; $pUp_s_o_30 = isset($_POST['up-s_o_30']) ? $_POST['up-s_o_30'] : '';

            $pUp_i_lec_2 = isset($_POST['up-i_lec_2']) ? $_POST['up-i_lec_2'] : '';    $pUp_i_rtw_2 = isset($_POST['up-i_rtw_2']) ? $_POST['up-i_rtw_2'] : '';    $pUp_i_fup_2 = isset($_POST['up-i_fup_2']) ? $_POST['up-i_fup_2'] : '';    $pUp_i_anq_2 = isset($_POST['up-i_anq_2']) ? $_POST['up-i_anq_2'] : '';    $pUp_i_pq_2 = isset($_POST['up-i_pq_2']) ? $_POST['up-i_pq_2'] : '';    $pUp_i_mg_2 = isset($_POST['up-i_mg_2']) ? $_POST['up-i_mg_2'] : '';    $pUp_i_1o1_2 = isset($_POST['up-i_1o1_2']) ? $_POST['up-i_1o1_2'] : '';    $pUp_i_dv_2 = isset($_POST['up-i_dv_2']) ? $_POST['up-i_dv_2'] : '';    $pUp_i_w_2 = isset($_POST['up-i_w_2']) ? $_POST['up-i_w_2'] : '';    $pUp_i_o_2 = isset($_POST['up-i_o_2']) ? $_POST['up-i_o_2'] : '';
            $pUp_i_lec_4 = isset($_POST['up-i_lec_4']) ? $_POST['up-i_lec_4'] : '';    $pUp_i_rtw_4 = isset($_POST['up-i_rtw_4']) ? $_POST['up-i_rtw_4'] : '';    $pUp_i_fup_4 = isset($_POST['up-i_fup_4']) ? $_POST['up-i_fup_4'] : '';    $pUp_i_anq_4 = isset($_POST['up-i_anq_4']) ? $_POST['up-i_anq_4'] : '';    $pUp_i_pq_4 = isset($_POST['up-i_pq_4']) ? $_POST['up-i_pq_4'] : '';    $pUp_i_mg_4 = isset($_POST['up-i_mg_4']) ? $_POST['up-i_mg_4'] : '';    $pUp_i_1o1_4 = isset($_POST['up-i_1o1_4']) ? $_POST['up-i_1o1_4'] : '';    $pUp_i_dv_4 = isset($_POST['up-i_dv_4']) ? $_POST['up-i_dv_4'] : '';    $pUp_i_w_4 = isset($_POST['up-i_w_4']) ? $_POST['up-i_w_4'] : '';    $pUp_i_o_4 = isset($_POST['up-i_o_4']) ? $_POST['up-i_o_4'] : '';
            $pUp_i_lec_6 = isset($_POST['up-i_lec_6']) ? $_POST['up-i_lec_6'] : '';    $pUp_i_rtw_6 = isset($_POST['up-i_rtw_6']) ? $_POST['up-i_rtw_6'] : '';    $pUp_i_fup_6 = isset($_POST['up-i_fup_6']) ? $_POST['up-i_fup_6'] : '';    $pUp_i_anq_6 = isset($_POST['up-i_anq_6']) ? $_POST['up-i_anq_6'] : '';    $pUp_i_pq_6 = isset($_POST['up-i_pq_6']) ? $_POST['up-i_pq_6'] : '';    $pUp_i_mg_6 = isset($_POST['up-i_mg_6']) ? $_POST['up-i_mg_6'] : '';    $pUp_i_1o1_6 = isset($_POST['up-i_1o1_6']) ? $_POST['up-i_1o1_6'] : '';    $pUp_i_dv_6 = isset($_POST['up-i_dv_6']) ? $_POST['up-i_dv_6'] : '';    $pUp_i_w_6 = isset($_POST['up-i_w_6']) ? $_POST['up-i_w_6'] : '';    $pUp_i_o_6 = isset($_POST['up-i_o_6']) ? $_POST['up-i_o_6'] : '';
            $pUp_i_lec_8 = isset($_POST['up-i_lec_8']) ? $_POST['up-i_lec_8'] : '';    $pUp_i_rtw_8 = isset($_POST['up-i_rtw_8']) ? $_POST['up-i_rtw_8'] : '';    $pUp_i_fup_8 = isset($_POST['up-i_fup_8']) ? $_POST['up-i_fup_8'] : '';    $pUp_i_anq_8 = isset($_POST['up-i_anq_8']) ? $_POST['up-i_anq_8'] : '';    $pUp_i_pq_8 = isset($_POST['up-i_pq_8']) ? $_POST['up-i_pq_8'] : '';    $pUp_i_mg_8 = isset($_POST['up-i_mg_8']) ? $_POST['up-i_mg_8'] : '';    $pUp_i_1o1_8 = isset($_POST['up-i_1o1_8']) ? $_POST['up-i_1o1_8'] : '';    $pUp_i_dv_8 = isset($_POST['up-i_dv_8']) ? $_POST['up-i_dv_8'] : '';    $pUp_i_w_8 = isset($_POST['up-i_w_8']) ? $_POST['up-i_w_8'] : '';    $pUp_i_o_8 = isset($_POST['up-i_o_8']) ? $_POST['up-i_o_8'] : '';
            $pUp_i_lec_10 = isset($_POST['up-i_lec_10']) ? $_POST['up-i_lec_10'] : ''; $pUp_i_rtw_10 = isset($_POST['up-i_rtw_10']) ? $_POST['up-i_rtw_10'] : ''; $pUp_i_fup_10 = isset($_POST['up-i_fup_10']) ? $_POST['up-i_fup_10'] : ''; $pUp_i_anq_10 = isset($_POST['up-i_anq_10']) ? $_POST['up-i_anq_10'] : ''; $pUp_i_pq_10 = isset($_POST['up-i_pq_10']) ? $_POST['up-i_pq_10'] : ''; $pUp_i_mg_10 = isset($_POST['up-i_mg_10']) ? $_POST['up-i_mg_10'] : ''; $pUp_i_1o1_10 = isset($_POST['up-i_1o1_10']) ? $_POST['up-i_1o1_10'] : ''; $pUp_i_dv_10 = isset($_POST['up-i_dv_10']) ? $_POST['up-i_dv_10'] : ''; $pUp_i_w_10 = isset($_POST['up-i_w_10']) ? $_POST['up-i_w_10'] : ''; $pUp_i_o_10 = isset($_POST['up-i_o_10']) ? $_POST['up-i_o_10'] : '';
            $pUp_i_lec_12 = isset($_POST['up-i_lec_12']) ? $_POST['up-i_lec_12'] : ''; $pUp_i_rtw_12 = isset($_POST['up-i_rtw_12']) ? $_POST['up-i_rtw_12'] : ''; $pUp_i_fup_12 = isset($_POST['up-i_fup_12']) ? $_POST['up-i_fup_12'] : ''; $pUp_i_anq_12 = isset($_POST['up-i_anq_12']) ? $_POST['up-i_anq_12'] : ''; $pUp_i_pq_12 = isset($_POST['up-i_pq_12']) ? $_POST['up-i_pq_12'] : ''; $pUp_i_mg_12 = isset($_POST['up-i_mg_12']) ? $_POST['up-i_mg_12'] : ''; $pUp_i_1o1_12 = isset($_POST['up-i_1o1_12']) ? $_POST['up-i_1o1_12'] : ''; $pUp_i_dv_12 = isset($_POST['up-i_dv_12']) ? $_POST['up-i_dv_12'] : ''; $pUp_i_w_12 = isset($_POST['up-i_w_12']) ? $_POST['up-i_w_12'] : ''; $pUp_i_o_12 = isset($_POST['up-i_o_12']) ? $_POST['up-i_o_12'] : '';
            $pUp_i_lec_14 = isset($_POST['up-i_lec_14']) ? $_POST['up-i_lec_14'] : ''; $pUp_i_rtw_14 = isset($_POST['up-i_rtw_14']) ? $_POST['up-i_rtw_14'] : ''; $pUp_i_fup_14 = isset($_POST['up-i_fup_14']) ? $_POST['up-i_fup_14'] : ''; $pUp_i_anq_14 = isset($_POST['up-i_anq_14']) ? $_POST['up-i_anq_14'] : ''; $pUp_i_pq_14 = isset($_POST['up-i_pq_14']) ? $_POST['up-i_pq_14'] : ''; $pUp_i_mg_14 = isset($_POST['up-i_mg_14']) ? $_POST['up-i_mg_14'] : ''; $pUp_i_1o1_14 = isset($_POST['up-i_1o1_14']) ? $_POST['up-i_1o1_14'] : ''; $pUp_i_dv_14 = isset($_POST['up-i_dv_14']) ? $_POST['up-i_dv_14'] : ''; $pUp_i_w_14 = isset($_POST['up-i_w_14']) ? $_POST['up-i_w_14'] : ''; $pUp_i_o_14 = isset($_POST['up-i_o_14']) ? $_POST['up-i_o_14'] : '';
            $pUp_i_lec_16 = isset($_POST['up-i_lec_16']) ? $_POST['up-i_lec_16'] : ''; $pUp_i_rtw_16 = isset($_POST['up-i_rtw_16']) ? $_POST['up-i_rtw_16'] : ''; $pUp_i_fup_16 = isset($_POST['up-i_fup_16']) ? $_POST['up-i_fup_16'] : ''; $pUp_i_anq_16 = isset($_POST['up-i_anq_16']) ? $_POST['up-i_anq_16'] : ''; $pUp_i_pq_16 = isset($_POST['up-i_pq_16']) ? $_POST['up-i_pq_16'] : ''; $pUp_i_mg_16 = isset($_POST['up-i_mg_16']) ? $_POST['up-i_mg_16'] : ''; $pUp_i_1o1_16 = isset($_POST['up-i_1o1_16']) ? $_POST['up-i_1o1_16'] : ''; $pUp_i_dv_16 = isset($_POST['up-i_dv_16']) ? $_POST['up-i_dv_16'] : ''; $pUp_i_w_16 = isset($_POST['up-i_w_16']) ? $_POST['up-i_w_16'] : ''; $pUp_i_o_16 = isset($_POST['up-i_o_16']) ? $_POST['up-i_o_16'] : '';
            $pUp_i_lec_18 = isset($_POST['up-i_lec_18']) ? $_POST['up-i_lec_18'] : ''; $pUp_i_rtw_18 = isset($_POST['up-i_rtw_18']) ? $_POST['up-i_rtw_18'] : ''; $pUp_i_fup_18 = isset($_POST['up-i_fup_18']) ? $_POST['up-i_fup_18'] : ''; $pUp_i_anq_18 = isset($_POST['up-i_anq_18']) ? $_POST['up-i_anq_18'] : ''; $pUp_i_pq_18 = isset($_POST['up-i_pq_18']) ? $_POST['up-i_pq_18'] : ''; $pUp_i_mg_18 = isset($_POST['up-i_mg_18']) ? $_POST['up-i_mg_18'] : ''; $pUp_i_1o1_18 = isset($_POST['up-i_1o1_18']) ? $_POST['up-i_1o1_18'] : ''; $pUp_i_dv_18 = isset($_POST['up-i_dv_18']) ? $_POST['up-i_dv_18'] : ''; $pUp_i_w_18 = isset($_POST['up-i_w_18']) ? $_POST['up-i_w_18'] : ''; $pUp_i_o_18 = isset($_POST['up-i_o_18']) ? $_POST['up-i_o_18'] : '';
            $pUp_i_lec_20 = isset($_POST['up-i_lec_20']) ? $_POST['up-i_lec_20'] : ''; $pUp_i_rtw_20 = isset($_POST['up-i_rtw_20']) ? $_POST['up-i_rtw_20'] : ''; $pUp_i_fup_20 = isset($_POST['up-i_fup_20']) ? $_POST['up-i_fup_20'] : ''; $pUp_i_anq_20 = isset($_POST['up-i_anq_20']) ? $_POST['up-i_anq_20'] : ''; $pUp_i_pq_20 = isset($_POST['up-i_pq_20']) ? $_POST['up-i_pq_20'] : ''; $pUp_i_mg_20 = isset($_POST['up-i_mg_20']) ? $_POST['up-i_mg_20'] : ''; $pUp_i_1o1_20 = isset($_POST['up-i_1o1_20']) ? $_POST['up-i_1o1_20'] : ''; $pUp_i_dv_20 = isset($_POST['up-i_dv_20']) ? $_POST['up-i_dv_20'] : ''; $pUp_i_w_20 = isset($_POST['up-i_w_20']) ? $_POST['up-i_w_20'] : ''; $pUp_i_o_20 = isset($_POST['up-i_o_20']) ? $_POST['up-i_o_20'] : '';
            $pUp_i_lec_22 = isset($_POST['up-i_lec_22']) ? $_POST['up-i_lec_22'] : ''; $pUp_i_rtw_22 = isset($_POST['up-i_rtw_22']) ? $_POST['up-i_rtw_22'] : ''; $pUp_i_fup_22 = isset($_POST['up-i_fup_22']) ? $_POST['up-i_fup_22'] : ''; $pUp_i_anq_22 = isset($_POST['up-i_anq_22']) ? $_POST['up-i_anq_22'] : ''; $pUp_i_pq_22 = isset($_POST['up-i_pq_22']) ? $_POST['up-i_pq_22'] : ''; $pUp_i_mg_22 = isset($_POST['up-i_mg_22']) ? $_POST['up-i_mg_22'] : ''; $pUp_i_1o1_22 = isset($_POST['up-i_1o1_22']) ? $_POST['up-i_1o1_22'] : ''; $pUp_i_dv_22 = isset($_POST['up-i_dv_22']) ? $_POST['up-i_dv_22'] : ''; $pUp_i_w_22 = isset($_POST['up-i_w_22']) ? $_POST['up-i_w_22'] : ''; $pUp_i_o_22 = isset($_POST['up-i_o_22']) ? $_POST['up-i_o_22'] : '';
            $pUp_i_lec_24 = isset($_POST['up-i_lec_24']) ? $_POST['up-i_lec_24'] : ''; $pUp_i_rtw_24 = isset($_POST['up-i_rtw_24']) ? $_POST['up-i_rtw_24'] : ''; $pUp_i_fup_24 = isset($_POST['up-i_fup_24']) ? $_POST['up-i_fup_24'] : ''; $pUp_i_anq_24 = isset($_POST['up-i_anq_24']) ? $_POST['up-i_anq_24'] : ''; $pUp_i_pq_24 = isset($_POST['up-i_pq_24']) ? $_POST['up-i_pq_24'] : ''; $pUp_i_mg_24 = isset($_POST['up-i_mg_24']) ? $_POST['up-i_mg_24'] : ''; $pUp_i_1o1_24 = isset($_POST['up-i_1o1_24']) ? $_POST['up-i_1o1_24'] : ''; $pUp_i_dv_24 = isset($_POST['up-i_dv_24']) ? $_POST['up-i_dv_24'] : ''; $pUp_i_w_24 = isset($_POST['up-i_w_24']) ? $_POST['up-i_w_24'] : ''; $pUp_i_o_24 = isset($_POST['up-i_o_24']) ? $_POST['up-i_o_24'] : '';
            $pUp_i_lec_26 = isset($_POST['up-i_lec_26']) ? $_POST['up-i_lec_26'] : ''; $pUp_i_rtw_26 = isset($_POST['up-i_rtw_26']) ? $_POST['up-i_rtw_26'] : ''; $pUp_i_fup_26 = isset($_POST['up-i_fup_26']) ? $_POST['up-i_fup_26'] : ''; $pUp_i_anq_26 = isset($_POST['up-i_anq_26']) ? $_POST['up-i_anq_26'] : ''; $pUp_i_pq_26 = isset($_POST['up-i_pq_26']) ? $_POST['up-i_pq_26'] : ''; $pUp_i_mg_26 = isset($_POST['up-i_mg_26']) ? $_POST['up-i_mg_26'] : ''; $pUp_i_1o1_26 = isset($_POST['up-i_1o1_26']) ? $_POST['up-i_1o1_26'] : ''; $pUp_i_dv_26 = isset($_POST['up-i_dv_26']) ? $_POST['up-i_dv_26'] : ''; $pUp_i_w_26 = isset($_POST['up-i_w_26']) ? $_POST['up-i_w_26'] : ''; $pUp_i_o_26 = isset($_POST['up-i_o_26']) ? $_POST['up-i_o_26'] : '';
            $pUp_i_lec_28 = isset($_POST['up-i_lec_28']) ? $_POST['up-i_lec_28'] : ''; $pUp_i_rtw_28 = isset($_POST['up-i_rtw_28']) ? $_POST['up-i_rtw_28'] : ''; $pUp_i_fup_28 = isset($_POST['up-i_fup_28']) ? $_POST['up-i_fup_28'] : ''; $pUp_i_anq_28 = isset($_POST['up-i_anq_28']) ? $_POST['up-i_anq_28'] : ''; $pUp_i_pq_28 = isset($_POST['up-i_pq_28']) ? $_POST['up-i_pq_28'] : ''; $pUp_i_mg_28 = isset($_POST['up-i_mg_28']) ? $_POST['up-i_mg_28'] : ''; $pUp_i_1o1_28 = isset($_POST['up-i_1o1_28']) ? $_POST['up-i_1o1_28'] : ''; $pUp_i_dv_28 = isset($_POST['up-i_dv_28']) ? $_POST['up-i_dv_28'] : ''; $pUp_i_w_28 = isset($_POST['up-i_w_28']) ? $_POST['up-i_w_28'] : ''; $pUp_i_o_28 = isset($_POST['up-i_o_28']) ? $_POST['up-i_o_28'] : '';
            $pUp_i_lec_30 = isset($_POST['up-i_lec_30']) ? $_POST['up-i_lec_30'] : ''; $pUp_i_rtw_30 = isset($_POST['up-i_rtw_30']) ? $_POST['up-i_rtw_30'] : ''; $pUp_i_fup_30 = isset($_POST['up-i_fup_30']) ? $_POST['up-i_fup_30'] : ''; $pUp_i_anq_30 = isset($_POST['up-i_anq_30']) ? $_POST['up-i_anq_30'] : ''; $pUp_i_pq_30 = isset($_POST['up-i_pq_30']) ? $_POST['up-i_pq_30'] : ''; $pUp_i_mg_30 = isset($_POST['up-i_mg_30']) ? $_POST['up-i_mg_30'] : ''; $pUp_i_1o1_30 = isset($_POST['up-i_1o1_30']) ? $_POST['up-i_1o1_30'] : ''; $pUp_i_dv_30 = isset($_POST['up-i_dv_30']) ? $_POST['up-i_dv_30'] : ''; $pUp_i_w_30 = isset($_POST['up-i_w_30']) ? $_POST['up-i_w_30'] : ''; $pUp_i_o_30 = isset($_POST['up-i_o_30']) ? $_POST['up-i_o_30'] : '';

            $up_comments = isset($_POST['up-comments']) ? $_POST['up-comments'] : '';

            $update_stu_report = mysqli_query($conn, "UPDATE `class_report_stu` SET 
            `s_l_2` = '$pUp_s_l_2', `s_ind_2` = '$pUp_s_ind_2', `s_wg_2` = '$pUp_s_wg_2', `s_anq_2` = '$pUp_s_anq_2', `s_sq_2` = '$pUp_s_sq_2', `s_wc_2` = '$pUp_s_wc_2', `s_sp_2` = '$pUp_s_sp_2', `s_tq_2` = '$pUp_s_tq_2', `s_w_2` = '$pUp_s_w_2', `s_o_2` = '$pUp_s_o_2',
            `s_l_4` = '$pUp_s_l_4', `s_ind_4` = '$pUp_s_ind_4', `s_wg_4` = '$pUp_s_wg_4', `s_anq_4` = '$pUp_s_anq_4', `s_sq_4` = '$pUp_s_sq_4', `s_wc_4` = '$pUp_s_wc_4', `s_sp_4` = '$pUp_s_sp_4', `s_tq_4` = '$pUp_s_tq_4', `s_w_4` = '$pUp_s_w_4', `s_o_4` = '$pUp_s_o_4',
            `s_l_6` = '$pUp_s_l_6', `s_ind_6` = '$pUp_s_ind_6', `s_wg_6` = '$pUp_s_wg_6', `s_anq_6` = '$pUp_s_anq_6', `s_sq_6` = '$pUp_s_sq_6', `s_wc_6` = '$pUp_s_wc_6', `s_sp_6` = '$pUp_s_sp_6', `s_tq_6` = '$pUp_s_tq_6', `s_w_6` = '$pUp_s_w_6', `s_o_6` = '$pUp_s_o_6',
            `s_l_8` = '$pUp_s_l_8', `s_ind_8` = '$pUp_s_ind_8', `s_wg_8` = '$pUp_s_wg_8', `s_anq_8` = '$pUp_s_anq_8', `s_sq_8` = '$pUp_s_sq_8', `s_wc_8` = '$pUp_s_wc_8', `s_sp_8` = '$pUp_s_sp_8', `s_tq_8` = '$pUp_s_tq_8', `s_w_8` = '$pUp_s_w_8', `s_o_8` = '$pUp_s_o_8',
            `s_l_10` = '$pUp_s_l_10', `s_ind_10` = '$pUp_s_ind_10', `s_wg_10` = '$pUp_s_wg_10', `s_anq_10` = '$pUp_s_anq_10', `s_sq_10` = '$pUp_s_sq_10', `s_wc_10` = '$pUp_s_wc_10', `s_sp_10` = '$pUp_s_sp_10', `s_tq_10` = '$pUp_s_tq_10', `s_w_10` = '$pUp_s_w_10', `s_o_10` = '$pUp_s_o_10',
            `s_l_12` = '$pUp_s_l_12', `s_ind_12` = '$pUp_s_ind_12', `s_wg_12` = '$pUp_s_wg_12', `s_anq_12` = '$pUp_s_anq_12', `s_sq_12` = '$pUp_s_sq_12', `s_wc_12` = '$pUp_s_wc_12', `s_sp_12` = '$pUp_s_sp_12', `s_tq_12` = '$pUp_s_tq_12', `s_w_12` = '$pUp_s_w_12', `s_o_12` = '$pUp_s_o_12',
            `s_l_14` = '$pUp_s_l_14', `s_ind_14` = '$pUp_s_ind_14', `s_wg_14` = '$pUp_s_wg_14', `s_anq_14` = '$pUp_s_anq_14', `s_sq_14` = '$pUp_s_sq_14', `s_wc_14` = '$pUp_s_wc_14', `s_sp_14` = '$pUp_s_sp_14', `s_tq_14` = '$pUp_s_tq_14', `s_w_14` = '$pUp_s_w_14', `s_o_14` = '$pUp_s_o_14',
            `s_l_16` = '$pUp_s_l_16', `s_ind_16` = '$pUp_s_ind_16', `s_wg_16` = '$pUp_s_wg_16', `s_anq_16` = '$pUp_s_anq_16', `s_sq_16` = '$pUp_s_sq_16', `s_wc_16` = '$pUp_s_wc_16', `s_sp_16` = '$pUp_s_sp_16', `s_tq_16` = '$pUp_s_tq_16', `s_w_16` = '$pUp_s_w_16', `s_o_16` = '$pUp_s_o_16',
            `s_l_18` = '$pUp_s_l_18', `s_ind_18` = '$pUp_s_ind_18', `s_wg_18` = '$pUp_s_wg_18', `s_anq_18` = '$pUp_s_anq_18', `s_sq_18` = '$pUp_s_sq_18', `s_wc_18` = '$pUp_s_wc_18', `s_sp_18` = '$pUp_s_sp_18', `s_tq_18` = '$pUp_s_tq_18', `s_w_18` = '$pUp_s_w_18', `s_o_18` = '$pUp_s_o_18',
            `s_l_20` = '$pUp_s_l_20', `s_ind_20` = '$pUp_s_ind_20', `s_wg_20` = '$pUp_s_wg_20', `s_anq_20` = '$pUp_s_anq_20', `s_sq_20` = '$pUp_s_sq_20', `s_wc_20` = '$pUp_s_wc_20', `s_sp_20` = '$pUp_s_sp_20', `s_tq_20` = '$pUp_s_tq_20', `s_w_20` = '$pUp_s_w_20', `s_o_20` = '$pUp_s_o_20',
            `s_l_22` = '$pUp_s_l_22', `s_ind_22` = '$pUp_s_ind_22', `s_wg_22` = '$pUp_s_wg_22', `s_anq_22` = '$pUp_s_anq_22', `s_sq_22` = '$pUp_s_sq_22', `s_wc_22` = '$pUp_s_wc_22', `s_sp_22` = '$pUp_s_sp_22', `s_tq_22` = '$pUp_s_tq_22', `s_w_22` = '$pUp_s_w_22', `s_o_22` = '$pUp_s_o_22',
            `s_l_24` = '$pUp_s_l_24', `s_ind_24` = '$pUp_s_ind_24', `s_wg_24` = '$pUp_s_wg_24', `s_anq_24` = '$pUp_s_anq_24', `s_sq_24` = '$pUp_s_sq_24', `s_wc_24` = '$pUp_s_wc_24', `s_sp_24` = '$pUp_s_sp_24', `s_tq_24` = '$pUp_s_tq_24', `s_w_24` = '$pUp_s_w_24', `s_o_24` = '$pUp_s_o_24',
            `s_l_26` = '$pUp_s_l_26', `s_ind_26` = '$pUp_s_ind_26', `s_wg_26` = '$pUp_s_wg_26', `s_anq_26` = '$pUp_s_anq_26', `s_sq_26` = '$pUp_s_sq_26', `s_wc_26` = '$pUp_s_wc_26', `s_sp_26` = '$pUp_s_sp_26', `s_tq_26` = '$pUp_s_tq_26', `s_w_26` = '$pUp_s_w_26', `s_o_26` = '$pUp_s_o_26',
            `s_l_28` = '$pUp_s_l_28', `s_ind_28` = '$pUp_s_ind_28', `s_wg_28` = '$pUp_s_wg_28', `s_anq_28` = '$pUp_s_anq_28', `s_sq_28` = '$pUp_s_sq_28', `s_wc_28` = '$pUp_s_wc_28', `s_sp_28` = '$pUp_s_sp_28', `s_tq_28` = '$pUp_s_tq_28', `s_w_28` = '$pUp_s_w_28', `s_o_28` = '$pUp_s_o_28',
            `s_l_30` = '$pUp_s_l_30', `s_ind_30` = '$pUp_s_ind_30', `s_wg_30` = '$pUp_s_wg_30', `s_anq_30` = '$pUp_s_anq_30', `s_sq_30` = '$pUp_s_sq_30', `s_wc_30` = '$pUp_s_wc_30', `s_sp_30` = '$pUp_s_sp_30', `s_tq_30` = '$pUp_s_tq_30', `s_w_30` = '$pUp_s_w_30', `s_o_30` = '$pUp_s_o_30'
            WHERE `admin_id` = '$admin_ID' AND `report_stu_id` = '$stu_id'");

            $update_ins_report = mysqli_query($conn, "UPDATE `class_report_ins` SET
            `i_lec_2` = '$pUp_i_lec_2', `i_rtw_2` = '$pUp_i_rtw_2', `i_fup_2` = '$pUp_i_fup_2', `i_anq_2` = '$pUp_i_anq_2', `i_pq_2` = '$pUp_i_pq_2', `i_mg_2` = '$pUp_i_mg_2', `i_1o1_2` = '$pUp_i_1o1_2', `i_dv_2` = '$pUp_i_dv_2', `i_w_2` = '$pUp_i_w_2', `i_o_2` = '$pUp_i_o_2',
            `i_lec_4` = '$pUp_i_lec_4', `i_rtw_4` = '$pUp_i_rtw_4', `i_fup_4` = '$pUp_i_fup_4', `i_anq_4` = '$pUp_i_anq_4', `i_pq_4` = '$pUp_i_pq_4', `i_mg_4` = '$pUp_i_mg_4', `i_1o1_4` = '$pUp_i_1o1_4', `i_dv_4` = '$pUp_i_dv_4', `i_w_4` = '$pUp_i_w_4', `i_o_4` = '$pUp_i_o_4',
            `i_lec_6` = '$pUp_i_lec_6', `i_rtw_6` = '$pUp_i_rtw_6', `i_fup_6` = '$pUp_i_fup_6', `i_anq_6` = '$pUp_i_anq_6', `i_pq_6` = '$pUp_i_pq_6', `i_mg_6` = '$pUp_i_mg_6', `i_1o1_6` = '$pUp_i_1o1_6', `i_dv_6` = '$pUp_i_dv_6', `i_w_6` = '$pUp_i_w_6', `i_o_6` = '$pUp_i_o_6',
            `i_lec_8` = '$pUp_i_lec_8', `i_rtw_8` = '$pUp_i_rtw_8', `i_fup_8` = '$pUp_i_fup_8', `i_anq_8` = '$pUp_i_anq_8', `i_pq_8` = '$pUp_i_pq_8', `i_mg_8` = '$pUp_i_mg_8', `i_1o1_8` = '$pUp_i_1o1_8', `i_dv_8` = '$pUp_i_dv_8', `i_w_8` = '$pUp_i_w_8', `i_o_8` = '$pUp_i_o_8',
            `i_lec_10` = '$pUp_i_lec_10', `i_rtw_10` = '$pUp_i_rtw_10', `i_fup_10` = '$pUp_i_fup_10', `i_anq_10` = '$pUp_i_anq_10', `i_pq_10` = '$pUp_i_pq_10', `i_mg_10` = '$pUp_i_mg_10', `i_1o1_10` = '$pUp_i_1o1_10', `i_dv_10` = '$pUp_i_dv_10', `i_w_10` = '$pUp_i_w_10', `i_o_10` = '$pUp_i_o_10',
            `i_lec_12` = '$pUp_i_lec_12', `i_rtw_12` = '$pUp_i_rtw_12', `i_fup_12` = '$pUp_i_fup_12', `i_anq_12` = '$pUp_i_anq_12', `i_pq_12` = '$pUp_i_pq_12', `i_mg_12` = '$pUp_i_mg_12', `i_1o1_12` = '$pUp_i_1o1_12', `i_dv_12` = '$pUp_i_dv_12', `i_w_12` = '$pUp_i_w_12', `i_o_12` = '$pUp_i_o_12',
            `i_lec_14` = '$pUp_i_lec_14', `i_rtw_14` = '$pUp_i_rtw_14', `i_fup_14` = '$pUp_i_fup_14', `i_anq_14` = '$pUp_i_anq_14', `i_pq_14` = '$pUp_i_pq_14', `i_mg_14` = '$pUp_i_mg_14', `i_1o1_14` = '$pUp_i_1o1_14', `i_dv_14` = '$pUp_i_dv_14', `i_w_14` = '$pUp_i_w_14', `i_o_14` = '$pUp_i_o_14',
            `i_lec_16` = '$pUp_i_lec_16', `i_rtw_16` = '$pUp_i_rtw_16', `i_fup_16` = '$pUp_i_fup_16', `i_anq_16` = '$pUp_i_anq_16', `i_pq_16` = '$pUp_i_pq_16', `i_mg_16` = '$pUp_i_mg_16', `i_1o1_16` = '$pUp_i_1o1_16', `i_dv_16` = '$pUp_i_dv_16', `i_w_16` = '$pUp_i_w_16', `i_o_16` = '$pUp_i_o_16',
            `i_lec_18` = '$pUp_i_lec_18', `i_rtw_18` = '$pUp_i_rtw_18', `i_fup_18` = '$pUp_i_fup_18', `i_anq_18` = '$pUp_i_anq_18', `i_pq_18` = '$pUp_i_pq_18', `i_mg_18` = '$pUp_i_mg_18', `i_1o1_18` = '$pUp_i_1o1_18', `i_dv_18` = '$pUp_i_dv_18', `i_w_18` = '$pUp_i_w_18', `i_o_18` = '$pUp_i_o_18',
            `i_lec_20` = '$pUp_i_lec_20', `i_rtw_20` = '$pUp_i_rtw_20', `i_fup_20` = '$pUp_i_fup_20', `i_anq_20` = '$pUp_i_anq_20', `i_pq_20` = '$pUp_i_pq_20', `i_mg_20` = '$pUp_i_mg_20', `i_1o1_20` = '$pUp_i_1o1_20', `i_dv_20` = '$pUp_i_dv_20', `i_w_20` = '$pUp_i_w_20', `i_o_20` = '$pUp_i_o_20',
            `i_lec_22` = '$pUp_i_lec_22', `i_rtw_22` = '$pUp_i_rtw_22', `i_fup_22` = '$pUp_i_fup_22', `i_anq_22` = '$pUp_i_anq_22', `i_pq_22` = '$pUp_i_pq_22', `i_mg_22` = '$pUp_i_mg_22', `i_1o1_22` = '$pUp_i_1o1_22', `i_dv_22` = '$pUp_i_dv_22', `i_w_22` = '$pUp_i_w_22', `i_o_22` = '$pUp_i_o_22',
            `i_lec_24` = '$pUp_i_lec_24', `i_rtw_24` = '$pUp_i_rtw_24', `i_fup_24` = '$pUp_i_fup_24', `i_anq_24` = '$pUp_i_anq_24', `i_pq_24` = '$pUp_i_pq_24', `i_mg_24` = '$pUp_i_mg_24', `i_1o1_24` = '$pUp_i_1o1_24', `i_dv_24` = '$pUp_i_dv_24', `i_w_24` = '$pUp_i_w_24', `i_o_24` = '$pUp_i_o_24',
            `i_lec_26` = '$pUp_i_lec_26', `i_rtw_26` = '$pUp_i_rtw_26', `i_fup_26` = '$pUp_i_fup_26', `i_anq_26` = '$pUp_i_anq_26', `i_pq_26` = '$pUp_i_pq_26', `i_mg_26` = '$pUp_i_mg_26', `i_1o1_26` = '$pUp_i_1o1_26', `i_dv_26` = '$pUp_i_dv_26', `i_w_26` = '$pUp_i_w_26', `i_o_26` = '$pUp_i_o_26',
            `i_lec_28` = '$pUp_i_lec_28', `i_rtw_28` = '$pUp_i_rtw_28', `i_fup_28` = '$pUp_i_fup_28', `i_anq_28` = '$pUp_i_anq_28', `i_pq_28` = '$pUp_i_pq_28', `i_mg_28` = '$pUp_i_mg_28', `i_1o1_28` = '$pUp_i_1o1_28', `i_dv_28` = '$pUp_i_dv_28', `i_w_28` = '$pUp_i_w_28', `i_o_28` = '$pUp_i_o_28',
            `i_lec_30` = '$pUp_i_lec_30', `i_rtw_30` = '$pUp_i_rtw_30', `i_fup_30` = '$pUp_i_fup_30', `i_anq_30` = '$pUp_i_anq_30', `i_pq_30` = '$pUp_i_pq_30', `i_mg_30` = '$pUp_i_mg_30', `i_1o1_30` = '$pUp_i_1o1_30', `i_dv_30` = '$pUp_i_dv_30', `i_w_30` = '$pUp_i_w_30', `i_o_30` = '$pUp_i_o_30'
            WHERE `admin_id` = '$admin_ID' AND `report_ins_id` = '$ins_id'");

            $update_com_report = mysqli_query($conn, "UPDATE `class_report_com` SET `comment` = '$up_comments' WHERE `admin_id` = '$admin_ID' AND `report_com_id` = '$com_id'");
            if($update_stu_report && $update_ins_report && $update_com_report){
               $_SESSION['success_alert'] = "Changes Saved";
               header("Location: admin/admin_reports_view.php?report_info_id=$info_id&report_stu_id=$stu_id&report_ins_id=$ins_id&report_com_id=$com_id"); exit;
            }else{
               $_SESSION['danger_alert'] = "Error in updating";
               header("Location: admin/admin_reports_view.php"); exit;
            }
         }else{
            $_SESSION['danger_alert'] = "Error";
            header("Location: admin/admin_reports_view.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Error";
         header("Location: admin/admin_reports_view.php"); exit;
      }
   }

   //THIS IS FOR ADMIN ARCHIVE CLASS REPORT
   if(isset($_POST['archive_class_report'])){
      if(isset($_SESSION['session_admin'])){
         $admin_ID = $_SESSION['session_admin'];

         if(isset($_GET['report_info_id']) && isset($_GET['report_stu_id']) && isset($_GET['report_ins_id']) && isset($_GET['report_com_id'])){
            $info_id = $_GET['report_info_id'];
            $stu_id = $_GET['report_stu_id'];
            $ins_id = $_GET['report_ins_id'];
            $com_id = $_GET['report_com_id'];

            $select_info = mysqli_query($conn, "SELECT * FROM `class_report_info` WHERE `report_info_id` = '$info_id' AND `admin_id` = '$admin_ID'");
            $fetch_info = mysqli_fetch_assoc($select_info);

            $select_stu = mysqli_query($conn, "SELECT * FROM `class_report_stu` WHERE `report_stu_id` = '$stu_id' AND `admin_id` = '$admin_ID'");
            $fetch_stu = mysqli_fetch_assoc($select_stu);

            $select_ins = mysqli_query($conn, "SELECT * FROM `class_report_ins` WHERE `report_ins_id` = '$ins_id' AND `admin_id` = '$admin_ID'");
            $fetch_ins = mysqli_fetch_assoc($select_ins);

            $select_com = mysqli_query($conn, "SELECT * FROM `class_report_com` WHERE `report_com_id` = '$com_id' AND `admin_id` = '$admin_ID'");
            $fetch_com = mysqli_fetch_assoc($select_com);

            if(($fetch_info['admin_archive'] == TRUE && $fetch_stu['admin_archive'] == TRUE && $fetch_ins['admin_archive'] == TRUE && $fetch_com['admin_archive'] == TRUE)){
               mysqli_query($conn, "UPDATE `class_report_info` SET `admin_archive` = FALSE WHERE `report_info_id` = '$info_id' AND `admin_id` = '$admin_ID'");
               mysqli_query($conn, "UPDATE `class_report_stu` SET `admin_archive` = FALSE WHERE `report_stu_id` = '$stu_id' AND `admin_id` = '$admin_ID'");
               mysqli_query($conn, "UPDATE `class_report_ins` SET `admin_archive` = FALSE WHERE `report_ins_id` = '$ins_id' AND `admin_id` = '$admin_ID'");
               mysqli_query($conn, "UPDATE `class_report_com` SET `admin_archive` = FALSE WHERE `report_com_id` = '$com_id' AND `admin_id` = '$admin_ID'");

               $_SESSION['success_alert'] = "Report Archived";
               header("Location: admin/admin_report.php"); exit;
            }else{
               $_SESSION['danger_alert'] = "Error in deleting";
               header("Location: admin/admin_report.php"); exit;
            }
         }else{
            $_SESSION['danger_alert'] = "Error";
            header("Location: admin/admin_report.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Error";
         header("Location: admin/admin_report.php"); exit;
      }
   }

   //THIS IS FOR ADMIN UNARCHIVE CLASS REPORT
   if(isset($_POST['unarchive_class_report'])){
      if(isset($_SESSION['session_admin'])){
         $admin_ID = $_SESSION['session_admin'];

         if(isset($_GET['report_info_id']) && isset($_GET['report_stu_id']) && isset($_GET['report_ins_id']) && isset($_GET['report_com_id'])){
            $info_id = $_GET['report_info_id'];
            $stu_id = $_GET['report_stu_id'];
            $ins_id = $_GET['report_ins_id'];
            $com_id = $_GET['report_com_id'];

            $select_info = mysqli_query($conn, "SELECT * FROM `class_report_info` WHERE `report_info_id` = '$info_id' AND `admin_id` = '$admin_ID'");
            $fetch_info = mysqli_fetch_assoc($select_info);

            $select_stu = mysqli_query($conn, "SELECT * FROM `class_report_stu` WHERE `report_stu_id` = '$stu_id' AND `admin_id` = '$admin_ID'");
            $fetch_stu = mysqli_fetch_assoc($select_stu);

            $select_ins = mysqli_query($conn, "SELECT * FROM `class_report_ins` WHERE `report_ins_id` = '$ins_id' AND `admin_id` = '$admin_ID'");
            $fetch_ins = mysqli_fetch_assoc($select_ins);

            $select_com = mysqli_query($conn, "SELECT * FROM `class_report_com` WHERE `report_com_id` = '$com_id' AND `admin_id` = '$admin_ID'");
            $fetch_com = mysqli_fetch_assoc($select_com);

            if(($fetch_info['admin_archive'] == FALSE && $fetch_stu['admin_archive'] == FALSE && $fetch_ins['admin_archive'] == FALSE && $fetch_com['admin_archive'] == FALSE)){
               mysqli_query($conn, "UPDATE `class_report_info` SET `admin_archive` = TRUE WHERE `report_info_id` = '$info_id' AND `admin_id` = '$admin_ID'");
               mysqli_query($conn, "UPDATE `class_report_stu` SET `admin_archive` = TRUE WHERE `report_stu_id` = '$stu_id' AND `admin_id` = '$admin_ID'");
               mysqli_query($conn, "UPDATE `class_report_ins` SET `admin_archive` = TRUE WHERE `report_ins_id` = '$ins_id' AND `admin_id` = '$admin_ID'");
               mysqli_query($conn, "UPDATE `class_report_com` SET `admin_archive` = TRUE WHERE `report_com_id` = '$com_id' AND `admin_id` = '$admin_ID'");

               $_SESSION['success_alert'] = "Report Unarchived";
               header("Location: admin/admin_archive.php"); exit;
            }else{
               $_SESSION['danger_alert'] = "Error in deleting";
               header("Location: admin/admin_archive.php"); exit;
            }
         }else{
            $_SESSION['danger_alert'] = "Error";
            header("Location: admin/admin_archive.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Error";
         header("Location: admin/admin_archive.php"); exit;
      }
   }

   //==========================================================-- ACADEMIC YEAR AND SUBJECTS --===============================================================================================================================================

   //THIS IS FOR ADD ACADEMIC YEAR
   if(isset($_POST['acad-submit'])){
      if(isset($_SESSION['session_admin'])){
         $school_year = mysqli_real_escape_string($conn, $_POST['new_school_year']);
         $semester = $_POST['new_semester'];

         $insert_query = mysqli_query($conn, "INSERT INTO `academic_year` VALUES ('0','$school_year','$semester','0')");
         if($insert_query){
            $_SESSION['success_alert'] = "New academic year added";
            header("Location: admin/admin_year.php"); exit;
         }else{
            $_SESSION['danger_alert'] = "Error in adding";
            header("Location: admin/admin_year.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Error";
         header("Location: admin/admin_year.php"); exit;
      }
   }

   //THIS IS FOR MANAGE ACADEMIC YEAR
   if(isset($_POST['acad-up-submit'])){
      if(isset($_SESSION['session_admin'])){
         if(isset($_GET['id'])){
            $acad_id = $_GET['id'];

            $up_school_year = mysqli_real_escape_string($conn, $_POST['up_school_year']);
            $up_semester = $_POST['up_semester'];
            $up_status = $_POST['up_status'];
            if($up_status == 1){
               $close_query = mysqli_query($conn, "UPDATE `academic_year` SET `status` = 2 WHERE `id` != '$acad_id' AND `status` = 1");
            }
            $update_query = mysqli_query($conn, "UPDATE `academic_year` SET `year` = '$up_school_year', `semester` = '$up_semester', `status` = '$up_status' WHERE `id` = '$acad_id'");
            if($update_query){
               $_SESSION['success_alert'] = "Academic year updated";
               header("Location: admin/admin_year.php"); exit;
            }else{
               $_SESSION['danger_alert'] = "Error in updating";
               header("Location: admin/admin_year.php"); exit;
            }
         }else{
            $_SESSION['danger_alert'] = "Error";
            header("Location: admin/admin_year.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Error";
         header("Location: admin/admin_year.php"); exit;
      }
   }

   //THIS IS FOR DELETE ACADEMIC YEAR
   if(isset($_POST['delete-acad'])){
      if(isset($_SESSION['session_admin'])){
         if(isset($_GET['id'])){
            $acad_id = $_GET['id'];

            $delete_query = mysqli_query($conn, "DELETE FROM `academic_year` WHERE `id` = '$acad_id'");
            if($delete_query){
               $_SESSION['success_alert'] = "Academic year deleted";
               header("Location: admin/admin_year.php"); exit;
            }else{
               $_SESSION['danger_alert'] = "Error in deleting";
               header("Location: admin/admin_year.php"); exit;
            }
         }else{
            $_SESSION['danger_alert'] = "Error";
            header("Location: admin/admin_year.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Error";
         header("Location: admin/admin_year.php"); exit;
      }
   }

   //THIS IS FOR ADD SUBJECT
   if(isset($_POST['subject-submit'])){
      if(isset($_SESSION['session_admin'])){
         $sub_code = mysqli_real_escape_string($conn, $_POST['new_sub_code']);
         $sub_desc = mysqli_real_escape_string($conn, $_POST['new_sub_desc']);

         $insert_query = mysqli_query($conn, "INSERT INTO `subjects` VALUES ('0','$sub_code','$sub_desc')");
         if($insert_query){
            $_SESSION['success_alert'] = "New subject added";
            header("Location: admin/admin_subject.php"); exit;
         }else{
            $_SESSION['danger_alert'] = "Error in adding";
            header("Location: admin/admin_subject.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Error";
         header("Location: admin/admin_subject.php"); exit;
      }
   }

   //THIS IS FOR MANAGE SUBJECT
   if(isset($_POST['sub-up-submit'])){
      if(isset($_SESSION['session_admin'])){

         if(isset($_GET['id'])){
            $sub_id = $_GET['id'];

            $up_sub_code = mysqli_real_escape_string($conn, $_POST['up_sub_code']);
            $up_sub_desc = mysqli_real_escape_string($conn, $_POST['up_sub_desc']);

            $up_subject = $up_sub_code.' '.$up_sub_desc;

            $select_query = mysqli_query($conn, "SELECT * FROM `subjects` WHERE `id` = '$sub_id'");
            if($sub_row  = mysqli_fetch_assoc($select_query)){
               $subject = $sub_row['sub_code'].' '.$sub_row['sub_desc'];

               $update_query = mysqli_query($conn, "UPDATE `subjects` SET `sub_code` = '$up_sub_code', `sub_desc` = '$up_sub_desc' WHERE `id` = '$sub_id'");
               if($update_query){
                  mysqli_query($conn, "UPDATE `class_report_info` SET `subject` = '$up_subject' WHERE `subject` = '$subject'");
   
                  $_SESSION['success_alert'] = "Subject updated";
                  header("Location: admin/admin_subject.php"); exit;
               }else{
                  $_SESSION['danger_alert'] = "Error in updating";
                  header("Location: admin/admin_subject.php"); exit;
               }
            }else{
               $_SESSION['danger_alert'] = "Error in fetching";
               header("Location: admin/admin_subject.php"); exit;
            }
         }else{
            $_SESSION['danger_alert'] = "Error";
            header("Location: admin/admin_subject.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Error";
         header("Location: admin/admin_subject.php"); exit;
      }
   }

   //THIS IS FOR DELETE SUBJECT
   if(isset($_POST['delete-subject'])){
      if(isset($_SESSION['session_admin'])){

         if(isset($_GET['id'])){
            $sub_id = $_GET['id'];

            $delete_query = mysqli_query($conn, "DELETE FROM `subjects` WHERE `id` = '$sub_id'");
            if($delete_query){
               $_SESSION['success_alert'] = "Subject deleted";
               header("Location: admin/admin_subject.php"); exit;
            }else{
               $_SESSION['danger_alert'] = "Error in deleting";
               header("Location: admin/admin_subject.php"); exit;
            }
         }else{
            $_SESSION['danger_alert'] = "Error";
            header("Location: admin/admin_subject.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Error";
         header("Location: admin/admin_subject.php"); exit;
      }
   }

   //==========================================================-- FACULTY --===============================================================================================================================================

   //THIS IS FOR DELETE FACULTY
   if(isset($_POST['delete_faculty'])){
      if(isset($_SESSION['session_admin'])){
         $admin_ID = $_SESSION['session_admin'];

         if(isset($_GET['id'])){
            $faculty_ID = $_GET['id'];
            $check_pic = mysqli_query($conn, "SELECT `faculty_pic_path` FROM `faculty_pic` WHERE `id` = '$faculty_ID'");
            $fetch_pic = mysqli_fetch_assoc($check_pic);

            $pic = 'assets/img/faculty_img/'.$fetch_pic['faculty_pic_path'];
            if(file_exists($pic)){
               unlink($pic);
            }
            $faculty_pic = mysqli_query($conn, "DELETE FROM `faculty_pic` WHERE `id` = '$faculty_ID'");
            $faculty_info = mysqli_query($conn, "DELETE FROM `class_report_info` WHERE `faculty_id` = '$faculty_ID'");
            $faculty_ins = mysqli_query($conn, "DELETE FROM `class_report_ins` WHERE `faculty_id` = '$faculty_ID'");
            $faculty_stu = mysqli_query($conn, "DELETE FROM `class_report_stu` WHERE `faculty_id` = '$faculty_ID'");
            $faculty_com = mysqli_query($conn, "DELETE FROM `class_report_com` WHERE `faculty_id` = '$faculty_ID'");
            if($faculty_pic && $faculty_info && $faculty_ins && $faculty_stu && $faculty_com == TRUE){
               mysqli_query($conn, "DELETE FROM `faculty` WHERE `id` = '$faculty_ID'");
               $_SESSION['success_alert'] = "Faculty deleted";
               header("Location: admin/admin_faculty.php"); exit;
            }else{
               $_SESSION['danger_alert'] = "Error in deleting";
               header("Location: admin/admin_faculty.php"); exit;
            }
         }else{
            $_SESSION['danger_alert'] = "Error";
            header("Location: admin/admin_faculty.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Error";
         header("Location: admin/admin_faculty.php"); exit;
      }
   }

   //==========================================================-- ADMIN EDIT PROFILE --===============================================================================================================================================

   //THIS IS FOR ADMIN UPDATE ACCOUNT
   if(isset($_POST['updateAdmin-submit'])){
      if(isset($_SESSION['session_admin'])){
         $admin_ID = $_SESSION['session_admin'];

         $update_fname = mysqli_real_escape_string($conn, $_POST['updateAdmin-fname']);
         $update_lname = mysqli_real_escape_string($conn, $_POST['updateAdmin-lname']);
         $update_email = mysqli_real_escape_string($conn, $_POST['updateAdmin-email']);

         $observer_name = $update_lname . ', ' . $update_fname;

         $current_email_query = mysqli_query($conn, "SELECT `email` FROM `admin` WHERE `id` = '$admin_ID'");
         $current_email_row = mysqli_fetch_assoc($current_email_query);
         $current_email = $current_email_row['email'];

         if($update_email !== $current_email) {
            $check_admin_email = mysqli_query($conn, "SELECT * FROM `admin` WHERE `email` = '$update_email'");
            $count_admin_email = mysqli_num_rows($check_admin_email);
            if($count_admin_email > 0){
               $_SESSION['primary_alert'] = "Email is already used";
               header("Location: admin/admin_profile.php"); exit;
            }
         }
         $update_admin = mysqli_query($conn, "UPDATE `admin` SET `first_name` = '$update_fname', `last_name` = '$update_lname', `email` = '$update_email' WHERE `id` = '$admin_ID'");
         $update_observer_name = mysqli_query($conn, "UPDATE `class_report_info` SET `observer_name` = '$observer_name' WHERE `admin_id` = '$admin_ID'");
         if($update_admin && $update_observer_name){
            $_SESSION['success_alert'] = "Changes Saved";
            header("Location: admin/admin_profile.php"); exit;
         }else{
            $_SESSION['danger_alert'] = "Error. in saving";
            header("Location: admin/admin_profile.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Error";
         header("Location: admin/admin_profile.php"); exit;
      }
   }

   //THIS IS FOR UPLOAD ADMIN PROFILE PHOTO
   if(isset($_POST['uploadAdmin-pic'])){
      if(isset($_SESSION['session_admin'])){
         $admin_ID = $_SESSION['session_admin'];

         $pic_name = $_FILES['admin-pic']['name'];
         $pic_tmpname = $_FILES['admin-pic']['tmp_name'];
         $pic_size = $_FILES['admin-pic']['size'];
         $pic_dir = 'assets/img/admin_img/'.$pic_name;

         if($pic_size < 10000000){
            $select_prev_pic = mysqli_query($conn, "SELECT `admin_pic_path` FROM `admin_pic` WHERE `id` = '$admin_ID'");
            if($fetch_prev_pic = mysqli_fetch_assoc($select_prev_pic)){
               $old_pic = 'assets/img/admin_img/'.$fetch_prev_pic['admin_pic_path'];

               if(file_exists($old_pic)){
                  unlink($old_pic);
               }
               mysqli_query($conn, "UPDATE `admin_pic` SET `admin_pic_path` = '$pic_name' WHERE `id` = '$admin_ID'");
            }else{
               mysqli_query($conn, "INSERT INTO `admin_pic` VALUES ('0', '$admin_ID', '$pic_name')");
            }
            if(move_uploaded_file($pic_tmpname, $pic_dir)){
               $_SESSION['success_alert'] = "Picture is uploaded";
               header("Location: admin/admin_profile.php"); exit;
            }else{
               $_SESSION['danger_alert'] = "Error!";
               header("Location: admin/admin_profile.php"); exit;
            }
         }else{
            $_SESSION['primary_alert'] = "Less than 10MB required";
            header("Location: admin/admin_profile.php"); exit;
         }
      }
   }

   //THIS IS FOR DELETE ADMIN PROFILE PHOTO
   if(isset($_POST['deleteAdmin-submit'])){
      if(isset($_SESSION['session_admin'])){
         $admin_ID = $_SESSION['session_admin'];

         $check_pic = mysqli_query($conn, "SELECT `admin_pic_path` FROM `admin_pic` WHERE `id` = '$admin_ID'");
         $fetch_pic = mysqli_fetch_assoc($check_pic);
         if($fetch_pic){
            $cur_pic = 'assets/img/admin_img/'.$fetch_pic['admin_pic_path'];

            if(file_exists($cur_pic)){
               unlink($cur_pic);
            }
            $delete_pic = mysqli_query($conn, "DELETE FROM `admin_pic` WHERE `id` = '$admin_ID'");
            if($delete_pic){
               $_SESSION['success_alert'] = "Photo Deleted";
               header("Location: admin/admin_profile.php"); exit;
            }else{
               $_SESSION['danger_alert'] = "Error in deleting";
               header("Location: admin/admin_profile.php"); exit;
            }
         }else{
            $_SESSION['primary_alert'] = "No photo to delete";
            header("Location: admin/admin_profile.php"); exit;
         }
      }
   }

   //THIS IS FOR ADMIN CHANGE PASSWORD
   if(isset($_POST['adminCP-submit'])){
      if(isset($_SESSION['session_admin'])){
         $admin_ID = $_SESSION['session_admin'];
         
         $current_password = mysqli_real_escape_string($conn, $_POST['admin-current-password']);
         $new_password = mysqli_real_escape_string($conn, $_POST['admin-new-password']);
         $new_password2 = mysqli_real_escape_string($conn, $_POST['admin-new-password2']);
         if($new_password == $new_password2){
            $check_password = mysqli_query($conn, "SELECT `password` FROM `admin` WHERE `id` = '$admin_ID'");
            $fetch_password = mysqli_fetch_assoc($check_password);

            $password_from_db = $fetch_password['password'];
            if($password_from_db == $current_password){
               $change_password = mysqli_query($conn, "UPDATE `admin` SET `password` = '$new_password' WHERE `id` = $admin_ID");
               if($change_password){
                  $_SESSION['success_alert'] = "Password Changed";
                  header("Location: admin/admin_profile.php"); exit;
               }else{
                  $_SESSION['danger_alert'] = "Error in changing";
                  header("Location: admin/admin_profile.php"); exit;
               }
            }else{
               $_SESSION['danger_alert'] = "Current password is incorrect";
               header("Location: admin/admin_profile.php"); exit;
            }
         }else{
            $_SESSION['danger_alert'] = "New passwords did not match";
            header("Location: admin/admin_profile.php"); exit;
         }
      }else{
         $_SESSION['danger_alert'] = "Error";
         header("Location: admin/admin_profile.php"); exit;
      }
   }

//==========================================================-- LOGOUT --===============================================================================================================================================

   // THIS IS FOR ADMIN LOGOUT
   if(isset($_POST['admin-logout'])){
      if(isset($_SESSION['session_admin'])){
         unset($_SESSION['session_admin']);
         $_SESSION['success_alert'] = "Log Out Successfully";
         header("Location: index.php"); exit;
      }
   }
?>