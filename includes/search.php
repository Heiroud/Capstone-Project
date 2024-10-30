<?php
   //Admin search -------------------------------------------------------------------------------------------------

   //home search report
   if(isset($_GET['home_search_report'])){
      $filter_search = mysqli_real_escape_string($conn, $_GET['home_search_report']);
      $search_report = mysqli_query($conn, "SELECT info.*,stu.*,ins.*,com.* 
      FROM `class_report_info` info 
      LEFT JOIN `class_report_stu` stu ON info.report_info_id = stu.report_stu_id
      LEFT JOIN `class_report_ins` ins ON info.report_info_id = ins.report_ins_id
      LEFT JOIN `class_report_com` com ON info.report_info_id = com.report_com_id
      WHERE CONCAT(info.section, info.instructor, info.subject) LIKE '%$filter_search%'
      AND info.admin_id = '$admin_ID' AND info.admin_archive = TRUE");
      if(mysqli_num_rows($search_report) > 0){
         ?>
            <div class="mb-3 mt-2">
               <a href="admin_home.php" class="burubordigbutton"><i class="bi bi-arrow-return-left"></i></a>
            </div>
         <?php
         while($row = mysqli_fetch_assoc($search_report)){
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
            <div class="mt-2">
               <a href="admin_home.php" class="burubordigbutton"><i class="bi bi-arrow-return-left"></i></a>
            </div>
            <div class="text-center fw-bold pagorflok">
               <p>No Search Report Found</p>
            </div>
         <?php
      }
   }

   //search report
   if(isset($_GET['search_report'])){
      $filter_search = mysqli_real_escape_string($conn, $_GET['search_report']);           
      $search_report = mysqli_query($conn, "SELECT info.*,stu.*,ins.*,com.*
      FROM `class_report_info` info 
      LEFT JOIN `class_report_stu` stu ON info.report_info_id = stu.report_stu_id
      LEFT JOIN `class_report_ins` ins ON info.report_info_id = ins.report_ins_id
      LEFT JOIN `class_report_com` com ON info.report_info_id = com.report_com_id
      WHERE CONCAT(info.section, info.instructor, info.subject) LIKE '%$filter_search%'
      AND info.admin_id = '$admin_ID' AND info.admin_archive = TRUE");
      if(mysqli_num_rows($search_report) > 0){
         ?>
            <div class="mb-3">
               <a href="admin_report.php" class="burubordigbutton"><i class="bi bi-arrow-return-left"></i></a>
            </div>
         <?php
         while($row = mysqli_fetch_assoc($search_report)){
         $faculty_ID = $row['faculty_id'];
         $select_faculty_pic = mysqli_query($conn, "SELECT * FROM `faculty_pic` WHERE `id` = '$faculty_ID'");
         $fecth_faculty_pic = mysqli_fetch_assoc($select_faculty_pic);
         if($fecth_faculty_pic){
            $faculty_pic = "http://localhost/ALPerf/" . $fecth_faculty_pic['faculty_pic_path'];
         }else{
            $faculty_pic = "../assets/img/default.jpg";
         }
         ?>
            <div class="col-md-6 col-lg-4">
               <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-start">
                     <div class="d-flex align-items-center herds">
                        <div class="picsur">
                           <img src="<?php echo $faculty_pic; ?>">
                        </div>
                        <h5> <?php echo $row['instructor'] ?> </h5>
                     </div>
                     <div class="dropdown">
                        <button type="button" class="dots border-0" id="dropdownMenuButton" data-bs-toggle="dropdown">
                           <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                           <li>
                              <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#archive_class_modal_<?php echo $row['report_info_id'] . '_' . $row['report_stu_id'] . '_' . $row['report_ins_id'] . '_' . $row['report_com_id']; ?>"> Archive </button>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <a href="admin_reports_view.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>">
                     <div class="card-body">
                        <p class="fw-bold"> <?php echo $row['section'] ?> </p>
                        <p class="fw-bold mb-2"> <?php echo date('M j, Y', strtotime($row['date'])); ?></p>
                     </div>
                  </a>
               </div>
            </div>
            <!-----------===============- ARCHIVE CLASS MODAL -===============------------------>
            <div class="modal" id="archive_class_modal_<?php echo $row['report_info_id'] . '_' . $row['report_stu_id'] . '_' . $row['report_ins_id'] . '_' . $row['report_com_id']; ?>">
               <div class="modal-dialog modal-dialog-centered" data-bs-backdrop="false">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Archive report?</h5>
                     </div>
                     <div class="modal-body fw-bold">
                        <?php echo $row['instructor'].', '.date('M j Y', strtotime($row['date'])); ?>
                     </div>
                     <div class="modal-footer p-2 delete_class_confirmation">
                        <form action="../process_admin.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>" method="POST">
                           <input type="submit" name="archive_class_report" value="Archive">
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
            <div>
               <a href="admin_report.php" class="burubordigbutton"><i class="bi bi-arrow-return-left"></i></a>
            </div>
            <div class="text-center fw-bold pagorflok">
               <p>No Report Found</p>
            </div>
         <?php
      }
   }

   //search archive
   if(isset($_GET['search_archive'])){
      $filter_search = mysqli_real_escape_string($conn, $_GET['search_archive']);
      $search_archive = mysqli_query($conn, "SELECT info.*,stu.*,ins.*,com.*
      FROM `class_report_info` info 
      LEFT JOIN `class_report_stu` stu ON info.report_info_id = stu.report_stu_id
      LEFT JOIN `class_report_ins` ins ON info.report_info_id = ins.report_ins_id
      LEFT JOIN `class_report_com` com ON info.report_info_id = com.report_com_id
      WHERE CONCAT(info.section, info.instructor, info.subject) LIKE '%$filter_search%'
      AND info.admin_id = '$admin_ID' AND info.admin_archive = FALSE");
      if(mysqli_num_rows($search_archive) > 0){
         ?>
            <div class="mb-3">
               <a href="admin_archive.php" class="burubordigbutton"><i class="bi bi-arrow-return-left"></i></a>
            </div>
         <?php
         while($row = mysqli_fetch_assoc($search_archive)){
         $faculty_ID = $row['faculty_id'];
         $select_faculty_pic = mysqli_query($conn, "SELECT * FROM `faculty_pic` WHERE `id` = '$faculty_ID'");
         $fecth_faculty_pic = mysqli_fetch_assoc($select_faculty_pic);
         if($fecth_faculty_pic){
            $faculty_pic = "http://localhost/ALPerf/" . $fecth_faculty_pic['faculty_pic_path'];
         }else{
            $faculty_pic = "../assets/img/default.jpg";
         }
         ?>
            <div class="col-md-6 col-lg-4">
               <div class="card">
                  <div class="card-header archive-card d-flex justify-content-between align-items-start">
                     <div class="d-flex align-items-center herds">
                        <div class="picsur">
                           <img src="<?php echo $faculty_pic; ?>">
                        </div>
                        <h5> <?php echo $row['instructor'] ?> </h5>
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
                  <a href="admin_archives_view.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>">
                     <div class="card-body">
                        <p class="fw-bold"> <?php echo $row['section'] ?> </p>
                        <p class="fw-bold mb-2"> <?php echo date('M j, Y', strtotime($row['date'])); ?></p>
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
                        <?php echo $row['instructor'].', '.date('M j Y', strtotime($row['date'])); ?>
                     </div>
                     <div class="modal-footer p-2 delete_class_confirmation">
                        <form action="../process_admin.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>" method="POST">
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
            <div>
               <a href="admin_archive.php" class="burubordigbutton"><i class="bi bi-arrow-return-left"></i></a>
            </div>
            <div class="text-center fw-bold pagorflok">
               <p>No Archive Found</p>
            </div>
         <?php
      }
   }

   //search subject
   if(isset($_GET['search_subject'])){
      $filter_search = mysqli_real_escape_string($conn, $_GET['search_subject']);
      $search_subject = mysqli_query($conn, "SELECT * FROM `subjects` WHERE CONCAT(sub_code, sub_desc) LIKE '%$filter_search%'");
      if(mysqli_num_rows($search_subject) > 0){
         ?>
            <div class="mb-3 mt-2">
               <a href="admin_subject.php" class="burubordigbutton"><i class="bi bi-arrow-return-left"></i></a>
            </div>
         <?php
         while($sub_row = mysqli_fetch_assoc($search_subject)){
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
         ?>
            <div class="mt-2">
               <a href="admin_subject.php" class="burubordigbutton"><i class="bi bi-arrow-return-left"></i></a>
            </div>
            <div class="text-center fw-bold pagorflok">
               <p>No Search Subject Found</p>
            </div>
         <?php
      }
   }

   //search faculty
   if(isset($_GET['search_faculty'])){
      $filter_search = mysqli_real_escape_string($conn, $_GET['search_faculty']);
      $search_faculty = mysqli_query($conn, "SELECT * FROM `faculty` WHERE CONCAT(first_name, last_name, email) LIKE '%$filter_search%' ");
      if(mysqli_num_rows($search_faculty) > 0){
         ?>
            <div class="mb-3 mt-2">
               <a href="admin_faculty.php" class="burubordigbutton"><i class="bi bi-arrow-return-left"></i></a>
            </div>
         <?php
         while($faculty_data = mysqli_fetch_assoc($search_faculty)){
            $faculty_ID = $faculty_data['id'];
            $select_faculty_pic = mysqli_query($conn, "SELECT * FROM `faculty_pic` WHERE `id` = '$faculty_ID'");
            $faculty_pic_row = mysqli_fetch_assoc($select_faculty_pic);
            if($faculty_pic_row){
               $faculty_pic = "http://localhost/ALPerf/" . $faculty_pic_row['faculty_pic_path'];
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
         ?>
            <div class="mt-2">
               <a href="admin_faculty.php" class="burubordigbutton"><i class="bi bi-arrow-return-left"></i></a>
            </div>
            <div class="text-center fw-bold pagorflok">
               <p>No Search Faculty Found</p>
            </div>
         <?php
      }
   }

   //Faculty search -------------------------------------------------------------------------------------------

   //home search report
   if(isset($_GET['home_search'])){
      $filter_search = mysqli_real_escape_string($conn, $_GET['home_search']);
      $search_report = mysqli_query($conn, "SELECT info.*,stu.*,ins.*,com.* 
      FROM `class_report_info` info 
      LEFT JOIN `class_report_stu` stu ON info.report_info_id = stu.report_stu_id
      LEFT JOIN `class_report_ins` ins ON info.report_info_id = ins.report_ins_id
      LEFT JOIN `class_report_com` com ON info.report_info_id = com.report_com_id
      WHERE CONCAT(info.section, info.observer_name, info.subject) LIKE '%$filter_search%'
      AND info.faculty_id = '$faculty_ID' AND info.faculty_archive = TRUE");
      if(mysqli_num_rows($search_report) > 0){
         ?>
            <div class="mb-3 mt-2">
               <a href="faculty_home.php" class="burubordigbutton"><i class="bi bi-arrow-return-left"></i></a>
            </div>
         <?php
         while($row = mysqli_fetch_assoc($search_report)){
            ?>
               <tr>
                  <td class="fw-bold"><a href="faculty_reports_view.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>"><?php echo $row['section']; ?></a></td>
                  <td class="fw-bold"><a href="faculty_reports_view.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>"><?php echo date('M j, Y', strtotime($row['date'])); ?></td>
                  <td class="fw-bold"><a href="faculty_reports_view.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>"><?php echo $row['observer_name']; ?></a></td>
               </tr>
            <?php
         }
      }else{
         ?>
            <div class="mt-2">
               <a href="faculty_home.php" class="burubordigbutton"><i class="bi bi-arrow-return-left"></i></a>
            </div>
            <div class="text-center fw-bold pagorflok">
               <p>No Report Found</p>
            </div>
         <?php
      }
   }

   //search report
   if(isset($_GET['faculty_search_report'])){
      $filter_search = mysqli_real_escape_string($conn, $_GET['faculty_search_report']);
      $search_report = mysqli_query($conn, "SELECT info.*,stu.*,ins.*,com.* 
      FROM `class_report_info` info 
      LEFT JOIN `class_report_stu` stu ON info.report_info_id = stu.report_stu_id
      LEFT JOIN `class_report_ins` ins ON info.report_info_id = ins.report_ins_id
      LEFT JOIN `class_report_com` com ON info.report_info_id = com.report_com_id
      WHERE CONCAT(info.section, info.observer_name, info.subject) LIKE '%$filter_search%'
      AND info.faculty_id = '$faculty_ID' AND info.faculty_archive = TRUE");
      if(mysqli_num_rows($search_report) > 0){
         ?>
            <div class="mb-3">
               <a href="faculty_report.php" class="burubordigbutton"><i class="bi bi-arrow-return-left"></i></a>
            </div>
         <?php
         while($row = mysqli_fetch_assoc($search_report)){
            $admin_ID = $row['admin_id'];
            $select_admin_pic = mysqli_query($conn, "SELECT * FROM `admin_pic` WHERE `id` = '$admin_ID'");
            $fecth_admin_pic = mysqli_fetch_assoc($select_admin_pic);
            if($fecth_admin_pic){
               $admin_pic = "http://localhost/ALPerf/" . $fecth_admin_pic['admin_pic_path'];
            }else{
               $admin_pic = "../assets/img/default.jpg";
            }
            ?>
               <div class="col-md-6 col-lg-4">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between align-items-start">
                        <div style="overflow: hidden;">
                           <h5> <?php echo $row['section'] ?> </h5>
                        </div>
                        <div class="dropdown">
                           <button type="button" class="dots border-0" id="dropdownMenuButton" data-bs-toggle="dropdown">
                              <i class="bi bi-three-dots-vertical"></i>
                           </button>
                           <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <li>
                                 <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#archive_class_modal_<?php echo $row['report_info_id'] . '_' . $row['report_stu_id'] . '_' . $row['report_ins_id'] . '_' . $row['report_com_id']; ?>"> Archive </button>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <a href="faculty_reports_view.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>">
                        <div class="card-body">
                           <div class="d-flex align-items-center bods">
                              <div class="picsur">
                                 <img src="<?php echo $admin_pic; ?>">
                              </div>
                              <p class="fw-bold"> <?php echo $row['observer_name'] ?> </p>
                           </div>
                           <p class="fw-bold"> <?php echo date('M j, Y', strtotime($row['date'])); ?></p>
                        </div>
                     </a>
                  </div>
               </div>
               <!-----------===============- ARCHIVE CLASS MODAL -===============------------------>
               <div class="modal" id="archive_class_modal_<?php echo $row['report_info_id'] . '_' . $row['report_stu_id'] . '_' . $row['report_ins_id'] . '_' . $row['report_com_id']; ?>">
                  <div class="modal-dialog modal-dialog-centered" data-bs-backdrop="false">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Archive report?</h5>
                        </div>
                        <div class="modal-body fw-bold">
                           <?php echo $row['section'].', '.date('M j Y', strtotime($row['date'])); ?>
                        </div>
                        <div class="modal-footer p-2 delete_class_confirmation">
                           <form action="../process_faculty.php?report_info_id=<?php echo $row['report_info_id']; ?>&report_stu_id=<?php echo $row['report_stu_id']; ?>&report_ins_id=<?php echo $row['report_ins_id']; ?>&report_com_id=<?php echo $row['report_com_id']; ?>" method="POST">
                              <input type="submit" name="archive_class_report" value="Archive">
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
            <div>
               <a href="faculty_report.php" class="burubordigbutton"><i class="bi bi-arrow-return-left"></i></a>
            </div>
            <div class="text-center fw-bold pagorflok">
               <p>No Report Found</p>
            </div>
         <?php
      }
   }

   //search archive
   if(isset($_GET['faculty_search_archive'])){
      $filter_search = mysqli_real_escape_string($conn, $_GET['faculty_search_archive']);
      $search_archive = mysqli_query($conn, "SELECT info.*,stu.*,ins.*,com.* 
      FROM `class_report_info` info 
      LEFT JOIN `class_report_stu` stu ON info.report_info_id = stu.report_stu_id
      LEFT JOIN `class_report_ins` ins ON info.report_info_id = ins.report_ins_id
      LEFT JOIN `class_report_com` com ON info.report_info_id = com.report_com_id
      WHERE CONCAT(info.section, info.observer_name, info.subject) LIKE '%$filter_search%'
      AND info.faculty_id = '$faculty_ID' AND info.faculty_archive = FALSE");
      if(mysqli_num_rows($search_archive) > 0){
         ?>
            <div class="mb-3">
               <a href="faculty_archive.php" class="burubordigbutton"><i class="bi bi-arrow-return-left"></i></a>
            </div>
         <?php
         while($row = mysqli_fetch_assoc($search_archive)){
            $admin_ID = $row['admin_id'];
            $select_admin_pic = mysqli_query($conn, "SELECT * FROM `admin_pic` WHERE `id` = '$admin_ID'");
            $fecth_admin_pic = mysqli_fetch_assoc($select_admin_pic);
            if($fecth_admin_pic){
               $admin_pic = "http://localhost/ALPerf/" . $fecth_admin_pic['admin_pic_path'];
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
                           <p class="fw-bold"> <?php echo date('M j, Y', strtotime($row['date'])); ?></p>
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
            <div>
               <a href="faculty_archive.php" class="burubordigbutton"><i class="bi bi-arrow-return-left"></i></a>
            </div>
            <div class="text-center fw-bold pagorflok">
               <p>No Archive Found</p>
            </div>
         <?php
      }
   }
?>