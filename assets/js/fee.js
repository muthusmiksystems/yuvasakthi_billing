let currentPage = 1; // Initialize current page
let totalPages = 1; // Total pages variable
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("paybtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal


// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function pending_call() {
    var searchTerm = document.getElementById('pending_search').value;
    var filterTerm = document.getElementById('pending_filter').value == '-Filter-' ? '' : document.getElementById('pending_filter').value;

    $.ajax({
        url: '/ajax/pending_fee_students.php',
        type: 'GET',
        data: { search: searchTerm, filter: filterTerm, page: currentPage },
        success: function (res) {
            var pend_stud = document.getElementById('pend_stud');
            var response = JSON.parse(res);

            // Update total pages
            totalPages = response.total_pages;

            // Clear any existing rows in the table
            pend_stud.innerHTML = '';

            // Loop through the array of students and create table rows
            response.data.forEach(student => {
                if (student.pending_amount != 0) {
                    var row = `
                        <tr>
                            <td>${student.trainee_id}</td>
                            <td>${student.name}</td>
                            <td>${student.father_name}</td>
                            <td>${student.contact}</td>
                            <td>${student.course}</td>
                            <td>${student.pending_dues}</td>
                            <td>${student.pending_amount}</td>
                            <td>
                                <button type="button" class="btn btn-primary" id="paybtn" onclick="openStudDetails('${student.trainee_id}')">
                                    Open Details
                                </button>
                            </td>
                        </tr>
                    `;

                    // Only append the row if the condition is true
                    pend_stud.innerHTML += row;
                }
            });


            // Update pagination controls
            updatePagination();
        },
        error: function (xhr, status, error) {
            console.error("Error fetching trainee data:", error);
        }
    });
}

function updatePagination() {
    const paginationContainer = document.getElementById('pagination');
    paginationContainer.innerHTML = ''; // Clear existing pagination

    // Create previous button
    const prevButton = document.createElement('button');
    prevButton.innerText = 'Previous';
    prevButton.disabled = currentPage === 1;
    prevButton.onclick = function () {
        if (currentPage > 1) {
            currentPage--;
            pending_call();
        }
    };
    paginationContainer.appendChild(prevButton);

    // Create page numbers
    for (let i = 1; i < totalPages; i++) {
        const pageButton = document.createElement('button');
        pageButton.innerText = i;
        pageButton.disabled = i === currentPage;
        pageButton.onclick = function () {
            currentPage = i;
            pending_call();
        };
        paginationContainer.appendChild(pageButton);
    }

    // Create next button
    const nextButton = document.createElement('button');
    nextButton.innerText = 'Next';
    nextButton.disabled = currentPage === totalPages;
    nextButton.onclick = function () {
        if (currentPage < totalPages) {
            currentPage++;
            pending_call();
        }
    };
    paginationContainer.appendChild(nextButton);
}

// Initial call to load the data
pending_call();

