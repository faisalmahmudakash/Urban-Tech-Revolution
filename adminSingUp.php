<?php
// Establish a connection to MySQL database
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

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $email = $_POST['email'];
    $permanentaddress = $_POST['Locality'];
    $secondaryaddress = $_POST['address'];
    $city = $_POST['State'];
    $country = $_POST['Country'];
    $registrationdate = $_POST['dob'];
    $gender = $_POST['gender'];
    $countrycode = $_POST['cod'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Image upload handling
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "img2/"; // Directory where images will be stored
        $targetFile = $targetDir . basename($_FILES['image']['name']);

        // Move uploaded file to the specified directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // Image successfully uploaded, now insert into the database
            $image = $targetFile; // Save image path to the database
        } else {
            // Handle image upload error
            echo "Error uploading image.";
            exit();
        }
    } else {
        // Handle image upload error
        echo "Error uploading image.";
        exit();
    }

    // SQL query to insert data into the adminreg table----just here
    // Hash the password before inserting it into the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); //-----------------------------------------------------------hassed

    $sql = "INSERT INTO adminreg (firstname, lastname, email, permanentaddress, secondaryaddress, city, image, country, registrationdate, gender, countrycode, phone, password) 
        VALUES ('$firstname', '$lastname', '$email', '$permanentaddress', '$secondaryaddress', '$city', '$image', '$country', '$registrationdate', '$gender', '$countrycode', '$phone', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        //echo '<script>alert("Image uploaded successfully!");</script>';
        header("Location: congratulationsPHP/congratulations.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Urban Tech Revulation</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/adminSingUp.css?v=2" rel="stylesheet">
</head>

<body>

    <div class="container mt-3">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <div class="row jumbotron box8">
                <div class="col-sm-12 mx-t3 mb-4">
                    <h2 class="text-center text-info">Admin Register</h2>
                </div>

                <div class="col-sm-6 form-group">
                    <label for="name-f">First Name</label>
                    <input type="text" class="form-control" name="fname" id="name-f" placeholder="Enter your first name." required pattern="[A-Za-z]+( [A-Za-z]+)?" title="Please enter letters only for the first name.">
                    <!-- 'pattern' attribute with [A-Za-z]+ allows only alphabetic characters -->
                </div>
                <div class="col-sm-6 form-group">
                    <label for="name-l">Last name</label>
                    <input type="text" class="form-control" name="lname" id="name-l" placeholder="Enter your last name." required pattern="[A-Za-z]+( [A-Za-z]+)?" title="Please enter letters only for the last name.">
                    <!-- 'pattern' attribute with [A-Za-z]+ allows only alphabetic characters -->
                </div>

                <div class="col-sm-6 form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email." pattern="^[^0-9][a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com|green\.com)$" title="Please enter a valid email address with domain as gmail.com, yahoo.com, or green.com and the first character not as a number." required>
                </div>

                <div class="col-sm-6 form-group">
                    <label for="address-1">Permanent Address</label>
                    <input type="address" class="form-control" name="Locality" id="address-1" placeholder="Locality/House/Street no." required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="address-2">Present Address</label>
                    <input type="address" class="form-control" name="address" id="address-2" placeholder="Village/City Name." required>
                </div>

                <div class="col-sm-2 form-group">
                    <label for="image">image</label>
                    <input type="file" class="form-control" name="image" id="image" placeholder="Image" required>
                </div>

                <div class="col-sm-4 form-group">
                    <label for="State">NID</label>
                    <input type="text" class="form-control" name="State" id="State" placeholder="Enter NID Number" pattern="[0-9]{10}" title="Please enter exactly 10 digits" required>
                </div>


                <div class="col-sm-6 form-group">
                    <label for="Country">Country</label>
                    <select class="form-control custom-select browser-default" name="Country">
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="India">India</option>
                        <option value="Napal">Napal</option>
                    </select>
                </div>

                <div class="col-sm-6 form-group">
                    <?php
                    date_default_timezone_set('Asia/Dhaka'); // Set the time zone to Asia/Dhaka (Bangladesh Standard Time)
                    $currentDate = date('Y-m-d'); // Get the current date in YYYY-MM-DD format for Dhaka timezone
                    ?>

                    <div class="mb-3">
                        <label for="date">Registration Date</label>
                        <input type="text" class="form-control" id="Date" name="dob" value="<?php echo $currentDate; ?>" readonly>
                    </div>
                </div>

                <!--<div class="col-sm-6 form-group">
                    <label for="Date">Registration Date</label>
                    <input type="Date" name="dob" class="form-control" id="Date" placeholder="" required>
                </div>-->

                <div class="col-sm-6 form-group">
                    <label for="sex">Gender</label>
                    <select id="sex" class="form-control browser-default custom-select" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="unspesified">Unspecified</option>
                    </select>
                </div>
                <div class="col-sm-2 form-group">
                    <label for="cod">Country code</label>
                    <select class="form-control browser-default custom-select" name="cod">

                        <option data-countryCode="BD" value="880" selected>Ban(+880)</option>

                        <option disabled="disabled">Other Countries</option>
                        <option data-countryCode="DZ" value="213">Algeria(+213)</option>
                    </select>
                </div>

                <div class="col-sm-4 form-group">
                    <label for="tel">Phone</label>
                    <input type="tel" name="phone" class="form-control" id="tel" placeholder="Enter Your Contact Number." required pattern="[0-9]{11}" title="Please enter a valid 11-digit phone number">
                    <!-- 'pattern' attribute with a regular expression for 11-digit phone number -->
                </div>


                <div class="col-sm-6 form-group">
                    <label for="pass">Password</label>
                    <input type="password" name="password" class="form-control" id="pass" placeholder="Enter your password." required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="pass2">Confirm Password</label>
                    <input type="password" name="cnf-password" class="form-control" id="pass2" placeholder="Re-enter your password." required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" oninput="checkPasswordMatch();" title="Password must contain at least 8 characters, including one uppercase letter, one lowercase letter, and one number.">
                    <!-- 'pattern' attribute with a regular expression for password complexity -->
                    <small id="password-error" class="text-danger" style="display: none;">Passwords do not match.</small>
                </div>

                <script>
                    function checkPasswordMatch() {
                        const password = document.getElementById('pass');
                        const confirmPassword = document.getElementById('pass2');
                        const passwordError = document.getElementById('password-error');

                        if (password.value !== confirmPassword.value) {
                            passwordError.style.display = 'block';
                            confirmPassword.setCustomValidity('Passwords do not match.');
                        } else {
                            passwordError.style.display = 'none';
                            confirmPassword.setCustomValidity('');
                        }
                    }
                    document.getElementById('pass').addEventListener('input', checkPasswordMatch);
                    document.getElementById('pass2').addEventListener('input', checkPasswordMatch);
                </script>

                <div class="col-sm-12 form-group mb-0">
                    <button id="submitBtn" class="btn btn-primary float-right mt-4" type="submit">Submit</button>
                </div>

            </div>
        </form>
    </div>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="js/script.js?v=1"></script>
</body>

</html>