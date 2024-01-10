<?php
//session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "urbancityrevolution";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $companyName = $conn->real_escape_string($_POST['companyName']);
    $address = $conn->real_escape_string($_POST['address']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $additionalInfo = $conn->real_escape_string($_POST['additionalInfo']);
    $createAccount = isset($_POST['createAccount']) ? 1 : 0; // Convert checkbox value to boolean

    $sql = "INSERT INTO visitorinfo (first_name, last_name, company_name, address, email, phone, additional_info, create_account)
            VALUES ('$firstName', '$lastName', '$companyName', '$address', '$email', '$phone', '$additionalInfo', '$createAccount')";

    if ($conn->query($sql) === TRUE) {
        // Set a session variable to indicate the card creation
        $_SESSION['card_created'] = true;
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Urban Tech Revulation</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Include the jsPDF library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>

<body>
    <form id="visitorForm" action="visitorCard.php" method="post">
        <!-- 2 column grid layout with text inputs for the first and last names -->
        <div class="row mb-1">
            <div class="col">
                <div data-mdb-input-init class="form-outline">
                    <label class="form-label" for="form6Example1">First name</label>
                    <input type="text" id="form6Example1" class="form-control" name="firstName" />
                </div>
            </div>
            <div class="col">
                <div data-mdb-input-init class="form-outline">
                    <label class="form-label" for="form6Example2">Last name</label>
                    <input type="text" id="form6Example2" class="form-control" name="lastName" />
                </div>
            </div>
        </div>

        <!-- Text input -->
        <div data-mdb-input-init class="form-outline mb-1">
            <label class="form-label" for="form6Example3">Company name</label>
            <input type="text" id="form6Example3" class="form-control" name="companyName" />
        </div>

        <!-- Text input -->
        <div data-mdb-input-init class="form-outline mb-1">
            <label class="form-label" for="form6Example4">Address</label>
            <input type="text" id="form6Example4" class="form-control" name="address" />
        </div>

        <!-- Email input -->
        <div data-mdb-input-init class="form-outline mb-1">
            <label class="form-label" for="form6Example5">Email</label>
            <input type="email" id="form6Example5" class="form-control" name="email" />
        </div>

        <!-- Number input -->
        <div data-mdb-input-init class="form-outline mb-1">
            <label class="form-label" for="form6Example6">Phone</label>
            <input type="number" id="form6Example6" class="form-control" name="phone" />
        </div>

        <!-- Message input -->
        <div data-mdb-input-init class="form-outline mb-1">
            <label class="form-label" for="form6Example7">Additional information</label>
            <textarea class="form-control" id="form6Example7" name="additionalInfo" rows="1"></textarea>
        </div>

        <!-- Checkbox -->
        <div class="form-check d-flex justify-content-center mb-1">
            <input class="form-check-input me-2" type="checkbox" value="" id="form6Example8" name="createAccount" checked />
            <label class="form-check-label" for="form6Example8"> Create an account? </label>
        </div>

        <style>
            .margin {
                display: flex;
                justify-content: space-around;
            }
        </style>
        <div class="margin">
            <!-- Submit button -->
            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-1">Submit</button>

            <!-- Download button -->
            <button id="downloadBtn" type="button" class="btn btn-primary btn-block mb-1">Download</button>
        </div>
    </form>

    <script>
        // Initialization
        import {
            Input,
            Ripple,
            initMDB
        } from "mdb-ui-kit";

        initMDB({
            Input,
            Ripple
        });
    </script>

    <script>
        document.getElementById('downloadBtn').addEventListener('click', function() {
            var form = document.getElementById('visitorForm');
            var formData = new FormData(form);

            var dataString = '';
            for (var pair of formData.entries()) {
                dataString += pair[0] + ': ' + pair[1] + '\n';
            }

            var confirmed = window.confirm('Do you want to download the data as a PDF?\n\n' + dataString);

            if (confirmed) {
                // Send the form data to the server for PDF generation
                fetch('generatePDF.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.blob())
                    .then(blob => {
                        // Trigger download of the generated PDF
                        var url = window.URL.createObjectURL(blob);

                        var a = document.createElement('a');
                        a.href = url;
                        a.download = 'visitorData.pdf';
                        document.body.appendChild(a);
                        a.click();

                        document.body.removeChild(a);
                        window.URL.revokeObjectURL(url);
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>

    <!--php
    require('fpdf.php'); // Assuming fpdf.php is included or required

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process and retrieve form data
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        // ... (retrieve other form fields)

        // Create PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'First Name: ' . $firstName);
        $pdf->Ln();
        $pdf->Cell(40, 10, 'Last Name: ' . $lastName);
        // ... (add other form fields to the PDF)

        // Output PDF as a download
        $pdf->Output('D', 'visitorData.pdf');
    }
    ?>-->

</body>

</html>