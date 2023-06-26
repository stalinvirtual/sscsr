<?php
/**
  * @author Stalin
  * @value :  Subject
  */
function valueAdded($str){
	$subject_value = explode('\n',$str);
	if(is_array($subject_value)){
		foreach($subject_value as $value){
		$subjectStr .=  $value.chr(10);
		}
		
	}
	else{
		$subjectStr = $str;
	}
	

	return $subjectStr;
	
}
function countSubject($str){
	
	$subject_value = explode('\n',$str);
	return count($subject_value);
	
}
function getName(){
	return "stalin";
}


?>