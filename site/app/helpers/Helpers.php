<?php

namespace App\Helpers;

use App\Models\Post;

use App\System\Route;
use App\Models\Faq as Faq;
use App\Models\Loginusers;
use App\Models\Users;

use App\Models\Exam as Exam;

use App\Models\GalleryChild;
use App\Models\EventCategory;
use App\Models\NoticeArchives;
use App\Models\Phase as Phase;
use App\Models\TenderArchives;

use App\Models\Notice as Notice;
use App\Models\Tender as Tender;
use App\Models\Gallery as Gallery;
use App\Models\Category as Category;
use App\Models\Examtype as Examtype;
use App\Models\Admitcard as Admitcard;
use App\Models\Department as Department;
use App\Models\Nomination as Nomination;
use App\Models\Debarredlists as Debarredlists;
use App\Models\Selectionpost as Selectionpost;
use App\Models\ImportantLinks as ImportantLinks;
use App\Models\Knowyourstatus as Knowyourstatus;

use App\Models\Nominationchild as Nominationchild;
use App\Models\NominationArchieves as NominationArchieves;
use App\Models\Selectionpostschild as Selectionpostschild;
use App\Models\SelectionpostArchives as SelectionpostArchives;
use App\Models\NominationArchieveschild as NominationArchieveschild;
use App\Models\SelectionpostschildArchives as SelectionpostschildArchives;



class Helpers
{
	/** helper methods / functions */
	static function urlSecurityAudit()
	{
		if (!isset($_SERVER['HTTP_REFERER']) || !isset($_SESSION['user']['username'])) {
			// redirect them to your desired location
			session_destroy();
			$route = new Route();
			$route->redirect($route->get_app_url());
			exit;
		}
	}

	static function e($value)
	{
		return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
	}


	static function cleanData($val)
	{
		return pg_escape_string($val);
	}
	// menu in options
	static function showMenuOptions($menus, $default_parent_id = 0, $current_menu_id = 0, $parent_id = 0, $chr = '')
	{


		foreach ($menus as $key => $item) {
			if ($item->menu_parent_id == $parent_id) {
				if ($item->id == $default_parent_id) {
					$selected = " selected=\"selected\" ";
				} else {
					$selected = "";
				}

				if ($item->id == $current_menu_id) {
					$disabled = " disabled=\"disabled\" ";
				} else {
					$disabled = "";
				}
				echo '<option ' . $selected . $disabled . ' value="' . $item->id . '">';
				echo $chr . $item->menu_name;
				echo '</option>';

				unset($menus[$key]);

				self::showMenuOptions($menus, $default_parent_id, $current_menu_id, $item->id, $chr . "|---");
			}
		}
	}
	// menu in links
	static function showMenuLinks($menus, $parent_id = 0, $level = 0)
	{
		$menu_children = array();
		foreach ($menus as $key => $item) {

			if ($item->menu_parent_id == $parent_id) {
				$menu_children[] = $item;
				unset($menus[$key]);
			}
		}
		//echo '<pre>';print_r($menu_children);
		if ($menu_children) {
			if ($parent_id == 0) {
				$ulclass = "nav navbar-nav navrulerclass";
				$liclass = 'dropdown';

				$extraDivStart = "";
				$extraDivEnd = "";
			} else {
				$ulclass = "dropdown-menu";
				$liclass = '';

				//$extraDivStart = '<div class="sub-nav col-1 ">';
				//$extraDivEnd = "</div>";
			}
			// echo $extraDivStart;
			echo '<ul class="' . $ulclass . " level-" . $level .  '">';
			//echo $level;
			//exit;
			/* if($level != 0){
					$angle='&nbsp;<i class="fa fa-angle-down"></i>';
				}
				else{
					$angle='';
				} */
			foreach ($menu_children as $key => $item) {



				//	$menu_children.count() != 0 ? $angle='&nbsp;<i class="fa fa-angle-down"></i>' : $angle='';

				echo '<li class="' . $liclass . '">';


				if ($item->is_redirect_popup == 0) {

					echo '<a href="' . $item->menu_full_url . '" >' . $item->menu_name . '</a>';
				} else {

					echo '<a href="' . $item->menu_full_url . '"  rel = "noopener noreferrer" target="_blank"  class="thumbnail page-permission" aria-label="Government of Tamil Nadu - External site that opens in a new window">' . $item->menu_name . '</a>';
				}


				self::showMenuLinks($menus, $item->id, $level++);
				echo '</li>';
			}
			echo '</ul>';
			// echo $extraDivEnd;
		}

		/*  if ($menu_children) {
            if ($parent_id == 0) {
                $ulclass = "nav navbar-nav ";
                $liclass = 'dropdown';
                $extraDivStart = "";
                $extraDivEnd = "";
            } else {
               /*  $ulclass = "";
                $liclass = 'dropdown';
                $extraDivStart = '<div class="dropdown-menus">';
                $extraDivEnd = "</div>";
				$name = ""; 
				$ulclass = "sub-nav-group ";
                $liclass = '';
                $extraDivStart = '<div class="sub-nav col-1">';
                $extraDivEnd = "</div>";
            }
            echo $extraDivStart;
            echo '<ul class="' . $ulclass .  '">';
            foreach ($menu_children as $key => $item) {

                echo '<li class="' . $liclass . '"><a href="' . $item->menu_full_url . '" id="accessible-megamenu-1620300104514-2" aria-haspopup="true" aria-controls="accessible-megamenu-1620300104514-3" aria-expanded="false" class="">' . $item->menu_name ."</a>";
                self::showMenuLinks($menus, $item->id, $level++);
                echo '</li>';
            }
            echo '</ul>';
            echo $extraDivEnd;
        } */
	}


	// menu in links
	static function showFooterMenuLinks($menus, $parent_id = 0, $level = 0)
	{
		$menu_children = array();
		foreach ($menus as $key => $item) {

			if ($item->menu_parent_id == $parent_id) {
				$menu_children[] = $item;
				unset($menus[$key]);
			}
		}
		//echo '<pre>';print_r($menu_children);
		if ($menu_children) {

			if ($parent_id == 0) {
				$ulclass = "nav navbar-nav navrulerclass";
				$liclass = 'dropdown';

				$extraDivStart = "";
				$extraDivEnd = "";
			} else {
				$ulclass = "dropdown-menu";
				$liclass = '';

				//$extraDivStart = '<div class="sub-nav col-1 ">';
				//$extraDivEnd = "</div>";
			}

			// echo $extraDivStart;
			echo '<ul class="nav navbar-nav"  style="margin-left: 35px;">';
			//echo $level;
			//exit;
			/* if($level != 0){
					$angle='&nbsp;<i class="fa fa-angle-down"></i>';
				}
				else{
					$angle='';
				} */
			foreach ($menu_children as $key => $item) {



				//	$menu_children.count() != 0 ? $angle='&nbsp;<i class="fa fa-angle-down"></i>' : $angle='';

				echo '<li><a href="' . $item->menu_full_url . '"  class="footerClassLi" >' . $item->menu_name . "</a>";
				self::showFooterMenuLinks($menus, $item->id, $level++);
				echo '</li>';
			}
			echo '</ul>';
			// echo $extraDivEnd;
		}

		/*  if ($menu_children) {
            if ($parent_id == 0) {
                $ulclass = "nav navbar-nav ";
                $liclass = 'dropdown';
                $extraDivStart = "";
                $extraDivEnd = "";
            } else {
               /*  $ulclass = "";
                $liclass = 'dropdown';
                $extraDivStart = '<div class="dropdown-menus">';
                $extraDivEnd = "</div>";
				$name = ""; 
				$ulclass = "sub-nav-group ";
                $liclass = '';
                $extraDivStart = '<div class="sub-nav col-1">';
                $extraDivEnd = "</div>";
            }
            echo $extraDivStart;
            echo '<ul class="' . $ulclass .  '">';
            foreach ($menu_children as $key => $item) {

                echo '<li class="' . $liclass . '"><a href="' . $item->menu_full_url . '" id="accessible-megamenu-1620300104514-2" aria-haspopup="true" aria-controls="accessible-megamenu-1620300104514-3" aria-expanded="false" class="">' . $item->menu_name ."</a>";
                self::showMenuLinks($menus, $item->id, $level++);
                echo '</li>';
            }
            echo '</ul>';
            echo $extraDivEnd;
        } */
	}


