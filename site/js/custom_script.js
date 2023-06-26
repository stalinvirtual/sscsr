$(document).ready(function(){



$('.dropdown').hover(
       function(){ $(this).addClass('open') },
       function(){ $(this).removeClass('open') }
);
	$(".fixeddiv").removeClass('fixed');
	$('.fill').click(function(){
	$(".fixeddiv").addClass('importantRule');
	});

$('.page-permission').click(function(){
return confirm('You are being redirected to an external website. Please note that SSCSR cannot be held responsible for external websites content - privacy policies.');

});
	$('#skip_to_main_content').click(function(){ window.location = '#main'});
	$('#sitemap').click(function(){ window.location = 'sitemap.php'});
	$('.closebtn').click(function(){ closeNav();});
	$('.openbtn').click(function(){ openNav();});


	$("#chennaidiv").show();
	$("#chennai-daily-order-div").show();
	$("#chennai-order-div").show();

			$(".nav li a").each(function() {
    //console.log($(this).attr('href'));
    if ((window.location.pathname.indexOf($(this).attr('href'))) > -1) {
        $(this).parent().addClass('activeClass');
    }
	});
	
	$(".nav li a").each(function() {
    //console.log($(this).attr('href'));
    if ((window.location.pathname.indexOf($(this).attr('href'))) > -1) {
        $(this).parent().addClass('activeClass');
    }
	});
	
	 $('.sitemap li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse');
    $('.sitemap li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).attr('title', 'Expand').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
        } else {
            children.show('fast');
            $(this).attr('title', 'Collapse').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
        }
        e.stopPropagation();
    });
	
	
	$("#ppr").on( "click", function() {
		$("#ppr").css("color","#ffffff");
		$("#pr").css("color","black");
		$("#alls").css("color","black");
		$("#ppr").css("backgroundColor","#0e446d");
		$("#pr").css("backgroundColor","#d4b98b");
		$("#alls").css("backgroundColor","#d4b98b");
		$("#ppr_container").show();
		$("#pr_container").hide();
	});
	
	$("#pr").on( "click", function() {
		$("#pr").css("color","#ffffff");
		$("#ppr").css("color","black");
		$("#alls").css("color","black");
		$("#pr").css("backgroundColor","#0e446d");
		$("#ppr").css("backgroundColor","#d4b98b");
		$("#alls").css("backgroundColor","#d4b98b");
		$("#ppr_container").hide();
		$("#pr_container").show();
	});
	
	$("#alls").on( "click", function() {
		$("#alls").css("color","#ffffff");
		$("#ppr").css("color","black");
		$("#pr").css("color","black");
		$("#alls").css("backgroundColor","#0e446d");
		$("#ppr").css("backgroundColor","#d4b98b");
		$("#pr").css("backgroundColor","#d4b98b");
		$("#ppr_container").show();
		$("#pr_container").show();
	});
	
	
	$("#pvp").on( "click", function() {
		$("#pvp").css("color","#ffffff");
		$("#ppv").css("color","black");
		$("#all_pv").css("color","black");
		$("#pvp").css("backgroundColor","#0e446d");
		$("#ppv").css("backgroundColor","#d4b98b");
		$("#all_pv").css("backgroundColor","#d4b98b");
		$("#pvp_container").show();
		$("#ppv_container").hide();
	});
	
	$("#ppv").on( "click", function() {
		$("#ppv").css("color","#ffffff");
		$("#pvp").css("color","black");
		$("#all_pv").css("color","black");
		$("#ppv").css("backgroundColor","#0e446d");
		$("#pvp").css("color","black");
		$("#all_pv").css("color","black");
		$("#ppv_container").show();
		$("#pvp_container").hide();
	});
	
	$("#all_pv").on( "click", function() {
		$("#all_pv").css("color","#ffffff");
		$("#pvp").css("backgroundColor","#d4b98b");
		$("#pr").css("backgroundColor","#d4b98b");
		$("#all_pv").css("backgroundColor","#0e446d");
		$("#pvp").css("backgroundColor","#d4b98b");
		$("#pr").css("backgroundColor","#d4b98b");
		$("#ppv_container").show();
		$("#pvp_container").show();
	});
	
	

	$(".c_tm").on( "click", function() {
		$("#chennaidiv").show();
		$("#delhidiv").hide();
		$("#ahmedabadidiv").hide();
		$("#mumbaidiv").hide();
		$("#kolkatadiv").hide();
		
	});
	$(".d_tm").on( "click", function() {
		$("#chennaidiv").hide();
		$("#delhidiv").show();
		$("#ahmedabadidiv").hide();
		$("#mumbaidiv").hide();
		$("#kolkatadiv").hide();
		
	});

$(".m_tm").on( "click", function() {
		$("#chennaidiv").hide();
		$("#delhidiv").hide();
		$("#ahmedabadidiv").hide();
		$("#mumbaidiv").show();
		$("#kolkatadiv").hide();
		
	});
