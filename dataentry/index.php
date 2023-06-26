<?php
session_start();


header("X-Frame-Options:DENY");
header("X-Content-Type-Options:nosniff");
header("X-XSS-Protection:0; mode=block");
header("Access-Control-Allow-Origin:*");
header("content-secuity-policy:default-src 'self'");


header("Set-Cookie: HttpOnly");
header("Set-Cookie: name=value; HttpOnly");
header_remove("X-Powered-By");
ini_set('expose_php', 'off');


if (!isset($_SERVER['HTTP_REFERER']) || !isset($_SESSION['sess_user'])) {
	// redirect them to your desired location
	header('location:login.php');

	exit;
} else {
	?>
	<?php include('header.php'); ?>

	<body>

		<div class="forms">
			<div class="inline-form widget-shadow">
				<div class="form-body" style="background-color:aliceblue">
					<form class="form-horizontal" method="post" id="search-form">
						<div class="form-group">
							<div class="col-sm-4"> </div>
							<div class="col-sm-2">
								<label for="examname" class="control-label">Select Year</label>
							</div>
							<div class="col-sm-6" style="width: 25%;padding: revert;margin-top: 5px;">
								<select name="exam_year" id="exam_year" required="true" class="form-control">
								</select>
							</div>
						</div>
					</form>
				</div>
				<div class="container">
				</div>
				<div class="form-body">
					<div class="row">
						<div class="col-lg-7 mb-4">
							<div id="chartContainer" style="height: 300px; width: 100%;margin: 0px auto;">
							</div>
						</div>
						<br><br>
						<div class="col-lg-5 mb-4">
							<table id="AssetsCountTable" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Exam</th>
										<th>Candidates</th>
										<th>Sign</th>
										<th>Photo</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>
						<div class="col-lg-12 mb-4">
							<div class="table_title"></div>
							<table id="example"
								class="display table table-striped table-bordered dt-responsive dataTable dtr-inline"
								width="100%" cellspacing="0">
							</table>
						</div>
					</div>
					<br><br>
				</div>
			</div>
		</div>
	</body>
	<?php
}
?>
<?php include('footer.php'); ?>
<script type="text/javascript" src="js/canvas.js"></script>
<style>
	thead {
		background-color: #223a7e;
		color: white;
	}

	span.badge.badge-pill.badge-warning {
		background: teal;
	}

	span.badge.badge-pill.badge-success {
		background: crimson;
	}

	.table-bordered>thead>tr>th,
	.table-bordered>tbody>tr>th,
	.table-bordered>tfoot>tr>th,
	.table-bordered>thead>tr>td,
	.table-bordered>tbody>tr>td,
	.table-bordered>tfoot>tr>td {
		border: none;
	}

	.table_title {
		padding: 15px;
		background: powderblue;
		margin-top: 5px;
		margin-bottom: 5px;

	}

	.table-bordered {
		border: none;
	}
