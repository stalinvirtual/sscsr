<?php
  error_reporting(0); 
  ?>
<div class="container-fluid">
   <div class="row">
       <div class="col-12">
           <div class="card">
               <div class="card-header">
                   <h3 class="card-title"><a href="<?php echo $create_faq_link; ?>" class="btn btn-primary pull-right" style="margin-top:-30px"><span class="glyphicon glyphicon-plus-sign"></span> Add FAQ </a></h3>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                   <table id="example2" class="table table-bordered table-hover">
                       <thead>
                           <tr>
                               <th>Sr.No</th>
                               <th>Faq Qns </th>
                               <th>Faq Ans</th>
                               <th>Status</th>
                               <th> Action </th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php
 
                          
                           foreach (@$faqlists as $sn => $faqlist) :
                               $delete_faq_link_str = str_replace("{id}", $faqlist->faq_id, $delete_faq_link);
                               $edit_faq_link_str = str_replace("{id}", $faqlist->faq_id, $edit_faq_link);
                               //$preview_url  = ($nomination->menu_type == 3) ? $nomination->menu_link : $this->route->site_url($nomination->menu_link);
                               // $view_nomination_link_str = str_replace("{id}", $nomination->id, $view_nomination_link);
                           ?>
                               <tr>
                                   <td><?= ++$sn; ?></td>
                                   <td><?= $faqlist->faq_title ?></td>
                                   <td><?= $faqlist->faq_content ?></td>
                                  
                                       <td><?php if($faqlist->p_status ==1)
                                   {
                                       echo '<i class="fa fa-flag" aria-hidden="true"  style="color:green"></i>';
                                   }else{
                                       echo '<i class="fa fa-flag" aria-hidden="true" style="color:red"></i>';
                                   }   ?>
                                   </td>
                                 
                                  
                                   <td>
                                       <!--  Form Start  --->
                                     
                                      <form method="post">
                                          <?php
                                         
                                               if($is_superadmin==1){?>
                                                  
                                                  
                                                   <a href="<?php echo $edit_faq_link_str ;?>" name="menu_update" class="iconSize">
                                                       <i class="fa fa-edit"></i>
                                                   </a>
                                                   <a href="<?php echo $delete_faq_link_str; ?>" onClick="return confirm('Are you sure you want to delete?');" class="iconSize" name="delete">
                                                       <i class="fa fa-trash"></i>
                                                   </a>
                                                   <?php
                                                   if (@$_GET['status'] == 0 && $faqlist->p_status != 1){
                                                       echo '<i class="fa fa-eye faq-publish-button" style="color:#007bff"></i>';
                                                   }
                                                  
                                               }
                                         
                                               else if($is_admin==1){?>
                                              
                                              
                                                   <a href="<?php echo $edit_faq_link_str;?>" name="menu_update" class="iconSize">
                                                       <i class="fa fa-edit"></i>
                                                   </a>
                                                   <a href="<?php echo $delete_faq_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
                                                       <i class="fa fa-trash"></i>
                                                   </a>
                                                   <?php
                                                   if (@$_GET['status'] == 0 && $faqlist->p_status != 1){
                                                       echo '<i class="fa fa-eye faq-publish-button" style="color:#007bff"></i>';
                                                   }
                                                  
                                                  
                                                }
                                               elseif($is_uploader==1 ){ ?>
                                                   <a href="<?php echo $edit_faq_link_str;?>" name="menu_update" class="iconSize">
                                                       <i class="fa fa-edit"></i>
                                                   </a>
                                                   <a href="<?php echo $delete_faq_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
                                                       <i class="fa fa-trash"></i>
                                                   </a>
                                                  
                                               <?php }
                                              
                                               else{
                                                   if (@$_GET['status'] == 0 && $faqlist->p_status != 1){
                                                       echo '<i class="fa fa-eye faq-publish-button" style="color:#007bff"></i>';
                                                   }
 
 
                                                   }
                                          ?>
                                          <input type="hidden" value="<?= $faqlist->faq_id ?>" name="id" id="faq_id">
                                       </form>
                                      <!--  Form Start  --->
                                   </td>
 
                               </tr>
                           <?php endforeach; ?>
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
