<!DOCTYPE html>
<html>
<title>login linebot system</title>
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport" content="initial-scale=0.9, maximum-scale=0.9, width=device-width, user-scalable=no" />
<link rel="stylesheet" href="<?PHP echo base_url("assets/style.css"); ?>">



<script src="<?PHP echo base_url("assets/plugins.bundle.js"); ?>"></script>
<link rel="stylesheet" href="<?PHP echo base_url("assets/plugins.bundle.css"); ?>">
<body>

	<?PHP echo $template['menu_left']; ?>
	
	<!-- <div style="text-align: center; font-size: large;" >
		<label for="Developing"><b>Developing...</b></label>	
	</div> -->

		<!--begin::Container-->
	<div class="container">
		<!--Begin::Row 1st-->
		<div class="row">
			<!--begin::Details 1st-->
			<div class="col-lg-12 col-md-12 col-sm-12 col-12 col-xl-12 col-xxl-12">
				<div class="card card-custom card-stretch gutter-b">
					<div class="card-body">
						<div class="card-header border-0 pt-1">
							<h4 class="card-title font-weight-bolder">ข้อมูลการฝึกอบรม</h4>
						</div>                
						<table class="table-borderless table-responsive mb-5">
							<tr>
								<td class="font-weight-bolder mx-4">ปีงบประมาณ</td>
								<td>
								    <select onchange="select_year()" name="select_training_year" id="select_training_year" class="form-control w-225px mx-4">
									
									<?PHP for ($i = 0; $i < sizeof($result_year); $i++) {?> 
									    <option value=<?PHP echo $result_year[$i]["Value"];?>> <?PHP echo $result_year[$i]["Value"];?></option>
									<?PHP }?> 
									</select>
									
									
									<!-- @using (Html.BeginForm("GetTraining", "Member", FormMethod.Post, new { role = "form" }))
									{
										@Html.DropDownList("selectYear", new SelectList(ViewBag.ListItemYear, "Value", "Text"), new { @class = "form-control w-225px mx-4", onchange = "$(this.form).submit();" })
										@Html.Hidden("code", @Session["Username"])
									} -->
								</td>
							</tr>
						</table>
						<!--begin::Title-->

						
						<list_training></list_training>

						<!-- @{ int rowTraining = 0; }
						@if (ViewBag.ListTraining != null && ViewBag.ListTraining[0].CourseDecsc != "")
						{
							foreach (var itemTraning in ViewBag.ListTraining)
							{
								{ rowTraining++; } -->
								<!-- <table class="table table-sm table-responsive table-borderless d-flex justify-content-between flex-wrap mt-1">
									<tr>
										<td class="text-dark-50 font-weight-bolder" style="min-width:  50px;">@rowTraining</td>
										<td class="text-dark-50 font-weight-bolder" style="min-width:  140px;">หัวข้ออบรม</td>
										<td colspan="6"><label class="mr-2">:</label><b>@itemTraning.CourseDecsc</b></td>
									</tr>
									<tr>
										<td></td>
										<td class="text-dark-50 font-weight-bolder" style="min-width:  110px;">ปีงบประมาณ</td>
										<td style="min-width:  150px;"><label class="mr-2">:</label><b>@itemTraning.Year</b></td>
										<td class="text-dark-50 font-weight-bolder" style="min-width:  110px;">ระหว่างวันที่</td>
										<td style="min-width:  170px;"><label class="mr-2">:</label><b>@itemTraning.StartDate</b></td>
										<td class="text-dark-50 font-weight-bolder" style="min-width:  70px;">เวลา</td>
										<td style="min-width:  150px;"><label class="mr-2">:</label><b>@itemTraning.StartTime</b></td>
									</tr>
									<tr>
										<td></td>
										<td class="text-dark-50 font-weight-bolder" style="min-width:  70px;">รุ่นที่</td>
										<td style="min-width:  100px;"><label class="mr-2">:</label><b>@itemTraning.ClassNo</b></td>
										<td class="text-dark-50 font-weight-bolder" style="min-width:  110px;">ถึงวันที่</td>
										<td style="min-width:  170px;"><label class="mr-2">:</label><b>@itemTraning.EndDate</b></td>
										<td class="text-dark-50 font-weight-bolder" style="min-width:  70px;">ถึง</td>
										<td style="min-width:  150px;"><label class="mr-2">:</label><b>@itemTraning.EndTime</b></td>
									</tr>
									<tr>
										<td></td>
										<td class="text-dark-50 font-weight-bolder" style="min-width:  110px;">ระยะเวลา</td>
										<td colspan="5"><label class="mr-2">:</label>รวมทั้งหมด&nbsp;<b>@itemTraning.PeriodDay</b>&nbsp;วัน&nbsp;<b>@itemTraning.PeriodHour</b>&nbsp;ชม.</td>
									</tr>
									<tr>
										<td></td>
										<td class="text-dark-50 font-weight-bolder" style="min-width:  110px;">สถานที่อบรม</td>
										<td colspan="5"><label class="mr-2">:</label><b>@itemTraning.Location</b></td>
									</tr>
									<tr>
										<td></td>
										<td class="text-dark-50 font-weight-bolder" style="min-width:  110px;">อบรมโดย</td>
										<td colspan="5"><label class="mr-2">:</label><b>@itemTraning.ArrangedBy</b></td>
									</tr>
								</table> -->
							
							<!-- }
						} -->

						<!--end::Title-->
					</div>
				</div>
			</div>
			<!--end::Details 1st-->
		</div>
		<!--end::Row 1st-->
	</div>
	<!--end::Container-->

<script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

	async function select_year(){  

		const user_ad_code = "<?php echo $user_ad_code; ?>";
		const select_training_year = document.getElementById("select_training_year").value;
		Get_Training(user_ad_code,select_training_year);


	}

	function Get_Training(user_ad_code,TrainingbyYear){

		var data = {
    		user_ad_code: user_ad_code,
    		TrainingbyYear: TrainingbyYear,
		};

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('index.php/api/Api_Member/Member_Training_by_year');?>",
			data: JSON.stringify(data),
			success: function(result){
				$("list_training").html(result);
			}
		})       
	}


	select_year()

</script>

</body>
</html>