	static function getImporantLinksFirstFourRow()
	{


		$ilink = new ImportantLinks();
		$ilinkforFirstFourRow = $ilink->getHomePageImportantLinksListFirstFourRowsOnly();
		return $ilinkforFirstFourRow;
	}
	static function getImporantLinksAfterFourRow()
	{

		$ilink = new ImportantLinks();
		$ilinkforAfterFirstFourRow = $ilink->getHomePageImportantLinksListAfterFirstFourRowsOnly();
		return $ilinkforAfterFirstFourRow;
	}
	static function getGalleryidBasedImages()
	{

		$Gallery = new Gallery();
		$q =  "on";
		$gallery_id_based_images = $Gallery->getGalleryidBasedImagesModel($q);
		
		return $gallery_id_based_images;
	}

	static function getNomination()
	{
		$nomination = new Nomination();
		$nominations = $nomination->getHomeNominationsList();
		return $nominations;
	}

	static function getNominationChildList()
	{
		$nominationchildclass = new Nominationchild();
		$nominationchildlist = $nominationchildclass->getNominationchild();
		return $nominationchildlist;
	}
	/****
	 * 
	 * Nomination Archives
	 * 
	 */

	static function getNominationArchives()
	{
		$nomination = new NominationArchieves();
		$nominations = $nomination->getHomeNominationsList();
		return $nominations;
	}

	static function getNominationChildListArchives()
	{
		$nominationchildclass = new NominationArchieveschild();
		$nominationchildlist = $nominationchildclass->getNominationArchieveschild();
		return $nominationchildlist;
	}


	/****
	 * 
	 * Nomination Archives
	 * 
	 */













	/******
	 * 
	 * Nomination List For Latest News
	 * date: 14-07-2022
	 * 
	 */

	static function getNominationLatestNews()
	{
		$nomination = new Nomination();
		$nominations = $nomination->getHomeNominationsListLatestNews();
		return $nominations;
	}

	static function getNominationChildListNews()
	{
		$nominationchildclass = new Nominationchild();
		$nominationchildlist = $nominationchildclass->getNominationchildLatestNews();
		return $nominationchildlist;
	}



	/******
	 * 
	 * Nomination List For Latest News
	 * 
	 * 
	 */

	/****
	 *
	 * Nomination Archieves
	 *
	 */


	static function getNominationArchievesListforAdmin()
	{
		$nomination = new NominationArchieves();
		$nominations = $nomination->getNominationsArchievesList();
		return  $nominations;
	}


	static function getNominationArchievesChildListforAdmin()
	{
		$nominationchildclass = new NominationArchieveschild();
		$nominationchildlist = $nominationchildclass->getNominationArchieveschild();
		return  $nominationchildlist;
	}





	/*****
	 * 
	 * Selection Posts
	 * 
	 * 
	 * 
	 */



	static function getSelectionPostsArchievesListforAdmin()
	{
		$nomination = new SelectionpostArchives();
		$nominations = $nomination->getSelectionPostListAdmin();
		return  $nominations;
	}


	static function getSelectionPostsArchievesChildListforAdmin()
	{
		$nominationchildclass = new SelectionpostschildArchives();
		$nominationchildlist = $nominationchildclass->getSelectionpostschild();
		return  $nominationchildlist;
	}


	/*****
	 * 
	 * Selection Posts
	 * 
	 * 
	 * 
	 */








	static function getNotice()
	{
		$notice = new Notice();
		$notices = $notice->getNotice();
		return $notices;
	}
	/****
	 * 
	 * Notice For Latest News
	 * 
	 */
	/***
	 *
	 * #faq
	 */
	static function getFaqListforAdmin()
	{
		$faqmodel = new Faq();
		$faqlists = $faqmodel->getFaqList();
		return $faqlists;
	}


	static function getNoticeLatestNews()
	{
		$notice = new Notice();
		$notices = $notice->getNoticeLatestNews();
		return $notices;
	}



	static function getCategory()
	{
		$category = new Category();
		$categorylist = $category->getCategoryNominations();
		return $categorylist;
	}
	static function getTender()
	{
		$tender = new Tender();
		$tenders = $tender->getHomePageTenderList();
		return $tenders;
	}
	/***
	 * 
	 * Tender For Latest News
	 */

	static function getTenderLatestNews()
	{
		$tender = new Tender();
		$tenders = $tender->getHomePageTenderListLatestNews();
		return $tenders;
	}

	static function getSelectionPost()
	{
		$selectionpost = new Selectionpost();
		$selectionposts = $selectionpost->getSelectionPostList();
		return $selectionposts;
	}

	static function getSelectionPostChild()
	{
		$selectionpostchildclass = new Selectionpostschild();
		$selectpostschildlist = $selectionpostchildclass->getSelectionpostschild();
		return $selectpostschildlist;
	}



	/*******
	 * 
	 * Sp List For Latest News
	 * 
	 * 
	 * 
	 */
	static function getSelectionPostLatestNews()
	{
		$selectionpost = new Selectionpost();
		$selectionposts = $selectionpost->getSelectionPostListLatestNews();
		return $selectionposts;
	}

	static function getSelectionPostChildLatestNews()
	{
		$selectionpostchildclass = new Selectionpostschild();
		$selectpostschildlist = $selectionpostchildclass->getSelectionpostschildLatestNews();
		return $selectpostschildlist;
	}

	static function getCategorySelectionPostsList()
	{
		$category = new Category();
		$categorylist = $category->getCategorySelectionPosts();
		return  $categorylist;
	}

	static function getDList()
	{
		$dlist  = new Debarredlists();
		$dlist_details = $dlist->getDebarredLists();
		return  $dlist_details;
	}

	/****
	 * 
	 * Faq For Websites
	 */

	static function getFaqForWebsites()
	{
		$faq  = new Faq();
		$faq_details = $faq->getFaqDatails();
		return  $faq_details;
	}





