<?php
session_start();
?>
<?php
include '../common/header.php';
?>


<div id="page-wrapper">
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-8">
				<h1 class="page-header">Fees Collections</h1>
			</div>

			<div class="col-lg-2  page-header d-flex justify-content-end align-items-end print hidden">
				<button type="button" class="btn btn-warning" onclick="handlePrint()"><b>Print</b></button>
			</div>

			<div class="col-lg-2  page-header d-flex justify-content-end align-items-end">
				<button type="button" class="btn btn-success" onclick="openPaymentModal()">
					Pay
				</button>
			</div>
		</div>


		<!-- /.main content -->
		<div
			style=" margin: 20px auto; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border-radius: 10px; overflow: hidden;">
			<div style="background-color: #4CAF50; color: white; padding: 15px 20px; text-align: center;">
				<h3>Select Student</h3>
			</div>
			<div style="padding: 20px;">
				<div style="margin-bottom: 15px;">
					<label for="tid" style="display: block; margin-bottom: 5px; font-weight: bold;">Trainee ID</label>
					<select id="tid" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd;"
						onchange="get_data()">
						<option value="0">-Please Select Trainee Id-</option>
						<?php
						global $link;
						$query = "SELECT * FROM tbl_trainee";
						$row = mysqli_query($link, $query);
						while ($data = mysqli_fetch_array($row)) {
							?>
							<option value="<?php echo $data["trainee_id"]; ?>">
								<?php echo $data["name"] . " | " . $data["trainee_id"]; ?>
							</option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div style="background-color: #f1f1f1; padding: 10px 20px; text-align: center;">
				Trainee Information Form
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div style="margin: 20px;">
						<div style="background-color: #28a745; color: white; padding: 15px 20px; text-align: center;">
							<h3>Trainee Information</h3>
						</div>
						<div style="padding: 20px;">
							<form id="trainee-form">
								<div style="margin-bottom: 15px;">
									<label for="sname"
										style="display: block; margin-bottom: 5px; font-weight: bold;">Name</label>
									<input type="text" id="sname"
										style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
								</div>
								<div style="margin-bottom: 15px;">
									<label for="fname"
										style="display: block; margin-bottom: 5px; font-weight: bold;">Father
										Name</label>
									<input type="hidden" name="t_id" id="htid" />
									<input type="text" id="fname"
										style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
								</div>
								<div style="margin-bottom: 15px;">
									<label for="phone"
										style="display: block; margin-bottom: 5px; font-weight: bold;">Phone
										No.</label>
									<input type="text" id="phone"
										style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
								</div>
								<div style="margin-bottom: 15px;">
									<label for="email"
										style="display: block; margin-bottom: 5px; font-weight: bold;">Email</label>
									<input type="text" id="email"
										style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
								</div>
								<div style="margin-bottom: 15px;">
									<label for="address"
										style="display: block; margin-bottom: 5px; font-weight: bold;">Address</label>
									<input type="text" id="address"
										style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
								</div>
								<div style="margin-bottom: 15px;">
									<label for="course"
										style="display: block; margin-bottom: 5px; font-weight: bold;">Course</label>
									<select multiple id="course" name="course[]"
										style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd;"
										required>
										<?php
										$query = "select * from tbl_course";
										$row = mysqli_query($link, $query);
										while ($data = mysqli_fetch_array($row)) {
											?>
											<option><?php echo $data["course_name"]; ?></option>
										<?php } ?>
									</select>
								</div>
								<div style="margin-bottom: 15px; display: none;" class="success">
									<label>due no</label>
									<input type="text" id="dueno" class="form-control" />
								</div>
								<div style="margin-bottom: 15px; display: none;" class="success">
									<label>due amt</label>
									<input type="text" id="dueamt" class="form-control" />
								</div>
								<div style="margin-bottom: 15px; display: none;" class="success">
									<label>Balance</label>
									<input type="text" id="balamt" class="form-control" />
								</div>
								<div style="margin-bottom: 15px;">
									<label for="doj" style="display: block; margin-bottom: 5px; font-weight: bold;">Date
										of
										Joining</label>
									<input type="date" id="doj"
										style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
								</div>
								<div style="margin-bottom: 15px;">
									<label for="fees"
										style="display: block; margin-bottom: 5px; font-weight: bold;">Total
										Fees</label>
									<input type="text" id="fees"
										style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
								</div>
								<div style="margin-bottom: 15px;">
									<label for="nodues"
										style="display: block; margin-bottom: 5px; font-weight: bold;">No. of
										Dues</label>
									<input type="text" id="nodues"
										style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd;"
										onchange="generateDueFields()">
								</div>
								<table
									style="width: 100%; border-collapse: collapse; margin-top: 20px; margin-bottom: 20px;"
									id="duesTable">
									<thead id="duesTableHeader"
										style="display: none; background-color: #f2f2f2; text-align: left;">
										<tr>
											<th style="padding: 10px; border: 1px solid #ddd;">#</th>
											<th style="padding: 10px; border: 1px solid #ddd;">Date</th>
											<th style="padding: 10px; border: 1px solid #ddd;">Amount</th>
										</tr>
									</thead>
									<tbody id="dueFieldsContainer"></tbody>
								</table>
								<div style="margin-bottom: 15px;">
									<label style="display: block; margin-bottom: 5px; font-weight: bold;">Gender</label>
									<div style="display: inline-block; margin-right: 10px;">
										<input type="radio" name="ge" id="gender1" value="male" checked> <label
											for="gender1">Male</label>
									</div>
									<div style="display: inline-block; margin-right: 10px;">
										<input type="radio" name="ge" id="gender2" value="female"> <label
											for="gender2">Female</label>
									</div>
									<div style="display: inline-block; margin-right: 10px;">
										<input type="radio" name="ge" id="gender3" value="other"> <label
											for="gender3">Other</label>
									</div>
								</div>
								<button type="button"
									style="padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; background-color: #4CAF50; color: white; width: 100%;"
									id="save_button" onclick="save_data()">Save</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div style="margin: 20px;">
						<div style="background-color: #4CAF50; color: white; padding: 15px 20px; text-align: center;">
							<h3>Last Payment Detail</h3>
						</div>
						<div style="padding: 20px;">
							<table
								style="width: 100%; border-collapse: collapse; margin-top: 20px; margin-bottom: 20px;"
								id="table">
								<thead style="background-color: #f2f2f2; text-align: left;">
									<tr>
										<th style="padding: 10px; border: 1px solid #ddd;">S.No</th>
										<th style="padding: 10px; border: 1px solid #ddd;">Date</th>
										<th style="padding: 10px; border: 1px solid #ddd;">Amount(rs)</th>
									</tr>
								</thead>
								<tbody id="mytbody"></tbody>
							</table>
						</div>
					</div>

				</div>
			</div>


		</div>

		<form id="pdfForm" action="generate_pdf.php" method="post" target="_blank" style="display: none;">
			<input type="hidden" name="html_content" id="html_content">
		</form>

	</div>
	<div style=" padding:10px;background-color: #ffffff; max-width: 500px;border:5px solid skyblue " id="billing"
		hidden>
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

	<div style=" padding:10px;background-color: #ffffff; max-width: 500px;border:5px solid skyblue " id="smikbill"
		hidden>
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


<!-- /#page-wrapper -->

<!-- /#wrapper -->
<?php
include '../common/footer.php';
?>

<script>
	$(document).ready(function () {
		// Reverse the order of rows in tbody
		$('#pending_body').html(function (_, html) {
			return $(this).children().get().reverse();
		});
	});

	function generateDueFields() {
		const dueFieldsContainer = document.getElementById('dueFieldsContainer');
		const noOfDuesInput = document.getElementById('nodues');
		const duesTableHeader = document.getElementById('duesTableHeader');
		dueFieldsContainer.innerHTML = ''; // Clear existing fields

		const noOfDues = parseInt(noOfDuesInput.value);
		if (!isNaN(noOfDues) && noOfDues > 0) {
			duesTableHeader.style.display = ''; // Show the table header

			for (let i = 1; i <= noOfDues; i++) {
				const dueNoField = `
			<tr class="success" hidden>
				<td>Due  ${i}</td>
				<td><input type="text" class="form-control" name="due_no_${i}" value="${i}" /></td>
			</tr>
		`;
				const dueAmtField = `
			<tr class="success">
				<td>${i}</td>
				<td><input type="date" class="form-control" name="due_date_${i}" style="width: 100px;font-size:10px" /></td>
				<td><input type="text" class="form-control" name="due_amt_${i}" /></td>
			</tr>
		`;
				dueFieldsContainer.innerHTML += dueNoField + dueAmtField;
			}
		} else {
			duesTableHeader.style.display = 'none'; // Hide the table header if no dues are entered
		}
	}

	function handleAmountCheck(result) {
		var amt = parseInt(document.getElementById("validamt").value);
		if (!amt || amt < 0) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Amount should not be greater than the 0',
			});
			document.getElementById("validamt").value = "0";
		}
		else {
			handlePay(result)
		}
	}

	function validateamt() {
		var amt = parseInt(document.getElementById("validamt").value);
		var fees = parseInt(document.getElementById("fees").value);
		var bal = parseInt(document.getElementById("balamt").value);
		var dueamt = parseInt(document.getElementById("dueamt").value)
		var payment_type = document.querySelector('input[name="payment_type"]:checked').value;
		const pendingPayDiv = document.getElementById('pendingPayDiv');
		console.log("ppp", payment_type)
		if (amt <= 0) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Amount should not be greater than the 0',
			});
			document.getElementById("validamt").value = "0";
		}
		if (payment_type == 'initial') {
			pendingPayDiv.classList.add('hidden'); // Show the pending payment date field
		} else if (payment_type == 'due' && amt < dueamt) {

			pendingPayDiv.classList.remove('hidden'); // Hide the pending payment date field
		}
		if (amt > bal) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Amount should not be greater than the fees',
			});
			document.getElementById("validamt").value = "0";
		}
	}
	function handlePayment(gst, result) {
		console.log("pppp", result)
		const amount = result.amount;
		var tid = document.getElementById("htid").value;
		// const inputAmount = document.getElementById("validamt").value.trim();
		const payedamt = amount;
		var date = result.paymentDate;
		var payableamt = document.getElementById("dueamt").value;

		var dueno = document.getElementById("dueno").value;
		payment_type = result.paymentType

		if (payment_type == 'due') {
			var pendingdate = result.pendingPaymentDate
		}
		else {
			var pendingdate = 0
		}
		// var pendingdate = document.getElementById("pending_payment_date").value;
		// var payment_type = document.querySelector('input[name="payment_type"]:checked').value;

		if (tid != '') {
			$.ajax({
				url: '/ajax/save_payment.php',
				type: 'POST',
				data: { t_id: tid, amt: payedamt, date: date, payableamt: payableamt, pendingdate: pendingdate, dueno: dueno, gst: gst, payment_type: payment_type },
				success: function (res) {
					Swal.fire({
						icon: 'success',
						title: 'Saved!',
						text: res,
					}).then(function () {
						// Reload the page after 2 seconds when the user clicks "OK"
						// setTimeout(function () {
						window.location.reload();
						// }, 2000);
					});
				},
				error: function (xhr, status, error) {
					console.error("Error fetching trainee data:", error);
				}
			});
		}
	}
	function get_data() {
		var tid = document.getElementById("tid").value;

		if (tid != 0) {
			document.getElementById("save_button").disabled = true;
		} else {
			document.getElementById("save_button").disabled = false;
		}

		if (tid != '') {
			$.ajax({
				url: '/ajax/get_trainee_data.php',
				type: 'GET',
				data: { tid: tid },
				success: function (res) {
					console.log("Trainee Data Response:", res);
					var response = JSON.parse(res);
					if (response.length > 0) {
						var trainee = response[0];
						document.getElementById("sname").value = trainee.name;
						document.getElementById("fname").value = trainee.father_name;
						document.getElementById("email").value = trainee.email;
						document.getElementById("address").value = trainee.address;
						document.getElementById("doj").value = trainee.doj;
						document.getElementById("course").value = trainee.course;
						document.getElementById("fees").value = trainee.fee;
						document.getElementById("htid").value = trainee.trainee_id;
						document.getElementById("phone").value = trainee.contact;
						document.getElementById("nodues").value = trainee.no_dues;
						// document.getElementById("initialAmt").value = trainee.initial_amt;
						document.getElementById("gender" + (trainee.gender === "male" ? "1" : (trainee.gender === "female" ? "2" : "3"))).checked = true;

						// Update billing details
						document.getElementById('billing_date').textContent = new Date().toLocaleDateString();
						document.getElementById('billing_date_smik').textContent = new Date().toLocaleDateString();
						document.getElementById('billing_address').textContent = trainee.name; // Example address
						document.getElementById('billing_address_smik').textContent = trainee.name; // Example address
						document.getElementById('billing_phone').textContent = trainee.contact;
						document.getElementById('billing_addresses').textContent = trainee.address;
						document.getElementById('billing_phone_smik').textContent = trainee.contact;
						document.getElementById('billing_addresses_smik').textContent = trainee.address;
						document.getElementById('trainee_course').textContent = trainee.course;
						document.getElementById('trainee_course_smik').textContent = trainee.course;
						document.getElementById('course_amount').textContent = trainee.fee;
						document.getElementById('billing_no').textContent = trainee.bill_no;
						document.getElementById('billing_no_smik').textContent = trainee.bill_no;
						document.getElementById('student_id').textContent = trainee.trainee_id;
						document.getElementById('student_id_smik').textContent = trainee.trainee_id;

						var totalFees = trainee.fee;
						var totalWords = numberToWords(totalFees); // Convert number to words function
						document.getElementById('billing_total').textContent = totalFees;
						document.getElementById('billing_total_words').textContent = totalWords;


						fee_details(trainee.course);
					} else {
						console.error("No data found for trainee id:", tid);
					}
					var printElements = document.getElementsByClassName('print');
					for (let i = 0; i < printElements.length; i++) {
						printElements[i].classList.remove('hidden');
					}
				},
				error: function (xhr, status, error) {
					console.error("Error fetching trainee data:", error);
				}
			});
		}
	}


	function fee_details(course) {
		var tid = document.getElementById("tid").value;
		console.log("tid in fee details", tid);
		if (tid != '') {
			$.ajax({
				url: '/ajax/get_payment_details.php',
				type: 'GET',
				data: { tid: tid },
				success: function (res) {
					var mytbody = document.getElementById("mytbody");
					mytbody.innerHTML = ""; // Clear previous table content

					var billingBody = document.getElementById('billing_body');
					billingBody.innerHTML = ""; // Clear billing table content

					var billingBodySmik = document.getElementById('billing_body_smik');
					billingBodySmik.innerHTML = ""; // Clear smik billing content

					var pendingBody = document.getElementById('pending_body');
					pendingBody.innerHTML = ""; // Clear pending payments content

					var response = JSON.parse(res);
					var mamt = 0, j = 1, k = 1, gstpaidamount = 0, gsttotalamount = 0;
					var pending_body_show = false;

					// Separate payments into different categories
					let initialPayments = response.filter(element => element.payment_type == 'initial' && element.status == 1);
					let paidPayments = response.filter(element => element.payment_type != 'initial' && element.status == 1);
					let notPaidPayments = response.filter(element => element.status == 0);

					// Function to append a row to a given table body
					function appendRow(tableBody, index, description, amount, statusText = '') {
						tableBody.innerHTML += `
					<tr style="border: 1px solid #dee2e6;">
						<td style="border: 1px solid #dee2e6;">${index}</td>
						<td style="border: 1px solid #dee2e6;"><b>${description}</b></td>
						<td style="border: 1px solid #dee2e6; text-align: right;"><b>${amount} ${statusText}</b></td>
					</tr>`;
					}
					let filteredElements = response.filter(element => element.status == 0);
					if (filteredElements.length > 0) {
						let firstDueElement = filteredElements.reduce((prev, curr) => {
							return (prev.due_id < curr.due_id) ? prev : curr;
						});

						document.getElementById("dueno").value = firstDueElement.due_id;
						document.getElementById("dueamt").value = firstDueElement.amount;
					} else {
						console.log("No due payments with status 0 found.");
					}
					// Show initial payments
					initialPayments.forEach(element => {
						mamt += parseInt(element.amount);
						appendRow(mytbody, j, `${element.date} (Initial Payment)`, element.amount);  // For mytbody
						appendRow(billingBody, j, `${element.date} (Initial Payment)`, element.gst > 0 ? element.amount + ' (smik) ' : element.amount);  // For billing_body
						// appendRow(billingBodySmik, j, `${element.date} (Initial Payment)`, element.amount);  // For billing_body_smik
						j++;
						if (element.gst > 0) {
							gstpaidamount += parseInt(element.amount);
							gsttotalamount += parseInt(element.gst);
						}
					});

					// Show paid payments
					paidPayments.forEach(element => {
						mamt += parseInt(element.amount);
						let gstDisplay = element.gst > 0 ? element.amount + ' (smik) ' : element.amount;

						appendRow(mytbody, j, element.date, element.amount);  // For mytbody
						appendRow(billingBody, j, element.date, gstDisplay);  // For billing_body
						// appendRow(billingBodySmik, j, element.date, gstDisplay);  // For billing_body_smik

						if (element.gst > 0) {
							gstpaidamount += parseInt(element.amount);
							gsttotalamount += parseInt(element.gst);
						}
						j++;
					});

					// Show unpaid payments in pending_body
					notPaidPayments.forEach(element => {
						appendRow(pendingBody, k, element.date, element.amount, 'Not Paid');
						appendRow(mytbody, j++, element.date, element.amount, 'Not Paid'); // For pending_body
						pending_body_show = true;
						k++;
					});

					// Add total and balance to mytbody
					let totalfees = parseInt(document.getElementById("fees").value);
					let balance = totalfees - mamt;
					document.getElementById("balamt").value = balance;
					appendRow(mytbody, j++, "Total Paid", mamt);
					if (balance > 0) {
						appendRow(mytbody, j, "Balance Amount", balance);
						appendRow(billingBody, j, "Balance Amount", balance);
					}

					// Add total with GST to billing_body_smik
					let halfGst = parseInt(gsttotalamount / 2);
					let billtot = gstpaidamount + gsttotalamount;

					billingBodySmik.innerHTML += `
					<tr style="border: 1px solid #dee2e6;">
						<td style="border: 1px solid #dee2e6;">1</td>
						<td style="border: 1px solid #dee2e6;"><b>${course}</b></td>
						<td style="border: 1px solid #dee2e6; text-align: right;"><b>${gstpaidamount}</b></td>
					</tr>
					<tr style="border: 1px solid #dee2e6;">
						<td style="border: 1px solid #dee2e6;">2</td>
						<td style="border: 1px solid #dee2e6;"><b>CGST</b></td>
						<td style="border: 1px solid #dee2e6; text-align: right;"><b>${halfGst}</b></td>
					</tr>
					<tr style="border: 1px solid #dee2e6;">
						<td style="border: 1px solid #dee2e6;">3</td>
						<td style="border: 1px solid #dee2e6;"><b>SGST</b></td>
						<td style="border: 1px solid #dee2e6; text-align: right;"><b>${halfGst}</b></td>
					</tr>
					<tr style="border: 1px solid #dee2e6;">
						<td style="border: 1px solid #dee2e6;">4</td>
						<td style="border: 1px solid #dee2e6;"><b>Total</b></td>
						<td style="border: 1px solid #dee2e6; text-align: right;"><b>${billtot}</b></td>
					</tr>`;

					// Convert total to words and update the display
					var totalWords = numberToWords(billtot);
					document.getElementById('billing_total_smik').textContent = billtot;
					document.getElementById('billing_total_words_smik').textContent = totalWords;

					// Show pending payments section if needed
					if (pending_body_show) {
						document.getElementById("pending").style.display = "block";
					}
				}
			});
		} else {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Not Working..!',
			});
		}
	}


	function save_data() {
		var sname = document.getElementById("sname").value;
		var fname = document.getElementById("fname").value;
		var email = document.getElementById("email").value;
		var address = document.getElementById("address").value;
		var doj = document.getElementById("doj").value;
		var course = document.getElementById("course");
		// var initialAmt = parseFloat(document.getElementById("initialAmt").value);
		var nodues = parseInt(document.getElementById("nodues").value);
		var fee = parseFloat(document.getElementById("fees").value);
		var phone = document.getElementById("phone").value;
		var gender = document.querySelector('input[name="ge"]:checked').value;

		// Check initial amount
		// if (!initialAmt || initialAmt < 4999) {
		// 	Swal.fire({
		// 		icon: 'error',
		// 		title: 'Oops...',
		// 		text: 'Initial Amount must be more than 5000.',
		// 	});
		// 	return;
		// }

		// Check required fields
		if (!sname || !fname || !doj || !course || !fee || !phone || !email || !address) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'All fields are required.',
			});
			return;
		}

		// Validate phone number
		if (!/^\d{10}$/.test(phone)) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Phone number must be a valid 10-digit number.',
			});
			return;
		}

		// Validate due amounts and due dates
		let selectedValues = [];
		for (let i = 0; i < course.options.length; i++) {
			if (course.options[i].selected) {
				selectedValues.push(course.options[i].value);
			}
		}

		let dueData = [];
		let totalDueAmt = 0;
		for (let i = 1; i <= nodues; i++) {
			let dueAmt = parseFloat(document.querySelector(`input[name="due_amt_${i}"]`).value);
			let dueDate = document.querySelector(`input[name="due_date_${i}"]`).value;

			if (!dueAmt || isNaN(dueAmt) || dueAmt <= 0) {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: `Due Amount for Due #${i} is required and must be a positive number.`,
				});
				return;
			}

			if (!dueDate) {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: `Due Date for Due #${i} is required.`,
				});
				return;
			}

			totalDueAmt += dueAmt;
			let dueNo = document.querySelector(`input[name="due_no_${i}"]`).value;
			dueData.push({ dueNo, dueAmt, dueDate });
		}

		// Check if total due amount plus initial amount is equal to the fee
		// if (totalDueAmt + initialAmt !== fee) {
		// 	Swal.fire({
		// 		icon: 'error',
		// 		title: 'Oops...',
		// 		text: 'The sum of Due Amounts and Initial Amount must be equal to the Total Fee.',
		// 	});
		// 	return;
		// }

		var courselist = selectedValues.join(", ");
		$.ajax({
			url: '/ajax/save_trainee.php',
			type: 'POST',
			data: {
				sname: sname,
				fname: fname,
				email: email,
				address: address,
				doj: doj,
				course: courselist,
				fee: fee,
				phone: phone,
				gender: gender,
				nodues: nodues,
				// initialAmt: initialAmt,
				dues: dueData
			},
			success: function (response) {
				// Parse the JSON response
				const res = JSON.parse(response);

				if (res.status === 'success') {
					Swal.fire({
						icon: 'success',
						title: 'Saved!',
						text: res.message,
					}).then(function () {
						window.location.reload();
					});
				} else if (res.status === 'error') {
					Swal.fire({
						icon: 'error',
						title: 'Error!',
						text: res.message,
					});
				}
			},
			error: function (xhr, status, error) {
				Swal.fire({
					icon: 'error',
					title: 'Error!',
					text: 'An unexpected error occurred.',
				});
				console.error('Error: ' + error);  // Log error to the console for debugging
			}
		});


	}



	window.onload = function () {
		let today = new Date();
		let day = String(today.getDate()).padStart(2, '0');
		let month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
		let year = today.getFullYear();

		let todayDate = year + '-' + month + '-' + day;
		document.getElementById('doj').value = todayDate;
		// document.getElementById('payment_date').value = todayDate;
	};
	// function handlePrint() {
	// 	// Open a new window
	// 	var win = window.open('', '_blank');
	// 	var linkData = `
	// 	<head>
	// 		<title>Fee Collection</title>
	// 		<meta name="viewport" content="width=device-width, initial-scale=1">
	// 		<link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">
	// 		<style>
	// 			/* Add any additional styling here */
	// 			.print-div {
	// 				padding: 20px;
	// 			}
	// 			.table {
	// 				width: 100%;
	// 				margin-bottom: 20px;
	// 				border-collapse: collapse;
	// 			}
	// 			.table-bordered th, .table-bordered td {
	// 				border: 1px solid #ddd !important;
	// 			}
	// 			.panel {
	// 				margin-bottom: 20px;
	// 				background-color: #fff;
	// 				border: 1px solid transparent;
	// 				border-radius: 4px;
	// 				box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
	// 			}
	// 		</style>
	// 	</head>`;

	// 	// Write the content to be printed into the new window
	// 	win.document.write(linkData + "<body><div class='print-div'>" + document.querySelector("#page-wrapper").innerHTML + "</div></body>");

	// 	// Add an onload event to the new window to trigger the print function once the content is fully loaded
	// 	win.document.close(); // Necessary for some browsers to trigger the onload event
	// 	win.onload = function () {
	// 		win.focus(); // Bring the print window to focus
	// 		win.print(); // Trigger the print dialog
	// 		win.close(); // Close the print window after printing
	// 	};
	// }
	function handleYuva() {
		// Get the HTML content of the page-wrapper div
		var pageContent = document.getElementById('billing').outerHTML;

		// Set the HTML content to the hidden input field
		document.getElementById('html_content').value = pageContent;

		// Submit the form to generate the PDF
		document.getElementById('pdfForm').submit();
	}
	function handleSmikBillPrint() {
		// Get the HTML content of the page-wrapper div
		var pageContent = document.getElementById('smikbill').outerHTML;

		// Set the HTML content to the hidden input field
		document.getElementById('html_content').value = pageContent;

		// Submit the form to generate the PDF
		document.getElementById('pdfForm').submit();
	}
	function numberToWords(num) {
		const a = ['Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
		const b = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
		const c = ['Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
		const d = ['Hundred', 'Thousand', 'Million'];

		function convertTens(num) {
			let str = '';
			if (num < 10) str = a[num];
			else if (num < 20) str = b[num - 10];
			else {
				let x = Math.floor(num / 10);
				let y = num % 10;
				str = c[x - 2];
				if (y > 0) str += '-' + a[y];
			}
			return str;
		}

		function convertHundreds(num) {
			let str = '';
			if (num > 99) {
				str += a[Math.floor(num / 100)] + ' ' + d[0] + ' ';
				num %= 100;
			}
			if (num > 0) str += convertTens(num);
			return str;
		}

		function convertNumber(num) {
			if (num === 0) return a[0];
			let str = '';
			if (Math.floor(num / 1000000) > 0) {
				str += convertNumber(Math.floor(num / 1000000)) + ' ' + d[2] + ' ';
				num %= 1000000;
			}
			if (Math.floor(num / 1000) > 0) {
				str += convertHundreds(Math.floor(num / 1000)) + ' ' + d[1] + ' ';
				num %= 1000;
			}
			if (num > 0) str += convertHundreds(num);
			return str.trim();
		}

		return convertNumber(num).trim();
	}

	console.log(numberToWords(2360) + ' Only');  // "Two Thousand Three Hundred Sixty Only"


	// Example usage:
	console.log(numberToWords(123456)); // Outputs: "One Hundred Twenty-Three Thousand Four Hundred Fifty-Six"
	console.log(numberToWords(101)); // Outputs: "One Hundred One"
	function handlePay(result1) {
		Swal.fire({
			title: 'Pay Options',
			text: 'Choose an option:',
			icon: 'info',
			showCancelButton: true,
			confirmButtonText: 'Yuva Shakthi Academy',
			cancelButtonText: 'Smik Systems',
			customClass: {
				confirmButton: 'btn btn-primary',  // Styling for Option 1 button
				cancelButton: 'btn btn-secondary'  // Styling for Option 2 button
			},
			buttonsStyling: false  // Use Bootstrap styling
		}).then((result) => {
			if (result.isConfirmed) {
				// Handle Option 1
				console.log('res1', result1)
				handlePayment(0, result1);
			} else if (result.dismiss === Swal.DismissReason.cancel) {
				// Handle Option 2
				handleSmik(result1);  // Call the handleSmik function
			}
		});
	}
	function handleSmik(result1) {
		// Get the payment amount
		console.log('handleSmik', result1)
		var payedamt = parseFloat(result1.amount)

		// Calculate GST (Assuming GST is 18%)
		var gstRate = 0.18;
		var gstAmount = payedamt * gstRate;
		var totalAmount = payedamt + gstAmount;

		// Show another SweetAlert with payment + GST details
		Swal.fire({
			title: 'Payment Details',
			html: `
			<p>Payment Amount: <b>₹${payedamt.toFixed(2)}</b></p>
			<p>GST (18%): <b>₹${gstAmount.toFixed(2)}</b></p>
			<p>Total Amount: <b>₹${totalAmount.toFixed(2)}</b></p>
		`,
			icon: 'info',
			confirmButtonText: 'OK',
			customClass: {
				confirmButton: 'btn btn-success'
			},
			buttonsStyling: false
		}).then((result) => {
			if (result.isConfirmed) {
				// Set the value of validamt to the total amount

				// Call the handlePayment function
				handlePayment(gstAmount, result1);
			}
		});
	}

	function handlePrint() {
		Swal.fire({
			title: 'Pay Options',
			text: 'Choose an option:',
			icon: 'info',
			showCancelButton: true,
			confirmButtonText: 'Yuva Shakthi Academy',
			cancelButtonText: 'Smik Systems',
			customClass: {
				confirmButton: 'btn btn-primary',  // Styling for Option 1 button
				cancelButton: 'btn btn-secondary'  // Styling for Option 2 button
			},
			buttonsStyling: false  // Use Bootstrap styling
		}).then((result) => {
			if (result.isConfirmed) {
				// Handle Option 1
				handleYuva()
			} else if (result.dismiss === Swal.DismissReason.cancel) {
				// Handle Option 2
				handleSmikBillPrint()
			}
		});
	}
	function openPaymentModal() {
		Swal.fire({
			title: 'New Payment',
			html: `
			<form id="paymentForm" class="needs-validation p-4" novalidate>
	<div class=" shadow-sm" >
		<div class="p-5">

			<!-- Payment Date Field -->
			<div class="mb-3">
				<label for="payment_date" class="form-label" style="color: #17a2b8;">Payment Date</label>
				<input type="date" class="form-control" id="payment_date" name="date" required>
				
			</div>

			<!-- Payment Amount Field -->
			<div class="mb-3">
				<label for="validamt" class="form-label" style="color: #17a2b8;">Amount</label>
				<input class="form-control" id="validamt" placeholder="Enter Amount" name="amt"
											required>
			</div>

			<!-- Payment Type Radio Buttons -->
			<div class="mb-3">
				<label class="form-label" style="color: #17a2b8;">Payment Type</label><br>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="payment_type" id="initial_payment" value="initial" onchange="validateamt()">
					<label class="form-check-label" for="initial_payment">Initial Payment</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="payment_type" id="due_payment" value="due" onchange="validateamt()">
					<label class="form-check-label" for="due_payment">Due Payment</label>
				</div>
			</div>

			<!-- Pending Payment Date Field (Hidden Initially) -->
			 <div class="mb-3 hidden" id="pendingPayDiv">
					<label for="pending_payment_date" class="form-label" style="color: #17a2b8;">Pay Date</label>
					<input type="date" class="form-control" id="pending_payment_date" name="pay_date">
				</div>

			
		</div>
	</div>
</form>

		`,
			showCancelButton: true,
			confirmButtonText: 'Pay',
			cancelButtonText: 'Close',
			preConfirm: () => {
				const paymentDate = document.getElementById('payment_date').value;
				const amount = (document.getElementById("validamt").value);
				const paymentType = document.querySelector('input[name="payment_type"]:checked').value;
				const pendingPaymentDate = document.getElementById('pending_payment_date').value;
				// if (paymentType != 'initial') {
				// 	validateamt()
				// }
				// Basic validation (you can extend this)
				if (!paymentDate) {
					Swal.showValidationMessage('Please fill  the paymentDate');
					return false;
				}
				// if (!amount) {
				// 	Swal.showValidationMessage('Please fill  the amount');
				// 	return false;
				// }
				if (!paymentType) {
					Swal.showValidationMessage('Please fill  the paymentType');
					return false;
				}
				// If everything is valid, return the form data
				const result = {
					paymentDate,
					amount,
					paymentType
				};
				if (paymentType === 'due') {
					result.pendingPaymentDate = pendingPaymentDate;
				}

				// Return the form data
				return result;
			}
		}).then((result) => {
			if (result.isConfirmed) {
				// Form data from SweetAlert modal
				console.log(result.value);
				handleAmountCheck(result.value); // Call your function to handle the payment
			}
		});
	}

</script>
<?php
if (isset($_GET['tid'])) {
	$traineeid = $_GET['tid'];
	echo '<script> $("#tid").val("' . $traineeid . '").trigger("change") </script>';
}
?>