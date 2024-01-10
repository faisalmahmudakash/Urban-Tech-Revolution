<?php
// Start the session
session_start();

// Establish a connection to MySQL database
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "urbancityrevolution"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $houseId = $_POST['houseId'];
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Image upload handling
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/"; // Directory where images will be stored
        $targetFile = $targetDir . basename($_FILES['image']['name']);

        // Move uploaded file to the specified directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // Image successfully uploaded, now insert into the database
            $image = $targetFile; // Save image path to the database

            // SQL query to insert data into the renthouse table
            $sql = "INSERT INTO renthouse (houseId, name, image, date, time, amount) 
                    VALUES ('$houseId', '$name', '$image', '$date', '$time',  '$amount')";

            if ($conn->query($sql) === TRUE) {
                header("Location: rent.php"); //------------------------------------------------------next terget change the location into Added done page;
            } else {
                echo '<div style="text-align: center; padding-top: 20px; color: red; font-size: 20px;">Error: ' . $conn->error . '</div>';
            }
        } else {
            // Handle image upload error
            echo "Error uploading image.";
        }
    } else {
        // Handle image upload error
        echo "Error uploading image.";
    }
}

// Close the database connection
$conn->close();
?>

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
    <link href="../css/bootstrap2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/style.css">

    <!-- Template Stylesheet -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="container mt-4">
        <style>
            .addHouse {
                color: black;
                text-align: center;
                font-size: 20px;
                padding: 9px 0px 0px 0px;

                margin-left: 74px;
                margin-bottom: 20px;
                text-align: end;
                width: 50%;
                /* You can adjust the width as needed */
            }

            .addHouseinto {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
        </style>
        <div class="addHouseinto">
            <h1 class="mb-4 addHouse">Add House Rental</h1>
            <a href="rent.php"><i class="fa fa-xmark fa-2x"></i></a>
        </div>


        <?php
        function generateHouseId()
        {
            $filename = 'last_house_id.txt'; // File to store the last house ID

            // Get the last house ID from the file if it exists, otherwise set a default value of 100
            $lastHouseId = file_exists($filename) ? intval(file_get_contents($filename)) : 100;

            // Increment the house ID for the next usage by 1
            $nextHouseId = $lastHouseId + 1;

            // Save the updated house ID to the file for future use
            file_put_contents($filename, $nextHouseId);

            return sprintf('%03d', $lastHouseId); // Return the last house ID (without incrementing)
        }
        ?>


        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6">
                    <div class="mb-3 a1">
                        <label for="houseId" class="form-label">House ID</label>
                        <input type="text" class="form-control" id="houseId" name="houseId" value="<?php echo generateHouseId(); ?>" readonly required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount" required>
                    </div>
                </div>

                <div class="col-6">
                    <?php
                    date_default_timezone_set('Asia/Dhaka'); // Set the time zone to Asia/Dhaka (Bangladesh Standard Time)
                    $currentDate = date('Y-m-d'); // Get the current date in YYYY-MM-DD format for Dhaka timezone
                    ?>

                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="text" class="form-control" id="date" name="date" value="<?php echo $currentDate; ?>" readonly>
                    </div>

                    <!--<div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="text" class="form-control" id="date" name="date" required>
                    </div>-->
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="time" class="form-label">Time</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        <div id="imageHelp" class="form-text">Please select an image file (jpg, jpeg, png, gif).</div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mb-1">Submit</button>
            </div>
        </form>
    </div>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
    <script src="../js/script.js"></script>
    <script src="rent.php"></script>
</body>

</html>