	static function getAdmitCardDetails()
	{


		//echo $data;


		$errorMsg = "";
		if (isset($_POST['admit_card'])) {
			$register_number     = trim($_POST['register_number']);
			$dob   = trim($_POST['dob']);
			$examname = trim($_POST['examname']);
			$examname = explode('_', $examname);
			$exam_value = $examname[0] . '_' . $examname[1] . '_' . $examname[2];
			$exam_type = $examname[2];
			$tier_id = $examname[3];
			$roll_no =  isset($_POST['roll_number'])?trim($_POST['roll_number']):null;
			$post_preference =  isset($_POST['post_preference_one'])?trim($_POST['post_preference_one']):null;


			$data_array = array(
				"table_name" => $exam_value,
				"register_number" => $register_number,
				"dob" => $dob,
				"tier_id" => $tier_id,
				"roll_no" => $roll_no,
				"post_preference" => $post_preference
			);

			

			

			$tableName = $exam_value;


			




			$admitcard = new Admitcard();


			switch ($exam_type) {
				case "tier":

					//if exam type is written exam -start
					$modelClass = new Admitcard();
					$data =  $modelClass->getQueryListTIER();
					// $this->printr($data);

					if($admitcard->getAdmitcardforTierCount($data_array)){


						if ($admitcard->getAdmitcardforTier($data_array)) {
							$admitcardresults= $admitcard->getAdmitcardforTier($data_array);
	
	
							// echo '<pre>';
							// print_r($admitcardresults);
	
							// phpinfo();
							 //exit;
	
	
							$array = json_decode(json_encode($admitcardresults), true);
							$exam_name = $admitcard->getExamName($exam_value);
							$admitcardresults = json_decode(json_encode($admitcardresults), true);
							$count = count((array)$admitcardresults);
							$arrays = [];
							foreach ($data as $val) {
	
								foreach (array_keys($array) as $res) {
									if ($res == $val->col_name) {
										$col_value =  $array[$res];
									}
	
									if ($res == 'pdf_attachment') {
										$pdf_name =  $array[$res];
									}
									if ($res == 'candidate_address') {
										$candidate_address =  $array[$res];
									}
									if ($res == 'exam_code') {
										$exam_year =  substr($array[$res], -4);
									}
								}
								$arrays[] = array(
									"col_name" => $val->col_name,
									"col_description" => $val->col_description,
									"is_tier" => $val->is_tier,
									"is_tier_order" => $val->is_tier_order,
									"col_value" => $col_value
								);
							}
							$datavalue = (object)$arrays;
							return ['admitcardresults' => $datavalue, 'year_of_exam' => $exam_year, 'count' => $count, "exam_name" => $exam_name, "pdf_name" => @$pdf_name, "exam_type" => $exam_type, "candidate_address" => $candidate_address, "tier_id" => $tier_id, "tableName" => $tableName, "regNo" => $register_number];
						} else {
							$modelClass = new Admitcard();
								  $data =  $modelClass->getNo( $tier_id,$tableName);
						    $no_of_days = $data->no_of_days;

							$errorMsg = "You can download your e-Admission certificate only $no_of_days days before your date of Examination";
						}
					}
					else{
						$errorMsg = "Your credentials are NOT correct. Please try with correct credentials";
					}

					


					//if exam type is written exam -end
					break;
				case "skill":


					$modelClass = new Admitcard();
					$data =  $modelClass->getQueryListSKILLTEST();
					if($admitcard->getAdmitcardforTierCount($data_array)){
						if ($admitcard->getAdmitcardforSkillTest($data_array)) {
							$admitcardresults = $admitcard->getAdmitcardforSkillTest($data_array);

							//$this->printr($admitcardresults);

							$array = json_decode(json_encode($admitcardresults), true);
							$exam_name = $admitcard->getExamName($exam_value);
							@$count = count((array)$admitcardresults);
							$arrays = [];
							foreach ($data as $val) {

								foreach (array_keys($array) as $res) {
									if ($res == $val->col_name) {
										$col_value =  $array[$res];
									}

									if ($res == 'pdf_attachment') {
										$pdf_name =  $array[$res];
									}
									if ($res == 'candidate_address') {
										$candidate_address =  $array[$res];
									}
									if ($res == 'exam_code') {
										$exam_year =  substr($array[$res], -4);
									}
								}
								$arrays[] = array(
									"col_name" => $val->col_name,
									"col_description" => $val->col_description,
									"is_skill" => $val->is_skill,
									"is_skill_order" => $val->is_skill_order,
									"col_value" => $col_value
								);
							}
							$datavalue = (object)$arrays;
							return ['admitcardresults' => $datavalue, 'count' => $count, "exam_name" => $exam_name, "pdf_name" => @$pdf_name, 'year_of_exam' => $exam_year,"exam_type" => $exam_type, "candidate_address" => $candidate_address, "tier_id" => $tier_id, "tableName" => $tableName, "regNo" => $register_number];
						} else {
							$errorMsg = "You can download your e-Admission certificate only 4 days before your date of Examination";
						}
					}
					else{
						$errorMsg = "Your credentials are NOT correct. Please try with correct credentials";
					}
					break;
				case "pet":
					// If exam Type is PET Start

					$modelClass = new Admitcard();
					$data =  $modelClass->getQueryListPET();
					if ($admitcard->getAdmitcardforPET($data_array)) {
						$admitcardresults = $admitcard->getAdmitcardforPET($data_array);

						/* echo "<pre>";
					print_r($admitcardresults);
					exit; */
						$array = json_decode(json_encode($admitcardresults), true);
						$exam_name = $admitcard->getExamName($exam_value);
						@$count = count((array)$admitcardresults);
						$arrays = [];
						foreach ($data as $val) {

							foreach (array_keys($array) as $res) {
								if ($res == $val->col_name) {
									$col_value =  $array[$res];
								}

								if ($res == 'pdf_attachment') {
									@$pdf_name =  $array[$res];
								}
								if ($res == 'candidate_address') {
									$candidate_address =  $array[$res];
								}
							}
							$arrays[] = array(
								"col_name" => $val->col_name,
								"col_description" => $val->col_description,
								"is_pet" => $val->is_pet,
								"is_pet_order" => $val->is_pet_order,
								"col_value" => $col_value
							);
						}
						$datavalue = (object)$arrays;

						$exam_year = $exam_name->table_exam_year;

						return ['admitcardresults' => $datavalue, 'year_of_exam' => $exam_year, 'count' => $count, "exam_name" => $exam_name, "pdf_name" => @$pdf_name, "exam_type" => $exam_type, "candidate_address" => $candidate_address, "tier_id" => $tier_id, "tableName" => $tableName, "regNo" => $register_number];
					} else {
						$errorMsg = "Your credentials are NOT correct. Please try with correct credentials";
					}

					// If exam Type is PET End

					break;
				case "dme":
					// If exam Type is DME Start
					$modelClass = new Admitcard();
					$data =  $modelClass->getQueryListDME();

					if ($admitcard->getAdmitcardforDME($data_array)) {
						$admitcardresults = $admitcard->getAdmitcardforDME($data_array);

						// echo "<pre>";
						// print_r($admitcardresults);
						// exit; 
						$array = json_decode(json_encode($admitcardresults), true);
						$exam_name = $admitcard->getExamName($exam_value);
						$count = count((array)$admitcardresults);
						$arrays = [];
						foreach ($data as $val) {

							foreach (array_keys($array) as $res) {
								if ($res == $val->col_name) {
									$col_value =  $array[$res];
								}

								if ($res == 'pdf_attachment') {
									$pdf_name =  $array[$res];
								}
								if ($res == 'candidate_address') {
									$candidate_address =  $array[$res];
								}
							}
							$arrays[] = array(
								"col_name" => $val->col_name,
								"col_description" => $val->col_description,
								"is_dme" => $val->is_dme,
								"is_dme_order" => $val->is_dme_order,
								"col_value" => $col_value
							);
						}
						$datavalue = (object)$arrays;
						//$this->printr($datavalue);

						$exam_year = $exam_name->table_exam_year;

						return ['admitcardresults' => $datavalue, 'year_of_exam' => $exam_year, 'count' => $count, "exam_name" => $exam_name, "pdf_name" => @$pdf_name, "exam_type" => $exam_type, "candidate_address" => $candidate_address, "tier_id" => $tier_id, "tableName" => $tableName, "regNo" => $register_number];
					} else {
						$errorMsg = "Your credentials are NOT correct. Please try with correct credentials";
					}
					// If exam Type is DME End

					break;
				default:
					//if exam type is DV -start
					$modelClass = new Admitcard();
					$data =  $modelClass->getQueryListDV();

					if($admitcard->getAdmitcardforTierCount($data_array)){
						if ($admitcard->getAdmitcardforDV($data_array)) {
							$admitcardresults = $admitcard->getAdmitcardforDV($data_array);
							$array = json_decode(json_encode($admitcardresults), true);
							$exam_name = $admitcard->getExamName($exam_value);
							$count = count((array)$admitcardresults);
							$arrays = [];
							foreach ($data as $val) {

								foreach (array_keys($array) as $res) {
									if ($res == $val->col_name) {
										$col_value =  $array[$res];
									}

									if ($res == 'pdf_attachment') {
										$pdf_name =  $array[$res];
									}
								}
								$arrays[] = array(
									"col_name" => $val->col_name,
									"col_description" => $val->col_description,
									"is_dv" => $val->is_dv,
									"is_dv_order" => $val->is_dv_order,
									"col_value" => $col_value
								);
							}
							$datavalue = (object)$arrays;

							$exam_year = $exam_name->table_exam_year;
							//$this->printr($datavalue);

							return ['admitcardresults' => $datavalue, 'year_of_exam' => $exam_year, 'count' => $count, "exam_name" => $exam_name, "pdf_name" => @$pdf_name, "exam_type" => $exam_type, "tier_id" => $tier_id, "tableName" => $tableName, "regNo" => $register_number];
						} else {
							
							$errorMsg = "You can download your e-Admission certificate only 4 days before your date of Examination";
						}
					}
					else{
						$errorMsg = "Your credentials are NOT correct. Please try with correct credentials";
					}
					//if exam type is DV -end
			} // Switch Case End


		}
		return ['errorMsg' => $errorMsg];
	}
	static function getAdmitCardPreviewDetails()
	{


		//echo $data;


		$errorMsg = "";
		if (isset($_POST['admit_card'])) {
			$register_number     = trim($_POST['register_number']);
			$dob   = trim($_POST['dob']);
			$examname = trim($_POST['examname']);
			$examname = explode('_', $examname);
			$exam_value = $examname[0] . '_' . $examname[1] . '_' . $examname[2];
			$exam_type = $examname[2];
			$tier_id = $examname[3];
			$roll_no =  isset($_POST['roll_number'])?trim($_POST['roll_number']):null;
			$post_preference =  isset($_POST['post_preference_one'])?trim($_POST['post_preference_one']):null;


			$data_array = array(
				"table_name" => $exam_value,
				"register_number" => $register_number,
				"dob" => $dob,
				"tier_id" => $tier_id,
				"roll_no" => $roll_no,
				"post_preference" => $post_preference
			);

			

			$tableName = $exam_value;


			




			$admitcard = new Admitcard();


			switch ($exam_type) {
				case "tier":

					//if exam type is written exam -start
					$modelClass = new Admitcard();
					$data =  $modelClass->getQueryListTIER();
					// $this->printr($data);

					if ($admitcard->getAdmitcardforTierPreview($data_array)) {
						// $admitcardresults = $admitcard->getAdmitcardforDV($data_array);
						// $array = json_decode(json_encode($admitcardresults), true);
						// $exam_name = $admitcard->getExamName($exam_value);
						// $count = count((array)$admitcardresults);
						// $arrays = [];
						$admitcardresults = $admitcard->getAdmitcardforTierPreview($data_array);


						//echo '<pre>';
						//print_r();


						$array = json_decode(json_encode($admitcardresults), true);
						$exam_name = $admitcard->getExamName($exam_value);
						@$count = count((array)$admitcardresults);
						$arrays = [];
						foreach ($data as $val) {

							foreach (array_keys($array) as $res) {
								if ($res == $val->col_name) {
									$col_value =  $array[$res];
								}

								if ($res == 'pdf_attachment') {
									$pdf_name =  $array[$res];
								}
								if ($res == 'candidate_address') {
									$candidate_address =  $array[$res];
								}
								if ($res == 'exam_code') {
									$exam_year =  substr($array[$res], -4);
								}
							}
							$arrays[] = array(
								"col_name" => $val->col_name,
								"col_description" => $val->col_description,
								"is_tier" => $val->is_tier,
								"is_tier_order" => $val->is_tier_order,
								"col_value" => $col_value
							);
						}
						$datavalue = (object)$arrays;

						






						return ['admitcardresults' => $datavalue, 'year_of_exam' => $exam_year, 'count' => $count, "exam_name" => $exam_name, "pdf_name" => @$pdf_name, "exam_type" => $exam_type, "candidate_address" => $candidate_address, "tier_id" => $tier_id, "tableName" => $tableName, "regNo" => $register_number];
					} else {
						$errorMsg = "Wrong Register Number  or Date of Birth or Exam";
					}


					//if exam type is written exam -end
					break;
				case "skill":


					$modelClass = new Admitcard();
					$data =  $modelClass->getQueryListSKILLTEST();
					if ($admitcard->getAdmitcardforSkillTest($data_array)) {
						$admitcardresults = $admitcard->getAdmitcardforSkillTest($data_array);

						//$this->printr($admitcardresults);

						$array = json_decode(json_encode($admitcardresults), true);
						$exam_name = $admitcard->getExamName($exam_value);
						@$count = count((array)$admitcardresults);
						$arrays = [];
						foreach ($data as $val) {

							foreach (array_keys($array) as $res) {
								if ($res == $val->col_name) {
									$col_value =  $array[$res];
								}

								if ($res == 'pdf_attachment') {
									$pdf_name =  $array[$res];
								}
								if ($res == 'candidate_address') {
									$candidate_address =  $array[$res];
								}
								if ($res == 'exam_code') {
									$exam_year =  substr($array[$res], -4);
								}
							}
							$arrays[] = array(
								"col_name" => $val->col_name,
								"col_description" => $val->col_description,
								"is_skill" => $val->is_skill,
								"is_skill_order" => $val->is_skill_order,
								"col_value" => $col_value
							);
						}
						$datavalue = (object)$arrays;
						return ['admitcardresults' => $datavalue, 'count' => $count, "exam_name" => $exam_name, "pdf_name" => @$pdf_name, 'year_of_exam' => $exam_year,"exam_type" => $exam_type, "candidate_address" => $candidate_address, "tier_id" => $tier_id, "tableName" => $tableName, "regNo" => $register_number];
					} else {
						$errorMsg = "Wrong Register Number  or Date of Birth or Exam";
					}




					break;
				case "pet":
					// If exam Type is PET Start

					$modelClass = new Admitcard();
					$data =  $modelClass->getQueryListPET();









					if ($admitcard->getAdmitcardforPET($data_array)) {
						$admitcardresults = $admitcard->getAdmitcardforPET($data_array);

						/* echo "<pre>";
					print_r($admitcardresults);
					exit; */
						$array = json_decode(json_encode($admitcardresults), true);
						$exam_name = $admitcard->getExamName($exam_value);
						@$count = count((array)$admitcardresults);
						$arrays = [];
						foreach ($data as $val) {

							foreach (array_keys($array) as $res) {
								if ($res == $val->col_name) {
									$col_value =  $array[$res];
								}

								if ($res == 'pdf_attachment') {
									@$pdf_name =  $array[$res];
								}
								if ($res == 'candidate_address') {
									$candidate_address =  $array[$res];
								}
							}
							$arrays[] = array(
								"col_name" => $val->col_name,
								"col_description" => $val->col_description,
								"is_pet" => $val->is_pet,
								"is_pet_order" => $val->is_pet_order,
								"col_value" => $col_value
							);
						}
						$datavalue = (object)$arrays;

						$exam_year = $exam_name->table_exam_year;






						return ['admitcardresults' => $datavalue, 'year_of_exam' => $exam_year, 'count' => $count, "exam_name" => $exam_name, "pdf_name" => @$pdf_name, "exam_type" => $exam_type, "candidate_address" => $candidate_address, "tier_id" => $tier_id, "tableName" => $tableName, "regNo" => $register_number];
					} else {
						$errorMsg = "Wrong Register Number  or Date of Birth or Exam";
					}

					// If exam Type is PET End

					break;
				case "dme":
					// If exam Type is DME Start
					$modelClass = new Admitcard();
					$data =  $modelClass->getQueryListDME();

					if ($admitcard->getAdmitcardforDME($data_array)) {
						$admitcardresults = $admitcard->getAdmitcardforDME($data_array);

						// echo "<pre>";
						// print_r($admitcardresults);
						// exit; 
						$array = json_decode(json_encode($admitcardresults), true);
						$exam_name = $admitcard->getExamName($exam_value);
						$count = count((array)$admitcardresults);
						$arrays = [];
						foreach ($data as $val) {

							foreach (array_keys($array) as $res) {
								if ($res == $val->col_name) {
									$col_value =  $array[$res];
								}

								if ($res == 'pdf_attachment') {
									$pdf_name =  $array[$res];
								}
								if ($res == 'candidate_address') {
									$candidate_address =  $array[$res];
								}
							}
							$arrays[] = array(
								"col_name" => $val->col_name,
								"col_description" => $val->col_description,
								"is_dme" => $val->is_dme,
								"is_dme_order" => $val->is_dme_order,
								"col_value" => $col_value
							);
						}
						$datavalue = (object)$arrays;
						//$this->printr($datavalue);

						$exam_year = $exam_name->table_exam_year;

						return ['admitcardresults' => $datavalue, 'year_of_exam' => $exam_year, 'count' => $count, "exam_name" => $exam_name, "pdf_name" => @$pdf_name, "exam_type" => $exam_type, "candidate_address" => $candidate_address, "tier_id" => $tier_id, "tableName" => $tableName, "regNo" => $register_number];
					} else {
						$errorMsg = "Wrong Register Number  or Date of Birth or Exam";
					}
					// If exam Type is DME End

					break;
				default:
					//if exam type is DV -start
					$modelClass = new Admitcard();
					$data =  $modelClass->getQueryListDV();


					if ($admitcard->getAdmitcardforDV($data_array)) {
						$admitcardresults = $admitcard->getAdmitcardforDV($data_array);
						$array = json_decode(json_encode($admitcardresults), true);
						$exam_name = $admitcard->getExamName($exam_value);
						$count = count((array)$admitcardresults);
						$arrays = [];
						foreach ($data as $val) {

							foreach (array_keys($array) as $res) {
								if ($res == $val->col_name) {
									$col_value =  $array[$res];
								}

								if ($res == 'pdf_attachment') {
									$pdf_name =  $array[$res];
								}
							}
							$arrays[] = array(
								"col_name" => $val->col_name,
								"col_description" => $val->col_description,
								"is_dv" => $val->is_dv,
								"is_dv_order" => $val->is_dv_order,
								"col_value" => $col_value
							);
						}
						$datavalue = (object)$arrays;

						$exam_year = $exam_name->table_exam_year;
						//$this->printr($datavalue);

						return ['admitcardresults' => $datavalue, 'year_of_exam' => $exam_year, 'count' => $count, "exam_name" => $exam_name, "pdf_name" => @$pdf_name, "exam_type" => $exam_type, "tier_id" => $tier_id, "tableName" => $tableName, "regNo" => $register_number];
					} else {
						$errorMsg = "Wrong Register Number  or Date of Birth or Exam";
					}
					//if exam type is DV -end
			} // Switch Case End


		}
		return ['errorMsg' => $errorMsg];
	}


