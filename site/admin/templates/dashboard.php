<?php 
namespace App\Controllers; 
use App\Helpers\Helpers;

Helpers::urlSecurityAudit();



echo $this->get_header();





?>
<!-- Content Wrapper. Contains page content -->



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">

                        <?php
                        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                       
                            if (@$_GET['action'] == 'listmenus') {
                                if (@$_GET['status'] == 1) {
                                    echo ' Menu Published ';
                                } else {
                                    echo ' Menu Unpublished ';
                                }
                            } elseif (@$_GET['action'] == 'listpages') {
                                //echo 'Page Creation ';
								if (@$_GET['status'] == 1) {
                                    echo ' Page Published ';
                                } else {
                                    echo 'Page Unpublished ';
                                }
                            } elseif (@$_GET['action'] == 'listmenuorders') {
                                echo 'Main-Menu Reorder';
                            } elseif (@$_GET['action'] == 'listexams') {
                                echo 'Exam Creation  ';
                            } elseif (@$_GET['action'] == 'listnominations') {
                                echo 'Nomination Creation  ';
                            } elseif (@$_GET['action'] == 'listselectionposts') {
                                echo 'Selection Posts Creation  ';
                            }
							elseif (@$_GET['action'] == 'listdebarredlists') {
                                echo 'Debarred List Creation  ';
                            }elseif (@$_GET['action'] == 'listofloginusers') {
                                echo 'List of Login User';
                            }elseif (@$_GET['action'] == 'listsubmenuorders') {
                                echo 'Sub-Menu Reorder';


                            }elseif (@$_GET['action'] == 'listsubmenuordersnew') {
                                echo 'Sub-Menu Reorder New';







                            }elseif (@$_GET['action'] == 'listphotogallery') {
                                echo 'Photo Gallery';
                            }elseif (@$_GET['action'] == 'listofcategory') {
                                echo 'Category';
                            }elseif (@$_GET['action'] == 'listofnotices') {
                                echo 'Notice';
                            }elseif (@$_GET['action'] == 'listoftenders') {
                                echo 'Tender';
                            }elseif (@$_GET['action'] == 'listofimportantlinks') {
                                echo 'Important Links';
                            } 
							elseif (@$_GET['action'] == 'listofphotogallery') {
                                echo 'Photo Gallery';
                            }
							elseif (@$_GET['action'] == 'listofeventcategories') {
                                echo 'Event Category';
                            }
                            /***
                            *
                            *
                            * #faq
                            */
                           elseif (@$_GET['action'] == 'listoffaq') {
                            echo 'FAQ';
                            }

                            /***
                            *
                            *
                            * Nomination Category Reorder 
                            */
                           elseif (@$_GET['action'] == 'listnominationreorders') {
                            echo 'Nomination Reorder';
                            }


                             /***
                            *
                            *
                            * Selection Post Category Reorder 
                            */
                           elseif (@$_GET['action'] == 'listselectionpostreorders') {
                            echo 'Selection Post Reorder';
                            }

                             /***
                            *
                            *
                            * Selection Post Category Reorder 
                            */
                           elseif (@$_GET['action'] == 'listnomination_archieves') {
                            echo 'Nomination Archieves';
                            }
                            elseif (@$_GET['action'] == 'listnominationsarchieves') {
                                echo 'Nomination Archieves';
                            }
                            elseif (@$_GET['action'] == 'listselectionpostsarchives') {
                                echo 'Selection Post Archieves';
                            }
                            elseif (@$_GET['action'] == 'listnoticesarchieves') {
                                echo 'Notices Archieves';
                            }
                            elseif (@$_GET['action'] == 'listtenderarchieves') {
                                echo 'Tender Archieves';
                            }
                            elseif (@$_GET['action'] == 'listoftenders') {
                                echo 'Tender';
                            }
                        
 

							
							
							
                        ?>
                    </h1>
                </div><!-- /.col -->
                <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
    <!-- Main content -->
    <!--<section class="content">-->
    <?php if (isset($message_type)) : ?>
        <div class="alert alert-<?php echo $message_type; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <?php

        if (@$_GET['action'] == 'listmenus') {
            require_once 'list-menu.php';
        } elseif (@$_GET['action'] == 'listpages') {
            require_once 'list-page.php';
        } elseif (@$_GET['action'] == 'listmenuorders') {
            require_once 'list-menureorder.php';
        } elseif (@$_GET['action'] == 'listexams') {
            require_once 'list-exam.php';
        } elseif (@$_GET['action'] == 'listnominations') {
            require_once 'list-nomination.php';
        } elseif (@$_GET['action'] == 'listselectionposts') {
            require_once 'list-selectionposts.php';
        }elseif (@$_GET['action'] == 'listdebarredlists') {
            require_once 'list-debarredlist.php';
        }elseif (@$_GET['action'] == 'listofloginusers') {
            require_once 'list-login-users.php';
        }elseif (@$_GET['action'] == 'listsubmenuorders') {
            require_once 'list-submenureorder.php';


            


        }elseif (@$_GET['action'] == 'listsubmenuordersnew') {
            require_once 'list-submenureordernew.php';






        }elseif (@$_GET['action'] == 'listphotogallery') {
            require_once 'list-photogallery.php';
        }elseif (@$_GET['action'] == 'listofcategory') {
            require_once 'list-category.php';
        }elseif (@$_GET['action'] == 'listofnotices') {
             require_once 'list-notices.php'; // commented for testing
           // require_once 'list-common-dt.php';
            
        }elseif (@$_GET['action'] == 'listoftenders') {
            require_once 'list-tender.php';
        }elseif (@$_GET['action'] == 'listofimportantlinks') {
            require_once 'list-importantlinks.php';
        }elseif (@$_GET['action'] == 'listofphotogallery') {
            require_once 'list-photogallery.php';
        }elseif (@$_GET['action'] == 'listofeventcategories') {
            require_once 'list-eventcategories.php';
        }
        /***
        *
        * #faq
        */
        elseif (@$_GET['action'] == 'listoffaq') {
            require_once 'list-faq.php';
        }

        /***
        *
        *
        * Nomination Category Reorder 
        */
        elseif (@$_GET['action'] == 'listnominationreorders') {
            require_once 'list-nominationreorder.php';
        }

        /***
        *
        *
        * Selection Post Category Reorder 
        */
        elseif (@$_GET['action'] == 'listselectionpostreorders') {
            require_once 'list-selectionpostreorder.php';
        }

        /***
        *
        *
        * Selection Post Category Reorder 
        */
        elseif (@$_GET['action'] == 'listckeditor' && $_GET['type']== 'image') {
           // echo 'stalin';
            require_once 'ck_upload.php';
        }

        elseif (@$_GET['action'] == 'listckeditor' && $_GET['type']== 'file') {
            // echo 'stalin';
             require_once 'ck_upload.php';
         }

         elseif (@$_GET['action'] == 'listnomination_archieves') {
            // echo 'stalin';
             require_once 'nomination_archieves.php';
         }

         elseif (@$_GET['action'] == 'listnominationsarchieves') {
            require_once 'list-nomination-archieves.php';
        }
        elseif (@$_GET['action'] == 'listselectionpostsarchives') {
            require_once 'list-selectionposts-archieves.php';
        }
        elseif (@$_GET['action'] == 'sp_archieves_by_month') {
            require_once 'sp_archieves_by_month.php';
        }
        elseif (@$_GET['action'] == 'listnoticesarchieves') {
            require_once 'list-notices-archieves.php';
        }
        elseif (@$_GET['action'] == 'notices_archieves_by_month') {
            require_once 'notices_archieves_by_month.php';
        }
        elseif (@$_GET['action'] == 'listtenderarchieves') {
            require_once 'list-tender-archieves.php';
        }
        elseif (@$_GET['action'] == 'listoftenders') {
            //    require_once 'list-tender.php'; // commented for testing
            require_once 'list-tender.php';
            
        }

 


    ?>



    <!-- </section>-->
    <!-- /.content -->
    <!-- /.content -->
</div>
<?php echo $this->get_footer(); ?>

<style>
.alert{
	margin: 8px;
}
</style>