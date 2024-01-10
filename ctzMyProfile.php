<?php
// Start the session
session_start();

// Check if the user is logged in and the email is set in the session
if (isset($_SESSION['citizenEmail'])) {
    $email = $_SESSION['citizenEmail'];

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

    // Query to fetch user information based on email
    $sql = "SELECT firstname, lastname, email, permanentaddress, secondaryaddress, city, image, country, registrationdate, gender, countrycode, phone FROM citizenreg WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Retrieve user information
        $firstName = $row['firstname'];
        $lastName = $row['lastname'];
        $email = $row['email'];
        $permanentAddress = $row['permanentaddress'];
        $secondaryAddress = $row['secondaryaddress'];
        $city = $row['city'];
        $image = $row['image'];
        $country = $row['country'];
        $registrationDate = $row['registrationdate'];
        $gender = $row['gender'];
        $countryCode = $row['countrycode'];
        $phone = $row['phone'];
    } else {
        echo "No user found with this email.";
    }

    // Close the result set
    $result->free_result();

    // Handle the form update
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the form fields are set and not empty
        if (
            isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) &&
            isset($_POST['permanentAddress']) && isset($_POST['secondaryAddress']) && isset($_POST['city']) &&
            isset($_POST['country']) && isset($_POST['registrationDate']) && isset($_POST['gender']) &&
            isset($_POST['countryCode']) && isset($_POST['phone'])
        ) {
            // Sanitize form input to prevent SQL injection
            $firstName = $conn->real_escape_string($_POST['firstName']);
            $lastName = $conn->real_escape_string($_POST['lastName']);
            $permanentAddress = $conn->real_escape_string($_POST['permanentAddress']);
            $secondaryAddress = $conn->real_escape_string($_POST['secondaryAddress']);
            $city = $conn->real_escape_string($_POST['city']);
            $country = $conn->real_escape_string($_POST['country']);
            $registrationDate = $conn->real_escape_string($_POST['registrationDate']);
            $gender = $conn->real_escape_string($_POST['gender']);
            $countryCode = $conn->real_escape_string($_POST['countryCode']);
            $phone = $conn->real_escape_string($_POST['phone']);

            // Prepare and execute SQL statement to update the user information
            $sql = "UPDATE citizenreg SET 
                    firstname = '$firstName',
                    lastname = '$lastName',
                    permanentaddress = '$permanentAddress',
                    secondaryaddress = '$secondaryAddress',
                    city = '$city',
                    country = '$country',
                    registrationdate = '$registrationDate',
                    gender = '$gender',
                    countrycode = '$countryCode',
                    phone = '$phone'
                    WHERE email = '$email'";

            if ($conn->query($sql) === TRUE) {
                echo '<p id="successMessage" style="background-color: yellow; text-align: center; padding: 10px; font-size: 20px; font-weight: 600; color: green;">
                        Record updated successfully</p>';
                echo '<script>
                        setTimeout(function() {
                            var successMessage = document.getElementById("successMessage");
                            successMessage.style.display = "none";
                            setTimeout(function() {
                                window.location.href = "ctzMyProfile.php"; // Redirect after 2 seconds
                            }, 2000); // Redirect after 2000 milliseconds (2 seconds)
                        }, 2000); // Hide the message after 2000 milliseconds (2 seconds)
                      </script>';
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "All fields are required";
        }
    }

    // Close the database connection
    $conn->close();
} else {
    echo "User is not logged in.";
}
?>
<!-- Your HTML content continues here -->




<!--phpppppppppppppppppppppppppppppppppppppppppppppppppppppppppppp-->


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

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/style.css">

    <!-- Template Stylesheet -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>