	// static function getAdmitCardPreviewDetails()
	// {


	// 	//echo $data;


	// 	$errorMsg = "";
	// 	if (isset($_POST['admit_card'])) {
	// 		$register_number     = trim($_POST['register_number']);
	// 		$dob   = trim($_POST['dob']);
	// 		$examname = trim($_POST['examname']);
	// 		$examname = explode('_', $examname);
	// 		$exam_value = $examname[0] . '_' . $examname[1] . '_' . $examname[2];
	// 		$exam_type = $examname[2];
	// 		$tier_id = $examname[3];
	// 		$data_array = array(
	// 			"table_name" => $exam_value,
	// 			"register_number" => $register_number,
	// 			"dob" => $dob,
	// 			"tier_id" => $tier_id
	// 		);
	// 		$admitcard = new Admitcard();


	// 		switch ($exam_type) {
	// 			case "tier":

	// 				//if exam type is written exam -start
	// 				$modelClass = new Admitcard();
	// 				$data =  $modelClass->getQueryListTIER();
	// 				// $this->printr($data);

	// 				if ($admitcard->getAdmitcardforTier($data_array)) {
	// 					$admitcardresults = $admitcard->getAdmitcardforTier($data_array);


	// 					$array = json_decode(json_encode($admitcardresults), true);
	// 					$exam_name = $admitcard->getExamName($exam_value);
	// 					@$count = count(@$admitcardresults);
	// 					$arrays = [];
	// 					foreach ($data as $val) {

