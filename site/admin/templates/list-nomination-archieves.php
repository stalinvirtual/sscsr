<div class="container-fluid">
   <div class="row">
       <div class="col-12">
           <div class="card">
 
               <?php
 
date_default_timezone_set("Etc/GMT+8");
 
               if ($is_publisher == 1) {
               } else { ?>
 
                   <div class="card-header">
                    
                       <h3 class="card-title" style="margin-right: 10px;"><a href="<?php echo $list_nomination_link; ?>" class="btn btn-primary pull-right" style="margin-top:-30px;padd"><span class="glyphicon glyphicon-plus-sign"></span> Main Page </a></h3>
                   </div>
                 
 
               <?php }
 
               ?>
 
               <!-- /.card-header -->
               <div class="card-body">
                   <table id="example2" class="table table-bordered table-hover">
                       <thead>
                           <tr>
                               <th>Sr.No</th>
                               <th width='100px'>Exam Name</th>
                               <th>Date  Val</th>
                               <th>Category Name  </th>
                              
                               <th>Pdf File</th>
                               <th>Status</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php
 
                          //$date = date("Y-m-d");
 
 
 
                          
                           foreach ($nominationsarchieves as $sn => $nomination) :
 
                               // $due_date = date('Y-m-d', strtotime($nomination->effort_from_date));
                               // if(strtotime($due_date) < strtotime($date)){
                               $delete_nomination_link_str = str_replace("{id}", $nomination->nomination_id, $delete_nomination_link);
                               $edit_nomination_link_str = str_replace("{id}", $nomination->nomination_id, $edit_nomination_link);
                               //$preview_url  = ($nomination->menu_type == 3) ? $nomination->menu_link : $this->route->site_url($nomination->menu_link);
                               // $view_nomination_link_str = str_replace("{id}", $nomination->id, $view_nomination_link);
                           ?>
                               <tr>
                                   <td><?= ++$sn; ?></td>
                                   <td><?= $nomination->exam_name ?></td>
                                   <td><?= date('Y-m-d', strtotime($nomination->date_archived)) ?></td>
                                   <td><?= $nomination->category_name ?></td>
                                  
 
                                   <td>
                                       <?php
 
 
                                       foreach ($nominationarchieveschildlist as $key => $childlist) :
                                           $selected = "";
                                           if ($nomination->nomination_id == $childlist->nomination_id) {
                                               $selected = "selected=\"selected\"";
                                               $uploadPath = 'nominations' . '/' . $childlist->attachment;
                                               $file_location = $this->route->get_base_url() . "/" . $uploadPath; ?>
 
                                               <a href="<?= $file_location ?>" target="_blank"><?= $childlist->pdf_name ?></a>,<br>
                                           <?php }
 
 
                                           ?>
 
                                       <?php endforeach; ?>
 
 
 
 
                                   </td>
                                   <td><?php if ($nomination->p_status == 1) {
                                           echo '<i class="fa fa-flag" aria-hidden="true"  style="color:green"></i>';
                                       } else {
                                           echo '<i class="fa fa-flag" aria-hidden="true" style="color:red"></i>';
                                       }   ?>
                                   </td>
                                   <td>
                                       <!--  Form Start  --->
 
 
 
 
                                       <form method="post">
                                           <?php
 
                                           if ($is_superadmin == 1) { ?>
 
 
                                               <a href="<?php echo $edit_nomination_link_str; ?>" name="menu_update" class="iconSize">
                                                   <i class="fa fa-edit"></i>
                                               </a>
                                               <a href="<?php echo $delete_nomination_link_str; ?>" onClick="return confirm('Are you sure you want to delete? This operation will delete the children menu if any? and this cannot be undo');" class="iconSize" name="delete">
                                                   <i class="fa fa-trash"></i>
                                               </a>
                                               <?php
                                               if (@$_GET['status'] == 0 && $nomination->p_status != 1) {
                                                   echo '<i class="fa fa-eye nomination-archives-publish-button" style="color:#007bff"></i>';
                                               }
                                           } else if ($is_admin == 1) { ?>
 
 
                                               <!-- <a href="<?php //echo $edit_nomination_link_str; ?>" name="menu_update" class="iconSize">
                                                   <i class="fa fa-edit"></i>
                                               </a> -->
                                               <!-- <a href="<?php //echo $delete_nomination_link_str; ?>" onClick="return confirm('Are you sure you want to delete? This operation will delete the children menu if any? and this cannot be undo');" class="iconSize" name="delete">
                                                   <i class="fa fa-trash"></i>
                                               </a> -->
                                               <?php
                                               if (@$_GET['status'] == 0 && $nomination->p_status != 1) {
                                                   echo '<i class="fa fa-eye nomination-archives-publish-button" style="color:#007bff"></i>';
                                               }
                                           } elseif ($is_uploader == 1) { ?>
                                               <!-- <a href="<?php //echo $edit_nomination_link_str; ?>" name="menu_update" class="iconSize">
                                                   <i class="fa fa-edit"></i>
                                               </a>
                                               <a href="<?php //echo $delete_nomination_link_str; ?>" onClick="return confirm('Are you sure you want to delete? This operation will delete the children menu if any? and this cannot be undo');" class="iconSize" name="delete">
                                                   <i class="fa fa-trash"></i>
                                               </a> -->
 
                                           <?php } else {
                                               if (@$_GET['status'] == 0 && $nomination->p_status != 1) {
                                                   echo '<i class="fa fa-eye nomination-archives-publish-button" style="color:#007bff"></i>';
                                               }
                                           }
                                           ?>
                                           <input type="hidden" value="<?= $nomination->nomination_id ?>" name="nomination_id" id="nomination_id">
                                       </form>
                                       <!--  Form Start  --->
                                   </td>
 
                               </tr>
                           <?php
 
 
                                    //   }
                      
                       endforeach; ?>
                           <?php //}
                           ?>
                       </tbody>
 
                   </table>
               </div>
               <!-- /.card-body -->
           </div>
           <!-- /.card -->
       </div>
       <!-- /.col -->
   </div>
   <!-- /.row -->
</div>
