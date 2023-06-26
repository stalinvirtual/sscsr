<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><a href="<?php echo $create_exam_link; ?>" class="btn btn-primary pull-right" style="margin-top:-30px"><span class="glyphicon glyphicon-plus-sign"></span> Add Exam</a></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Exam Name</th>
                                <th>Exam Code </th>
                                <th> Exam Date</th>
                                <th> Exam Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($exams as $sn => $exam) :
                                $delete_exam_link_str = str_replace("{id}", $exam->id, $delete_exam_link);
                                $edit_exam_link_str = str_replace("{id}", $exam->id, $edit_exam_link);


                            ?>
                                <tr>
                                    <td><?= ++$sn; ?></td>
                                    <td><?= $exam->exam_name ?></td>
                                    <td><?= $exam->exam_code ?></td>
                                    <td><?= $exam->exam_date ?></td>



                                    <td><?= $exam->exam_time ?></td>

                                    <td>
                                        <form method="post">
                                            <!-- <input type="submit" class="btn btn-info" name="update" value="Edit"> -->
                                            <a href="<?php echo $edit_exam_link_str; ?>" name="page_update" class="iconSize">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="<?php echo $delete_exam_link_str; ?>" onClick="return confirm('Are you sure you want to delete? This operation will delete the children menu if any? and this cannot be undo');" class="iconSize" name="delete">
                                                <i class="fa fa-trash"></i>
                                            </a>

                                            <!-- <i class="fa fa-envelope" style="font-size:24px"><input type="submit" class="btn btn-info" name="update"></i> -->
                                            <!-- <input type="submit" onClick="return confirm('Please confirm deletion');" class="btn btn-danger" name="delete" value="Delete"> -->
                                            <?php
                                            if ($user_role_id == 2 || $user_role_id == 1) {
                                                // if ($status == 0 || $status == 1) {
                                                //echo '<input type="submit" class="btn btn-warning" name="view" value="View">';

                                                //echo '<button type="submit" class="iconSize" name="view"><i class="fa fa-eye"></i></button>';
                                                // }
                                                //} else {
                                                //if ($status == 0) {
                                                echo '<button type="submit" class="iconSize" name="view"><i class="fa fa-eye"></i></button>';
                                                //}
                                            }
                                            ?>
                                            <input type="hidden" value="<?= $menu->m_menu_id ?>" name="menu_id">
                                        </form>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
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