	// 						foreach (array_keys($array) as $res) {
	// 							if ($res == $val->col_name) {
	// 								$col_value =  $array[$res];
	// 							}

	// 							if ($res == 'pdf_attachment') {
	// 								$pdf_name =  $array[$res];
	// 							}
	// 							if ($res == 'candidate_address') {
	// 								$candidate_address =  $array[$res];
	// 							}
	// 							if ($res == 'exam_code') {
	// 								$exam_year =  substr($array[$res], -4);
	// 							}
	// 						}
	// 						$arrays[] = array(
	// 							"col_name" => $val->col_name,
	// 							"col_description" => $val->col_description,
	// 							"is_tier" => $val->is_tier,
	// 							"is_tier_order" => $val->is_tier_order,
	// 							"col_value" => $col_value
	// 						);
	// 					}
	// 					$datavalue = (object)$arrays;






	// 					return ['admitcardresults' => $datavalue, 'year_of_exam' => $exam_year, 'count' => $count, "exam_name" => $exam_name, "pdf_name" => @$pdf_name, "exam_type" => $exam_type, "candidate_address" => $candidate_address];
	// 				} else {
	// 					$errorMsg = "Wrong Register Number  or Date of Birth or Exam";
	// 				}


	// 				//if exam type is written exam -end
	// 				break;
	// 			case "skill":


