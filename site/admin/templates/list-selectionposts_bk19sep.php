<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <?php
                if ($is_publisher == 1) {
                } else {
                ?>
                    <div class="card-header">
                        <h3 class="card-title" style="padding-top:30px !important"><a href="<?php echo $create_selection_post_link; ?>" class="btn btn-primary pull-right" style="margin-top:-30px"><span class="glyphicon glyphicon-plus-sign"></span> Add Selection Post </a></h3>

                        <h3 class="card-title" style="margin-right: 10px;padding-top:30px !important"><a href="<?php echo $list_selection_posts_archives_link; ?>" class="btn btn-primary pull-right" style="margin-top:-30px;"><span class="glyphicon glyphicon-plus-sign"></span> Archives </a></h3>
                    </div>

                    



                <?php  }

                ?>












                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Exam Name</th>
                                <th>Category Name </th>
                                <th>Phase Name </th>
                                <th>Pdf File</th>
                                <th>Status</th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($selectposts_new as $sn => $selectionpost) :
                                $delete_selection_post_link_str = str_replace("{id}", $selectionpost->selection_post_id, $delete_selection_post_link);
                                $edit_selection_post_link_str = str_replace("{id}", $selectionpost->selection_post_id, $edit_selection_post_link);
                                //$preview_url  = ($nomination->menu_type == 3) ? $nomination->menu_link : $this->route->site_url($nomination->menu_link);
                                // $view_nomination_link_str = str_replace("{id}", $nomination->id, $view_nomination_link);
                            ?>
                                <tr>
                                    <td><?= ++$sn; ?></td>
                                    <td><?= $selectionpost->exam_name ?></td>
                                    <td><?= $selectionpost->category_name ?></td>
                                    <td><?= $selectionpost->phase_name ?></td>
                                    <td>
                                        <?php


                                        foreach ($selectpostschildlist as $key => $childlist) :
                                            $selected = "";
                                            if ($selectionpost->selection_post_id == $childlist->selection_post_id) {
                                                $selected = "selected=\"selected\"";
                                                $uploadPath = 'selectionposts' . '/' . $childlist->attachment;
                                                $file_location = $this->route->get_base_url() . "/" . $uploadPath; ?>

                                                <a href="<?= $file_location ?>" target="_blank"><?= $childlist->pdf_name ?></a><br>
                                            <?php }


                                            ?>

                                        <?php endforeach; ?>




                                    </td>
                                    <td><?php if ($selectionpost->p_status == 1) {
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


                                                <a href="<?php echo $edit_selection_post_link_str; ?>" name="menu_update" class="iconSize">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="<?php echo $delete_selection_post_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <?php
                                                if (@$_GET['status'] == 0 && $selectionpost->p_status != 1) {
                                                    echo '<i class="fa fa-eye selectionpost-publish-button" style="color:#007bff"></i>';
                                                }
                                            } else if ($is_admin == 1) { ?>


                                                <a href="<?php echo $edit_selection_post_link_str; ?>" name="menu_update" class="iconSize">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="<?php echo $delete_selection_post_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <?php
                                                if (@$_GET['status'] == 0 && $selectionpost->p_status != 1) {
                                                    echo '<i class="fa fa-eye selectionpost-publish-button" style="color:#007bff"></i>';
                                                }
                                            } elseif ($is_uploader == 1) { ?>
                                                <a href="<?php echo $edit_selection_post_link_str; ?>" name="menu_update" class="iconSize">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="<?php echo $delete_selection_post_link_str; ?>" onClick="return confirm('Are you sure you want to delete? ');" class="iconSize" name="delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>

                                            <?php } else {
                                                if (@$_GET['status'] == 0 && $selectionpost->p_status != 1) {
                                                    echo '<i class="fa fa-eye selectionpost-publish-button" style="color:#007bff"></i>';
                                                }
                                            }
                                            ?>
                                            <input type="hidden" value="<?= $selectionpost->selection_post_id ?>" name="id" id="selection_post_id">
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