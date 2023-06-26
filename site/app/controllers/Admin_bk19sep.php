<?php

namespace App\Controllers;

use App\System\Route;
use App\Helpers\Helpers;
use App\Models\Candidate;
use App\Models\Faq as Faq;
use App\Models\Menu as Menu;
use App\Models\Page as Page;
use App\Models\Post as Post;
use App\Models\Users as User;
use App\Models\Phase as Phase;
use App\Models\TenderArchives;
use App\Models\Notice as Notice;
use App\Models\Tender as Tender;
use App\Models\Gallery as Gallery;
use App\Models\Category as Category;
use App\Controllers\BackEndController;
use App\Models\Department as Department;
use App\Models\Loginusers as Loginusers;
use App\Models\Nomination as Nomination;
use App\Models\NominationArchieveschild;
use App\Models\GalleryChild as GalleryChild;
use App\Models\Debarredlists as Debarredlists;
use App\Models\EventCategory as EventCategory;
use App\Models\Selectionpost as Selectionpost;
use App\Models\ImportantLinks as ImportantLinks;
use App\Models\NoticeArchives as NoticeArchives;
use App\Models\Nominationchild as Nominationchild;
use App\Models\NominationArchieves as NominationArchieves;
use App\Models\Selectionpostschild as Selectionpostschild;
use App\Models\SelectionpostArchives as SelectionpostArchives;
use App\Models\SelectionpostschildArchives as SelectionpostschildArchives;







ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Admin extends BackEndController
{
    public $links = array(
        "gallery_link" => "Admin/dashboard/?action=listofphotogallery",
        "event_category_link" => "Admin/dashboard/?action=listofeventcategories",


        "important_link" => "Admin/dashboard/?action=listofimportantlinks",
        "tender_link" => "Admin/dashboard/?action=listoftenders",
        "notice_link" => "Admin/dashboard/?action=listofnotices",
        "category_link" => "Admin/dashboard/?action=listofcategory",
        "photogallery_link" => "Admin/dashboard/?action=listphotogallery",
        "list_exams_link" => "Admin/dashboard/?action=listexams",
        "menus_reorder_link" => "Admin/dashboard/?action=listmenuorders",
        "category_reorder_nomination_link" => "Admin/dashboard/?action=listnominationreorders",
        "category_reorder_sp_link" => "Admin/dashboard/?action=listselectionpostreorders",





        "sub_menus_reorder_link" => "Admin/dashboard/?action=listsubmenuorders",
        "sub_menus_reorder_link_new" => "Admin/dashboard/?action=listsubmenuordersnew",






        "create_exam_link" => "Admin/editexam",
        "edit_exam_link" => "Admin/editexam/{id}",
        "delete_exam_link" => "Admin/deleteexam/{id}",
        "view_exam_link" => "Admin/viewexam/{id}",
        "list_menu_link" => "Admin/dashboard/?action=listmenus",
        "create_menu_link" => "Admin/editmenu",
        "edit_menu_link" => "Admin/editmenu/{id}",
        "view_menu_link" => "Admin/viewmenu/{id}",
        "delete_menu_link" => "Admin/deletemenu/{id}",
        "published_menus_list_link" => "Admin/dashboard/?action=listmenus&&status=1",
        "unpublished_menus_list_link" => "Admin/dashboard/?action=listmenus&&status=0",

        "list_page_link" => "Admin/dashboard/?action=listpages",
        "create_page_link" => "Admin/editpage",
        "edit_page_link" => "Admin/editpage/{id}",
        "view_page_link" => "Admin/viewpage/{id}",
        "delete_page_link" => "Admin/deletepage/{id}",
        ##### page  published & Page unpublished ######
        "published_pages_list_link" => "Admin/dashboard/?action=listpages&&status=1",
        "unpublished_pages_list_link" => "Admin/dashboard/?action=listpages&&status=0",
        ##### page  published & Page unpublished ######



        "create_candidate_link" => "Admin/editcandidate",
        "edit_candidate_link" => "Admin/editcandidate/{id}",
        "delete_candidate_link" => "Admin/deletecandidate/{id}",
        "view_candidate_link" => "Admin/viewcandidate/{id}",

        "list_nomination_link" => "Admin/dashboard/?action=listnominations",


        "list_nomination_archives_link" => "Admin/dashboard/?action=listnominationsarchieves",




        "nomination_archieves" => "Admin/dashboard/?action=listnomination_archieves",

        "sp_archieves_by_month" => "Admin/dashboard/?action=sp_archieves_by_month",



        "list_notices_archives_link" => "Admin/dashboard/?action=listnoticesarchieves",

        "notices_archieves_by_month" => "Admin/dashboard/?action=notices_archieves_by_month",




        "list_tender_archives_link" => "Admin/dashboard/?action=listtenderarchieves",

        "tender_archieves_by_month" => "Admin/dashboard/?action=tender_archieves_by_month",


        "common_nomination_archive" => "Admin/commonNominationArchive",
        "tender_boy" => "Admin/ArchiveTest",












        "create_nomination_link" => "Admin/editnomination",
        "edit_nomination_link" => "Admin/editnomination/{id}",
        "delete_nomination_link" => "Admin/deletenomination/{id}",

        "list_selection_posts_link" => "Admin/dashboard/?action=listselectionposts",

        "list_selection_posts_archives_link" => "Admin/dashboard/?action=listselectionpostsarchives",



        "create_selection_post_link" => "Admin/editselectionpost",
        "edit_selection_post_link" => "Admin/editselectionpost/{id}",
        "delete_selection_post_link" => "admin/deleteselectionpost/{id}",

        "list_ckeditor_link_file" => "Admin/dashboard/?action=listckeditor&type=file",
        "list_ckeditor_link_image" => "Admin/dashboard/?action=listckeditor&type=image",







        "list_debarred_lists_link" => "Admin/dashboard/?action=listdebarredlists",
        "create_debarred_lists_link" => "Admin/editdebarredlists",
        "edit_debarred_lists_link" => "Admin/editdebarredlists/{id}",
        "delete_debarred_lists_link" => "admin/deletedebarredlists/{id}",


        "list_of_login_user_details" => "Admin/dashboard/?action=listofloginusers",
        "create_login_user_link" => "Admin/editloginuser",
        "edit_login_user_link" => "Admin/editloginuser/{id}",
        "delete_login_user_link" => "admin/deleteloginuser/{id}",

        "list_of_category" => "Admin/dashboard/?action=listofcategory",
        "create_category_link" => "Admin/editcategory",
        "edit_category_link" => "Admin/editcategory/{id}",
        "delete_category_link" => "admin/deletecategory/{id}",



        "list_of_notices" => "Admin/dashboard/?action=listofnotices",
        "create_notice_link" => "Admin/editnotice",
        "edit_notice_link" => "Admin/editnotice/{id}",
        "delete_notice_link" => "admin/deletenotice/{id}",


        /*****
         * #
         * FAQ
         *
         */

        "list_of_faq" => "Admin/dashboard/?action=listoffaq",
        "create_faq_link" => "Admin/editfaq",
        "edit_faq_link" => "Admin/editfaq/{id}",
        "delete_faq_link" => "admin/deletefaq/{id}",
        /*****
         *
         * FAQ
         *
         */



        "list_of_tenders" => "Admin/dashboard/?action=listoftenders",
        "create_tender_link" => "Admin/edittender",
        "edit_tender_link" => "Admin/edittender/{id}",
        "delete_tender_link" => "admin/deletetender/{id}",

        "common_archives__link" => "admin/archiveBtnFunction/{id}",
        "copy_tender_link" => "admin/copy-tender/{id}",


        "list_of_importantlinks" => "Admin/dashboard/?action=listofimportantlinks",
        "create_important_link" => "Admin/editimportantlink",
        "edit_important_link" => "Admin/editimportantlink/{id}",
        "delete_important_link" => "admin/deleteimportantlink/{id}",



        //Event Category 

        "list_of_event_categories" => "Admin/dashboard/?action=listofeventcategories",
        "create_event_category_link" => "Admin/editeventcategory",
        "edit_event_category_link" => "Admin/editeventcategory/{id}",
        "delete_event_category_link" => "admin/deleteeventcategory/{id}",
        //Event Category 


        //Photo Gallery

        "list_of_gallery" => "Admin/dashboard/?action=listofgallery",
        "create_gallery_link" => "Admin/editgallery",
        "edit_gallery_link" => "Admin/editgallery/{id}",
        "delete_gallery_link" => "admin/deletegallery/{id}",
        //Photo Category 


    );
    public function  __construct($param_data = array())
    {
        parent::__construct($param_data);
        $this->setTheme("admin");
        // since al admin pages are authorized, redirect if the session is gone
        if (!isset($_SESSION['user'])) {
            $this->logout();
        }
    }
    public function index()
    {
        print_r($_POST);
        $this->dashboard();
    }
    public function dashboard()
    {
        // check for add menu
        $user = new User();
        $loginUser = $user->getUser();
        ########  Role checking ########

        $is_superadmin = $user->is_superadmin(); // super admin 
        $data['is_superadmin'] = $is_superadmin; // super admin 

        $is_admin = $user->is_admin(); // admin 
        $data['is_admin'] = $is_admin; // admin 

        $is_uploader = $user->is_uploader(); //uploader
        $data['is_uploader'] = $is_uploader; //uploader

        $is_publisher = $user->is_publisher();  // publisher
        $data['is_publisher'] = $is_publisher;  // publisher

        ########  Role Checking ########

        if ($is_admin) {
        }
        $menu = new Menu();
        $status = isset($_GET['status']) ? $_GET['status'] : 0;

        #####  Menu Publish and Unpublished  Start #####

        if ($status == null  || $status == 0) {
            $menus = $menu->getMenus();
        } else {
            $menus = $menu->getAllPublishedMenus();
        }
        $data['menus'] = $menus;


        #####  Menu Publish and Unpublished End #####


        #####  Page Publish and Unpublished #####
        $page = new Page();
        if ($status == null  || $status == 0) {
            $pages = $page->getPagesUnpublished();
        } else {
            $pages = $page->getPagesPublished();
        }
        $data['pages'] = $pages;

        // echo '<pre>';
        //  print_r($data['pages']);
        #####  Page Publish and Unpublished #####

        $data['nominations'] = Helpers::getNominationListforAdmin();
        $date = date("Y-m-d");
        $nominationCount = count((array)$data['nominations']);

        /****
         * 
         * Nomination Archieves
         * 
         * 
         */


        $data['nominations_new'] = Helpers::getNominationListforAdmin();

        $data['nominationchildlist'] = Helpers::getNominationChildListforAdmin();



        // $data['nominationsarchieves'] = Helpers::getNominationArchievesListforAdmin();





        // $data['nominationarchieveschildlist'] = Helpers::getNominationArchievesChildListforAdmin();


        // echo '<pre>';
        //print_r($data['nominationarchieveschildlist']);



        /*****
         * 
         * Selection Post Archives
         * 
         */

        $data['selectionposts'] = Helpers::getSelectionpostListforAdmin();



        $data['selectposts_new'] = Helpers::getSelectionpostListforAdmin();
        $data['selectpostschildlist'] = Helpers::getSelectionpostchildListforAdmin();
        $data['selectionpostsarchieves'] = Helpers::getSelectionPostsArchievesListforAdmin();
        $data['selectionpostsarchieveschildlist'] = Helpers::getSelectionPostsArchievesChildListforAdmin();

        $data['noticecreationlists'] = Helpers::getNoticeListforAdmin();
        $data['noticecreationlists_new'] = Helpers::getNoticeListforAdmin();
        $data['noticecreationlistsarchives'] = Helpers::getNoticeListArchivesforAdmin();
        // $tendercreationlists = Helpers::getArchives("tendercreationlists","Tender","getTenderListforAdmin");

        //$creation_lists_new =  $tendercreationlists["creation_lists_new"] ;
        //  $data['creation_lists_new'] = $tendercreationlists["creation_lists_new"] ;
        //  $data['creation_lists_archives'] = $tendercreationlists["creation_lists_archives"] ;



        $data['categories'] = Helpers::getCategoryListforAdmin();
        $data['departments'] = Helpers::getDepartmentListforAdmin();
        $data['phases'] = Helpers::getPhaseListforAdmin();
        $data['posts'] = Helpers::getPostListforAdmin();

        $data['debarredgetlists'] = Helpers::getDebarredListforAdmin();
        $data['usercreationlists'] = Helpers::getUserCreationforAdmin();
        $data['categorycreationlists'] = Helpers::getCategoryCreationListforAdmin();


        /****
         *
         * #faq
         */
        $data['faqlists'] = Helpers::getFaqListforAdmin();



        $data['importantlinkscreationlists'] = Helpers::getImportantLinksListforAdmin();
        $data['eventcategorygetlists'] = Helpers::getEventCategoryListforAdmin();
        $data['gallerymodelgetlists'] = Helpers::getPhotoGalleryListforAdmin();
        $data['gallerymodelchildlist'] = Helpers::getPhotoGalleryChildListforAdmin();
        $data['user_role_id'] = (int) $loginUser['roleid'];
        $data['logged_user'] = $loginUser;
        //$data['status']  = $status;
        $this->prepare_menus($data);
        if (isset($_SESSION['notification'])) {
            $notification_data = $_SESSION['notification'];
            $data = array_merge($data, $notification_data);
            unset($_SESSION['notification']);
        }

        $this->render("dashboard", $data);
    }
    private function prepare_menus(&$data)
    {
        $link_routes = [];
        $route = new \App\System\Route();
        foreach ($this->links as $key => $route_str) {
            $link_routes[$key] = $route->site_url($route_str);
        }
        $data = array_merge($data, $link_routes);
    }

    public function editMenu()
    {
        $data = [];
        $this->saveMenu();
        $user = new User();
        $page = new Page();
        $loginUser = $user->getUser();

        ########  Role checking ########

        $is_superadmin = $user->is_superadmin(); // super admin 
        $data['is_superadmin'] = $is_superadmin; // super admin 

        $is_admin = $user->is_admin(); // admin 
        $data['is_admin'] = $is_admin; // admin 

        $is_uploader = $user->is_uploader(); //uploader
        $data['is_uploader'] = $is_uploader; //uploader

        $is_publisher = $user->is_publisher();  // publisher
        $data['is_publisher'] = $is_publisher;  // publisher

        ########  Role Checking ########


        $is_admin = $user->is_admin();
        $data['is_admin'] = $is_admin;
        $data['logged_user'] = $loginUser;
        $data['pages'] = $page->getPages();
        ob_start();
        if ($is_admin) {
        }
        $menu = new Menu();
        // chek if the id is available in the params 
        $menu_id = (isset($this->data['params'][0])) ? $this->data['params'][0] : 0;


        $current_menu = $menu->getMenu($menu_id, DB_ASSOC);
        $data['current_menu'] = $current_menu;


        // echo   '<pre>';
        // print_r( $data['current_menu']);
        // exit;




        $menus = $menu->getMenusDropdown();
        $data['menus'] = $menus;
        \App\Helpers\Helpers::showMenuOptions($menus, $current_menu['menu_parent_id'], $current_menu['id']);
        $data['renderedMenuOptions'] = ob_get_clean();
        $this->prepare_menus($data);
        $this->render("edit-menu", $data);
    }
    public function viewMenu()
    {
        $data = [];
        $this->saveMenu();
        $user = new User();
        $page = new Page();
        $loginUser = $user->getUser();
        $is_admin = $user->is_admin();
        $data['is_admin'] = $is_admin;
        $data['logged_user'] = $loginUser;
        $data['pages'] = $page->getPages();
        ob_start();
        if ($is_admin) {
        }
        $menu = new Menu();
        // chek if the id is available in the params 
        $menu_id = (isset($this->data['params'][0])) ? $this->data['params'][0] : 0;
        $current_menu = $menu->getMenu($menu_id, DB_ASSOC);
        $data['current_menu'] = $current_menu;
        $menus = $menu->getMenus();
        $data['menus'] = $menus;
        \App\Helpers\Helpers::showMenuOptions($menus, $current_menu['menu_parent_id'], $current_menu['id']);
        $data['renderedMenuOptions'] = ob_get_clean();
        $this->prepare_menus($data);
        $this->render("view-menu", $data);
    }
    private function saveMenu()
    {

        $message = $message_type = "";
        if (isset($_POST['save-menu'])) {


            if (@Helpers::cleanData($_POST['is_redirect_popup']) == 'on') {
                $is_redirect_popup = 1;
            } else {
                $is_redirect_popup = 0;
            }



            $menu_id = isset($_POST['id']) ? $_POST['id'] : 0;


            if (isset($_FILES['attachment']) && $_FILES['attachment']['name'] != "") {
                //pdf upload function

                $file = rand(1000, 100000) . "-" . $_FILES['attachment']['name'];
                $file_loc = $_FILES['attachment']['tmp_name'];
                $file_size = $_FILES['attachment']['size'];
                $file_type = $_FILES['attachment']['type'];
                $folder = './uploads/';
                $new_size = $file_size / 1024;
                /* make file name in lower case */
                $new_file_name = strtolower($file);
                /* make file name in lower case */
                $final_file = str_replace(' ', '-', $new_file_name);
                if (move_uploaded_file($file_loc, $folder . $final_file)) {   // echo "File is valid, and was successfully uploaded.\n";
                } else {
                    echo "File size greater than 300kb!\n\n";
                }


                //pdf upload function
            } else {
                $final_file = "";
            }
            $menu_type = Helpers::cleanData($_POST['menu_type']);
            // echo $menu_type;


            if ($menu_type == 1) {
                $page = new Page();
                $menu_page_id_value = Helpers::cleanData($_POST['menu_page_id']);
                $menu_page_id = (int) $menu_page_id_value;
                $data['pages'] = $page->pageDetails($menu_page_id);

                // print_r($data['pages']);
                $page_title = $data['pages']['title'];
                $page_title_remove_whitespace = str_replace(' ', '', $page_title);
                $page_title_lowercase = strtolower($page_title_remove_whitespace);
                $menu_link =  $page_title_lowercase;
                $menu_name = Helpers::cleanData($_POST['menu_name']);
            } else if ($menu_type == 2) {
                $menu_link = Helpers::cleanData($_POST['menu_link']);
                $menu_name = Helpers::cleanData($_POST['menu_name']);
            } else if ($menu_type == 3) {
                $menu_link = "";
                $menu_name = Helpers::cleanData($_POST['menu_name']);
            } else {
                $menu_name = Helpers::cleanData($_POST['menu_name']) . '&nbsp;<i class="fa fa-angle-down"></i>';
                $menu_link = Helpers::cleanData($_POST['menu_link']);
            }




            $menu =  new  \App\Models\Menu();
            $lastinsertedid = $menu->lastInsertedID();

            if ($final_file == '') {
                $final_file = Helpers::cleanData($_POST['pdflink']);
            }



            $menu_data = [
                'menu_parent_id' => Helpers::cleanData($_POST['menu_parent_id']),
                'menu_name' => $menu_name,
                'menu_link' => $menu_link,
                'menu_type' => Helpers::cleanData($_POST['menu_type']),
                'menu_page_id'   => (int) Helpers::cleanData($_POST['menu_page_id']),
                'menu_route'     => Helpers::cleanData($_POST['menu_route']),
                'menu_order'     => $lastinsertedid->max + 1,
                'status'         => 0,
                'attachment' => $final_file,
                'is_footer_menu' => Helpers::cleanData($_POST['is_footer_menu']),
                'is_redirect_popup' => $is_redirect_popup,



            ];


            // echo "<pre>";
            //print_r($menu_data);
            //exit; 

            if ($menu_id == 0) { // insert new menu 
                if ($menu->addMenu($menu_data)) {
                    $message = "Menu Added successfully";
                    $message_type = "success";
                } else {
                    $message = "Error adding menu";
                    $message_type = "warning";
                }
            } else { // update menu
                if ($menu->updateMenu($menu_data, $menu_id)) {
                    $message = "Menu Updated successfully";
                    $message_type = "success";
                } else {
                    $message = "Error updating Menu";
                    $message_type = "warning";
                }
            }
            $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
            $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listmenus&&status=0"));
        }
    }
    public function listPages()
    {
        // check for add menu


        $user = new User();
        $loginUser = $user->getUser();
        $is_admin = $user->is_admin();
        $data['is_admin'] = $is_admin;
        if ($is_admin) {
        }
        $page = new Page();
        $pages = $page->getPages();
        $data['pages'] = $pages;
        $data['user_role_id'] = (int) $loginUser['roleid'];
        $data['logged_user'] = $loginUser;

        $this->prepare_menus($data);
        if (isset($_SESSION['notification'])) {
            $notification_data = $_SESSION['notification'];
            $data = array_merge($data, $notification_data);
            unset($_SESSION['notification']);
        }
        $this->render("dashboard", $data);
    }
    public function editPage()
    {
        $data = [];
        $this->savePage();
        $user = new User();
        $loginUser = $user->getUser();



        ########  Role checking ########

        $is_superadmin = $user->is_superadmin(); // super admin 
        $data['is_superadmin'] = $is_superadmin; // super admin 

        $is_admin = $user->is_admin(); // admin 
        $data['is_admin'] = $is_admin; // admin 

        $is_uploader = $user->is_uploader(); //uploader
        $data['is_uploader'] = $is_uploader; //uploader

        $is_publisher = $user->is_publisher();  // publisher
        $data['is_publisher'] = $is_publisher;  // publisher

        ########  Role Checking ########

        $data['logged_user'] = $loginUser;

        //  ob_start();

        $page = new Page();
        // chek if the id is available in the params 
        $page_id = (isset($this->data['params'][0])) ? $this->data['params'][0] : 0;

        $current_page = $page->getPage($page_id, DB_ASSOC);
        $data['current_page'] = $current_page;
        $pages = $page->getPages();
        $data['pages'] = $pages;
        $this->prepare_menus($data);
        $this->render("edit-page", $data);
    }


    private function savePage()
    {
        $message = $message_type = "";
        if (isset($_POST['save-page'])) {

            $page_id = isset($_POST['page_id']) ? $_POST['page_id'] : 0;

            $page =  new  \App\Models\Page();
            $page_data = [
                'page_content' => htmlspecialchars(addslashes($_POST['page_content'])),
                'title' => Helpers::cleanData($_POST['title']),
                'status' => 0,

            ];



            if ($page_id == 0) {
                // insert new menu 
                if ($page->addPage($page_data)) {
                    $message = "Page Added successfully";
                    $message_type = "success";
                } else {
                    $message = "Error adding Page";
                    $message_type = "warning";
                }
            } else { // update menu

                $page_data = [
                    'page_content' => htmlspecialchars(addslashes($_POST['page_content'])),
                    'title' => Helpers::cleanData($_POST['title']),
                    'status' => 0,
                    'last_content' => htmlspecialchars(addslashes($_POST['page_content'])),
                ];

                /* echo "<pre>";
			print_r($page_data);
			exit; */



                if ($page->updatePage($page_data, $page_id)) {
                    $message = "Page Updated successfully";
                    $message_type = "success";
                } else {
                    $message = "Error updating Menu";
                    $message_type = "warning";
                }
            }
            $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
            $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listpages&&status=0"));
        }
    }



    public function deletePage()
    {
        $data = [];
        $message = $message_type = "";
        $page_id = $this->data['params'][0];




        $page = new Page();
        if ($page->deletePage($page_id)) {
            $message = "Page Deleted successfully";
            $message_type = "success";
        } else {
            $message = "Error deleting page ";
        }
        $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
        $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listpages&&status=0"));
    }


    /**
     * delete menu
     */
    public function deleteMenu()
    {
        $data = [];
        $message = $message_type = "";
        $menu_id = $this->data['params'][0];


        $menu =  new  \App\Models\Menu();
        if ($menu->deleteMenu($menu_id)) {
            $message = "Menu Deleted successfully";
            $message_type = "success";
        } else {
            if ($menu_id == 1) {
                $message = "You cannot delete Root Menu";
                $message_type = "danger";
            } else {
                $message = "Error deleting menu";
                $message_type = "warning";
            }
        }
        $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
        $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listmenus"));
    }

    /**
     * logout admin
     */
    public function logout()
    {
        session_destroy();
        $this->route->redirect($this->route->get_app_url());
    }

    // List Exams start
    public function listExams()
    {
        // check for add menu


        $user = new User();
        $loginUser = $user->getUser();
        $is_admin = $user->is_admin();
        $data['is_admin'] = $is_admin;
        if ($is_admin) {
        }
        $exam = new Exam();
        $exams = $exam->getExams();
        // echo '<pre>';
        // print_r($exams);

        $data['exams'] = $exams;
        $data['user_role_id'] = (int) $loginUser['roleid'];
        $data['logged_user'] = $loginUser;

        $this->prepare_menus($data);
        if (isset($_SESSION['notification'])) {
            $notification_data = $_SESSION['notification'];
            $data = array_merge($data, $notification_data);
            unset($_SESSION['notification']);
        }
        $this->render("dashboard", $data);
    }
    public function editExam()
    {
        $data = [];
        $this->saveExam();
        $user = new User();
        $loginUser = $user->getUser();
        $is_admin = $user->is_admin();
        $data['is_admin'] = $is_admin;
        $data['logged_user'] = $loginUser;

        ob_start();
        if ($is_admin) {
        }
        $exam = new Exam();
        // chek if the id is available in the params 
        $exam_id = (isset($this->data['params'][0])) ? $this->data['params'][0] : 0;

        $current_exam = $exam->getExam($exam_id, DB_ASSOC);
        $data['current_exam'] = $current_exam;
        $exams = $exam->getExams();
        $data['exams'] = $exams;
        $this->prepare_menus($data);
        $this->render("edit-exam", $data);
    }
    private function saveExam()
    {
        $message = $message_type = "";
        if (isset($_POST['save-exam'])) {
            $exam_id = isset($_POST['id']) ? $_POST['id'] : 0;

            $exam =  new  \App\Models\Exam();
            $exam_data = [
                'exam_name' => Helpers::cleanData($_POST['exam_name']),
                'exam_code' => Helpers::cleanData($_POST['exam_code']),
                'exam_date' => date('Y-m-d', strtotime(Helpers::cleanData($_POST['exam_date']))),
                'exam_time' => Helpers::cleanData($_POST['exam_time'])
            ];


            if ($exam_id == 0) {

                // insert new menu 
                if ($exam->addExam($exam_data)) {


                    $message = "Exam  Added successfully";
                    $message_type = "success";
                } else {
                    $message = "Error adding Exam";
                    $message_type = "warning";
                }
            } else { // update menu
                if ($exam->updateExam($exam_data, $exam_id)) {
                    $message = "Exam Updated successfully";
                    $message_type = "success";
                } else {
                    $message = "Error updating Exam";
                    $message_type = "warning";
                }
            }
            $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
            $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listexams"));
        }
    }
    public function menusreorderlinks()
    {
        $user = new User();
        $loginUser = $user->getUser();
        $is_admin = $user->is_admin();
        $data['is_admin'] = $is_admin;
        if ($is_admin) {
            $exam = new Exam();
            $exams = $exam->getExams();


            $data['exams'] = $exams;
        }
        $data['user_role_id'] = (int) $loginUser['roleid'];
        $data['logged_user'] = $loginUser;

        $this->prepare_menus($data);
        if (isset($_SESSION['notification'])) {
            $notification_data = $_SESSION['notification'];
            $data = array_merge($data, $notification_data);
            unset($_SESSION['notification']);
        }
        $this->render("dashboard", $data);
    }
    public function ajaxresponsemenuorder()
    {
        if (isset($_POST["action"])) {

            if ($_POST["action"] == 'fetch_data') {
                $menu = new Menu();
                $ret = $menu->reorderMenus();
                $data  = $ret;
                echo json_encode($data);
            }

            if ($_POST['action'] == 'update') {
                for ($count = 0; $count < count($_POST["page_id_array"]); $count++) {

                    $menu =  new  \App\Models\Menu();
                    $menu_data = [
                        'menu_order'     => $count + 1
                    ];

                    if ($menu->updatereorderMenu($menu_data, $_POST["page_id_array"][$count])) {
                        $message = "Menu Updated successfully";
                        $message_type = "success";
                    } else {
                        $message = "Error updating Menu";
                        $message_type = "warning";
                    }
                }
            }
        }
    }


    /****
     * 
     * Nomination Reorder
     * 
     */
    public function ajaxresponsenominationorder()
    {
        if (isset($_POST["action"])) {

            if ($_POST["action"] == 'fetch_data') {
                $nomination = new Category();
                $ret = $nomination->reorderNomination();
                $data  = $ret;
                echo json_encode($data);
            }

            if ($_POST['action'] == 'update') {
                for ($count = 0; $count < count($_POST["page_id_array"]); $count++) {

                    $nomination =  new  \App\Models\Category();
                    $nomination_data = [
                        'nomination_order'     => $count + 1
                    ];

                    if ($nomination->updatereorderNomination($nomination_data, $_POST["page_id_array"][$count])) {
                        $message = "Menu Updated successfully";
                        $message_type = "success";
                    } else {
                        $message = "Error updating Menu";
                        $message_type = "warning";
                    }
                }
            }
        }
    }


    /****
     * 
     * Selection Post Reorder
     * 
     */
    public function ajaxresponseselectionpostreorder()
    {
        if (isset($_POST["action"])) {

            if ($_POST["action"] == 'fetch_data') {
                $sp = new Category();
                $ret = $sp->reorderSelectionPost();
                $data  = $ret;
                echo json_encode($data);
            }

            if ($_POST['action'] == 'update') {
                for ($count = 0; $count < count($_POST["page_id_array"]); $count++) {

                    $sp =  new  \App\Models\Category();
                    $sp_data = [
                        'selection_post_order'     => $count + 1
                    ];

                    if ($sp->updatereorderSelectionPost($sp_data, $_POST["page_id_array"][$count])) {
                        $message = "Menu Updated successfully";
                        $message_type = "success";
                    } else {
                        $message = "Error updating Menu";
                        $message_type = "warning";
                    }
                }
            }
        }
    }

    public function ajaxresponsesubmenuorder()
    {
        if (isset($_POST["action"])) {

            if ($_POST["action"] == 'fetch_data') {
                $menu = new Menu();
                $ret = $menu->reorderSubMenus();
                $data  = $ret;
                echo json_encode($data);
            }

            if ($_POST['action'] == 'update') {
                for ($count = 0; $count < count($_POST["page_id_array"]); $count++) {

                    $menu =  new  \App\Models\Menu();
                    $menu_data = [
                        'menu_order'     => $count + 1
                    ];

                    if ($menu->updatereorderSubMenu($menu_data, $_POST["page_id_array"][$count])) {
                        $message = "Menu Updated successfully";
                        $message_type = "success";
                    } else {
                        $message = "Error updating Menu";
                        $message_type = "warning";
                    }
                }
            }
        }
    }

    /******
     * 
     * Submenu Reorder New
     * 
     * 
     */

    public function ajaxresponsesubmenuordernew()
    {
        if (isset($_POST["action"])) {

            if ($_POST["action"] == 'fetch_data') {

                $menu_id = $_POST["menu_id"];

                if ($menu_id != 0) {

                    $message   = 'selected';
                } else {
                    $message = "";
                }
                $menu = new Menu();
                $ret = $menu->reorderSubMenusNew();





                //echo '<pre>';
                //print_r($ret);
                echo '<option value="">Select Menu </option>';
                foreach ($ret as $val) { ?>

                    <option value="<?php echo $val->menu_parent_id; ?>" <?php if ($val->menu_parent_id == $menu_id) {
                                                                            echo $message;
                                                                        } ?>><?php echo $val->parent_name; ?></option>

                    <?php }








                //  $data  = $ret;
                // echo json_encode($data);
            }

            // if ($_POST['action'] == 'update') {
            //     for ($count = 0; $count < count($_POST["page_id_array"]); $count++) {

            //         $menu =  new  \App\Models\Menu();
            //         $menu_data = [
            //             'menu_order'     => $count + 1
            //         ];

            //         if ($menu->updatereorderSubMenuNew($menu_data, $_POST["page_id_array"][$count])) {
            //             $message = "Menu Updated successfully";
            //             $message_type = "success";
            //         } else {
            //             $message = "Error updating Menu";
            //             $message_type = "warning";
            //         }
            //     }
            // }
        }
    }

    public function ajaxresponsesubmenuordernewbyId()
    {
        if (isset($_POST["action"])) {

            if ($_POST["action"] == 'fetch_data') {
                $id = $_POST["id"];
                $menu = new Menu();
                $ret = $menu->reorderSubMenusNewById($id);
                $data  = $ret;
                echo json_encode($data);
            }

            if ($_POST['action'] == 'update') {
                for ($count = 0; $count < count($_POST["page_id_array"]); $count++) {

                    $menu =  new  \App\Models\Menu();
                    $menu_data = [
                        'menu_order'     => $count + 1
                    ];

                    if ($menu->updatereorderSubMenuNew($menu_data, $_POST["page_id_array"][$count])) {
                        $message = "Menu Updated successfully";
                        $message_type = "success";
                    } else {
                        $message = "Error updating Menu";
                        $message_type = "warning";
                    }
                }
            }
        }
    }





















    public function ajaxresponse()
    {
        $menuid = $_POST['menuid'];
        // echo $cid;
        $menu = new Menu();

        $menu_data = [
            'status' => true,
        ];

        if ($menu->updateState($menu_data, $menuid)) {
            $message = 1;
            header('Content-Type: application/json');
            echo json_encode(array("message" => $message));
        }

        //$this->route->redirect($this->route->site_url("Admin/dashboard"));
    }


    //Nominations

    // List Exams start
    public function listNominations()
    {
        // check for add menu



        $user = new User();
        $loginUser = $user->getUser();
        $is_admin = $user->is_admin();
        $data['is_admin'] = $is_admin;
        if ($is_admin) {
        }









        $data['user_role_id'] = (int) $loginUser['roleid'];
        $data['logged_user'] = $loginUser;



        $this->prepare_menus($data);
        if (isset($_SESSION['notification'])) {

            $notification_data = $_SESSION['notification'];
            $data = array_merge($data, $notification_data);
            unset($_SESSION['notification']);
        }
        $this->render("dashboard", $data);
    }





    public function editNomination()

    {

        $data = [];

        $this->saveNomination();

        $user = new User();

        $loginUser = $user->getUser();

        ########  Role checking ########

        $is_superadmin = $user->is_superadmin(); // super admin 
        $data['is_superadmin'] = $is_superadmin; // super admin 

        $is_admin = $user->is_admin(); // admin 
        $data['is_admin'] = $is_admin; // admin 

        $is_uploader = $user->is_uploader(); //uploader
        $data['is_uploader'] = $is_uploader; //uploader

        $is_publisher = $user->is_publisher();  // publisher
        $data['is_publisher'] = $is_publisher;  // publisher

        ########  Role Checking ########

        $data['logged_user'] = $loginUser;




        $nomination = new Nomination();

        // chek if the id is available in the params 

        $nomination_id = (isset($this->data['params'][0])) ? $this->data['params'][0] : 0;



        $current_nomination = $nomination->getNomination($nomination_id, DB_ASSOC);

        $data['current_nomination'] = $current_nomination;

        $nominations = $nomination->getNominations();

        $data['nominations'] = $nominations;



        $category = new Category();

        $categories = $category->getCategoryNominations();

        $data['categories'] = $categories;

        $nominationchildclass = new Nominationchild();

        $nominationchildlist = $nominationchildclass->getNominationchild();



        $data['nominationchildlist'] = $nominationchildlist;



        $data['nomination_id'] =  $nomination_id;





        $this->prepare_menus($data);

        $this->render("edit-nomination", $data);
    }

    private function saveNomination()

    {
        $message = $message_type = "";



        if (isset($_POST['save-nomination'])) {

            $nomination_id = isset($_POST['id']) ? $_POST['id'] : 0;

            $nomination =  new \App\Models\Nomination();

            $examname = str_replace("'", "''", Helpers::cleanData($_POST['exam_name']));

            $nomination_data = [

                'exam_name' => $examname,
                'category_id' => Helpers::cleanData($_POST['category_id']),
                'effect_from_date' => date('Y-m-d', strtotime(Helpers::cleanData($_POST['effect_from_date']))),
                'effect_to_date' => date('Y-m-d', strtotime(Helpers::cleanData($_POST['effect_to_date']))),
            ];



            if ($nomination_id == 0) {



                // insert new menu 

                if ($nomination->addNomination($nomination_data)) {



                    $lastinsertsql = $nomination->lastInsertedId();

                    $lastinsertedid =  $lastinsertsql['max'];




                    // echo '<pre>';
                    // print_r($_FILES);
                    // echo count($_FILES);
                    // exit;




                    if (count($_FILES) > 0) {  //uploaded File 

                        foreach ($_FILES['pdf_file']['name'] as $i => $name) {



                            $item_name = Helpers::cleanData($_POST['pdf_name'][$i]);

                            $item_name = htmlspecialchars($item_name);



                            $tmp_name = $_FILES['pdf_file']['tmp_name'][$i];

                            $error = $_FILES['pdf_file']['error'][$i];

                            $size = $_FILES['pdf_file']['size'][$i];

                            $type = $_FILES['pdf_file']['type'][$i];

                            $folder = './nominations/';

                            $file = rand(1000, 100000) . "-" . $_FILES['pdf_file']['name'][$i];

                            $new_file_name = strtolower($file);

                            $final_file = str_replace(' ', '-', $new_file_name);

                            if (move_uploaded_file($tmp_name, $folder . $final_file)) {  // echo "File is valid, and was successfully uploaded.\n";

                            } else {

                                echo "File size greater than 300kb!\n\n";
                            }



                            $nominationchild =  new \App\Models\Nominationchild();





                            $nomination_child_data = [

                                'nomination_id' => $lastinsertedid,

                                'pdf_name' => $item_name,

                                'attachment' => $final_file,

                                'status' => 1



                            ];

                            $nominationchild->addNominationchild($nomination_child_data);
                        }
                    } //uploaded File









                    $message = "Nomination Added successfully";

                    $message_type = "success";
                } else {

                    $message = "Error adding Nomination";

                    $message_type = "warning";
                }
            } else { // update menu

                $nomination_data = [

                    'exam_name' => $examname,
                    'category_id' => Helpers::cleanData($_POST['category_id']),
                    'effect_from_date' => date('Y-m-d', strtotime(Helpers::cleanData($_POST['effect_from_date']))),
                    'effect_to_date' => date('Y-m-d', strtotime(Helpers::cleanData($_POST['effect_to_date']))),
                    'p_status' => '0',
                ];

                //echo '<pre>';

                // print_r($nomination_data);
                // exit;

                if ($nomination->updateNomination($nomination_data, $nomination_id)) {










                    foreach ($_FILES['pdf_file']['name'] as $i => $name) {

                        if ($_FILES['pdf_file']['size'][$i] != 0) {



                            $item_name = Helpers::cleanData($_POST['pdf_name'][$i]);

                            $item_name = htmlspecialchars($item_name);

                            $child_id = isset($_POST['nomination_child_id'][$i]) ? $_POST['nomination_child_id'][$i] : 0;



                            $tmp_name = $_FILES['pdf_file']['tmp_name'][$i];

                            $error = $_FILES['pdf_file']['error'][$i];

                            $size = $_FILES['pdf_file']['size'][$i];

                            $type = $_FILES['pdf_file']['type'][$i];

                            $folder = './nominations/';

                            $file = rand(1000, 100000) . "-" . $_FILES['pdf_file']['name'][$i];

                            $new_file_name = strtolower($file);

                            $final_file = str_replace(' ', '-', $new_file_name);

                            if (move_uploaded_file($tmp_name, $folder . $final_file)) {  // echo "File is valid, and was successfully uploaded.\n";

                            } else {

                                echo "File size greater than 300kb!\n\n";
                            }



                            $nominationchild =  new \App\Models\Nominationchild();





                            $nomination_child_data = [

                                'nomination_id' => $nomination_id,

                                'pdf_name' => $item_name,

                                'attachment' => $final_file,

                                'status' => 1



                            ];




                            if ($child_id == 0) {



                                $nominationchild->addNominationchild($nomination_child_data);
                            } else {

                                $nominationchild->updateNominationChild($nomination_child_data, $child_id);
                            }
                        } //Validation

                    }








                    $message = "Nomination Updated successfully";

                    $message_type = "success";
                } else {

                    $message = "Error updating Nomination";

                    $message_type = "warning";
                }
            }

            $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];


            $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listnominations"));
        }
    }

    public function deleteNomination()
    {
        $data = [];
        $message = $message_type = "";
        $page_id = $this->data['params'][0];




        $nomination = new Nomination();
        if ($nomination->deleteNomination($page_id)) {
            $message = "Nomination  Deleted successfully";
            $message_type = "success";
        } else {
            $message = "Error deleting Nomination ";
        }
        $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
        $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listnominations"));
    }




    ######### Author:Stalin ####



    ######### Date : 13 july-2021 ###



    ######## Selection Posts #######

    public function editselectionpost()

    {

        $data = [];

        $this->saveSelectionpost();

        $user = new User();

        $loginUser = $user->getUser();

        ########  Role checking ########

        $is_superadmin = $user->is_superadmin(); // super admin 
        $data['is_superadmin'] = $is_superadmin; // super admin 

        $is_admin = $user->is_admin(); // admin 
        $data['is_admin'] = $is_admin; // admin 

        $is_uploader = $user->is_uploader(); //uploader
        $data['is_uploader'] = $is_uploader; //uploader

        $is_publisher = $user->is_publisher();  // publisher
        $data['is_publisher'] = $is_publisher;  // publisher

        ########  Role Checking ########

        $data['logged_user'] = $loginUser;



        ob_start();

        if ($is_admin) {
        }

        $selectionpost = new Selectionpost();

        // chek if the id is available in the params 

        $selectionpost_id = (isset($this->data['params'][0])) ? $this->data['params'][0] : 0;



        $current_selectionpost = $selectionpost->getselectionpost($selectionpost_id, DB_ASSOC);

        $data['current_selectionpost'] = $current_selectionpost;

        $selectionposts = $selectionpost->getSelectionpost();

        $data['selectionposts'] = $selectionposts;



        $category = new Category();

        $categories = $category->getCategorySelectionPosts();

        $data['categories'] = $categories;








        $phase = new Phase();

        $phases = $phase->getPhase();

        $data['phases'] = $phases;


        $selectionpostchildclass = new Selectionpostschild();

        $selectionpostchildlist = $selectionpostchildclass->getSelectionpostschild();



        $data['selectionpostchildlist'] = $selectionpostchildlist;



        $data['selectionpost_id'] =  $selectionpost_id;





        $this->prepare_menus($data);

        $this->render("edit-selectionpost", $data);
    }

    private function saveSelectionpost()

    {







        $message = $message_type = "";

        if (isset($_POST['selectionpost'])) {

            // echo "<pre>";

            // print_r($_POST);
            // exit;

            $selectionpost_id = isset($_POST['id']) ? $_POST['id'] : 0;


            // echo  $selectionpost_id;

            //exit;




            $selectionpost =  new \App\Models\Selectionpost();

            $examname = str_replace("'", "''", Helpers::cleanData($_POST['exam_name']));

            $selectionpost_data = [

                'exam_name' => $examname,
                'category_id' => Helpers::cleanData($_POST['category_id']),

                'phase_id' => Helpers::cleanData($_POST['phase_id']),

                'effort_from_date' => date('Y-m-d', strtotime(Helpers::cleanData($_POST['effort_from_date']))),

                'effect_to_date' => date('Y-m-d', strtotime(Helpers::cleanData($_POST['effect_to_date']))),
            ];

            if ($selectionpost_id == 0) {



                // insert new menu 

                if ($selectionpost->addselectionpost($selectionpost_data)) {



                    $lastinsertsql = $selectionpost->lastInsertedId();

                    $lastinsertedid =  $lastinsertsql['max'];







                    foreach ($_FILES['pdf_file']['name'] as $i => $name) {



                        $item_name = Helpers::cleanData($_POST['pdf_name'][$i]);



                        $tmp_name = $_FILES['pdf_file']['tmp_name'][$i];

                        $error = $_FILES['pdf_file']['error'][$i];

                        $size = $_FILES['pdf_file']['size'][$i];

                        $type = $_FILES['pdf_file']['type'][$i];

                        $folder = './selectionposts/';

                        $file = rand(1000, 100000) . "-" . $_FILES['pdf_file']['name'][$i];

                        $new_file_name = strtolower($file);

                        $final_file = str_replace(' ', '-', $new_file_name);

                        if (move_uploaded_file($tmp_name, $folder . $final_file)) {  // echo "File is valid, and was successfully uploaded.\n";

                        } else {

                            echo "File size greater than 300kb!\n\n";
                        }



                        $selectionpostchild =  new \App\Models\Selectionpostschild();





                        $selectionpost_child_data = [

                            'selection_post_id' => $lastinsertedid,

                            'pdf_name' => $item_name,

                            'attachment' => $final_file,

                            'status' => 1



                        ];

                        $selectionpostchild->addSelectionpostchild($selectionpost_child_data);
                    }






                    $message = "Selectionpost Added successfully";

                    $message_type = "success";
                } else {

                    $message = "Error adding selectionpost";

                    $message_type = "warning";
                }
            } else { // update menu

                $selectionpost =  new \App\Models\Selectionpost();



                $selectionpost_data = [

                    'exam_name' => $examname,
                    'category_id' => Helpers::cleanData($_POST['category_id']),

                    'phase_id' => Helpers::cleanData($_POST['phase_id']),

                    'effort_from_date' => date('Y-m-d', strtotime(Helpers::cleanData($_POST['effort_from_date']))),

                    'effect_to_date' => date('Y-m-d', strtotime(Helpers::cleanData($_POST['effect_to_date']))),
                    'p_status' => '0',




                ];


                if ($selectionpost->updateSelectionpost($selectionpost_data, $selectionpost_id)) {










                    foreach ($_FILES['pdf_file']['name'] as $i => $name) {

                        if ($_FILES['pdf_file']['size'][$i] != 0) {



                            $item_name = Helpers::cleanData($_POST['pdf_name'][$i]);

                            $child_id = isset($_POST['selectionpost_child_id'][$i]) ? $_POST['selectionpost_child_id'][$i] : 0;



                            $tmp_name = $_FILES['pdf_file']['tmp_name'][$i];

                            $error = $_FILES['pdf_file']['error'][$i];

                            $size = $_FILES['pdf_file']['size'][$i];

                            $type = $_FILES['pdf_file']['type'][$i];

                            $folder = './selectionposts/';

                            $file = rand(1000, 100000) . "-" . $_FILES['pdf_file']['name'][$i];

                            $new_file_name = strtolower($file);

                            $final_file = str_replace(' ', '-', $new_file_name);

                            if (move_uploaded_file($tmp_name, $folder . $final_file)) {  // echo "File is valid, and was successfully uploaded.\n";

                            } else {

                                echo "File size greater than 300kb!\n\n";
                            }



                            $selectionpostchild =  new \App\Models\Selectionpostschild();





                            $selectionpost_child_data = [

                                'selection_post_id' => $selectionpost_id,

                                'pdf_name' => $item_name,

                                'attachment' => $final_file,

                                'status' => 1



                            ];




                            if ($child_id == 0) {



                                $selectionpostchild->addSelectionpostchild($selectionpost_child_data);
                            } else {

                                $selectionpostchild->updateSelectionpostchild($selectionpost_child_data, $child_id);
                            }
                        } //Validation

                    }








                    $message = "Selectionpost Updated successfully";

                    $message_type = "success";
                } else {

                    $message = "Error updating selectionpost";

                    $message_type = "warning";
                }
            }

            $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];

            $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listselectionposts"));
        }
    }
    public function deleteSelectionpost()
    {
        $data = [];
        $message = $message_type = "";
        $sp_id = $this->data['params'][0];






        $sp = new Selectionpost();
        if ($sp->deleteSelectionPost($sp_id)) {
            $message = "Selection Post Deleted successfully";
            $message_type = "success";
        } else {
            $message = "Error deleting Selection Post ";
        }
        $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
        $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listselectionposts"));
    }





    public function ajaxresponseforselectionpostsforremovingfileupload()

    {

        $pdf_id = Helpers::cleanData($_POST['pdf_id']);

        $sp_id = Helpers::cleanData($_POST['sp_id']);

        // echo $cid;

        $spchild =  new \App\Models\Selectionpostschild();



        $menu_data = [

            'status' => 0,



        ];



        if ($spchild->updateState($menu_data, $pdf_id)) {

            $message = 1;

            header('Content-Type: application/json');

            echo json_encode(array("message" => $message));
        }



        //$this->route->redirect($this->route->site_url("admin/dashboard"));

    }




    ######### Author:Stalin ####



    ######### Date : 13 july-2021 ###



    ######## Selection Posts #######



    public function ajaxresponseforfileupload()

    {

        $pdf_id = Helpers::cleanData($_POST['pdf_id']);

        $nomination_id = Helpers::cleanData($_POST['nomination_id']);

        // echo $cid;

        $nominationchild =  new \App\Models\Nominationchild();



        $menu_data = [

            'status' => 0,



        ];



        if ($nominationchild->updateState($menu_data, $pdf_id)) {

            $message = 1;

            header('Content-Type: application/json');

            echo json_encode(array("message" => $message));
        }



        //$this->route->redirect($this->route->site_url("admin/dashboard"));

    }






    public function printr($data = array())

    {

        echo '<pre>';

        print_r($data);

        exit;
    }

    //Debarredlists Starts
    public function editdebarredlists()
    {
        $data = [];
        $this->saveDlist();
        $user = new User();
        $loginUser = $user->getUser();
        ########  Role checking ########

        $is_superadmin = $user->is_superadmin(); // super admin 
        $data['is_superadmin'] = $is_superadmin; // super admin 

        $is_admin = $user->is_admin(); // admin 
        $data['is_admin'] = $is_admin; // admin 

        $is_uploader = $user->is_uploader(); //uploader
        $data['is_uploader'] = $is_uploader; //uploader

        $is_publisher = $user->is_publisher();  // publisher
        $data['is_publisher'] = $is_publisher;  // publisher

        ########  Role Checking ########
        $data['logged_user'] = $loginUser;


        $dlist = new Debarredlists();
        // chek if the id is available in the params 
        $dlist_id = (isset($this->data['params'][0])) ? $this->data['params'][0] : 0;

        $current_dlist = $dlist->getDlist($dlist_id, DB_ASSOC);
        $data['current_dlist'] = $current_dlist;
        $dlists = $dlist->getDlists();
        $data['dlists'] = $dlists;
        $this->prepare_menus($data);
        $this->render("edit-debarredlist", $data);
    }
    private function saveDlist()
    {
        $message = $message_type = "";
        if (isset($_POST['save_dlist'])) {
            $dlist_id = isset($_POST['id']) ? $_POST['id'] : 0;


            if (isset($_FILES['attachment']) && $_FILES['attachment']['name'] != "") {
                //pdf upload function

                $file = rand(1000, 100000) . "-" . $_FILES['attachment']['name'];
                $file_loc = $_FILES['attachment']['tmp_name'];
                $file_size = $_FILES['attachment']['size'];
                $file_type = $_FILES['attachment']['type'];
                $folder = './debarredlists/';
                $new_size = $file_size / 1024;
                /* make file name in lower case */
                $new_file_name = strtolower($file);
                /* make file name in lower case */
                $final_file = str_replace(' ', '-', $new_file_name);
                if (move_uploaded_file($file_loc, $folder . $final_file)) {   // echo "File is valid, and was successfully uploaded.\n";
                } else {
                    echo "File size greater than 300kb!\n\n";
                }


                //pdf upload function
            } else {
                $final_file = "";
            }







            if ($final_file == '') {
                $final_file = Helpers::cleanData($_POST['pdflink']);
            }



            $effect_from_date = date('Y-m-d', strtotime(Helpers::cleanData($_POST['effect_from_date'])));
            //$effect_to_date =  date('Y-m-d', strtotime(Helpers::cleanData($_POST['effect_to_date'])));
            $dlist_data = [
                'pdf_name' => Helpers::cleanData($_POST['pdf_name']),
                'attachment' => $final_file,
                'effect_from_date' => $effect_from_date,
                'p_status' => '0'
            ];


            /* echo "<pre>";
			print_r($menu_data);
			exit; */

            $dlist =  new  \App\Models\Debarredlists();

            if ($dlist_id == 0) { // insert new menu 


                if ($dlist->addDlist($dlist_data)) {


                    $message = "Debarred List  Added successfully";
                    $message_type = "success";
                } else {
                    $message = "Error adding Debarred List";
                    $message_type = "warning";
                }
            } else { // update menu



                if ($dlist->updateDlist($dlist_data, $dlist_id)) {
                    $message = "Debarred List Updated successfully";
                    $message_type = "success";
                } else {
                    $message = "Error updating Debarred List";
                    $message_type = "warning";
                }
            }
            $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
            $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listdebarredlists"));
        }
    }

    public function deletedebarredlists()
    {
        $data = [];
        $message = $message_type = "";
        $dl_id = $this->data['params'][0];




        $dl = new Debarredlists();
        if ($dl->deleteDebarredList($dl_id)) {
            $message = "Debarred List Deleted successfully";
            $message_type = "success";
        } else {
            $message = "Error deleting Debarred List ";
        }
        $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
        $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listdebarredlists"));
    }







    //Debarredlists End



    public function ArchivesTest()
    {




        echo '<pre>';
        print_r($_POST);

        $tender = new Tender();


        $tenderlist_data = $_POST['id'];


        if ($tender->archiveTenderStatus($tenderlist_data)) {


            $message = "Tender  Archived successfully";
            $message_type = "success";
        }

        $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
        $this->route->redirect($this->route->site_url("Admin/dashboard/?action=tender_archieves_by_month"));
    }



    //Tenderlists Starts
    public function edittender()
    {
        $data = [];
        $this->saveTender();
        $user = new User();
        $loginUser = $user->getUser();
        ########  Role checking ########

        $is_superadmin = $user->is_superadmin(); // super admin 
        $data['is_superadmin'] = $is_superadmin; // super admin 

        $is_admin = $user->is_admin(); // admin 
        $data['is_admin'] = $is_admin; // admin 

        $is_uploader = $user->is_uploader(); //uploader
        $data['is_uploader'] = $is_uploader; //uploader

        $is_publisher = $user->is_publisher();  // publisher
        $data['is_publisher'] = $is_publisher;  // publisher

        ########  Role Checking ########
        $data['logged_user'] = $loginUser;


        $tenderlists = new Tender();
        // chek if the id is available in the params 
        $tenderid = (isset($this->data['params'][0])) ? $this->data['params'][0] : 0;

        $current_tender = $tenderlists->getTenderby($tenderid, DB_ASSOC);
        $data['current_tender'] = $current_tender;

        /* 	
        $tlists = $tlist->getDlists();
        $data['dlists'] = $dlists; */


        $this->prepare_menus($data);
        $this->render("edit-tender", $data);
    }
    private function saveTender()
    {
        $message = $message_type = "";







        if (isset($_POST['save_tender'])) {
            $tenderid = isset($_POST['id']) ? $_POST['id'] : 0;


            if (isset($_FILES['attachment']) && $_FILES['attachment']['name'] != "") {
                //pdf upload function

                $file = rand(1000, 100000) . "-" . $_FILES['attachment']['name'];
                $file_loc = $_FILES['attachment']['tmp_name'];
                $file_size = $_FILES['attachment']['size'];
                $file_type = $_FILES['attachment']['type'];
                $folder = './tender/';
                $new_size = $file_size / 1024;
                /* make file name in lower case */
                $new_file_name = strtolower($file);
                /* make file name in lower case */
                $final_file = str_replace(' ', '-', $new_file_name);

                if (move_uploaded_file($file_loc, $folder . $final_file)) {   // echo "File is valid, and was successfully uploaded.\n";
                } else {
                    echo "File size greater than 300kb!\n\n";
                }


                //pdf upload function
            } else {
                $final_file = "";
            }







            if ($final_file == '') {
                $final_file = Helpers::cleanData($_POST['pdflink']);
            }



            $effect_from_date = date('Y-m-d', strtotime(Helpers::cleanData($_POST['effect_from_date'])));
            $effect_to_date =  date('Y-m-d', strtotime(Helpers::cleanData($_POST['effect_to_date'])));
            $tenderlist_data = [
                'pdf_name' => Helpers::cleanData($_POST['pdf_name']),
                'attachment' => $final_file,
                'effect_from_date' => $effect_from_date,
                'effect_to_date' => $effect_to_date,
                'p_status' => '0'
            ];


            /* echo "<pre>";
			print_r($menu_data);
			exit; */

            $tender =  new  \App\Models\Tender();

            if ($tenderid == 0) { // insert new menu 


                if ($tender->addTender($tenderlist_data)) {


                    $message = "Tender  Added successfully";
                    $message_type = "success";
                } else {
                    $message = "Error adding Tender";
                    $message_type = "warning";
                }
            } else { // update menu



                if ($tender->updateTender($tenderlist_data, $tenderid)) {
                    $message = "Tender Updated successfully";
                    $message_type = "success";
                } else {
                    $message = "Error updating Tender";
                    $message_type = "warning";
                }
            }
            $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
            $this->route->redirect($this->route->site_url("Admin/dashboard/?action=tender_archieves_by_month"));
        }
    }


    public function deleteTender()
    {
        $data = [];
        $message = $message_type = "";
        $tender_id = $this->data['params'][0];




        $tender = new Tender();
        if ($tender->deleteTenderStatus($tender_id)) {
            $message = "Tender   Deleted successfully";
            $message_type = "success";
        } else {
            $message = "Error deleting Tender ";
        }
        $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
        $this->route->redirect($this->route->site_url("Admin/dashboard/?action=tender_archieves_by_month"));
    }

    public function copyTender()
    {
        $data = [];
        $message = $message_type = "";
        $tender_id = $this->data['params'][0];




        $tender = new Tender();
        if ($tender->copyTender($tender_id)) {
            $message = "Tender   copied successfully";
            $message_type = "success";
        } else {
            $message = "Error copying Tender ";
        }
        $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
        $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listoftenders"));
    }


    public function archiveTender()
    {
        $data = [];
        $message = $message_type = "";
        $tender_id = $this->data['params'][0];




        $tender = new Tender();
        if ($tender->archiveTenderStatus($tender_id)) {
            $message = "Tender   Archived successfully";
            $message_type = "success";
        } else {
            $message = "Error Archiving Tender ";
        }
        $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
        $this->route->redirect($this->route->site_url("Admin/dashboard/?action=tender_archieves_by_month"));
    }




    public function deleteimportantlink()
    {
        $data = [];
        $message = $message_type = "";
        $il_id = $this->data['params'][0];




        $il = new ImportantLinks();
        if ($il->deleteImportantLinksStatus($il_id)) {
            $message = "Important Links Deleted successfully";
            $message_type = "success";
        } else {
            $message = "Error deleting Important Links ";
        }
        $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
        $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listofimportantlinks&&status=0"));
    }











    //Tenderlists End



    #######################   Important Links Start #####################
    public function editimportantlink()
    {
        $data = [];
        $this->saveImportantLink();
        $user = new User();
        $loginUser = $user->getUser();
        ########  Role checking ########

        $is_superadmin = $user->is_superadmin(); // super admin 
        $data['is_superadmin'] = $is_superadmin; // super admin 

        $is_admin = $user->is_admin(); // admin 
        $data['is_admin'] = $is_admin; // admin 

        $is_uploader = $user->is_uploader(); //uploader
        $data['is_uploader'] = $is_uploader; //uploader

        $is_publisher = $user->is_publisher();  // publisher
        $data['is_publisher'] = $is_publisher;  // publisher

        ########  Role Checking ########
        $data['logged_user'] = $loginUser;


        $importantlinks = new ImportantLinks();
        // chek if the id is available in the params 
        $importantlinkid = (isset($this->data['params'][0])) ? $this->data['params'][0] : 0;

        $current_importantlink = $importantlinks->getImportantLinksby($importantlinkid, DB_ASSOC);
        $data['current_importantlink'] = $current_importantlink;

        /* 	
        $tlists = $tlist->getDlists();
        $data['dlists'] = $dlists; */


        $this->prepare_menus($data);
        $this->render("edit-importantlinks", $data);
    }
    private function saveImportantLink()
    {
        $message = $message_type = "";
        if (isset($_POST['save_important_link'])) {
            $ilid = isset($_POST['id']) ? $_POST['id'] : 0;
            $creation_date = date('Y-m-d', strtotime(Helpers::cleanData($_POST['creation_date'])));
            $illist_data = [
                'link_name' => Helpers::cleanData($_POST['link_name']),
                'menu_link' => Helpers::cleanData($_POST['menu_link']),
                'creation_date' => $creation_date,
                'status' => '0'
            ];


            /* echo "<pre>";
			print_r($illist_data);
			exit; */

            $il =  new  \App\Models\ImportantLinks();

            if ($ilid == 0) { // insert new menu 


                if ($il->addImportantLinks($illist_data)) {


                    $message = "Important Link Added successfully";
                    $message_type = "success";
                } else {
                    $message = "Error adding Important Link";
                    $message_type = "warning";
                }
            } else { // update menu



                if ($il->updateImportantLinks($illist_data, $ilid)) {
                    $message = "Important Link Updated successfully";
                    $message_type = "success";
                } else {
                    $message = "Error updating Important Link";
                    $message_type = "warning";
                }
            }
            $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
            $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listofimportantlinks"));
        }
    }



    #################   Important Links  End    ###################






    ####### Login Users Edit Form#########


    public function editloginuser()
    {
        $data = [];
        $this->saveLoginuser();
        $user = new User();
        $loginUser = $user->getUser();
        ########  Role checking ########

        $is_superadmin = $user->is_superadmin(); // super admin 
        $data['is_superadmin'] = $is_superadmin; // super admin 

        $is_admin = $user->is_admin(); // admin 
        $data['is_admin'] = $is_admin; // admin 

        $is_uploader = $user->is_uploader(); //uploader
        $data['is_uploader'] = $is_uploader; //uploader

        $is_publisher = $user->is_publisher();  // publisher
        $data['is_publisher'] = $is_publisher;  // publisher

        ########  Role Checking ########
        $data['logged_user'] = $loginUser;

        ob_start();
        if ($is_admin) {
        }
        $userlist = new Loginusers();
        // chek if the id is available in the params 
        $user_id = (isset($this->data['params'][0])) ? $this->data['params'][0] : 0;

        $current_userlist = $userlist->getUserlist($user_id, DB_ASSOC);
        $data['current_userlist'] = $current_userlist;



        #####  Get Roles  ########
        $role = new User();

        $roles = $role->getRolesList();
        $data['roles'] = $roles;
        #####  Get Roles  ########


        $this->prepare_menus($data);
        $this->render("edit-user-creation", $data);
    }
    private function saveLoginuser()
    {

        $message = $message_type = "";
        if (isset($_POST['save_user'])) {




            $user_id = isset($_POST['id']) ? $_POST['id'] : 0;

            $userlist =  new  \App\Models\Loginusers();

            if ($user_id == 0) { //insert



                $userlist_data = [
                    'username' =>  Helpers::cleanData($_POST['username']),
                    'email' =>     Helpers::cleanData($_POST['email']),
                    'phone_number' => Helpers::cleanData($_POST['phone_number']),
                    'password' => md5(Helpers::cleanData($_POST['password'])),
                    'user_role_id' => Helpers::cleanData($_POST['user_role_id']),
                    'created_on' => date('Y-m-d H:i:s'),
                    'last_login' => date('Y-m-d H:i:s'),
                    'status' => "false"
                ];

                /* echo '<pre>';
						print_r($userlist_data);
						exit; */


                // insert new menu 
                if ($userlist->addUserlist($userlist_data)) {


                    $message = "User Added successfully";
                    $message_type = "success";
                } else {
                    $message = "Error adding User";
                    $message_type = "warning";
                }
            } else { // update menu


                $userlist =  new  \App\Models\Loginusers();

                $userlist_data = [
                    'username' =>  Helpers::cleanData($_POST['username']),
                    'email' =>     Helpers::cleanData($_POST['email']),
                    'phone_number' => Helpers::cleanData($_POST['phone_number']),
                    'user_role_id' => Helpers::cleanData($_POST['user_role_id']),
                    'created_on' => date('Y-m-d H:i:s'),
                    'last_login' => date('Y-m-d H:i:s'),
                    'status' => "false"
                ];



                if ($userlist->updateUserlist($userlist_data,  $user_id)) {
                    $message = "User Updated successfully";
                    $message_type = "success";
                } else {
                    $message = "Error updating User";
                    $message_type = "warning";
                }
            }
            $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
            $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listofloginusers"));
        }
    }





    ####### Login Users Edit Form#########


    ######   Category   #################
    public function editcategory()
    {
        $data = [];
        $this->saveCategory();
        $user = new User();
        $loginUser = $user->getUser();
        ########  Role checking ########

        $is_superadmin = $user->is_superadmin(); // super admin 
        $data['is_superadmin'] = $is_superadmin; // super admin 

        $is_admin = $user->is_admin(); // admin 
        $data['is_admin'] = $is_admin; // admin 

        $is_uploader = $user->is_uploader(); //uploader
        $data['is_uploader'] = $is_uploader; //uploader

        $is_publisher = $user->is_publisher();  // publisher
        $data['is_publisher'] = $is_publisher;  // publisher

        ########  Role Checking ########
        $data['logged_user'] = $loginUser;

        ob_start();
        if ($is_admin) {
        }
        $categorylist = new Category();
        // chek if the id is available in the params 
        $category_id = (isset($this->data['params'][0])) ? $this->data['params'][0] : 0;

        $current_category_details = $categorylist->getCategoryby($category_id, DB_ASSOC);
        $data['current_category_details'] = $current_category_details;



        #####  Get Roles  ########
        $role = new User();

        $roles = $role->getRolesList();
        $data['roles'] = $roles;
        #####  Get Roles  ########


        $this->prepare_menus($data);
        $this->render("edit-category", $data);
    }
    private function saveCategory()
    {

        $message = $message_type = "";
        if (isset($_POST['save_category'])) {

            $category_id = isset($_POST['id']) ? $_POST['id'] : 0;


            $categorylist =  new  \App\Models\Category();

            if ($_POST['categoryforwhat'] == 'selection_post') {

                $sp = 1;
                $nm = 0;
            } else {
                $sp = 0;
                $nm = 1;
            }

            // if(@$_POST['category_status'] == 'on'){
            // 	$status = 1;
            // }else{
            // 	$status = 0;
            // }

            if ($category_id == 0) { //insert



                $string = htmlspecialchars(strip_tags($_POST['category_name']));

                $categorylist_data = [
                    'category_name' =>  Helpers::cleanData($string),
                    'show_in_selection_post' => $sp,
                    'show_in_nomination' => $nm,

                    'creation_date' => date('Y-m-d H:i:s'),
                    'status' => 0
                ];


                // insert new menu 
                if ($categorylist->addCategory($categorylist_data)) {


                    $message = "Category Added successfully";
                    $message_type = "success";
                } else {
                    $message = "Error adding Category";
                    $message_type = "warning";
                }
            } else { // update menu


                $categorylist =  new  \App\Models\Category();

                $categorylist_data = [
                    'category_name' =>  Helpers::cleanData($_POST['category_name']),
                    'show_in_selection_post' => $sp,
                    'show_in_nomination' => $nm,

                    'creation_date' => date('Y-m-d H:i:s'),
                    //'status' =>$status
                ];



                if ($categorylist->updateCategory($categorylist_data,  $category_id)) {
                    $message = "Category Updated successfully";
                    $message_type = "success";
                } else {
                    $message = "Error updating Category";
                    $message_type = "warning";
                }
            }
            $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
            $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listofcategory"));
        }
    }


    public function deleteCategory()
    {
        $data = [];
        $message = $message_type = "";
        $category_id = $this->data['params'][0];




        $category = new Category();
        if ($category->deleteCategory($category_id)) {
            $message = "Category Deleted successfully";
            $message_type = "success";
        } else {
            $message = "Error deleting Category ";
        }
        $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
        $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listofcategory"));
    }


    public function deleteGallery()
    {
        $data = [];
        $message = $message_type = "";
        $gallery_id = $this->data['params'][0];




        $gallery = new Gallery();
        if ($gallery->deleteGallery($gallery_id)) {
            $message = "Gallery Deleted successfully";
            $message_type = "success";
        } else {
            $message = "Error deleting Gallery ";
        }
        $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
        $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listofphotogallery"));
    }















    ###### Category #####################

    #############################  Notices  start  ############################
    public function editnotice()
    {
        $data = [];
        $this->saveNotice();
        $user = new User();
        $loginUser = $user->getUser();
        $is_admin = $user->is_admin();
        $data['is_admin'] = $is_admin;
        $data['logged_user'] = $loginUser;


        ########  Role checking ########

        $is_superadmin = $user->is_superadmin(); // super admin 
        $data['is_superadmin'] = $is_superadmin; // super admin 

        $is_admin = $user->is_admin(); // admin 
        $data['is_admin'] = $is_admin; // admin 

        $is_uploader = $user->is_uploader(); //uploader
        $data['is_uploader'] = $is_uploader; //uploader

        $is_publisher = $user->is_publisher();  // publisher
        $data['is_publisher'] = $is_publisher;  // publisher

        ########  Role Checking ########

        ob_start();
        if ($is_admin) {
        }
        $notice = new Notice();
        // chek if the id is available in the params 
        $notice_id = (isset($this->data['params'][0])) ? $this->data['params'][0] : 0;

        $current_notice = $notice->getNoticeby($notice_id, DB_ASSOC);
        $data['current_notice'] = $current_notice;

        $category = new Category();

        $categories = $category->getCategoryNominations();

        $data['categories'] = $categories;

        $notices = $notice->getNoticeList();
        $data['notices'] = $notices;
        $this->prepare_menus($data);
        $this->render("edit-notice", $data);
    }
    private function saveNotice()
    {
        $message = $message_type = "";
        if (isset($_POST['save_notice'])) {
            $notice_id = isset($_POST['id']) ? $_POST['id'] : 0;


            if (isset($_FILES['attachment']) && $_FILES['attachment']['name'] != "") {
                //pdf upload function

                $file = rand(1000, 100000) . "-" . $_FILES['attachment']['name'];
                $file_loc = $_FILES['attachment']['tmp_name'];
                $file_size = $_FILES['attachment']['size'];
                $file_type = $_FILES['attachment']['type'];
                $folder = './notices/';
                $new_size = $file_size / 1024;
                /* make file name in lower case */
                $new_file_name = strtolower($file);
                /* make file name in lower case */
                $final_file = str_replace(' ', '-', $new_file_name);
                if (move_uploaded_file($file_loc, $folder . $final_file)) {   // echo "File is valid, and was successfully uploaded.\n";
                } else {
                    echo "File size greater than 300kb!\n\n";
                }


                //pdf upload function
            } else {
                $final_file = "";
            }







            if ($final_file == '') {
                $final_file = Helpers::cleanData($_POST['pdflink']);
            }



            $effect_from_date = date('Y-m-d', strtotime(Helpers::cleanData($_POST['effect_from_date'])));
            $effect_to_date =  date('Y-m-d', strtotime(Helpers::cleanData($_POST['effect_to_date'])));
            $noticelist_data = [
                'pdf_name' => Helpers::cleanData($_POST['pdf_name']),
                'category_id' => Helpers::cleanData($_POST['category_id']),
                'attachment' => $final_file,
                'effect_from_date' => $effect_from_date,
                'effect_to_date' => $effect_to_date,
                'p_status' => '0'
            ];


            /* echo "<pre>";
			print_r($menu_data);
			exit; */

            $noticelist =  new  \App\Models\Notice();

            if ($notice_id == 0) { // insert new menu 


                if ($noticelist->addNotice($noticelist_data)) {


                    $message = "Notice  Added successfully";
                    $message_type = "success";
                } else {
                    $message = "Error adding Notice";
                    $message_type = "warning";
                }
            } else { // update menu



                if ($noticelist->updateNotice($noticelist_data, $notice_id)) {
                    $message = "Notice Updated successfully";
                    $message_type = "success";
                } else {
                    $message = "Error updating Notice";
                    $message_type = "warning";
                }
            }
            $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
            $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listofnotices"));
        }
    }



    public function deleteNotice()
    {
        $data = [];
        $message = $message_type = "";
        $notice_id = $this->data['params'][0];




        $notice = new Notice();
        if ($notice->deleteNoticeStatus($notice_id)) {
            $message = "Notice  Deleted successfully";
            $message_type = "success";
        } else {
            $message = "Error deleting Notice ";
        }
        $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
        $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listofnotices"));
    }




    ###################### Notices End #################################







    public function ajaxresponseforpage()
    {
        $pageid = Helpers::cleanData($_POST['pageid']);
        // echo $cid;
        $page = new Page();

        $page_data = [
            'status' => true,
        ];

        if ($page->updatePageState($page_data, $pageid)) {
            $message = 1;
            header('Content-Type: application/json');
            echo json_encode(array("message" => $message));
        }

        //$this->route->redirect($this->route->site_url("Admin/dashboard"));
    }
    public function ajaxresponseforNomination()
    {
        $nomination_id = Helpers::cleanData($_POST['nomination_id']);
        // echo $nomination_id;
        $nomination = new Nomination();

        $nomination_data = [
            'p_status' => '1',
        ];

        if ($nomination->updateNominationState($nomination_data, $nomination_id)) {
            $message = 1;
            header('Content-Type: application/json');
            echo json_encode(array("message" => $message));
        }

        //$this->route->redirect($this->route->site_url("Admin/dashboard"));
    }

    /*****
     * 
     * Nomination Archives Publish Button
     */

    public function ajaxresponseforNominationArchives()
    {
        $nomination_id = Helpers::cleanData($_POST['nomination_id']);
        // echo $nomination_id;
        $nomination = new NominationArchieves();

        $nomination_data = [
            'p_status' => '1',
        ];

        if ($nomination->updateNominationArchivesState($nomination_data, $nomination_id)) {
            $message = 1;
            header('Content-Type: application/json');
            echo json_encode(array("message" => $message));
        }

        //$this->route->redirect($this->route->site_url("Admin/dashboard"));
    }













    public function ajaxresponseforSelectionPost()
    {
        $selection_post_id = Helpers::cleanData($_POST['selection_post_id']);
        // echo $cid;
        $selectionpost = new Selectionpost();

        $selection_post_data = [
            'p_status' => '1',
        ];

        if ($selectionpost->updateSelectionpostState($selection_post_data, $selection_post_id)) {
            $message = 1;
            header('Content-Type: application/json');
            echo json_encode(array("message" => $message));
        }
    }

    public function ajaxresponseforDebarredList()
    {
        $debarred_lists_id = Helpers::cleanData($_POST['debarred_lists_id']);
        // echo $cid;
        $debarred_lists = new Debarredlists();

        $debarred_lists_data = [
            'p_status' => '1',
        ];

        if ($debarred_lists->updateDebarredlistState($debarred_lists_data, $debarred_lists_id)) {
            $message = 1;
            header('Content-Type: application/json');
            echo json_encode(array("message" => $message));
        }

        //$this->route->redirect($this->route->site_url("Admin/dashboard"));
    }

    public function ajaxresponseforNotice()
    {
        $notice_id = Helpers::cleanData($_POST['notice_id']);
        // echo $cid;
        $notice_model = new Notice();

        $notice_data = [
            'p_status' => '1',
        ];

        if ($notice_model->updateNoticeState($notice_data, $notice_id)) {
            $message = 1;
            header('Content-Type: application/json');
            echo json_encode(array("message" => $message));
        }

        //$this->route->redirect($this->route->site_url("Admin/dashboard"));
    }



    /***
     * Faq  Publish Button
     * 
     */
    public function ajaxresponseforFaq()
    {
        $faq_id = Helpers::cleanData($_POST['faq_id']);
        // echo $cid;
        $faq_model = new Faq();

        $faq_data = [
            'p_status' => '1',
        ];

        if ($faq_model->updateFaqState($faq_data, $faq_id)) {
            $message = 1;
            header('Content-Type: application/json');
            echo json_encode(array("message" => $message));
        }
    }


    public function ajaxresponseforTender()
    {
        $tender_id = Helpers::cleanData($_POST['tender_id']);
        // echo $cid;
        $tender_model = new Tender();

        $tender_data = [
            'p_status' => '1',
        ];

        if ($tender_model->updateTenderState($tender_data, $tender_id)) {
            $message = 1;
            header('Content-Type: application/json');
            echo json_encode(array("message" => $message));
        }

        //$this->route->redirect($this->route->site_url("Admin/dashboard"));
    }

    ################  Ajax Response For Important Links  Start ##############

    public function ajaxresponseforImportantLinks()
    {
        $importantlink_id = Helpers::cleanData($_POST['importantlink_id']);
        // echo $cid;
        $il_model = new ImportantLinks();

        $il_data = [
            'status' => '1',
        ];

        if ($il_model->updateImportantLinksState($il_data, $importantlink_id)) {
            $message = 1;
            header('Content-Type: application/json');
            echo json_encode(array("message" => $message));
        }
    }
    ################  Ajax Response For Important Links  End ##############


    ################  Ajax Response For Event Category  Start ##############

    public function ajaxresponseforEventCategory()
    {
        $ec_id = Helpers::cleanData($_POST['ec_id']);
        // echo $cid;
        $ec_model = new EventCategory();

        $ec_data = [
            'status' => '1',
        ];

        if ($ec_model->updateEventCategoryState($ec_data, $ec_id)) {
            $message = 1;
            header('Content-Type: application/json');
            echo json_encode(array("message" => $message));
        }
    }
    ################  Ajax Response For Event Category   End ##############



    public function ajaxresponseforNarchieves()
    {

        $year = $_POST['nom_year'];
        $month = $_POST['nom_month'];

        $model = new NominationArchieves();

        $model_archieves = $model->nominationArchieves($year, $month);

        $arrayValue = json_decode(json_encode($model_archieves), true);

        if (count($arrayValue) > 0) {

            foreach ($arrayValue  as $row) {
                @$array['data'][] = array($row['exam_name'], $row['category_name'], $row['date_archived']);
            }
            $string =    json_encode($array);
            $dataList = substr($string, 1, -1);
            echo "{" . str_replace('}', ']', str_replace('{', '[', $dataList)) . "}";
        } else {
            echo 'null';
        }
    }


    /*****
     * 
     * 
     * Selection Post Archives By Month
     * 
     * 
     * 
     */
    public function ajaxresponseforSelectionPostarchievesByMonth()
    {

        $year = $_POST['sp_year'];
        $month = $_POST['sp_month'];

        $model = new SelectionpostArchives();

        $model_archieves = $model->selectionPostArchievesByMonth($year, $month);

        $arrayValue = json_decode(json_encode($model_archieves), true);

        if (count($arrayValue) > 0) {

            foreach ($arrayValue  as $row) {
                @$array['data'][] = array($row['exam_name'], $row['category_name'], $row['date_archived']);
            }
            $string =    json_encode($array);
            $dataList = substr($string, 1, -1);
            echo "{" . str_replace('}', ']', str_replace('{', '[', $dataList)) . "}";
        } else {
            echo 'null';
        }
    }



    /*****
     * 
     * 
     * Selection Post Archives By Month
     * 
     * 
     * 
     */


    /*****
     * 
     * 
     * Notice Archives By Month
     * 
     * 
     * 
     */
    public function ajaxresponseforNoticearchievesByMonth()
    {

        $year = $_POST['notice_year'];
        $month = $_POST['notice_month'];

        $model = new NoticeArchives();

        $model_archieves = $model->noticeArchievesByMonth($year, $month);

        $arrayValue = json_decode(json_encode($model_archieves), true);

        if (count($arrayValue) > 0) {

            foreach ($arrayValue  as $row) {
                @$array['data'][] = array($row['pdf_name'], $row['category_name'], $row['date_archived']);
            }
            $string =    json_encode($array);
            $dataList = substr($string, 1, -1);
            echo "{" . str_replace('}', ']', str_replace('{', '[', $dataList)) . "}";
        } else {
            echo 'null';
        }
    }



    /*****
     * 
     * 
     *  Archives By Month
     * 
     * 
     * 
     */
    public function ajaxresponseforArchievesByMonth()
    {
        $year = $_POST['year'];
        $month = $_POST['month'];
        $elink = $_POST['elink'];
        $dlink = $_POST['dlink'];
        $alink = $_POST['alink'];
        $effect_from_date = $_POST['effect_from_date'];
        $effect_to_date = $_POST['effect_to_date'];
        $modelName = $_POST['model'];
        switch ($modelName) {
            case "Gallery":
                $model = new Gallery();
                break;
            case "SelectionpostArchives":
                $model = new SelectionpostArchives();
                break;
            case "Nomination":
                $model = new Nomination();
                $functionName = "get" . $modelName . "Details";

                $idname = 'nomination_id';
                $model_archieves = $model->$functionName($year, $month, $effect_from_date, $effect_to_date);
                $arrayValue = json_decode(json_encode($model_archieves), true);



                $user = new User();


                $is_superadmin = $user->is_superadmin(); // super admin 
                $data['is_superadmin'] = $is_superadmin; // super admin 

                $is_admin = $user->is_admin(); // admin 
                $data['is_admin'] = $is_admin; // admin 

                $is_uploader = $user->is_uploader(); //uploader
                $data['is_uploader'] = $is_uploader; //uploader

                $is_publisher = $user->is_publisher();  // publisher
                $data['is_publisher'] = $is_publisher;




                if (count($arrayValue) > 0) {
                    foreach ($arrayValue as $row) :
                        $delete_nomination_link_str = str_replace("{id}", $row['nomination_id'], $dlink);
                        $edit_nomination_link_str = str_replace("{id}", $row['nomination_id'],  $elink);
                        $archive_nomination_link_str = str_replace("{id}", $row['nomination_id'],  $alink);

                        $nominationchildclass = new Nominationchild();

                        $nominationchildlist = $nominationchildclass->getNominationchild();





                        $output = "";
                        foreach ($nominationchildlist as $key => $childlist) :
                            $selected = "";
                            if ($row['nomination_id'] == $childlist->nomination_id) {
                                $selected = "selected=\"selected\"";
                                $uploadPath = 'nominations' . '/' . $childlist->attachment;
                                $file_location = $this->route->get_base_url() . "/" . $uploadPath;



                                $output .= <<<HTML
            
            <a href='$file_location'  target="_blank"> $childlist->pdf_name</a>,<br>
HTML;
                            }


                    ?>

                        <?php endforeach; ?>


                        <?php $flagValue = Helpers::flagoutput($row['p_status']);




                        $rolebasedValue = Helpers::roleBased();






                        if ($rolebasedValue['is_superadmin'] == 1) {


                            $primaryid = $row['nomination_id'];

                            $publishbaseurl = $this->route->site_url("Admin/ajaxresponseforPublish");
                            $archivesbaseurl = $this->route->site_url("Admin/ajaxresponseforArchives");
                            $redirecturl = $this->route->site_url("Admin/dashboard/?action=listnominations&&status=0");
                            $status = $row['p_status'];


                            $actionoutputValue = Helpers::iconOperation($edit_nomination_link_str, $delete_nomination_link_str, $archive_nomination_link_str, $primaryid, $idname,  $publishbaseurl,  $archivesbaseurl, $redirecturl, $status, "Nomination");
                        } else if ($rolebasedValue['is_admin'] == 1) {


                            $primaryid = $row['nomination_id'];

                            $publishbaseurl = $this->route->site_url("Admin/ajaxresponseforPublish");
                            $archivesbaseurl = $this->route->site_url("Admin/ajaxresponseforArchives");
                            $redirecturl = $this->route->site_url("Admin/dashboard/?action=listnominations&&status=0");
                            $status = $row['p_status'];


                            $actionoutputValue = Helpers::iconOperation($edit_nomination_link_str, $delete_nomination_link_str, $archive_nomination_link_str, $primaryid, $idname,  $publishbaseurl,  $archivesbaseurl, $redirecturl, $status, "Nomination");
                        } elseif ($rolebasedValue['is_uploader'] == 1) {
                            $primaryid = $row['nomination_id'];

                            $publishbaseurl = $this->route->site_url("Admin/ajaxresponseforPublish");
                            $archivesbaseurl = $this->route->site_url("Admin/ajaxresponseforArchives");
                            $redirecturl = $this->route->site_url("Admin/dashboard/?action=listnominations&&status=0");
                            $status = $row['p_status'];


                            $actionoutputValue = Helpers::iconOperation($edit_nomination_link_str, $delete_nomination_link_str, $archive_nomination_link_str, $primaryid, $idname,  $publishbaseurl,  $archivesbaseurl, $redirecturl, $status, "Nomination");
                        } else {
                            // if (@$_GET['status'] == 0 && $row['p_status'] != 1) {
                            //     echo '<i class="fa fa-eye nomination-publish-button" style="color:#007bff"></i>';
                            // }
                        }

                        // echo  $output;

                        // $outputarray =explode(" ",$output);





                        // $outputarray = array($output);

                        // print_r( $outputarray);

                        @$array['data'][] = array($primaryid, $row['exam_name'], $row['category_name'], $output, $row['effect_from_date'], $row['effect_to_date'], $flagValue, $actionoutputValue);





                    endforeach;


                    //echo '<pre>';
                    //print_r($array);





                    $string =    json_encode($array);




                    $dataList = substr($string, 1, -1);
                    echo "{" . str_replace('}', ']', str_replace('{', '[', $dataList)) . "}";
                } else {
                    echo 'null';
                }










                break;
            case "Tender":
                $model = new Tender();
                $functionName = "get" . $modelName . "Details";

                $idname = 'tender_id';


                $model_archieves = $model->$functionName($year, $month, $effect_from_date, $effect_to_date);
                $arrayValue = json_decode(json_encode($model_archieves), true);
                if (count($arrayValue) > 0) {

                    foreach ($arrayValue  as $row) {

                        $delete_tender_link_str = str_replace("{id}", $row['tender_id'], $dlink);
                        $edit_tender_link_str = str_replace("{id}", $row['tender_id'], $elink);

                        $archive_tender_link_str = str_replace("{id}", $row['tender_id'], $alink);





                        $uploadPath = 'tender' . '/' . $row['attachment'];
                        $file_location = $this->route->get_base_url() . "/" . $uploadPath;

                        $output = "";
                        $output .=  '<a href=" ' . $file_location . '" target="_blank">' . $row["attachment"] . ' </a>';

                        ?>

<?php

                        $flagValue = Helpers::flagoutput($row['p_status']);
                        $rolebasedValue = Helpers::roleBased();

                        if ($rolebasedValue['is_admin'] == 1) {


                            $primaryid = $row['tender_id'];

                            $publishbaseurl = $this->route->site_url("Admin/ajaxresponseforPublish");
                            $archivesbaseurl = $this->route->site_url("Admin/ajaxresponseforArchives");
                            $redirecturl = $this->route->site_url("Admin/dashboard/?action=tender_archieves_by_month&&status=0");
                            $status = $row['p_status'];


                            $actionoutputValue = Helpers::iconOperation($edit_tender_link_str, $delete_tender_link_str, $archive_tender_link_str, $primaryid, $idname, $publishbaseurl,  $archivesbaseurl, $redirecturl, $status, "Tender");
                        }


                        @$array['data'][] = array($row['tender_id'], $row['pdf_name'], $output, $row['effect_from_date'], $row['effect_to_date'], $flagValue, $actionoutputValue);
                    }
                    $string =    json_encode($array);
                    $dataList = substr($string, 1, -1);
                    echo "{" . str_replace('}', ']', str_replace('{', '[', $dataList)) . "}";
                } else {
                    echo 'null';
                }



















                break;
            default:
                echo "Your favorite color is neither red, blue, nor green!";
        }
    }
















    /*****
     * 
     * 
     * Selection Post Archives By Month
     * 
     * 
     * 
     */





    ################  Ajax Response For  Category  Start ##############

    public function ajaxresponseforPublish()
    {
        $rowid = Helpers::cleanData($_POST['rowid']);
        $modelClassName = Helpers::cleanData($_POST['modelClassName']);



        // $favcolor = "red";

        switch ($modelClassName) {
            case "Gallery":
                $model = new Gallery();
                break;
            case "SelectionpostArchives":
                $model = new SelectionpostArchives();
                break;
            case "NoticeArchives":
                $model = new NoticeArchives();
                break;
            case "TenderArchives":
                $model = new TenderArchives();
                break;
            case "Tender":
                $model = new Tender();
                break;
            default:
                echo "Your favorite color is neither red, blue, nor green!";
        }

        $functionName = "update" . $modelClassName . "State";
        //  echo $functionName;

        //  exit;



        $data = [
            'p_status' => '1',
        ];

        if ($model->$functionName($data,  $rowid)) {
            $message = 1;
            header('Content-Type: application/json');
            echo json_encode(array("message" => $message));
        }
    }
    ################  Ajax Response For  Category   End ##############



    public function ajaxresponseforArchives()
    {
        $rowid = Helpers::cleanData($_POST['rowid']);
        $modelClassName = Helpers::cleanData($_POST['modelClassName']);

        // echo  $rowid;

        // echo  $modelClassName;
        //sa exit;

        // $favcolor = "red";

        switch ($modelClassName) {
            case "Nomination":
                $model = new Nomination();
                $redirectUrl = 'listnominations';
                break;
            case "SelectionpostArchives":
                $model = new SelectionpostArchives();
                break;
            case "NoticeArchives":
                $model = new NoticeArchives();
                break;
            case "TenderArchives":
                $model = new TenderArchives();
                break;
            case "Tender":
                $model = new Tender();
                break;
            default:
                echo "Your favorite color is neither red, blue, nor green!";
        }

        $functionName = "archive" . $modelClassName . "Status";
        $tenderlist_data = $_POST['rowid'];
        //  echo $functionName;
        if ($model->$functionName($tenderlist_data)) {


            $message =  $modelClassName . "  Archived successfully";

            $status = 'success';
            header('Content-Type: application/json');
            echo json_encode(array("message" => $message, "status" => $status));
        }






        // $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];

        // $redirectUrlPath = "Admin/dashboard/?action=".$redirectUrl;

        // echo  $redirectUrlPath ;







        // $this->route->redirect($this->route->site_url( $redirectUrlPath));
        // exit;
    }






    ################  Ajax Response For  Category  Start ##############

    public function ajaxresponseforCategory()
    {
        $cat_id = Helpers::cleanData($_POST['cat_id']);
        // echo $cid;
        $category_model = new Category();

        $category_data = [
            'status' => '1',
        ];

        if ($category_model->updateCategoryState($category_data, $cat_id)) {
            $message = 1;
            header('Content-Type: application/json');
            echo json_encode(array("message" => $message));
        }
    }
    ################  Ajax Response For  Category   End ##############














    /*  Check Username Availability with jQuery and AJAX  Start*/

    public function ajaxResponseforUserNameAlreadyExists()
    {
        $username = Helpers::cleanData($_POST['username']);
        // echo $cid;
        $user_lists = new Loginusers();

        if ($user_lists->usernameAlreadyExists($username)) {
            $message = 1;
            header('Content-Type: application/json');
            echo json_encode(array("message" => $message));
        }
    }

    /*  Check Username Availability with jQuery and AJAX  Start*/

    /*  Check Email Availability with jQuery and AJAX  Start*/

    public function ajaxResponseforEmailAlreadyExists()
    {
        $email = Helpers::cleanData($_POST['email']);
        // echo $cid;
        $user_lists = new Loginusers();

        if ($user_lists->emailAlreadyExists($email)) {
            $message = 1;
            header('Content-Type: application/json');
            echo json_encode(array("message" => $message));
        }
    }

    /*  Check Email Availability with jQuery and AJAX  Start*/
    /*  Check Phone Number Availability with jQuery and AJAX  Start*/

    public function ajaxResponseforPhoneNumberAlreadyExists()
    {
        $phone_number = Helpers::cleanData($_POST['phone_number']);
        // echo $cid;
        $user_lists = new Loginusers();

        if ($user_lists->phonenumberAlreadyExists($phone_number)) {
            $message = 1;
            header('Content-Type: application/json');
            echo json_encode(array("message" => $message));
        }
    }

    /*  Check Phone Number Availability with jQuery and AJAX  Start*/

    #######################   Event Category Start #####################
    public function editEventCategory()
    {
        $data = [];
        $this->saveEventCategory();
        $user = new User();
        $loginUser = $user->getUser();
        ########  Role checking ########

        $is_superadmin = $user->is_superadmin(); // super admin 
        $data['is_superadmin'] = $is_superadmin; // super admin 

        $is_admin = $user->is_admin(); // admin 
        $data['is_admin'] = $is_admin; // admin 

        $is_uploader = $user->is_uploader(); //uploader
        $data['is_uploader'] = $is_uploader; //uploader

        $is_publisher = $user->is_publisher();  // publisher
        $data['is_publisher'] = $is_publisher;  // publisher

        ########  Role Checking ########
        $data['logged_user'] = $loginUser;


        $eventcategory = new EventCategory();
        // chek if the id is available in the params 
        $eventcategoryid = (isset($this->data['params'][0])) ? $this->data['params'][0] : 0;



        $current_eventcategory = $eventcategory->getEventCategoryby($eventcategoryid, DB_ASSOC);


        $data['current_eventcategory'] = $current_eventcategory;

        $this->prepare_menus($data);
        $this->render("edit-eventcategory", $data);
    }
    private function saveEventCategory()
    {




        $message = $message_type = "";
        if (isset($_POST['save_event_category'])) {





            $event_id = isset($_POST['id']) ? $_POST['id'] : 0;


            $creation_date = date('Y-m-d', strtotime(Helpers::cleanData($_POST['creation_date'])));
            $event_category_data = [
                'event_name' => Helpers::cleanData($_POST['event_name']),
                'creation_date' => $creation_date,
                'status' => '0'
            ];




            $event =  new  \App\Models\EventCategory();

            if ($event_id == 0) { // insert new menu 


                if ($event->addEventCategory($event_category_data)) {


                    $message = "Event Category Added successfully";
                    $message_type = "success";
                } else {
                    $message = "Error adding Event Category ";
                    $message_type = "warning";
                }
            } else { // update menu



                if ($event->updateEventCategory($event_category_data, $event_id)) {
                    $message = "Event Category Updated successfully";
                    $message_type = "success";
                } else {
                    $message = "Error updating Event Category ";
                    $message_type = "warning";
                }
            }
            $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
            $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listofeventcategories"));
        }
    }

    public function deleteeventcategory()
    {
        $data = [];
        $message = $message_type = "";
        $eventcategory_id = $this->data['params'][0];




        $eventcategory = new EventCategory();
        if ($eventcategory->deleteEventCategory($eventcategory_id)) {
            $message = "Event Category Deleted successfully";
            $message_type = "success";
        } else {
            $message = "Error deleting Event Category ";
        }
        $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
        $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listofeventcategories"));
    }

    #######################   Event Category End #####################

    #############################  FAQ  start  ############################
    public function editfaq()
    {
        $data = [];
        $this->saveFaq();
        $user = new User();
        $loginUser = $user->getUser();
        $is_admin = $user->is_admin();
        $data['is_admin'] = $is_admin;
        $data['logged_user'] = $loginUser;


        ########  Role checking ########

        $is_superadmin = $user->is_superadmin(); // super admin 
        $data['is_superadmin'] = $is_superadmin; // super admin 

        $is_admin = $user->is_admin(); // admin 
        $data['is_admin'] = $is_admin; // admin 

        $is_uploader = $user->is_uploader(); //uploader
        $data['is_uploader'] = $is_uploader; //uploader

        $is_publisher = $user->is_publisher();  // publisher
        $data['is_publisher'] = $is_publisher;  // publisher

        ########  Role Checking ########

        ob_start();
        if ($is_admin) {
        }
        $faq = new Faq();
        // chek if the id is available in the params 
        $faq_id = (isset($this->data['params'][0])) ? $this->data['params'][0] : 0;

        $current_faq = $faq->getFaqby($faq_id, DB_ASSOC);
        $data['current_faq'] = $current_faq;



        $faqs = $faq->getFaqList();
        $data['faqs'] = $faqs;
        $this->prepare_menus($data);
        $this->render("edit-faq", $data);
    }
    private function saveFaq()
    {
        $message = $message_type = "";
        if (isset($_POST['save_faq'])) {
            $faq_id = isset($_POST['id']) ? $_POST['id'] : 0;
            $effect_from_date = date('Y-m-d', strtotime(Helpers::cleanData($_POST['effect_from_date'])));

            $faq_title = Helpers::cleanData($_POST['faq_title']);
            $faq_title_cs =  Helpers::e($faq_title);


            $faq_content = Helpers::cleanData($_POST['faq_content']);
            $faq_content_cs =  Helpers::e($faq_content);





            $faqlist_data = [
                'faq_title' =>  $faq_title_cs,
                'faq_content' =>  $faq_content_cs,
                'effect_from_date' => $effect_from_date,
                'p_status' => '0'
            ];


            /* echo "<pre>";
			print_r($menu_data);
			exit; */

            $faqlist =  new  \App\Models\Faq();

            if ($faq_id == 0) { // insert new menu 


                if ($faqlist->addFaq($faqlist_data)) {


                    $message = "Faq   Added successfully";
                    $message_type = "success";
                } else {
                    $message = "Error adding Faq";
                    $message_type = "warning";
                }
            } else { // update menu

                if ($faqlist->updateFaq($faqlist_data, $faq_id)) {
                    $message = "Faq Updated successfully";
                    $message_type = "success";
                } else {
                    $message = "Error updating Faq";
                    $message_type = "warning";
                }
            }
            $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
            $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listoffaq"));
        }
    }


    public function deleteFaq()
    {
        $data = [];
        $message = $message_type = "";
        $faq_id = $this->data['params'][0];




        $faq = new Faq();
        if ($faq->deleteFaqStatus($faq_id)) {
            $message = "Faq  Deleted successfully";
            $message_type = "success";
        } else {
            $message = "Error deleting Faq ";
        }
        $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
        $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listoffaq"));
    }


    #############################  FAQ  End  ############################













    #######################   Gallery Start #####################
    public function editGallery()
    {
        $data = [];
        $this->saveGallery();
        $user = new User();
        $loginUser = $user->getUser();
        ########  Role checking ########

        $is_superadmin = $user->is_superadmin(); // super admin 
        $data['is_superadmin'] = $is_superadmin; // super admin 

        $is_admin = $user->is_admin(); // admin 
        $data['is_admin'] = $is_admin; // admin 

        $is_uploader = $user->is_uploader(); //uploader
        $data['is_uploader'] = $is_uploader; //uploader

        $is_publisher = $user->is_publisher();  // publisher
        $data['is_publisher'] = $is_publisher;  // publisher

        ########  Role Checking ########
        $data['logged_user'] = $loginUser;


        $gallery_model = new Gallery();
        // chek if the id is available in the params 
        $gallery_id = (isset($this->data['params'][0])) ? $this->data['params'][0] : 0;


        $current_gallery = $gallery_model->getGallery($gallery_id, DB_ASSOC);
        $data['current_gallery'] = $current_gallery;

        $gallery_child_model = new GalleryChild();

        $gallery_child_list = $gallery_child_model->getGalleryChildList();
        $data['gallery_child_list'] = $gallery_child_list;
        //$nominations = $nomination->getNominations();

        //$data['nominations'] = $nominations;

        $data['gallery_id'] =  $gallery_id;

        $eventcategory_model = new EventCategory();

        $eventcategories = $eventcategory_model->getEventCategoriesList();

        $data['eventcategories'] = $eventcategories;

        $this->prepare_menus($data);
        $this->render("edit-gallery", $data);
    }
    private function saveGallery()

    {
        $message = $message_type = "";
        if (isset($_POST['save_gallery'])) {
            $gallery_id = isset($_POST['gallery_id']) ? $_POST['gallery_id'] : 0;
            $gallery_model =  new \App\Models\Gallery();
            $gallery_data = [

                'year' => Helpers::cleanData($_POST['year']),
                'event_id' => Helpers::cleanData($_POST['event_id']),
                'creation_date' => date('Y-m-d', strtotime(Helpers::cleanData($_POST['creation_date']))),

            ];

            if ($gallery_id == 0) {
                // insert new menu 
                if ($gallery_model->addGallery($gallery_data)) {
                    $lastinsertsql = $gallery_model->lastInsertedId();
                    $lastinsertedid =  $lastinsertsql['max'];

                    foreach ($_FILES['image_file']['name'] as $i => $name) {

                        $tmp_name = $_FILES['image_file']['tmp_name'][$i];

                        $error = $_FILES['image_file']['error'][$i];

                        $size = $_FILES['image_file']['size'][$i];

                        $type = $_FILES['image_file']['type'][$i];

                        $folder = './gallery/';

                        $file = rand(1000, 100000) . "-" . $_FILES['image_file']['name'][$i];

                        $new_file_name = strtolower($file);

                        $final_file = str_replace(' ', '-', $new_file_name);

                        if (move_uploaded_file($tmp_name, $folder . $final_file)) {  // echo "File is valid, and was successfully uploaded.\n";

                        } else {

                            echo "File size greater than 300kb!\n\n";
                        }
                        $gallery_model_child =  new \App\Models\GalleryChild();

                        $gallery_child_data = [

                            'gallery_id' => $lastinsertedid,

                            'image_path' => $final_file,

                            'status' => 1

                        ];

                        $gallery_model_child->addGalleryChild($gallery_child_data);
                    }
                    $message = "Gallery Added successfully";

                    $message_type = "success";
                } else {

                    $message = "Error adding Gallery";

                    $message_type = "warning";
                }
            } else { // update menu


                $gallery_data = [

                    'year' => Helpers::cleanData($_POST['year']),
                    'event_id' => Helpers::cleanData($_POST['event_id']),
                    'creation_date' => date('Y-m-d', strtotime(Helpers::cleanData($_POST['creation_date']))),
                    'p_status' => '0',

                ];
                if ($gallery_model->updateGallery($gallery_data, $gallery_id)) {

                    foreach ($_FILES['image_file']['name'] as $i => $name) {

                        if ($_FILES['image_file']['size'][$i] != 0) {

                            $child_id = isset($_POST['image_id'][$i]) ? $_POST['image_id'][$i] : 0;

                            $tmp_name = $_FILES['image_file']['tmp_name'][$i];

                            $error = $_FILES['image_file']['error'][$i];

                            $size = $_FILES['image_file']['size'][$i];

                            $type = $_FILES['image_file']['type'][$i];

                            $folder = './gallery/';

                            $file = rand(1000, 100000) . "-" . $_FILES['image_file']['name'][$i];

                            $new_file_name = strtolower($file);

                            $final_file = str_replace(' ', '-', $new_file_name);

                            if (move_uploaded_file($tmp_name, $folder . $final_file)) {  // echo "File is valid, and was successfully uploaded.\n";

                            } else {

                                echo "File size greater than 300kb!\n\n";
                            }

                            $gallery_model_child =  new \App\Models\GalleryChild();

                            $lastinsertsql = $gallery_model->lastInsertedId();
                            $lastinsertedid =  $lastinsertsql['max'];

                            $gallery_child_data = [

                                'gallery_id' => $lastinsertedid,

                                'image_path' => $final_file,

                                'status' => 1

                            ];

                            if ($child_id == 0) {
                                $gallery_model_child->addGalleryChild($gallery_child_data);
                            } else {

                                $gallery_model_child->updateGalleryChild($gallery_child_data, $child_id);
                            }
                        } //Validation

                    }

                    $message = "Gallery Updated successfully";

                    $message_type = "success";
                } else {

                    $message = "Error updating Gallery";

                    $message_type = "warning";
                }
            }

            $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];

            $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listofphotogallery"));
        }
    }



    #######################   Gallery  End #####################

    public function ajaxResponseForDataTableLoad()
    {

       
        







        $request = 1;
        if (isset($_POST['request'])) {
            $request = $_POST['request'];
        }
        if ($request == 1) {
            ## Read value
            $draw = $_POST['draw'];
            $row = $_POST['start'];



            $rowperpage = $_POST['length']; // Rows display per page
            $columnIndex = $_POST['order'][0]['column']; // Column index
            $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
            $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc

            $searchValue = $_POST['search']['value']; // Search value

            ## Search 
            $searchQuery = " ";
            if ($searchValue != '') {
                $searchQuery = "   exam_name ilike '%".$searchValue."%' or 
                category_name ilike '%".$searchValue."%' or 
                TO_CHAR(effect_from_date, 'yyyy-mm-dd') like'%".$searchValue."%'  or
                TO_CHAR(effect_to_date, 'yyyy-mm-dd') like'%".$searchValue."%' 
                 ";

              //  echo $searchQuery;
                
            }

          

            ## Total number of records without filtering
            $model = new Nomination();

            // if (!isset($_POST["year"])) {


            //     //echo 'di';
            //    // exit;



            //     $totalRecordsWithoutFiltering =  $model->totalRecordsWithOutFiltering();

            //     $totalRecords = $totalRecordsWithoutFiltering->allcount;
    
    
            //     ## Total number of records with filtering
    
            //     $totalRecordsWithFiltering =  $model->totalRecordsWithFiltering($searchQuery);
    
            //     $totalRecordwithFilter = $totalRecordsWithFiltering->allcount;

            //      ## Fetch records
            // $fetchRecordsObject =  $model->totalRecordWithFiltering($searchQuery);


            // $fetchRecords = (array)$fetchRecordsObject;

            // }
            // else{

               // echo 'stalin';

                //exit;

                $year = trim($_POST['year']);
                $month = trim($_POST['month']);
                //$effect_from_date = $_POST['effect_from_date'];

                $effect_from_date =  date('Y-m-d', strtotime($_POST['effect_from_date'])); 
                $effect_to_date =  date('Y-m-d', strtotime($_POST['effect_to_date'])); 


                $totalRecordsWithoutFiltering =  $model->totalRecordsWithOutFiltering();

                $totalRecords = $totalRecordsWithoutFiltering->allcount;
    
    
                ## Total number of records with filtering
    
                $totalRecordsWithFiltering =  $model->totalRecordsWithFiltering($searchQuery);
    
                $totalRecordwithFilter = $totalRecordsWithFiltering->allcount;
                

                $fetchRecordsObject = $model->getNominationDetails($year, $month, $effect_from_date, $effect_to_date,$searchQuery);

                $fetchRecords = (array)$fetchRecordsObject;


           // }


           





           


            //echo '<pre>';

            //print_R($fetchRecords);
            //exit;

            $nominationchildlist = Helpers::getNominationChildListforAdmin();


            //echo '<pre>';

            //print_R($this->links);

            //exit;

            $edit_nomination_link =  $this->links['edit_nomination_link'];


            $data = array();

            foreach ($fetchRecords  as $rowval) {

                $edit_nomination_link_str = str_replace("{id}", $rowval->nomination_id, $edit_nomination_link);

                $baseurl = $this->route->site_url($edit_nomination_link_str);

                // // Update Button
                //  $updateButton = "<button class='btn btn-sm btn-info updateUser' data-id='".$row['id']."' data-toggle='modal' data-target='#updateModal' >Update</button>";

                $updateButton =  "<a href= '" . $baseurl . "' name='menu_update' class='iconSize'> 
               
         <button type='button' title='Edit' class='btn btn-secondary iconWidth updateUser'><i class='fas fa-edit'></i></button>
         </a>";



                // Delete Button
                $deleteButton = "<button title='Delete' class='btn btn-sm btn-danger iconWidth deletebtn' style='height:30px'  data-id='" . $rowval->nomination_id . "'><i class='fa fa-trash'></i></button>";
                $archivesButton = "<button  title='Archive' style='height:30px' class='btn btn-sm btn-primary archivebtn' data-id='" . $rowval->nomination_id . "'><i class='fa  fa-archive'></i></button>";

                if ( $rowval->p_status != 1) {
                    $publishButton = "<button  title='Publish' style='height:30px' class='btn btn-sm btn-success publishbtn iconWidth' data-id='" . $rowval->nomination_id . "'><i class='fa  fa-eye'></i></button>";
                    $action = $updateButton . " " . $deleteButton . " " . $archivesButton . " " . $publishButton;
                }
                else{
                    $action = $updateButton . " " . $deleteButton . " " . $archivesButton ;

                }

                

                $pdfPath = "";

                foreach ($nominationchildlist as $key => $childlist) {

                    $selected = "";
                    if ($rowval->nomination_id == $childlist->nomination_id) {
                        $selected = "selected=\"selected\"";
                        $uploadPath = 'nominations' . '/' . $childlist->attachment;
                        $file_location = $this->route->get_base_url() . "/" . $uploadPath;
                        $pdfPath .= <<<TEXT
                <a href="$file_location " target="_blank">$childlist->pdf_name </a>,<br>
TEXT;
                    }
                }

                $flag = "";
                if ($rowval->p_status == 1) {

                    $flag .= '<i class="fa fa-flag" aria-hidden="true"  style="color:green"></i>';
                } else {
                    $flag .=  '<i class="fa fa-flag" aria-hidden="true" style="color:red"></i>';
                }








                $data[] = array(
                    "nomination_id" => $rowval->nomination_id,
                    "exam_name" => $rowval->exam_name,
                    "category_name" => $rowval->category_name,
                    "pdf_name"      => $pdfPath,
                    "effect_from_date"      => $rowval->effect_from_date,
                    "effect_to_date"      => $rowval->effect_to_date,
                    "p_status"      => $flag,
                    "action"      => $action,


                );
            }

            ## Response
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $data
            );

            echo json_encode($response);
            exit;
        }  //request 1


        // Delete Nomination
        if ($request == 4) {

            $id = $_POST['id'];
            // Check id
            ## Fetch records
            $model = new Nomination();
            $checkId =  $model->checkNominationId($id);
            $checkIdCount = $checkId->checkid;
            if ($checkIdCount > 0) {
                $deleteQuery =  $model->deleteNomination($id);
                echo 1;
                exit;
            } else {
                echo 0;
                exit;
            }
        }
        // Archive Nomination
        if ($request == 5) {

            $id = $_POST['id'];
            // Check id
            ## Fetch records
            $model = new Nomination();
            $checkId =  $model->checkNominationId($id);
            $checkIdCount = $checkId->checkid;
            if ($checkIdCount > 0) {
                $archiveQuery =  $model->archiveNominationStatus($id);
                echo 1;
                exit;
            } else {
                echo 0;
                exit;
            }
        }

         // Publish Nomination
         if ($request == 6) {

            $id = $_POST['id'];

            $nomination_data = [
                'p_status' => '1',
            ];
    
            
            // Check id
            ## Fetch records
            $model = new Nomination();
            $checkId =  $model->checkNominationId($id);
            $checkIdCount = $checkId->checkid;
            if ($checkIdCount > 0) {
                $publishQuery =  $model->updateNominationState($nomination_data, $id);
                echo 1;
                exit;
            } else {
                echo 0;
                exit;
            }
        }
    }

   public function  commonNominationArchive(){


    //echo '<pre>';
   // print_R($_POST);
   // exit;


    if (!empty($_POST["action"])) {

        $nomination = new Nomination();


        $nomination_list_data = $_POST['ids'];

        if($_POST["action"] == 'archive'){

            if ($nomination->archiveNominationStatus($nomination_list_data)) {


                $message = "Nomination  Archived successfully";
                $message_type = "success";
            }
        

        }
        else{

            if ($nomination->deleteNomination($nomination_list_data)) {


                $message = "Nomination  Deleted successfully";
                $message_type = "success";
            }

        }

    }


   


   
    $_SESSION['notification'] = ['message' => $message, 'message_type' => $message_type];
        $this->route->redirect($this->route->site_url("Admin/dashboard/?action=listnominations"));


   }

}