	// 				$modelClass = new Admitcard();
	// 				$data =  $modelClass->getQueryListSKILLTEST();
	// 				if ($admitcard->getAdmitcardforSkillTest($data_array)) {
	// 					$admitcardresults = $admitcard->getAdmitcardforSkillTest($data_array);

	// 					//$this->printr($admitcardresults);

	// 					$array = json_decode(json_encode($admitcardresults), true);
	// 					$exam_name = $admitcard->getExamName($exam_value);
	// 					@$count = count(@$admitcardresults);
	// 					$arrays = [];
	// 					foreach ($data as $val) {

	// 						foreach (array_keys($array) as $res) {
	// 							if ($res == $val->col_name) {
	// 								$col_value =  $array[$res];
	// 							}

	// 							if ($res == 'pdf_attachment') {
	// 								$pdf_name =  $array[$res];
	// 							}
	// 							if ($res == 'candidate_address') {
	// 								$candidate_address =  $array[$res];
	// 							}
	// 						}
	// 						$arrays[] = array(
	// 							"col_name" => $val->col_name,
	// 							"col_description" => $val->col_description,
	// 							"is_skill" => $val->is_skill,
	// 							"is_skill_order" => $val->is_skill_order,
	// 							"col_value" => $col_value
	// 						);
	// 					}
	// 					$datavalue = (object)$arrays;
	// 					return ['admitcardresults' => $datavalue, 'count' => $count, "exam_name" => $exam_name, "pdf_name" => @$pdf_name, "exam_type" => $exam_type, "candidate_address" => $candidate_address];
	// 				} else {
	// 					$errorMsg = "Wrong Register Number  or Date of Birth or Exam";
	// 				}




	// 				break;
	// 			case "pet":
	// 				// If exam Type is PET Start

	// 				$modelClass = new Admitcard();
	// 				$data =  $modelClass->getQueryListPET();









	// 				if ($admitcard->getAdmitcardforPET($data_array)) {
	// 					$admitcardresults = $admitcard->getAdmitcardforPET($data_array);

	// 					/* echo "<pre>";
	// 					   print_r($admitcardresults);
	// 					   exit; */
	// 					$array = json_decode(json_encode($admitcardresults), true);
	// 					$exam_name = $admitcard->getExamName($exam_value);
	// 					@$count = count(@$admitcardresults);
	// 					$arrays = [];
	// 					foreach ($data as $val) {

	// 						foreach (array_keys($array) as $res) {
	// 							if ($res == $val->col_name) {
	// 								$col_value =  $array[$res];
	// 							}

	// 							if ($res == 'pdf_attachment') {
	// 								@$pdf_name =  $array[$res];
	// 							}
	// 							if ($res == 'candidate_address') {
	// 								$candidate_address =  $array[$res];
	// 							}
	// 						}
	// 						$arrays[] = array(
	// 							"col_name" => $val->col_name,
	// 							"col_description" => $val->col_description,
	// 							"is_pet" => $val->is_pet,
	// 							"is_pet_order" => $val->is_pet_order,
	// 							"col_value" => $col_value
	// 						);
	// 					}
	// 					$datavalue = (object)$arrays;


	// 					$exam_year = $exam_name->table_exam_year;



	// 					return ['admitcardresults' => $datavalue, 'year_of_exam' => $exam_year, 'count' => $count, "exam_name" => $exam_name, "pdf_name" => @$pdf_name, "exam_type" => $exam_type, "candidate_address" => $candidate_address];
	// 				} else {
	// 					$errorMsg = "Wrong Register Number  or Date of Birth or Exam";
	// 				}

	// 				// If exam Type is PET End

	// 				break;
	// 			case "dme":
	// 				// If exam Type is DME Start
	// 				$modelClass = new Admitcard();
	// 				$data =  $modelClass->getQueryListDME();

	// 				if ($admitcard->getAdmitcardforDME($data_array)) {
	// 					$admitcardresults = $admitcard->getAdmitcardforDME($data_array);

	// 					// echo "<pre>";
	// 					// print_r($admitcardresults);
	// 					// exit; 
	// 					$array = json_decode(json_encode($admitcardresults), true);
	// 					$exam_name = $admitcard->getExamName($exam_value);
	// 					$count = count((array)$admitcardresults);
	// 					$arrays = [];
	// 					foreach ($data as $val) {

	// 						foreach (array_keys($array) as $res) {
	// 							if ($res == $val->col_name) {
	// 								$col_value =  $array[$res];
	// 							}

	// 							if ($res == 'pdf_attachment') {
	// 								$pdf_name =  $array[$res];
	// 							}
	// 							if ($res == 'candidate_address') {
	// 								$candidate_address =  $array[$res];
	// 							}
	// 						}
	// 						$arrays[] = array(
	// 							"col_name" => $val->col_name,
	// 							"col_description" => $val->col_description,
	// 							"is_dme" => $val->is_dme,
	// 							"is_dme_order" => $val->is_dme_order,
	// 							"col_value" => $col_value
	// 						);
	// 					}
	// 					$datavalue = (object)$arrays;
	// 					//$this->printr($datavalue);

	// 					return ['admitcardresults' => $datavalue, 'count' => $count, "exam_name" => $exam_name, "pdf_name" => @$pdf_name, "exam_type" => $exam_type, "candidate_address" => $candidate_address];
	// 				} else {
	// 					$errorMsg = "Wrong Register Number  or Date of Birth or Exam";
	// 				}
	// 				// If exam Type is DME End

