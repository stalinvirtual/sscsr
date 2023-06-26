
function validateHtml(id){
	/*   
	<   60,
	>   62 ,
	;   59,
	:	58,
	=	61,
	+	43,
	_ 	95,
	?	63,
	`	96,
	~	126,
	{	123
	\	92,
	|	124
	}	125,
	!	33,
	@	64,
	#	35,
	$	36,
	%	37,
	^	94,
	*	42,
	
	

	*/
	var ta = document.getElementById(id);
	const keycodevalues = [60, 62, 59, 58,61,43,63,96,126,123,92,124,125,33,64,35,36,37,94,42];
	let keycodevalueslength = keycodevalues.length;	
		
	for (let i = 0; i < keycodevalueslength; i++) {
		
			ta.addEventListener(
		'keypress',
		function (e) {
			if (e.keyCode == keycodevalues[i]) {
					if(id == "exam_name"){
						$('.exam_name_validation').html('<div class="form-group"><div class="col-sm-3"></div><div class="col-sm-9"><span> @  #  $  %  ^  *  <  >  ;  :  =  +   _   ?  `  ~  {  }  \ | </span></div> </div><div class="form-group">	<div class="col-sm-3"></div> <div class="col-sm-9"><span class ="error_text" style="color:red">Special characters are not permitted.</span></div></div>');
					}
					
					if(id == "exam_short_name"){
						$('.exam_short_name_validation').html('<div class="form-group"><div class="col-sm-3"></div><div class="col-sm-9"><span> @  #  $  %  ^  *  <  >  ;  :  =  +   _   ?  `  ~  {  }  \ | </span></div> </div><div class="form-group">	<div class="col-sm-3"></div> <div class="col-sm-9"><span class ="error_text" style="color:red">Special characters are not permitted.</span></div></div>');
					}
					
					if(id == "column_name"){
						$('.column_name_validate').html('<div class="form-group"><div class="col-sm-3"></div><div class="col-sm-9"><span> @  #  $  %  ^  *  <  >  ;  :  =  +      ?  `  ~  {  }  \ | </span></div> </div><div class="form-group">	<div class="col-sm-3"></div> <div class="col-sm-9"><span class ="error_text" style="color:red">Special characters are not permitted.</span></div></div>');
					}
					
					if(id == "column_description"){
						$('.column_desc_validate').html('<div class="form-group"><div class="col-sm-3"></div><div class="col-sm-9"><span> @  #  $  %  ^  *  <  >  ;  :  =  +     ?  `  ~  {  }  \ | </span></div> </div><div class="form-group">	<div class="col-sm-3"></div> <div class="col-sm-9"><span class ="error_text" style="color:red">Special characters are not permitted.</span></div></div>');
					}
					
					
					
				
				e.preventDefault();
			}
		}
	);
  
    }	

}	

function stringLengthCheck(name, minlength, maxlength,content){
	var mnlen = minlength;
	var mxlen = maxlength;
	if(name.length < mnlen || name.length > mxlen)
	{ 
		alert(content +"should be " +mnlen+ " to " +mxlen+ " characters.");
	return false;
	}
	else
	{ 
		return true;
	}
}

function selectionpost_shortcode(examCode,examYear){
	const myArray = examCode.includes("/");

	let examshocode ="";

	if(myArray === true){
		const myArray = examCode.split("/");
		let word = myArray[0]+"_"+examYear+"_"+"sp"+"_"+myArray[3];
		const myArray2 = word.split("-");
		let word2 = myArray2[0]+"_"+myArray2[1];
		 examshocode = word2 ;
	}
	else{

		 examshocode = examCode + examYear;

	}
	return examshocode;

}
	
