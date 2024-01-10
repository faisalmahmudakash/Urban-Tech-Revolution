<!DOCTYPE html>
<html>

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

    <!-- Template Stylesheet -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <style>
            .editHouse {
                color: black;
                text-align: center;
                font-size: 20px;
                /*margin: -48px;*/
                padding: 9px 0px 0px 0px;
            }

            .customAlign {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
        </style>
        <div class="d-flex flex-column align-items-center mb-5 customAlign">
            <div>
                <h2 class="editHouse" style="color: black"><a href="rent.php"><i class="fa fa-light fa-circle-left pe-4" style="color: #4b525d;"></i>
                    </a> Search and Update House</h2>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="houseId">Enter House ID:</label>
                <input type="text" id="houseId" name="houseId" required>
                <button type="submit" name="search">Search</button>
            </form>
        </div>
    </div>

    <?php
    // Establish connection to your database
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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
        $houseId = $_POST['houseId'];

        // Prepare SQL statement to fetch data based on houseId
        $sql = "SELECT * FROM renthouse WHERE houseId = '$houseId'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                // Displaying the data in an HTML form for updating
                echo '
                <!DOCTYPE html>
                <html>
                    <head>
                        <!-- Customized Bootstrap Stylesheet -->
                        <link href="../css/bootstrap.min.css" rel="stylesheet">
                        <link href="../css/style.css" rel="stylesheet">
                        
                    </head>
                    <body>
                        <div class="container">
                            <form action="editForm.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="houseId" class="form-label">House ID</label>
                                            <input type="text" class="form-control" name="houseId" value="' . $row['houseId'] . '" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="' . $row['name'] . '" required>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Amount</label>
                                            <input type="text" class="form-control" id="amount" name="amount" value="' . $row['amount'] . '" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="date" class="form-label">Date</label>
                                            <input type="date" class="form-control" id="date" name="date" value="' . $row['date'] . '" required readonly>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="time" class="form-label">Time</label>
                                            <input type="time" class="form-control" id="time" name="time" value="' . $row['time'] . '" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Upload Image</label>
                                            <input type="file" class="form-control" id="image" name="image" value="" accept="image/*">
                                            <div id="imageHelp" class="form-text">Please select an image file (jpg, jpeg, png, gif).</div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary mb-5" name="update">Submit</button>
                                </div>
                            </form>
                        </div>
                    </body>
                </html>';
            }
        } else {
            echo '<div style="text-align: center; margin-top: 20px; font-size: 18px; color: red;">No results found for the entered House ID.</div>';
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
        $houseId = $_POST['houseId'];
        $name = $_POST['name'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $amount = $_POST['amount'];

        // Check if an image file was uploaded
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
            $targetDirectory = "uploads/"; // Directory where the image will be stored
            $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Attempt to move the uploaded image file to the target directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                // If the upload was successful, update the database with the image file name
                $sql = "UPDATE renthouse SET name='$name', image='$targetFile', date='$date', time='$time', amount='$amount' WHERE houseId='$houseId'";
                if ($conn->query($sql) === TRUE) {
                    echo '<div style="text-align: center; margin-top: 20px; font-size: 18px; color: Green;">Record updated successfully.</div>';
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            // If no image file was uploaded, update other fields in the database without the image
            $sql = "UPDATE renthouse SET name='$name', date='$date', time='$time', amount='$amount' WHERE houseId='$houseId'";
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    }


    $conn->close();
    ?>



    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
    <script src="../js/script.js"></script>
    <script src="rent.php"></script>
</body>

</html>