	// 				break;
	// 			default:
	// 				//if exam type is DV -start
	// 				$modelClass = new Admitcard();
	// 				$data =  $modelClass->getQueryListDV();


	// 				if ($admitcard->getAdmitcardforDV($data_array)) {
	// 					$admitcardresults = $admitcard->getAdmitcardforDV($data_array);
	// 					$array = json_decode(json_encode($admitcardresults), true);
	// 					$exam_name = $admitcard->getExamName($exam_value);
	// 					$count = count((array)$admitcardresults);
	// 					$arrays = [];
	// 					foreach ($data as $val) {

	// 						foreach (array_keys($array) as $res) {
	// 							if ($res == $val->col_name) {
	// 								$col_value =  $array[$res];
	// 							}

	// 							if ($res == 'pdf_attachment') {
	// 								$pdf_name =  $array[$res];
	// 							}
	// 						}
	// 						$arrays[] = array(
	// 							"col_name" => $val->col_name,
	// 							"col_description" => $val->col_description,
	// 							"is_dv" => $val->is_dv,
	// 							"is_dv_order" => $val->is_dv_order,
	// 							"col_value" => $col_value
	// 						);
	// 					}
	// 					$datavalue = (object)$arrays;
	// 					//$this->printr($datavalue);

	// 					return ['admitcardresults' => $datavalue, 'count' => $count, "exam_name" => $exam_name, "pdf_name" => @$pdf_name, "exam_type" => $exam_type];
	// 				} else {
	// 					$errorMsg = "Wrong Register Number  or Date of Birth or Exam";
	// 				}
	// 				//if exam type is DV -end
	// 		} // Switch Case End


	// 	}
	// 	return ['errorMsg' => $errorMsg];
	// }

	static function getNominationListforAdmin()
	{
		$nomination = new Nomination();
		$nominations = $nomination->getNominationsList();
		return  $nominations;
	}


	static function getNominationChildListforAdmin()
	{
		$nominationchildclass = new Nominationchild();
		$nominationchildlist = $nominationchildclass->getNominationchild();
		return  $nominationchildlist;
	}

	static function getCategoryListforAdmin()
	{
		$category = new Category();
		$categories = $category->getCategorySelectionPosts();
		return $categories;
	}

	static function getDepartmentListforAdmin()
	{
		$department = new Department();
		$departments = $department->getDepartment();
		return $departments;
	}

	static function getPhaseListforAdmin()
	{
		$phase = new Phase();
		$phases = $phase->getPhase();
		return $phases;
	}

	static function getPostListforAdmin()
	{
		$post = new Post();
		$posts = $post->getPost();
		return $posts;
	}

	static function getSelectionpostListforAdmin()
	{
		$selectionpost = new Selectionpost();
		$selectionposts = $selectionpost->getSelectionPostListAdmin();
		return $selectionposts;
	}

	static function getSelectionpostchildListforAdmin()
	{
		$selectionpostchildclass = new Selectionpostschild();
		$selectpostschildlist = $selectionpostchildclass->getSelectionpostschild();
		return  $selectpostschildlist;
	}

	static function getDebarredListforAdmin()
	{
		$debarredlistsclass = new Debarredlists();
		$debarredgetlists = $debarredlistsclass->getDlists();
		return  $debarredgetlists;
	}

	static function getUserCreationforAdmin()
	{
		$usercreationclass = new Loginusers();
		$usercreationlists = $usercreationclass->getUsers();
		return  $usercreationlists;
	}

	static function getCategoryCreationListforAdmin()
	{
		$categorycreationclass = new Category();
		$categorycreationlists = $categorycreationclass->getCategory();
		return $categorycreationlists;
	}


	static function getNoticeListforAdmin()
	{
		$noticecreationclass = new Notice();
		$noticecreationlists = $noticecreationclass->getNoticeDashboard();
		return $noticecreationlists;
	}

	static function getNoticeListArchivesforAdmin()
	{

		$noticecreationarchivesclass = new NoticeArchives();
		$noticecreationlists = $noticecreationarchivesclass->getNoticeDashboard();
		return $noticecreationlists;
	}




	static function getTenderListforAdmin()
	{
		$tendercreationclass = new Tender();
		$tendercreationlists = $tendercreationclass->getTender();
		return $tendercreationlists;
	}


	static function getTenderListArchivesforAdmin()
	{
		$tendercreationclass = new TenderArchives();
		$tendercreationlists = $tendercreationclass->getTender();
		return $tendercreationlists;
	}







	static function getImportantLinksListforAdmin()
	{
		$importantlinkscreationclass = new ImportantLinks();
		$importantlinkscreationlists = $importantlinkscreationclass->getImportantLinks();
		return  $importantlinkscreationlists;
	}
	static function getEventCategoryListforAdmin()
	{
		$eventcategorymodel = new EventCategory();
		$eventcategorygetlists = $eventcategorymodel->getEventCategoriesList();
		return  $eventcategorygetlists;
	}
	static function getPhotoGalleryListforAdmin()
	{
		$gallerymodel = new Gallery();
		$gallerymodelgetlists = $gallerymodel->getGalleryList();
		return   $gallerymodelgetlists;
	}

	static function getPhotoGalleryChildListforAdmin()
	{
		$gallerymodelchild = new GalleryChild();
		$gallerymodelchildlist = $gallerymodelchild->getGalleryChildList();
		return    $gallerymodelchildlist;
	}