function openTab(evt, tabName) {
    // Hide all tab content
    const tabcontent = document.getElementsByClassName("tabcontent");
    for (let i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Remove the "active" class from all tab links
    const tablinks = document.getElementsByClassName("tablinks");
    for (let i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}
function openStudDetails(trainee_id) {
    var paymentbtn = document.getElementById('paymentbtn')
    var duebtn = document.getElementById('duebtn')
    paymentbtn.style.display = "block"
    duebtn.style.display = "none"
    modal.style.display = "block";
    openTab(event, 'studentDetails')
    if (trainee_id != 0) {
        document.getElementById("save_button").disabled = true;
    } else {
        document.getElementById("save_button").disabled = false;
    }

    if (trainee_id != '') {
        $.ajax({
            url: '/ajax/get_trainee_data.php',
            type: 'GET',
            data: { tid: trainee_id },
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
    var tid = document.getElementById("htid").value;
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
                function appendRow(tableBody, index, description, amount, statusText = '', buttonHtml) {
                    tableBody.innerHTML += `
                      <tr style="border: 1px solid #dee2e6;">
                        <td style="border: 1px solid #dee2e6;">${index}</td>
                        <td style="border: 1px solid #dee2e6;"><b>${description}</b></td>
                        <td style="border: 1px solid #dee2e6; text-align: right;"><b>${amount} ${statusText}</b></td>
                        ${buttonHtml ? `<td style="border: 1px solid #dee2e6;"><b>${buttonHtml}</b></td>` : ''}
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
                    appendRow(mytbody, j, `${element.date} (Initial Payment)`, element.amount, '', '<button type="button" class="btn text-success mx-auto" id="paybtn" disabled><strong>Paid</strong></button>');  // For mytbody
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

                    appendRow(mytbody, j, element.date, element.amount, '', '<button type="button" class="btn text-success mx-auto" id="paybtn" disabled><strong>Paid</strong></button>');  // For mytbody
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
                    if(element.payment_type == 'initial' && element.status == 0)
                    {
                        appendRow(pendingBody, k, 'Initial Payment', element.amount, 'Not Paid');
                    }
                    else{
                        appendRow(pendingBody, k, element.date, element.amount, 'Not Paid');
                    }
                    
                    if (element.payment_type == 'initial' && element.status == 0) {
                        appendRow(
                            mytbody,
                            j++, // Increment the index
                            'Initial Payment', // Date from the element
                            element.amount, // Amount from the element
                            'Not Paid', // Status text
                            `<button type="button" class="btn btn-danger" onclick="openPaymentModal('${element.date}', ${element.amount},'initial')" id="paybtn">Pay</button>`
                        );

                    }
                    else {
                        appendRow(
                            mytbody,
                            j++, // Increment the index
                            element.date, // Date from the element
                            element.amount, // Amount from the element
                            'Not Paid', // Status text
                            `<button type="button" class="btn btn-danger" onclick="openPaymentModal('${element.date}', ${element.amount})" id="paybtn">Pay</button>`
                        );
                    }

                    pending_body_show = true;
                    k++;
                });

                // Add total and balance to mytbody
                let totalfees = parseInt(document.getElementById("fees").value);
                let balance = totalfees - mamt;
                document.getElementById("balamt").value = balance;
                appendRow(mytbody, j++, "Total Paid", mamt, '', `<div class=" print">
				<button type="button" class="btn btn-warning" onclick="handlePrint()"><b>Print</b></button>
			</div>`);
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
function openAddStud() {
    var duebtn = document.getElementById("duebtn")
    var paymentbtn = document.getElementById("paymentbtn")
    modal.style.display = "block";
    duebtn.style.display = "block"
    paymentbtn.style.display = "none"
}
function generateDueFields() {
    const dueFieldsContainer = document.getElementById('dueFieldsContainer');
    const noOfDuesInput = document.getElementById('nodues');
    const duesTableHeader = document.getElementById('duesTableHeader');
    dueFieldsContainer.innerHTML = ''; // Clear existing fields
    const dueNoField = `
    <tr class="success" hidden>
        <td>Due  1</td>
        <td><input type="text" class="form-control" name="initial_amt" value="1" /></td>
    </tr>
`;
    const dueAmtField = `
    <tr class="success">
        <td>1</td>
        <td class="text-center text-success"><strong>Initial Amount</strong></td>
        <td><input type="text" class="form-control" name="initial_amt" id="initial_amt" /></td>
    </tr>
`;
    dueFieldsContainer.innerHTML += dueNoField + dueAmtField;
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
            <td><input type="date" class="form-control" name="due_date_${i}"  /></td>
            <td><input type="text" class="form-control" name="due_amt_${i}" /></td>
        </tr>
    `;
            dueFieldsContainer.innerHTML += dueNoField + dueAmtField;
        }
    } else {
        duesTableHeader.style.display = 'none'; // Hide the table header if no dues are entered
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
    var init_amt = document.getElementById("initial_amt").value || 0

    if (!sname || !fname || !doj || !course || !fee || !phone || !email || !address || !init_amt) {
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
    console.log("calc=", parseInt(totalDueAmt) + parseInt(init_amt))
    console.log("fee=", fee)
    if ((parseInt(totalDueAmt) + parseInt(init_amt)) !== fee) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: `The total initial amount plus due amounts must be equal to the total fee.`,
        });
        return;
    }

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
            dues: dueData,
            init_amt: init_amt
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

function openPaymentModal(date = '', amt = '', payment_type = 'due') {
    // Populate the modal fields with the provided data
    document.getElementById('payment_date').value = date;
    document.getElementById('validamt').value = amt;

    // Set the correct payment type
    if (payment_type === 'initial') {
        document.getElementById('initial_payment').checked = true;
    } else {
        document.getElementById('due_payment').checked = true;
    }
    var modal = document.getElementById("paymentModal");
    modal.style.display = "block";

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

function handleAmountCheck() {
    var payeddate = document.getElementById("payment_date").value;
    var dueamt = parseInt(document.getElementById("dueamt").value)

    var amt = parseInt(document.getElementById("validamt").value);
    // Validate payment date
    if (amt < dueamt) {
        const pendingPayDiv = document.getElementById('pending_payment_date').value;
        if (!pendingPayDiv) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select a pay date.',
            });
            return;  // Stop further execution if payment date is not provided
        }
    }
    else {
        if (!payeddate) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select a payment date.',
            });
            return;  // Stop further execution if payment date is not provided
        }
    }


    // Validate amount
    var amt = parseInt(document.getElementById("validamt").value);
    if (!amt || amt <= 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Amount should be greater than 0.',
        });
        document.getElementById("validamt").value = "0";  // Reset the amount to "0"
        return;  // Stop further execution if the amount is invalid
    }

    // Call handlePay if all validations pass
    handlePay();
}

