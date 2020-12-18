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

    <div class="container">
	<!--begin::1st Row-->
	<div class="row" >
		<!--begin::Details 1st-->
		<div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-5 col-xl-5 col-xxl-5">
			<div class="card card-custom card-stretch gutter-b">
				<div class="card-body">
					<div class="card-header border-0 pt-1">
						<h4 class="card-title font-weight-bolder">ข้อมูลพื้นฐาน</h4>
					</div>
					<div class="table flex-grow-1">
						<div class="row">
							<!--begin::Title-->
							<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 col-xxl-4">
								<table class="table-borderless table-sm d-flex justify-content-between flex-wrap">
									<tr>
										<td class="text-dark-50 font-weight-bold pb-5" style="width:150px;"><img class="personImage" src="<?php print_r($result["ImagePersonal"]);?>"></td>
									</tr>
								</table>
							</div>
							<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-8">
								<table class="table-borderless table-sm d-flex justify-content-between flex-wrap">
									<tr>
										<td class="text-dark-50 font-weight-bold" style="min-width:110px;">รหัสประจำตัว</td>
										<td style="min-width:190px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->PersonalID);?></b></td>
									</tr>
									<tr>
										<td class="text-dark-50 font-weight-bold" style="min-width:110px;">ชื่อ - นามสกุล</td>
										<td style="min-width:220px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->PersonalName);?></b></td>
									</tr>
									<tr>
										<td class="text-dark-50 font-weight-bold" style="min-width:110px;">เพศ</td>
										<td style="min-width:190px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->Sex);?></b></td>
									</tr>
								</table>
							</div>
							<!--end::Title-->
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-7 col-xl-7 col-xxl-7">
			<div class="card card-custom card-stretch gutter-b">
				<div class="card-body">
					<div class="card-header border-0 pt-1">
						<h4 class="card-title font-weight-bolder">ข้อมูลส่วนตัว</h4>
					</div>
					<div class="table table-responsive flex-grow-1">
						<!--begin::Title-->
						<table class="table-borderless table-sm d-flex justify-content-between flex-wrap">
							<tr>
								<td class="text-dark-50 font-weight-bold" style="min-width:130px;">วัน/เดือน/ปี เกิด</td>
								<td style="min-width:200px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->BirthDate);?></b></td>
							</tr>
							<tr>
								<td class="text-dark-50 font-weight-bold" style="min-width:130px;">สัญชาติ</td>
								<td style="min-width:150px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->Nationality);?></b></td>
							</tr>
							<tr>
								<td class="text-dark-50 font-weight-bold" style="min-width:130px;">เลขบัตรประชาชน</td>
								<td style="min-width:200px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->IDCard);?></b></td>
							</tr>
							<tr>
								<td class="text-dark-50 font-weight-bold" style="min-width:130px;">ที่อยู่ปัจจุบัน</td>
								<td style="min-width:250px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->HomeAddress);?></b></td>
							</tr>
							<tr>
								<td class="text-dark-50 font-weight-bold" style="min-width:130px;">จังหวัด</td>
								<td style="min-width:250px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->Province); echo " "; print_r($result["personal"]->Postcode);?></b></td>
							</tr>
							<tr>
								<td class="text-dark-50 font-weight-bold" style="min-width:130px;">โทรศัพท์</td>
								<td style="min-width:200px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->Tel);?></b></td>
							</tr>
						</table>
						<!--end::Title-->
					</div>
				</div>
			</div>
		</div>
		<!--end::Details 1st-->
	</div>
	<!--end::Row 1st-->
	<!--Begin::Row 2nd-->
	<div class="row">
		<!--begin::Details 2st-->
		<div class="col-lg-12 col-md-12 col-sm-12 col-12 col-xl-12 col-xxl-12">
			<div class="card card-custom card-stretch gutter-b">
				<div class="card-body">
					<div class="card-header border-0 pt-1">
						<h4 class="card-title font-weight-bolder">ข้อมูลสถานะการทำงานปัจจุบัน</h4>
					</div>
					<div class="table table-responsive table-borderless flex-grow-1">
						<!--begin::Title-->
						<table class="table-borderless table-sm d-flex justify-content-between flex-wrap">
							<tr>
								<td class="text-dark-50 font-weight-bold" style="min-width:  130px;">วันที่เข้าทำงาน</td>
								<td style="min-width:  180px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->EnterDate);?></b></td>
							</tr>
							<tr>
								<td class="text-dark-50 font-weight-bold" style="min-width:  100px;">สังกัด</td>
								<td style="min-width:  400px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->Department);?></b></td>
							</tr>
							<tr>
								<td class="text-dark-50 font-weight-bold" style="min-width:  155px;">รหัสประจำตำแหน่ง</td>
								<td style="min-width:  120px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->PositionID);?></b></td>
							</tr>
							<tr>
								<td class="text-dark-50 font-weight-bold" style="min-width:  110px;">ตำแหน่ง</td>
								<td style="min-width:  300px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->PositionName);?></b></td>
								<td class="text-dark-50 font-weight-bold">ระดับ</td>
								<td><label class="mr-2">:</label><b><?php print_r($result["personal"]->Class);?></b></td>
							</tr>
							<tr>
								<td class="text-dark-50 font-weight-bold" style="min-width:  110px;">วันที่ครองระดับ</td>
								<td style="min-width:  180px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->ClassDate);?></b></td>
								<td class="text-dark-50 font-weight-bold" style="min-width:  110px;">วันที่ครองตำแหน่ง</td>
								<td style="min-width:  180px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->PositionDate);?></b></td>
							</tr>
							<tr>
								<td class="text-dark-50 font-weight-bold" style="min-width:  100px;">ประเภท</td>
								<td style="min-width:  180px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->PositionType);?></b></td>
								<td class="text-dark-50 font-weight-bold" style="min-width:  100px;">สถานะ</td>
								<td style="min-width:  180px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->Stat);?></b></td>
							</tr>
							<tr>
								<td class="text-dark-50 font-weight-bold" style="min-width:  110px;">ระดับขั้น</td>
								<td style="min-width:  80px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->Level);?></b></td>
								<td class="text-dark-50 font-weight-bold" style="min-width:  130px;">อัตราเงินเดือน</td>
								<td style="min-width:  180px;"><label class="mr-2">:</label><b><?php print_r($result["personal"]->Salary);?></b></td>
							</tr>
						</table>
						<!--end::Title-->
					</div>
				</div>
			</div>
		</div>
		<!--end::Details 2rd-->
	</div>
	<!--end::Row 2nd-->
	<!--Begin::Row 3rd-->
	<div class="row">
		<!--begin::Details 3rd-->
		<div class="col-lg-12 col-md-12 col-sm-12 col-12 col-xl-12 col-xxl-12">
			<div class="card card-custom card-stretch gutter-b">
				<div class="card-body">
					<div class="card-header border-0 pt-1">
						<h4 class="card-title font-weight-bolder">ประวัติการเลื่อนตำแหน่ง</h4>
					</div>
					<div class="table table-responsive flex-grow-1">
						<!--begin::Title-->
						<table class="table-bordered table-hover table-sm table-head-custom table-vertical-center">
							<tr class="text-center">
								<th class="text-dark-50 font-weight-bolder" style="min-width:  60px;">ลำดับที่</th>
								<th class="text-dark-50 font-weight-bolder" style="min-width: 100px;">คำสั่งเลขที่</th>
								<th class="text-dark-50 font-weight-bolder" style="min-width: 150px;">ลงวันที่</th>
								<th class="text-dark-50 font-weight-bolder" style="min-width: 170px;">ตำแหน่ง</th>
								<th class="text-dark-50 font-weight-bolder" style="min-width: 200px;">เลขที่ตำแหน่ง</th>
								<th class="text-dark-50 font-weight-bolder" style="min-width: 60px;">ระดับ</th>
								<th class="text-dark-50 font-weight-bolder" style="min-width: 150px;">วันที่มีผล</th>
							</tr>


							<?php
								$index = 0;
								foreach ($result["upgradeposition"] as $value) {
									$index++; ?>
									<tr class="text-center">
										<td><?php echo ($index); ?></td>
										<td><?php print_r($value->DocumentID); ?></td>
										<td><?php print_r($value->DocumentDate); ?></td>
										<td><?php print_r($value->PositionName); ?></td>
										<td><?php print_r($value->PositionID); ?></td>
										<td><?php print_r($value->PositionClass); ?></td>
										<td><?php print_r($value->PositionEffect); ?></td>
									</tr>
							<?php } ?>
							
						</table>
						<!--end::Title-->
					</div>
				</div>
			</div>
		</div>
		<!--end::Details 3rd-->
	</div>
	<!--end::Row 3rd-->
	<!--Begin::Row 4th-->
	<div class="row">
		<!--begin::Details 4th-->
		<div class="col-lg-12 col-md-12 col-sm-12 col-12 col-xl-12 col-xxl-12">
			<div class="card card-custom card-stretch gutter-b">
				<div class="card-body">
					<div class="card-header border-0 pt-1">
						<h4 class="card-title font-weight-bolder">ข้อมูลการเลื่อนเงินเดือน</h4>
					</div>
					<div class="table table-responsive flex-grow-1">
						<!--begin::Title-->
						<table class="table-bordered table-hover table-head-custom table-vertical-center table-sm">
							<tr class="text-center">
								<th class="text-dark-50 font-weight-bolder" style="min-width:  50px;">#</th>
								<th class="text-dark-50 font-weight-bolder" style="min-width:  220px;">อัตราขั้นเงินเดือนปัจจุบัน</th>
								<th class="text-dark-50 font-weight-bolder" style="min-width:  170px;">อัตราเงินเดือนปัจจุบัน</th>
								<th class="text-dark-50 font-weight-bolder" style="min-width:  150px;">เลขที่คำสั่ง</th>
								<th class="text-dark-50 font-weight-bolder" style="min-width:  190px;">ลงวันที่</th>
							</tr>
							<tr class="text-center">
								<td>1</td>
								<td><?php print_r($result["personal"]->Level);?></td>
								<td><?php print_r($result["personal"]->Salary);?></td>
								<td><?php print_r($result["upgradesalarydocid"]->DocumentID);?></td>
								<td><?php print_r($result["personal"]->LevelDate);?></td>
							</tr> 

							<!-- @{ int rowUpSalNo = 1; }
							@if (ViewBag.ListUpSal != null)
							{
								foreach (var itemUpSal in ViewBag.ListUpSal)
								{
									{ rowUpSalNo++; }
									<tr class="text-center">
										<td>@rowUpSalNo</td>
										<td>@itemUpSal.PositionLevel</td>
										<td>@itemUpSal.Amount</td>
										<td>@itemUpSal.DocumentID</td>
										<td>@itemUpSal.DocumentDate</td>
									</tr>
								}
							} -->

							<?php
								$index = 1;
								foreach ($result["upgradesalary"] as $value) {
									$index++; ?>
									<tr class="text-center">
										<td><?php echo ($index); ?></td>
										<td><?php print_r($value->PositionLevel); ?></td>
										<td><?php print_r($value->Amount); ?></td>
										<td><?php print_r($value->DocumentID); ?></td>
										<td><?php print_r($value->DocumentDate); ?></td>
									
									</tr>
							<?php } ?>
						</table>
						<!--end::Title-->
					</div>
				</div>
			</div>
		</div>
		<!--end::Details 4th-->
	</div>
	<!--end::Row 4th-->
	<!--Begin::Row 5th-->
	<div class="row">
		<!--begin::Details 5th-->
		<div class="col-lg-12 col-md-12 col-sm-12 col-12 col-xl-12 col-xxl-12">
			<div class="card card-custom card-stretch gutter-b">
				<div class="card-body">
					<div class="card-header border-0 pt-1">
						<h4 class="card-title font-weight-bolder">ข้อมูลบุตร</h4>
					</div>
					<div class="table table-responsive flex-grow-1">
						<!--begin::Title-->
						<table class="table-bordered table-hover table-head-custom table-vertical-center table-sm">
							<tr class="text-center">
								<th class="text-dark-50 font-weight-bolder" style="min-width:  80px;">คนที่</th>
								<th class="text-dark-50 font-weight-bolder" style="min-width:  300px;">ชื่อ - สกุล</th>
								<th class="text-dark-50 font-weight-bolder" style="min-width:  170px;">เกิดวันที่</th>
							</tr>

							<?php
								$index = 0;
								foreach ($result["child"] as $value) {
									$index++; ?>
									<tr class="text-center">
								
									<td style="text-align:center;"><?php print_r($value->ChildSeq);?></td>
									<td class="ml-3"><?php print_r($value->ChildName); ?></td>
									<td style="text-align:center;"><?php print_r($value->BirthDate); ?></td>

								
									</tr>
							<?php } ?>


							<!-- @foreach (var itemChild in ViewBag.ListChild)
							{
								<tr>
									<td style="text-align:center;">@itemChild.ChildSeq</td>
									<td class="ml-3">@itemChild.ChildName</td>
									<td style="text-align:center;">@itemChild.BirthDate</td>
								</tr>
							} -->

						</table>
						<!--end::Title-->
					</div>
				</div>
			</div>
		</div>
		<!--end::Details 5th-->
	</div>
	<!--end::Row 5th-->
	<!--Begin::Row 6th-->
	<div class="row">
		<!--begin::Details 6th-->
		<div class="col-lg-12 col-md-12 col-sm-12 col-12 col-xl-12 col-xxl-12">
			<div class="card card-custom card-stretch gutter-b">
				<div class="card-body">
					<div class="card-header border-0 pt-1">
						<h4 class="card-title font-weight-bolder">ประวัติการศึกษา</h4>
					</div>
					<div class="table table-responsive flex-grow-1">
						<!--begin::Title-->

						<?php
							
								foreach ($result["education"] as $value) { ?>

									<table class="table-borderless table-sm d-flex justify-content-between flex-wrap mt-1">
										<tr>
											<th class="text-dark-50 font-weight-bold" style="min-width:  140px;">วุฒิการศึกษา</th>
											<td style="min-width:  300px;"><label class="mr-2">:</label><b><?php print_r($value->DegreeDesc); ?></b></td>
										</tr>
										<tr>
											<th class="text-dark-50 font-weight-bold" style="min-width:  140px;">สถาบัน</th>
											<td style="min-width:  350px;"><label class="mr-2">:</label><b><?php print_r($value->EducationName); ?></b></td>
										</tr>
										<tr>
											<th class="text-dark-50 font-weight-bold" style="min-width:  140px;">ปีที่สำเร็จการศึกษา</th>
											<td style="min-width:  150px;"><label class="mr-2">:</label><b><?php print_r($value->GraduatedYear); ?></b></td>
										</tr>
										<tr>
											<th class="text-dark-50 font-weight-bold" style="min-width:  140px;">กลุ่มวิชา</th>
											<td style="min-width:  200px;"><label class="mr-2">:</label><b><?php print_r($value->Group); ?></b></td>
										</tr>
									</table>
									<hr />
								
						<?php } ?>





						<!-- @foreach (var itemEdu in ViewBag.ListEdu) 
						{
						<table class="table-borderless table-sm d-flex justify-content-between flex-wrap mt-1">
							<tr>
								<th class="text-dark-50 font-weight-bold" style="min-width:  140px;">วุฒิการศึกษา</th>
								<td style="min-width:  300px;"><label class="mr-2">:</label><b>@itemEdu.DegreeDesc</b></td>
							</tr>
							<tr>
								<th class="text-dark-50 font-weight-bold" style="min-width:  140px;">สถาบัน</th>
								<td style="min-width:  350px;"><label class="mr-2">:</label><b>@itemEdu.EducationName</b></td>
							</tr>
							<tr>
								<th class="text-dark-50 font-weight-bold" style="min-width:  140px;">ปีที่สำเร็จการศึกษา</th>
								<td style="min-width:  150px;"><label class="mr-2">:</label><b>@itemEdu.GraduatedYear</b></td>
							</tr>
							<tr>
								<th class="text-dark-50 font-weight-bold" style="min-width:  140px;">กลุ่มวิชา</th>
								<td style="min-width:  200px;"><label class="mr-2">:</label><b>@itemEdu.Group</b></td>
							</tr>
						</table>
						<hr />
						} -->
						<!--end::Title-->
					</div>
				</div>
			</div>
		</div>
		<!--end::Details 6th-->
	</div>
	<!--end::Row 6th-->
	<!--Begin::Row 7th-->
	<div class="row">
		<!--begin::Details 7th-->
		<div class="col-lg-12 col-md-12 col-sm-12 col-12 col-xl-12 col-xxl-12">
			<div class="card card-custom card-stretch gutter-b">
				<div class="card-body">
					<div class="card-header border-0 pt-1">
						<h4 class="card-title font-weight-bolder">เครื่องราชอิสริยาภรณ์</h4>
					</div>
					<div class="table table-responsive flex-grow-1">
						<!--begin::Title-->
						<table class="table-borderless table-sm table-hover d-flex justify-content-between flex-wrap mt-1">
							<tr>
								<th class="text-dark-50 font-weight-bold" style="min-width:  140px;">ชื่อเครื่องราชฯ</th>
								<td style="min-width:  500px;"><label class="mr-2">:</label><b><?php print_r($result["decoration"]->DecorationName ); ?></b></td>
							</tr>
							<tr>
								<th class="text-dark-50 font-weight-bold" style="min-width:  140px;">วันที่ได้รับ</th>
								<td style="min-width:  200px;"><label class="mr-2">:</label><b><?php print_r($result["decoration"]->DecorationDate ); ?></b></td>
							</tr>
						</table>
						<!--end::Title-->
					</div>
				</div>
			</div>
		</div>
		<!--end::Details 7th-->
	</div>
	<!--end::Row 7th-->
</div>

</body>
</html>