$(".k_tm").on( "click", function() {
		$("#chennaidiv").hide();
		$("#delhidiv").hide();
		$("#ahmedabadidiv").hide();
		$("#mumbaidiv").hide();
		$("#kolkatadiv").show();
		
	});
$(".a_tm").on( "click", function() {
		$("#chennaidiv").hide();
		$("#delhidiv").hide();
		$("#ahmedabadidiv").show();
		$("#mumbaidiv").hide();
		$("#kolkatadiv").hide();
		
	});

$(".chennai_daily_order").on( "click", function() {
		$("#chennai-daily-order-div").show();
		$("#delhi-daily-order-div").hide();
		$("#ahmedabad-daily-order-div").hide();
		$("#mumbai-daily-order-div").hide();
		$("#kolkata-daily-order-div").hide();
		
	});
	$(".delhi_daily_order").on( "click", function() {
		$("#chennai-daily-order-div").hide();
		$("#delhi-daily-order-div").show();
		$("#ahmedabad-daily-order-div").hide();
		$("#mumbai-daily-order-div").hide();
		$("#kolkata-daily-order-div").hide();
		
	});

$(".mumbai_daily_order").on( "click", function() {
		$("#chennai-daily-order-div").hide();
		$("#delhi-daily-order-div").hide();
		$("#ahmedabad-daily-order-div").hide();
		$("#mumbai-daily-order-div").show();
		$("#kolkata-daily-order-div").hide();
		
	});
$(".kolkata_daily_order").on( "click", function() {
		$("#chennai-daily-order-div").hide();
		$("#delhi-daily-order-div").hide();
		$("#ahmedabad-daily-order-div").hide();
		$("#mumbai-daily-order-div").hide();
		$("#kolkata-daily-order-div").show();
		
	});
$(".ahmedabad_daily_order").on( "click", function() {
		$("#chennai-daily-order-div").hide();
		$("#delhi-daily-order-div").hide();
		$("#ahmedabad-daily-order-div").show();
		$("#mumbai-daily-order-div").hide();
		$("#kolkata-daily-order-div").hide();
		
	});
$(".chennai_order").on( "click", function() {
		$("#chennai-order-div").show();
		$("#delhi-order-div").hide();
		$("#ahmedabad-order-div").hide();
		$("#mumbai-order-div").hide();
		$("#kolkata-order-div").hide();
		
	});
	$(".delhi_order").on( "click", function() {
		$("#chennai-order-div").hide();
		$("#delhi-order-div").show();
		$("#ahmedabad-order-div").hide();
		$("#mumbai-order-div").hide();
		$("#kolkata-order-div").hide();
		
	});

$(".mumbai_order").on( "click", function() {
		$("#chennai-order-div").hide();
		$("#delhi-order-div").hide();
		$("#ahmedabad-order-div").hide();
		$("#mumbai-order-div").show();
		$("#kolkata-order-div").hide();
		
	});
$(".kolkata_order").on( "click", function() {
		$("#chennai-order-div").hide();
		$("#delhi-order-div").hide();
		$("#ahmedabad-order-div").hide();
		$("#mumbai-order-div").hide();
		$("#kolkata-order-div").show();
		
	});
$(".ahmedabad_order").on( "click", function() {
		$("#chennai-order-div").hide();
		$("#delhi-order-div").hide();
		$("#ahmedabad-order-div").show();
		$("#mumbai-order-div").hide();
		$("#kolkata-order-div").hide();
		
	});
	
	
	
	//order page onclick 
	

	 $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: true,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
    
		/* Custom buttons */
		$('#font-setting-buttons').easyView({
			container: '.buttons',
			increaseSelector: '.increase-me',
			decreaseSelector: '.decrease-me',
			normalSelector: '.reset-me',
			contrastSelector: '.change-me'
		});
		$('#mycalendar').monthly({
			mode: 'event',
			//jsonUrl: 'events.json',
			//dataType: 'json'
			xmlUrl: 'events.xml'
		});

		

	switch(window.location.protocol) {
	case 'http:':
	case 'https:':
	// running on a server, should be good.
	break;
	case 'file:':
	//alert('Just a heads-up, events will not work when run locally.');
	}

	});
function filterme() {
	
	
  //build a regex filter string with an or(|) condition
  var types = $('input:checkbox[name="type"]:checked').map(function() {
    return '^' + this.value + '\$';
  }).get().join('|');
  //filter in column 0, with an regex, no smart filtering, no inputbox,not case sensitive
  dTbl.fnFilter(types,3, true, false, false, false);

 
}
//header fixed
var num = 0; //number of pixels before modifying styles

$(window).bind('scroll', function () {
    if ($(window).scrollTop() > num) {
        $('.fixeddiv').addClass('fixed');
    } else {
        $('.fixeddiv').removeClass('fixed');
    }
});
function aonclick(){
 $('.fixeddiv').removeClass('fixed');	
}
//side nav bar
function openNav() {
	document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}