function handlePay() {
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
            console.log('res1', result)
            handlePayment(0, result);
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // Handle Option 2
            handleSmik(result);  // Call the handleSmik function
        }
    });
}

function handlePayment(gst, result) {
    const amount = document.getElementById("validamt").value
    var tid = document.getElementById("htid").value;
    const payedamt = amount;
    var date = document.getElementById("payment_date").value
    var payableamt = document.getElementById("dueamt").value;

    var dueno = document.getElementById("dueno").value;
    const payment_type = document.querySelector('input[name="payment_type"]:checked')?.value;

    if (payment_type == 'due') {
        var pendingdate = document.getElementById("pending_payment_date").value
    }
    else {
        var pendingdate = 0
    }
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
                    window.location.reload();
                });
            },
            error: function (xhr, status, error) {
                console.error("Error fetching trainee data:", error);
            }
        });
    }
}

function handleSmik(result1) {
    var payedamt = document.getElementById("validamt").value
    var gstRate = 0.18;
    var gstAmount = payedamt * gstRate;
    var totalAmount = payedamt + gstAmount;
    Swal.fire({
        title: 'Payment Details',
        html: `
        <p>Payment Amount: <b>₹${payedamt}</b></p>
        <p>GST (18%): <b>₹${gstAmount}</b></p>
        <p>Total Amount: <b>₹${totalAmount}</b></p>
    `,
        icon: 'info',
        confirmButtonText: 'OK',
        customClass: {
            confirmButton: 'btn btn-success'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            handlePayment(gstAmount, result1);
        }
    });
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

    if (amt > bal) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Amount should not be greater than the fees',
        });
        document.getElementById("validamt").value = "0";
    }
    if (amt < dueamt) {
        pendingPayDiv.style.display = "block"
    }

}
function handlemodalclose() {
    var paymodal = document.getElementById('paymentModal')
    paymodal.style.display = "none"
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