<?php

/**
 * page controller
 */

namespace App\Controllers;

use App\Controllers\FrontEndController;
use App\Models\Menu as Menu;
use App\Models\Page as Page;
use App\Helpers\Helpers;
use App\Models\ImportantLinks as ImportantLinks;

class PageController extends FrontEndController
{
    public function __construct($param_data = array())
    {
        parent::__construct($param_data);
        $menu  = new Menu();
		//for header published menus
        ob_start();
        \App\Helpers\Helpers::showMenuLinks($menu->getMenusForPublish());
        $menuStr = ob_get_clean();
        // echo $menuStr;
        $this->data['renderedMenu'] = $menuStr;
		
		//for footer published menus
		 ob_start();
        \App\Helpers\Helpers::showFooterMenuLinks($menu->getFooterMenusForPublish());
        $footermenuStr = ob_get_clean();
        // echo $menuStr;
        $this->data['renderedFooterMenu'] = $footermenuStr;
    }
    public function index($data = array())
    {
        $data['new_data'] = "welcome";
		
        echo $this->render('home', $data);
    }
    /**
     * show article page here
     */
    public function show()
    {
        $page_id = $this->data['params'][0];
        $page_obj = new Page();
        $page = $page_obj->getPage($page_id);
        $data['page'] = $page;
        $this->update_placeholders($page);
		
		$ilink = new ImportantLinks();
		$ilinkforFirstFourRow = $ilink->getHomePageImportantLinksListFirstFourRowsOnly();
		$data['ilinkforFirstFourRow'] = $ilinkforFirstFourRow;
		
		$ilinkforAfterFirstFourRow = $ilink->getHomePageImportantLinksListAfterFirstFourRowsOnly();
		$data['ilinkforAfterFirstFourRow'] = $ilinkforAfterFirstFourRow;

        $data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();
        // here you should get a content from db 

        $this->render('page', $data);
    }
    /**
     * we have some available placeholders 
     * {{base_url}}
     * {{theme_url}}
     */
    private function update_placeholders(&$page)
    {
		
		//print_r(&$page);
        $placeholder_array = ["{{base_url}}", "{{theme_url}}"];
        $replace_array = [$this->route->get_base_url(), $this->theme_url];
        $page->page_original_content = html_entity_decode(stripslashes($page->page_content));

        $page->page_content = html_entity_decode(stripslashes(str_replace($placeholder_array, $replace_array, $page->page_content)));
        $page->last_content = html_entity_decode(stripslashes(str_replace($placeholder_array, $replace_array, $page->last_content)));
    }
}