	static function encrypt_with_cryptoJS_and_decrypt_with_php($encrypted_data)
	{

		// we use the same key and IV
		$key = hex2bin("0123456789abcdef0123456789abcdef");
		$iv =  hex2bin("abcdef9876543210abcdef9876543210");

		// we receive the encrypted string from the post
		$decrypted = openssl_decrypt($encrypted_data, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
		// finally we trim to get our original string
		$decryptedStr = preg_replace("/[^0-9A-Za-z]/", "", trim($decrypted));
		return $decryptedStr;
	}

	static function getAdmitCardbyEmailIntegration()
	{

		$errorMsg = "";


		$admitcard = new Admitcard();


		$selectedTableFormat = $_POST['selectedTableFormat'];
		$selectedTableFormatValue =  explode('_', 	$selectedTableFormat);
		$exam_type = $selectedTableFormatValue[1];

		$table_name = $_POST['examname'] . "_" . $_POST['exam_year'] . "_" . $exam_type;
		$tier_id = $_POST['selectedtier'];




		$data_array = array(
			"table_name" => $table_name,
			"tier_id" => $tier_id
		);



		switch ($exam_type) {
			case "tier":

				//if exam type is written exam -start
				$modelClass = new Admitcard();
				$data =  $modelClass->getQueryListTIER();

				$column_master_count = count($data);





				//	echo "<pre>";

				//	print_r($data);

				//$data_array = $_POST;


				if ($admitcard->getAdmitcardforTierEmailIntetgration($data_array)) {
					$admitcardresults = $admitcard->getAdmitcardforTierEmailIntetgration($data_array);

					$array = json_decode(json_encode($admitcardresults), true);

					//echo "<pre>";

					//print_r($array);





					$exam_name = $admitcard->getExamName($table_name);

					@$count = count(@$admitcardresults);
					$arrays = [];
					for ($j = 0; $j < count($array); $j++) {


						foreach ($data as $val) {

							foreach (array_keys($array[$j]) as $res) {

								if ($res == 'pdf_attachment') {
									$pdf_name =  $array[$j][$res];
								}
								if ($res == 'candidate_address') {
									$candidate_address =  $array[$j][$res];
								}
								if ($res == 'exam_code') {
									$exam_year =  $array[$j][$res];
								}
								if ($res == $val->col_name) {
									$col_value =  $array[$j][$res];
									$arrays[] = array(
										"col_name" => $val->col_name,
										"col_description" => $val->col_description,
										"is_tier" => $val->is_tier,
										"is_tier_order" => $val->is_tier_order,
										"col_value" => $col_value
									);
								}
							}
						}
					}


					$datavalueForeach = $arrays;





					// $t = array_slice($datavalue, 0,51); 

					// $s = array_slice($datavalue, 52,105); 

					$datavalue = array_chunk($datavalueForeach, $column_master_count);

					return ['admitcardresults' => $datavalue, 'year_of_exam' => $exam_year, 'count' => $count, "exam_name" => $exam_name, "pdf_name" => @$pdf_name, "exam_type" => $exam_type, "candidate_address" => $candidate_address];
				} else {
					$errorMsg = "Wrong Register Number  or Date of Birth or Exam";
				}

				//if exam type is written exam -end
				break;

				//if exam type is DV -end
		} // Switch Case End



		return ['errorMsg' => $errorMsg];
	}


	static function getArchives($category, $modelClassName, $functionName)
	{

		$category = Helpers::$functionName();

		$date = date("Y-m-d");

		$count = count((array)$category);

		if ($count > 0) {  // Tender  count if start


			switch ($modelClassName) {
				case "Tender":
					foreach ($category as $sn => $categorylist) : // Foreach Start
						$due_date = date('Y-m-d', strtotime($categorylist->effect_from_date));
						$pdf_name = $categorylist->pdf_name;
						$attachment = $categorylist->attachment;
						$id = date('Y-m-d', strtotime($categorylist->tender_id));
						if ($categorylist->p_status == '1') { // Status Check start if
							if (strtotime($due_date) < strtotime($date)) { // Date Comparison start if
								$tender_id = 0;

								$category_data = [
									'pdf_name' => $pdf_name,
									'attachment' => $attachment,
									'date_archived' => $due_date,
									'p_status' => '0'
								];
								$tendersarchives =  new \App\Models\TenderArchives();
								if ($tender_id == 0) { //tender is 0



									if ($tendersarchives->addTender($category_data)) { // Insert Tender Archives Start 

										$tendersarchives =  new \App\Models\TenderArchives();
									}  // Insert Tender Archives End 

									$tendersarchives =  new \App\Models\Tender();

									if ($tendersarchives->deleteTenderStatus($categorylist->tender_id)) { //Delete  Tender Start 

										$noticesarchives =  new \App\Models\TenderArchives();
									}  // Delete Tender End 
								} //tender is 0
							} // Date Comparison End if
						} // Status Check end if
					endforeach;  // Foreach End


					$tendercreationlists_new = Helpers::$functionName();
					$tendercreationlistsarchives = Helpers::getTenderListArchivesforAdmin();







					break;
				case "SelectionpostArchives":
					$model = new SelectionpostArchives();
					break;
				case "NoticeArchives":
					$model = new NoticeArchives();
					break;
				default:
					echo "Your favorite color is neither red, blue, nor green!";
			}
		}  // Tender  count if End




		$array = array(

			"creation_lists_new" => @$tendercreationlists_new,
			"creation_lists_archives" => @$tendercreationlistsarchives

		);

		return  $array;
	}



	static function flagoutput($status)
	{

		$flag = "";
		if ($status == 1) {

			$flag .= '<i class="fa fa-flag" aria-hidden="true"  style="color:green"></i>';
		} else {
			$flag .=  '<i class="fa fa-flag" aria-hidden="true" style="color:red"></i>';
		}
		return $flag;
	}
	static function roleBased(){

		$user = new Users();
        
		$is_superadmin = $user->is_superadmin(); // super admin 
		$data['is_superadmin'] = $is_superadmin; // super admin 

		$is_admin = $user->is_admin(); // admin 
		$data['is_admin'] = $is_admin; // admin 

		$is_uploader = $user->is_uploader(); //uploader
		$data['is_uploader'] = $is_uploader; //uploader

		$is_publisher = $user->is_publisher();  // publisher
		$data['is_publisher'] = $is_publisher;  // publisher

		return $data;

	}


	static function iconOperation( 
		$edit_tender_link_str,
		 $delete_tender_link_str ,
		 $archive_tender_link_str, 
		 $primaryid,
		 $idname,
		 $publishbaseurl, 
		 $archivesbaseurl, 
		 $redirecturl,
		 $status,
		 $model
		 
		 ){

		$actionoutput = "";
                $actionoutput .= <<<TEXT
                <form method="post">       
        TEXT;
                
                $actionoutput .=  '<a href=" '.$edit_tender_link_str .'" name="menu_update" class="iconSize" > 
               
                <button type="button" title="Edit" class="btn btn-secondary iconWidth" ><i class="fas fa-edit"></i></button>
                </a>';
        
                $actionoutput .= <<<TEXT
        <a href=" $delete_tender_link_str" 
        onclick="return confirmationdelete(event)" 
        class="iconSize" name="delete">
        
        <button type="button" title="Delete" class="btn btn-danger iconWidth"><i class="fas fa-trash"></i></button>
        
        </a>
        TEXT;


		$actionoutput .= <<<TEXT
		<button type="button" title="Publish" class="btn btn-primary iconWidth"><i class="fa fa-archive archives-button" 
		style="" id="$primaryid" onclick="archivesButton(
			'archives-button',
			'$idname',
			'$archivesbaseurl',
			'$redirecturl', 
			'$model',   
			'$primaryid'
		
		
		)"></i></button>
	
	TEXT;
        // $actionoutput .= <<<TEXT
        // <a href=" $archive_tender_link_str" 
        // onclick="return confirmationarchive(event)" 
        // class="iconSize" name="archive">
        
        
        
        // <button type="button" title="Archive" class="btn btn-info iconWidth"><i class="fas fa-archive"></i></button>
        // </a>
        // TEXT;
        
        
        
       
        
        if (@$_GET['status'] == 0 &&  $status != 1) {
            $actionoutput .= <<<TEXT
            <button type="button" title="Publish" class="btn btn-primary iconWidth"><i class="fa fa-eye tender-publish-button" 
            style="" id="$primaryid" onclick="publishButton(
                'tender-publish-button',
                '$idname',
                '$archivesbaseurl',
                '$redirecturl', 
                '$model',  
                '$primaryid'
            
            
            )"></i></button>
        
        TEXT;
        }
        
        $actionoutput .= <<<TEXT
        <input type="hidden" value=" $primaryid " name="id" id="$idname">
        TEXT;
        $actionoutput .= "</form>";

		return $actionoutput;
	}

	
}