</style>
<script type="text/javascript">

	var default_year = new Date().getFullYear() - 1;

	function rejected_candidates(year) {
		var rejected = null;
		$.ajax({
			'async': false,
			'type': "POST",
			'global': false,
			'dataType': 'json',
			'url': "rejected.php",
			'data': {
				'year': year
			},
			'success': function (data1) {
				rejected = data1;
			}
		});
		return rejected;
	};
	function accepted_candidates(year) {
		var accepted = null;
		$.ajax({
			'async': false,
			'type': "POST",
			'global': false,
			'dataType': 'json',
			'url': "accepted.php",
			'data': {
				'year': year
			},
			'success': function (data) {
				accepted = data;
			}
		});
		return accepted;
	};

	function getChangedAssetsCounts(year) {
		$.ajax({
			type: "POST",
			url: 'exam_assets_count.php',
			'data': {
				'year': default_year
			},
			dataType: "json",
			success: function (data) {
				var dti = $('#AssetsCountTable').DataTable();
				$.each(data, function (i, item) {
					dti.row.add([
						item.table_name.slice(0, -10),
						item.cnt_rows,
						item.photo,
						item.signature
					]).draw(false);
				});
			}
		});
	}

	$(document).ready(function () {


		$('.table_title').hide();
		$('#AssetsCountTable').DataTable({
			dom: 'Bftrip',
			buttons: [
				'excel', 'pdf'
			],
			"order": [
				[1, 'asc']
			],
			"pageLength": 3,
			"lengthMenu": [[3, 10, 20, -1], [3, 10, 20, 'Todos']],
			//give separate color for each column in the table 
			"columnDefs": [
				{
					"targets": [0],
					"className": "text-left",

				},
				{
					"targets": [1],
					"render": function (data, type, full, meta) {
						return '<div class="text-center"><span class="badge badge-pill badge-success">' + data + '</span></div>';
					}


				},
				{
					"targets": [2],
					"render": function (data, type, full, meta) {
						return '<div class="text-center"><span class="badge badge-pill badge-warning">' + data + '</span></div>';
					}
				},
				{
					"targets": [3],
					"render": function (data, type, full, meta) {
						return '<div class="text-center"><span class="badge badge-pill badge-info">' + data + '</span></div>';
					}
				}
			],
		});
		getChangedAssetsCounts(default_year);
		$('#exam_year').select2({
			placeholder: "Select Year",
			allowClear: true,
			data: [
				{
					id: default_year,
					text: default_year
				}
			]
		});

		//select exam year
		$('#exam_year').select2({
			placeholder: 'Select Exam year',
			ajax: {
				url: 'search_exam_year.php',
				dataType: 'json',
				delay: 250,
				processResults: function (data) {
					return {
						results: data
					};
				},
				cache: true
			}
		});

		$('#exam_year').on('change', function () {
			default_year = $('#exam_year option:selected').val();
			chart.options.data[0].dataPoints = accepted_candidates(default_year);
			chart.options.data[1].dataPoints = rejected_candidates(default_year);
			chart.options.title.text = "Dashboard For The Year -" + default_year;
			chart.render();
			//update data table 
			if ($.fn.DataTable.isDataTable('#example')) {
				$('.table_title').hide();
				$('#example').DataTable().clear().destroy();
				$('#example').DataTable().hide();
			}
			//reload data table
			$('#AssetsCountTable').DataTable().clear()
			getChangedAssetsCounts(default_year);
		});

		var chart = new CanvasJS.Chart("chartContainer",
			{
				backgroundColor: "transparent",
				title: {
					text: "Dashboard",
					fontColor: "#008B8B",
					fontSize: 25,
					padding: 10
				},
				subtitles: [{
					text: "Application Status",
					fontSize: 15,
				}],
				legends: {
					verticalAlign: "bottom",
					horizontalAlign: "center"
				},
				animationEnabled: true,
				axisX: {
					labelFontColor: "black",
					labelFontFamily: "tahoma",
					labelFontWeight: "bold",
					labelFontStyle: "italic",
					labelAutoFit: true,
					labelAngle: 180,
					labelMaxWidth: "50",
					labelWrap: true,
					title: "Candidates",
				},
				axisY: {
					labelFontColor: "black",
					labelFontFamily: "tahoma",
					labelFontWeight: "bold",
					labelFontStyle: "italic",
					labelAutoFit: true,
					labelAngle: 180,
					labelMaxWidth: "50",
					labelWrap: true,
				},
				data: [
					{
						toolTipContent: "{label} - {y} %",
						type: "column",
						name: "Accepted",
						showInLegend: true,
						loading: true,
						click: function (e) {
							if ($.fn.DataTable.isDataTable('#example')) {
								$('.table_title').hide();
								$('#example').DataTable().clear();
							}
							$.ajax(
								{
									post: "POST",
									url: "fetch.php",
									data: {
										'exam_code': e.dataPoint.label,
										'year': default_year,
										'exam_type': 'accepted'
									},
									dataType: 'json',
								}).done(function (datas) {
									var dataObject = eval(datas);
									var columns = [];
									$('#example').DataTable({
										"processing": true,
										"order": [
											[1, 'asc']
										],
										"pageLength": 5,
										"lengthMenu": [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
										"dom": "lrftB<'toolbar'>ip",
										buttons: [
											{
												extend: 'excel',
												text: '<i class="fa fa-file-excel-o" style="color:green;"> Excel</i>',
												title: 'table Excel Sheet Column Names',
												filename: 'table_name',
												exportOptions: {
													columns: ':visible'
												}

											},
											{
												extend: 'pdf',
												text: '<i class="fa fa-file-pdf-o" style="color:red;"> PDF</i>',
												title: 'table PDF Column Names',
												filename: 'table_name',
												exportOptions: {
													columns: ':visible'
												}
											}

										],
										"destroy": true,
										"data": dataObject[0].DATA,
										"columns": dataObject[0].COLUMNS,
										"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
											$('td', nRow).css('background-color', '#4a6e99');
											$('td', nRow).css('color', '#ffffff');
											$('td', nRow).css('font-weight', 'bold');
											$('td', nRow).css('font-size', '15px');
											$('td', nRow).css('font-family', 'tahoma');
											$('td', nRow).css('text-align', 'left');
											$('td', nRow).css('border', '1px solid #dddddd');
											$('td', nRow).css('padding', '5px');
											$('td', nRow).css('border-collapse', 'collapse');
											$('td', nRow).css('border-spacing', '0');
											$('td', nRow).css('word-wrap', 'break-word');
											$('td', nRow).css('white-space', 'normal');
											$('td', nRow).css('word-break', 'normal');
											$('td', nRow).css('overflow', 'hidden');
											$('td', nRow).css('text-overflow', 'ellipsis');
											$('td', nRow).css('-webkit-line-clamp', '2');
										},
									});
									$('.table_title').html('<h4 style="text-align:center;">' + default_year + '-' + e.dataPoint.label + ' Exam Accepted Candidates</h4>');
									$("div.toolbar").html(
										'<button type="button" class="dt-button buttons-html5" name="cbox1"><span>TIER-1</span></button>&nbsp;' +
										'<button type="button" class="dt-button buttons-html5" name="cbox2"<span>TIER-2</span></button>&nbsp;' +
										'<button type="button" class="dt-button buttons-html5" name="cbox3"<span>TIER-3</span></button>&nbsp;' +
										'<button type="button" class="dt-button buttons-html5" name="cbox4"<span>TIER-4</span></button>'
									);
								}).fail(function () {
									alert(this.responseText);
								});
						},
						theme: "theme2",
						indexLabelOrientation: "vertical",
						type: "column",
						dataPoints: accepted_candidates(default_year)
					},
					{
						toolTipContent: "{label} - {y} %",
						type: "column",
						name: "Rejected",
						showInLegend: true,
						loading: true,
						click: function (e) {
							$.ajax(
								{
									post: "POST",
									url: "fetch.php",
									data: {
										'exam_code': e.dataPoint.label,
										'year': default_year,
										'exam_type': 'rejected'
									},
									dataType: 'json',
								}).done(function (datas) {
									var dataObject = eval(datas);
									var columns = [];
									$('#example').DataTable({
										"processing": true,
										"order": [
											[1, 'asc']
										],
										"pageLength": 5,
										"lengthMenu": [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
										"dom": "lrftBip",
										buttons: [
											{
												extend: 'excel',
												text: '<i class="fa fa-file-excel-o" style="color:green;"> Excel</i>',
												title: 'table Excel Sheet Column Names',
												filename: 'table_name',
												exportOptions: {
													columns: ':visible'
												}

											},
											{
												extend: 'pdf',
												text: '<i class="fa fa-file-pdf-o" style="color:red;"> PDF</i>',
												title: 'table PDF Column Names',
												filename: 'table_name',
												exportOptions: {
													columns: ':visible'
												}
											}

										],
										"destroy": true,
										"data": dataObject[0].DATA,
										"columns": dataObject[0].COLUMNS,
										"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
											$('td', nRow).css('background-color', '#a15452');
											$('td', nRow).css('color', '#ffffff');
											$('td', nRow).css('font-weight', 'bold');
											$('td', nRow).css('font-size', '15px');
											$('td', nRow).css('font-family', 'tahoma');
											$('td', nRow).css('text-align', 'left');
											$('td', nRow).css('border', '1px solid #423b3b');
											$('td', nRow).css('padding', '5px');
											$('td', nRow).css('border-collapse', 'collapse');
											$('td', nRow).css('border-spacing', '0');
											$('td', nRow).css('word-wrap', 'break-word');
											$('td', nRow).css('white-space', 'normal');
											$('td', nRow).css('word-break', 'normal');
											$('td', nRow).css('overflow', 'hidden');
											$('td', nRow).css('text-overflow', 'ellipsis');
											$('td', nRow).css('-webkit-line-clamp', '2');
										}
									});
									$('.table_title').show();
									$('.table_title').html('<h4 style="text-align:center;">' + default_year + '-' + e.dataPoint.label + ' Exam Rejected Candidates</h4>');

								}).fail(function () {
									alert(this.responseText);
								});
						},
						type: "column",
						dataPoints: rejected_candidates(default_year)
					}
				]
			});
		chart.options.title.text = "Dashboard For The Year -" + default_year;
		chart.render();
	});
</script>

</html>