<body>
    <!-- Add your HTML body content here -->
    <div class="container d-flex flex-column align-items-center">
        <div class="container d-flex flex-column align-items-center">
            <div class="d-flex">
                <h1 class="mb-5">User Profile Information</h1>
                <a href="ctzIndex.php"><i style="float: left; margin-left: 100px; margin-top: 20px" class="fa-solid fa-x fa-5"></i></a>
            </div>

            <?php if (!empty($image)) : ?>
                <img class="rounded-circle me-lg-2 zoomable-image" src="<?php echo $image; ?>" alt="User Image" style="width: 120px; height: 140px;" id="userImage">
            <?php endif; ?>
            <style>
                /* CSS for image zoom effect */
                .zoomable-image {
                    transition: transform 0.3s ease-in-out;
                }

            </style>
            <!-- JavaScript/jQuery Script for Image Hover Effect -->
            <script>
                $(document).ready(function() {
                    // Prevent zoom effect for touch devices
                    $('.zoomable-image').on('touchstart', function(e) {
                        e.preventDefault();
                    });
                });
            </script>

            <?php if (isset($firstName) && isset($lastName) && isset($email)) : ?>
                <span class="d-none d-lg-inline-flex mb-5">
                    <p style="font-size: 30px; font-weight: 600; "><?php echo $firstName . ' ' . $lastName; ?></p>
                </span>
            <?php endif; ?>
        </div>



        <form action="ctzMyProfile.php" method="post">
            <div class="d-flex flex-row mb-5">
                <div class="me-4">
                    <label for="firstName">First Name:</label> <br>
                    <input type="text" id="firstName" name="firstName" value="<?php echo isset($firstName) ? $firstName : ''; ?>" required pattern="[A-Za-z]+( [A-Za-z]+)?" title="Please enter letters only for the first name.">
                </div>
                <div class="me-4">
                    <label for="lastName">Last Name:</label> <br>
                    <input type="text" id="lastName" name="lastName" value="<?php echo isset($lastName) ? $lastName : ''; ?>" required pattern="[A-Za-z]+( [A-Za-z]+)?" title="Please enter letters only for the last name.">
                </div>
                <div class="me-4">
                    <label for="email">Email:</label> <br>
                    <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" pattern="^[^0-9][a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com|green\.com)$" title="Please enter a valid email address with domain as gmail.com, yahoo.com, or green.com and the first character not as a number." required>
                </div>
            </div>


            <div class="d-flex flex-row mb-5">
                <div class="me-4">
                    <label for="permanentAddress">Permanent Address:</label> <br>
                    <input type="text" id="permanentAddress" name="permanentAddress" value="<?php echo isset($permanentAddress) ? $permanentAddress : ''; ?>" required>
                </div>
                <div class="me-4">
                    <label for="secondaryAddress">Secondary Address:</label> <br>
                    <input type="text" id="secondaryAddress" name="secondaryAddress" value="<?php echo isset($secondaryAddress) ? $secondaryAddress : ''; ?>" required>
                </div>
                <div class="me-4">
                    <label for="city">NID:</label> <br>
                    <input type="text" id="city" name="city" value="<?php echo isset($city) ? $city : ''; ?>" pattern="[0-9]{10}" required>
                </div>
            </div>


            <div class="d-flex flex-row mb-5">
                <div class="me-4">
                    <label for="country">Country:</label> <br>
                    <input type="text" id="country" name="country" value="<?php echo isset($country) ? $country : ''; ?>">
                </div>

                <div class="me-4">
                    <label for="gender">Gender:</label> <br>
                    <input type="text" id="gender" name="gender" value="<?php echo isset($gender) ? $gender : ''; ?>">
                </div>

                <div class="me-4">
                    <label for="registrationDate">Registration Date:</label> <br>
                    <input type="text" id="registrationDate" name="registrationDate" value="<?php echo isset($registrationDate) ? $registrationDate : ''; ?>" readonly>
                </div>
            </div>


            <div class="d-flex flex-row mb-5 justify-content-center">
                <div class="me-4">
                    <label for="countryCode">Country Code:</label> <br>
                    <input type="text" id="countryCode" name="countryCode" value="<?php echo isset($countryCode) ? $countryCode : ''; ?>" readonly>
                </div>
                <div class="me-4">
                    <label for="phone">Phone:</label> <br>
                    <input type="text" id="phone" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>" required pattern="[0-9]{11}" title="Please enter a valid 11-digit phone number">
                </div>
                <!-- Image upload field -->
                <div>
                    <label for="profileImage">Profile Image:</label> <br>
                    <input type="file" id="profileImage" name="profileImage">
                </div>
            </div>

            <div class="d-flex flex-row mb-5 justify-content-center">
                <style>
                    .button {
                        background-color: lightgreen;
                        padding: 0px 10px 0px 10px;
                        font-weight: 600;
                        font-size: 20px;
                    }

                    .button:hover {
                        background-color: darkgreen;
                        color: #fff;
                    }
                </style>
                <input class="button" type="submit" value="Update">
            </div>
        </form>
    </div>

</body>

</html>