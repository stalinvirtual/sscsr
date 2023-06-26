<?php

require_once("config/db.php");
require_once("functions.php");

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {

	$output = "";
	$tablename = $_POST['tablename'];
	$array = explode('_', $tablename);
	$tierBasedTable = $array[0] . '_' . $array[1] . '_' . $array[2];
	$kyas_table = $array[0] . '_' . $array[1] . '_' . 'kyas';
	$tier_id = $array[3];
	$query = "
	select kd.*,ted.*,t.tier_name, t.tier_id from $kyas_table as kd 
join $tierBasedTable as ted 
on kd.reg_no = ted.reg_no and trim(kd.exam_code) = trim(ted.exam_code)
join tier_master as t 
on ted.tier_id = cast(t.tier_id as char(255))
where ted.ac_printed = '1' and ted.tier_id = '$tier_id' ";







	$result = getAll($query);
	$resultCount = getRowCount($query);
	$output .= "
	 <form id='frm-example' action='' method='POST'>
	 <table id='exam_data1' class='display table table-striped table-bordered dt-responsive' width='100%'>
						<thead>
							<tr class='danger'>	
							  <th  width=5%>Sno</th>						  
							  <th width=35%>Candidate Name</th> 
							  <th width=10%>Dob</th> 
							  <th width=10%>Reg No </th>  
							  <th width=10%>Roll No </th> 
							  <th width=10%>IP Address </th> 
							  <th width=20%>Updated Time </th> 
							</tr>
						</thead>
					<tbody>";
	$i = 1;
	foreach ($result as $row) {
		//if($row->dtmstatus == '0'){
		$output .=
			'<tr class="warning">
			<td>' . $i . '</td>
			<td>' . $row->cand_name . '</td>
			<td>' . $row->dob . '</td>
			<td>' . $row->reg_no . '</td>
			<td>' . $row->roll_no . '</td>
			<td>' . $row->ipaddress . '</td>
			<td>' . $row->updated_on . '</td>
			</tr>';
		$i++;
	}
	$output .= "</tbody><tfoot>
	<tr class='success'>       
	 <th>Sno</th>						  
	  <th>Candidate Name</th>                    
	  <th>Dob</th> 
	  <th>Reg No</th>	
	  <th>Roll No </th>  
	  <th>IP Address</th> 
	  <th>Updated Time </th>  
	</tr>
</tfoot></table>";
	echo $output;

} else {
	header("Location: index.php");
	exit();

}

?>