<?php
session_start();
?>
<?php
include '../common/header.php';
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div>
			<h1 class="page-header">Fees Collections</h1>
		</div>
		<div>
			<div class="row">
				<div class="col-lg-3">
					<h3>Pending Students</h3>
				</div>
				<div class="col-lg-3">
					<button type="button" class="btn btn-primary" onclick="openAddStud()">
						Add Student
					</button>
				</div>
				<div class="col-lg-3">
					<input class="form-control rounded-0" type="search" placeholder="search students"
						oninput="pending_call()" id="pending_search">
				</div>
				<div class="col-lg-3">
					<select class="form-control" id="pending_filter" onchange="pending_call()">
						<option>-Filter-</option>
						<option value="asc">Asc</option>
						<option value="desc">Desc</option>
					</select>
				</div>
			</div>
			<table class="table table-hover">
				<thead>
					<tr class="bg-primary">
						<th>ID</th>
						<th>Name</th>
						<th>Father Name</th>
						<th>Contact</th>
						<th>Course</th>
						<th>Pending Due</th>
						<th>Pending Amount</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="pend_stud">
				</tbody>
			</table>
			<div id="pagination" class="pagination-controls">
				<!-- Pagination buttons will be dynamically inserted here -->
			</div>
		</div>
	</div>


	<!------------------------------------ modal------------------------------------------------------------------------ -->
	<div id="myModal" class="modal" style="display:none;"> <!-- Initially hidden -->

		<!-- Modal content -->
		<div class="modal-content" style="width:50%;">
			<span class="close" style="cursor:pointer;">&times;</span>
			<h3 class="page-header">Student Information</h3>
			<div class="tab">
				<div class="row">
					<button class="tablinks btn btn-danger col-lg-4" onclick="openTab(event, 'studentDetails')"
						id="defaultOpen">Student Details</button>
					<button class="tablinks btn btn-warning col-lg-4" id="paymentbtn"
						onclick="openTab(event, 'paymentDetails')" style="display:none">Payment Details</button>
					<button class="tablinks btn btn-warning col-lg-4" id="duebtn" onclick="openTab(event, 'dueDetails')"
						style="display:none">Due Details</button>
				</div>

			</div>
			<div id="studentDetails" class="tabcontent">
				<h5>Student Details</h5>
				<div class="">
					<table class="table">
						<tbody>
							<tr class="danger">
								<td>Name</td>
								<td>
									<input type="hidden" name="t_id" id="htid" />
									<input type="text" id="sname" class="form-control" required />
								</td>
							</tr>
							<tr class="danger">
								<td>Father Name</td>
								<td><input type="text" id="fname" class="form-control" required /></td>
							</tr>
							<tr class="danger">
								<td>Phone No.</td>
								<td><input type="text" id="phone" class="form-control" required /></td>
							</tr>
							<tr class="danger">
								<td>Email</td>
								<td><input type="email" id="email" class="form-control" required /></td>
							</tr>
							<tr class="danger">
								<td>Address</td>
								<td><input type="text" id="address" class="form-control" required /></td>
							</tr>
							<tr class="danger">
								<td>Course</td>
								<td>
									<select multiple class="form-control" id="course" name="course[]" required>
										<?php
										$query = "SELECT * FROM tbl_course";
										$row = mysqli_query($link, $query);
										while ($data = mysqli_fetch_array($row)) {
											echo "<option>" . htmlspecialchars($data["course_name"]) . "</option>";
										}
										?>
									</select>
								</td>
							</tr>
							<tr class="danger">
								<td>DOJ</td>
								<td><input type="date" id="doj" class="form-control" required /></td>
							</tr>
							<tr class="danger">
								<td>Total Fees</td>
								<td><input type="number" id="fees" class="form-control" required /></td>
							</tr>
							<tr class="danger">
								<td>No. of Dues</td>
								<td><input type="number" id="nodues" class="form-control" onchange="generateDueFields()"
										required /></td>
							</tr>
							<tr class="success" hidden>
								<td>due no</td>
								<td><input type="text" id="dueno" class="form-control" />
								</td>
							</tr>
							<tr class="success" hidden>
								<td>due amt</td>
								<td><input type="text" id="dueamt" class="form-control" />
								</td>
							</tr>
							<tr class="success" hidden>
								<td>Balance</td>
								<td><input type="text" id="balamt" class="form-control" />
								</td>
							</tr>
							<tr class="danger">
								<td>Gender</td>
								<td>
									<label class="radio-inline">
										<input type="radio" name="ge" id="gender1" value="male" checked> Male
									</label>
									<label class="radio-inline">
										<input type="radio" name="ge" id="gender2" value="female"> Female
									</label>
									<label class="radio-inline">
										<input type="radio" name="ge" id="gender3" value="other"> Other
									</label>
								</td>
							</tr>
						</tbody>
					</table>

				</div>
			</div>

			<div id="paymentDetails" class="tabcontent" style="display:none">
				<h5>Payment Details</h5>
				<div class="panel-body">
					<table class="table table-bordered table-hover table-striped" id="table">
						<thead class="btn-danger">
							<tr>
								<th>S.No</th>
								<th>Date</th>
								<th>Amount (Rs)</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="mytbody"></tbody>
					</table>
				</div>

			</div>

			<div id="dueDetails" class="tabcontent" style="display:none">
				<div class="panel-body" id="dueFieldsRow">
					<table id="duesTable" class="table table-bordered table-hover table-striped">
						<thead id="duesTableHeader" class="btn-info">
							<tr class="text-center">
								<th class="text-center">#</th>
								<th class="text-center">Date</th>
								<th class="text-center">Amount</th>
							</tr>
						</thead>
						<tbody id="dueFieldsContainer">
							<!-- Due fields will be generated here -->
						</tbody>
					</table>
					<div class="panel-heading text-center">
						<button id="save_button" type="button" class="btn btn-success"
							onclick="save_data()">Save</button>
					</div>
				</div>
			</div>
		</div>


	</div>



	<!-- Bootstrap Modal -->
	<div class="modal" id="paymentModal">
		<div class="modal-content" style="width:25%;">
			<form id="paymentForm" class="needs-validation p-4" novalidate>
				<div class="shadow-sm">
					<div class="p-5">
						<!-- Payment Date Field -->
						<div class="mb-3">
							<label for="payment_date" class="form-label" style="color: #17a2b8;">Payment
								Date</label>
							<input type="date" class="form-control" id="payment_date" name="date" required>
						</div>

						<!-- Payment Amount Field -->
						<div class="mb-3">
							<label for="validamt" class="form-label" style="color: #17a2b8;">Amount</label>
							<input type="number" class="form-control" id="validamt" placeholder="Enter Amount"
								name="amt" required onchange="validateamt()">
						</div>

						<!-- Payment Type Radio Buttons -->
						<div class="mb-3">
							<label class="form-label" style="color: #17a2b8;">Payment Type</label><br>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="payment_type" id="initial_payment"
									value="initial">
								<label class="form-check-label" for="initial_payment">Initial Payment</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="payment_type" id="due_payment"
									value="due">
								<label class="form-check-label" for="due_payment">Due Payment</label>
							</div>
						</div>

						<!-- Pending Payment Date Field -->
						<div class="mb-3" id="pendingPayDiv" style="display:none">
							<label for="pending_payment_date" class="form-label" style="color: #17a2b8;">Pay
								Date</label>
							<input type="date" class="form-control" id="pending_payment_date" name="pay_date">
						</div>
					</div>
					<div class="">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
							onclick="handlemodalclose()">Close</button>
						<button type="button" class="btn btn-primary" id="submitPayment"
							onclick="handleAmountCheck()">Pay</button>
					</div>
				</div>
			</form>
		</div>

	</div>

	<!------------------------------------------ bill --------------------------------------------------------------->

	<form id="pdfForm" action="generate_pdf.php" method="post" target="_blank" style="display: none;">
		<input type="hidden" name="html_content" id="html_content">
	</form>

	<div style=" padding:10px;background-color: #ffffff; max-width: 500px;border:5px solid skyblue " id="billing" hidden>
		<div style="margin-bottom: 10px; text-align: center;">
			<h2 style="margin: 0; color: #333;"><b>Yuva Sakthi Academy</b></h2>
			<p style="margin-top:10px;margin-bottom:0px">D.NO-137, FNO-312/2, Sathy Road, Near Karur Vysya Bank,</p>
			<p style="margin-top:0px;">Saravanampatti, Coimbatore - 641 035</p>
		</div>
		<div style="margin-bottom: 10px; text-align: right;">
			<p style="margin: 0; font-size: 14px; color: #333;"><strong>Bill No:</strong> <span id="billing_no"></span>
			</p>
		</div>
		<div style="margin-bottom: 10px; text-align: right;">
			<p style="margin: 0; font-size: 14px; color: #333;"><strong>DATE:</strong> <span id="billing_date"></span>
			</p>
		</div>
		<div style="margin-bottom: 10px; text-align: left;">
			<p style="margin: 0; font-size: 14px; color: #333;"><strong>Id:</strong> <span id="student_id"></span></p>
		</div>
		<div style="margin-bottom: 10px; text-align: left;">
			<p style="margin: 0; font-size: 14px; color: #333;"><strong>Name:</strong> <span
					id="billing_address"></span></p>
		</div>

		<div style="margin-bottom: 10px; text-align: left;">
			<p style="margin: 0; font-size: 14px; color: #333;"><strong>PHONE:</strong> <span id="billing_phone"></span>
			</p>
		</div>
		<div style="margin-bottom: 10px; text-align: left;">
			<p style="margin: 0; font-size: 14px; color: #333;"><strong>ADDRESS:</strong> <span
					id="billing_addresses"></span>
			</p>
		</div>
		<div style="margin-bottom: 10px; text-align: left;">
			<p style="margin: 0; font-size: 14px; color: #333;"><strong>Course:</strong> <span
					id="trainee_course"></span>
			</p>
		</div>
		<div style="margin-bottom: 20px; text-align: left;">
			<p style="margin: 0; font-size: 14px; color: #333;"><strong>Amount:</strong> <span
					id="course_amount"></span>
			</p>
		</div>

		<div style="margin-bottom: 20px;">
			<table style="width: 100%; border-collapse: collapse;" class="table table-striped">
				<thead>
					<tr>
						<th
							style="border: 1px solid #dee2e6; padding: 0px; background-color: #f8f9fa; text-align: center;">
							S.NO</th>
						<th
							style="border: 1px solid #dee2e6; padding: 12px; background-color: #f8f9fa; text-align: center; font-weight: bold;">
							DESCRIPTION</th>
						<th
							style="border: 1px solid #dee2e6; padding: 12px; background-color: #f8f9fa; text-align: center; font-weight: bold;">
							AMOUNT</th>
					</tr>
				</thead>
				<tbody id="billing_body" style="text-align: right ;">
					<!-- Dynamic content here -->
				</tbody>
			</table>
		</div>
		<div id="pending" style="display:none">
			<div style="margin-bottom: 20px; text-align: left;">
				<p style="margin: 0; font-size: 14px; color: #333;"><strong>Pending Dues</strong>
				</p>
			</div>
			<div style="margin-bottom: 20px;">
				<table style="width: 100%; border-collapse: collapse;" class="table table-striped">
					<thead>
						<tr>
							<th
								style="border: 1px solid #dee2e6; padding: 0px; background-color: #f8f9fa; text-align: center;">
								S.NO</th>
							<th
								style="border: 1px solid #dee2e6; padding: 12px; background-color: #f8f9fa; text-align: center; font-weight: bold;">
								DESCRIPTION</th>
							<th
								style="border: 1px solid #dee2e6; padding: 12px; background-color: #f8f9fa; text-align: center; font-weight: bold;">
								AMOUNT</th>
						</tr>
					</thead>
					<tbody id="pending_body" style="text-align: right;">
						<!-- Dynamic content here -->
					</tbody>
				</table>
			</div>
		</div>
		<div style="margin-bottom: 20px; text-align: right;">
			<p style="margin: 0; font-size: 16px; color: #333;"><strong>TOTAL:</strong> <span id="billing_total"></span>
				(Rupees <span id="billing_total_words"></span> Only)</p>
		</div>
		<div style="margin-bottom: 20px;margin-top: 50px;">
			<p style="margin: 0; font-size: 16px; color: #333; text-align: right;"><strong>Authorized Signatory</strong>
			</p>
		</div>
	</div>

	<!-- smik system -->

	<div style=" padding:10px;background-color: #ffffff; max-width: 500px;border:5px solid skyblue " id="smikbill" hidden>
		<div style="margin-bottom: 10px; text-align: center;">
			<h2 style="margin: 0; color: #333;"><b>Smik Systems</b></h2>
			<p style="margin-top:10px;margin-bottom:0px">D.NO-137, FNO-312/2, Sathy Road, Near Karur Vysya Bank,</p>
			<p style="margin-top:0px;">Saravanampatti, Coimbatore - 641 035</p>
		</div>
		<div style="margin-bottom: 10px; text-align: right;">
			<p style="margin: 0; font-size: 14px; color: #333;"><strong>Bill No:</strong> <span
					id="billing_no_smik"></span>
			</p>
		</div>
		<div style="margin-bottom: 10px; text-align: right;">
			<p style="margin: 0; font-size: 14px; color: #333;"><strong>DATE:</strong> <span
					id="billing_date_smik"></span>
			</p>
		</div>
		<div style="margin-bottom: 10px; text-align: left;">
			<p style="margin: 0; font-size: 14px; color: #333;"><strong>Id:</strong> <span id="student_id_smik"></span>
			</p>
		</div>
		<div style="margin-bottom: 10px; text-align: left;">
			<p style="margin: 0; font-size: 14px; color: #333;"><strong>Name:</strong> <span
					id="billing_address_smik"></span></p>
		</div>

		<div style="margin-bottom: 10px; text-align: left;">
			<p style="margin: 0; font-size: 14px; color: #333;"><strong>PHONE:</strong> <span
					id="billing_phone_smik"></span>
			</p>
		</div>
		<div style="margin-bottom: 10px; text-align: left;">
			<p style="margin: 0; font-size: 14px; color: #333;"><strong>ADDRESS:</strong> <span
					id="billing_addresses_smik"></span>
			</p>
		</div>
		<div style="margin-bottom: 10px; text-align: left;">
			<p style="margin: 0; font-size: 14px; color: #333;"><strong>Course:</strong> <span
					id="trainee_course_smik"></span>
			</p>
		</div>

		<div style="margin-bottom: 20px;">
			<table style="width: 100%; border-collapse: collapse;" class="table table-striped">
				<thead>
					<tr>
						<th
							style="border: 1px solid #dee2e6; padding: 0px; background-color: #f8f9fa; text-align: center;">
							S.NO</th>
						<th
							style="border: 1px solid #dee2e6; padding: 12px; background-color: #f8f9fa; text-align: center; font-weight: bold;">
							SERVICES</th>
						<th
							style="border: 1px solid #dee2e6; padding: 12px; background-color: #f8f9fa; text-align: center; font-weight: bold;">
							AMOUNT</th>
					</tr>
				</thead>
				<tbody id="billing_body_smik" style="text-align: right;">
					<!-- Dynamic content here -->
				</tbody>
			</table>
		</div>
		<div style="margin-bottom: 20px; text-align: right;">
			<p style="margin: 0; font-size: 16px; color: #333;"><strong>TOTAL:</strong> <span
					id="billing_total_smik"></span>
				(Rupees <span id="billing_total_words_smik"></span> Only)</p>
		</div>
		<div style="margin-bottom: 20px;margin-top: 50px;">
			<p style="margin: 0; font-size: 16px; color: #333; text-align: right;"><strong>Authorized Signatory</strong>
			</p>
		</div>
	</div>
</div>

<script src="../../assets/js/fee.js" type="text/javascript"></script>

<?php
?>