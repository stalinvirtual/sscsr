<?php

namespace App\Controllers;

use App\System\Route; ?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <meta name="format-detection" content="telephone=no" />
      <link rel="apple-touch-icon" href="assets/images/favicon/apple-touch-icon.png">
      <link rel="icon" href="assets/images/favicon/favicon.png">
      <meta name="keywords" content="ministry, department">
      <meta name="description" content="Ministry/Department">
      <meta name="author" content="National Informatics Center">
      <title>Home | Ministry | Department | GoI</title>
       <base href="<?php echo $this->base_url; ?>" />
      <!-- Custom styles for this template -->
      <link href="assets/css/base.css" rel="stylesheet" media="all">
      <link href="assets/css/base-responsive.css" rel="stylesheet" media="all">
      <link href="assets/css/grid.css" rel="stylesheet" media="all">
      <link href="assets/css/font.css" rel="stylesheet" media="all">
      <link href="assets/css/font-awesome.min.css" rel="stylesheet" media="all">
      <link href="assets/css/flexslider.css" rel="stylesheet" media="all">
      <link href="assets/css/print.css" rel="stylesheet" media="print" />
      <!-- Theme styles for this template -->
      <link href="assets/css/megamenu.css" rel="stylesheet" media="all" />
      <link href="theme/css/site.css" rel="stylesheet" media="all">
      <link href="theme/css/site-responsive.css" rel="stylesheet" media="all">
      <link href="theme/css/ma5gallery.css" rel="stylesheet" type="text/css">
      <link href="theme/css/print.css" rel="stylesheet" type="text/css" media="print">
      <style>
         .image-video {}
      </style>
      <!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
      <![endif]-->
      <!-- Custom JS for this template -->
      <noscript>
         <link href="theme/css/no-js.css" type="text/css" rel="stylesheet">
      </noscript>
   </head>
   <body>
      <div id="fb-root"></div>
      <header>
         <div class="region region-header-top">
            <div id="block-cmf-content-header-region-block" class="block block-cmf-content first last odd">
               <noscript class="no_scr">"JavaScript is a standard programming language that is included to provide interactive features, Kindly enable Javascript in your browser. For details visit help page"
               </noscript>
               <div class="wrapper common-wrapper">
                  <div class="container common-container four_content ">
                     <div class="common-left clearfix">
                        <ul>
                           <li class="gov-india"><span class="responsive_go_hindi" lang="hi"><a target="_blank" href="https://india.gov.in/hi" title="???? ????? ( ????? ??????? ?? ?? ?? ????? ??? ????? ??)" role="link">???? ?????</a></span></li>
                           <li class="ministry">
                              <a target="_blank" href="https://india.gov.in/" title="Government of india,External Link that opens in a new window" role="link">Government of india</a>
                           </li>
                        </ul>
                     </div>
                     <div class="common-right clearfix">
                        <ul id="header-nav">
                           <li class="ico-skip cf"><a href="#skipCont" title="">Skip to main content</a></li>
                           <li class="ico-site-search cf">
                              <a href="javascript:void(0);" id="toggleSearch" title="Site Search">
                              <img class="top" src="assets/images/ico-site-search.png" alt="Site Search" /></a>
                              <div class="search-drop both-search">
                                 <div class="google-find">
                                    <form method="get" action="http://www.google.com/search" target="_blank">
                                       <label for="search_key_g" class="notdisplay">Search</label>
                                       <input type="text" name="q" value="" id="search_key_g"/> 
                                       <input type="submit" value="Search" class="submit" /> 
                                       <div class="">
                                          <input type="radio" name="sitesearch" value="" id="the_web"/> 
                                          <label for="the_web">The Web</label> 
                                          <input type="radio" name="sitesearch" value="india.gov.in" checked id="the_domain"/> <label for="the_domain"> INDIA.GOV.IN</label>
                                       </div>
                                    </form>
                                 </div>
                                 <div class="find">
                                    <form name="searchForm" action="home.php">
                                       <label for="search_key" class="notdisplay">Search</label>
                                       <input type="text" name="search_key" id="search_key" onKeyUp="autoComplete()" autocomplete="off" required />
                                       <input type="submit" value="Search" class="bttn-search"/>
                                    </form>
                                    <div id="auto_suggesion"></div>
                                 </div>
                              </div>
                           </li>
                           <li class="ico-accessibility cf">
                              <a href="javascript:void(0);" id="toggleAccessibility" title="Accessibility Dropdown">
                              <img class="top" src="assets/images/ico-accessibility.png" alt="Accessibility Dropdown" />
                              </a>
                              <ul>
                                 <li> <a onClick="set_font_size('increase')" title="Increase font size" href="javascript:void(0);">A<sup>+</sup></a> </li>
                                 <li> <a onClick="set_font_size()" title="Reset font size" href="javascript:void(0);">A<sup>&nbsp;</sup></a> </li>
                                 <li> <a onClick="set_font_size('decrease')" title="Decrease font size" href="javascript:void(0);">A<sup>-</sup></a> </li>
                                 <li> <a href="javascript:void(0);" class="high-contrast dark" title="High Contrast">A</a> </li>
                                 <li> <a href="javascript:void(0);" class="high-contrast light" title="Normal Contrast" style="display: none;">A</a> </li>
                              </ul>
                           </li>
                           <li class="ico-sitemap cf"><a href="" title="Sitemap">
                              <img class="top" src="assets/images/ico-sitemap.png" alt="Sitemap" /></a>
                           </li>
                           <li class="ico-accessibility mobilecat cf">
                              <a href="javascript:void(0);" id="toggleAccessibility" title="Accessibility Dropdown" style="font-size: x-large;">
                              <i class="fa fa-bars"></i>
                              </a>
                              <ul style="right: -35px !important;">
                                 <li> <a  title="Increase font size" href="#" style="width: 70px !important;">Admin</a> </li>
                                 <li> <a  title="Increase font size" href="#" style="width: 70px !important;">Result</a> </li>
                                 <li> <a  title="Increase font size" href="#" style="width: 70px !important;">Admint Card</a> </li>
                                 <li> <a  title="Increase font size" href="#" style="width: 70px !important;">Apply</a> </li>
                                 <li> <a  title="Increase font size" href="#" style="width: 70px !important;">Answer Key</a> </li>
                              </ul>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--Top-Header Section end-->
         <section class="wrapper header-wrapper">
            <div class="container header-container">
               <h1 class="logo">
                  <a href="home.php" title="Home" rel="home" class="header__logo" id="logo">
                     <img class="national_emblem" src="assets/images/SSClogo.png" alt="National Emblem Logo">
                     <strong style="font-size: 100%;" class="sscsrhindihead">???????? ??? ????</strong>
                     <span class="sscsrhead">STAFF SELECTION COMMISSION</span>
                     <h3 class="place" style="font-size: 89%;">Southern Region, Chennai</h3>
                  </a>
               </h1>
               <div class="header-right clearfix">
                  <div class="right-content clearfix">
                     <div class="float-element" style="padding-top: 0px !important;">
                        <a class="sw-logo" target="_blank" href="https://swachhbharat.mygov.in/" title="India Emblem"><img src="assets/images/emblem-dark.png" alt="India Emblem"></a>
                     </div>
                  </div>
               </div>
               <div class="header-right clearfix ontabmodehide">
                  <div class="right-content clearfix">
                     <div class="float-element">

                        <?php
              $route = new Route();
              $adminpage = $route->site_url("IndexController/admin_login");

              ?>
                     <a class="sw-logo" target="_blank" href="<?php echo $adminpage; ?>" title="Admin Login">
                        <img class="national_emblem" src="theme/images/header-icons/admin.png" alt="Admin Login">
                           <h1>Admin</h1>
                        </a>
                     </div>
                  </div>
               </div>
               <div class="header-right clearfix ontabmodehide">
                  <div class="right-content clearfix">
                     <div class="float-element">
                     <a class="sw-logo" target="_blank" href="inner.php" title="Exam Result">
                        <img class="national_emblem" src="theme/images/header-icons/result.png" alt="Exam Result">
                           <h1>Result</h1>
                        </a>
                     </div>
                  </div>
               </div>
               <div class="header-right clearfix ontabmodehide">
                  <div class="right-content clearfix">
                     <div class="float-element">
                     <a class="sw-logo" target="_blank" href="inner.php" title="Answer Key">
                        <img class="national_emblem" src="theme/images/header-icons/answer_key.png" alt="Answer Key">
                           <h1>Answer Key</h1>
                        </a>
                     </div>
                  </div>
               </div>
               <div class="header-right clearfix ontabmodehide">
                  <div class="right-content clearfix">
                     <div class="float-element">
                        <a class="sw-logo" target="_blank" href="inner.php" title="Admit card">
                        <img class="national_emblem" src="theme/images/header-icons/Admit-card.png" alt="Admit card">
                           <h1>Admit Card</h1>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!--/.header-wrapper-->
         <div class="wrapper megamenu-wraper">
            <div class="container">
               <a class="showhide" href="javascript:void(0)"><em></em><em></em><em></em></a>
               <nav class="main-menu clearfix" id="main_menu">
                  <?php
                     echo $renderedMenu;
                  ?>
               </nav>
            </div>
         </div>
      </header>
      <!--/.nav-wrapper-->