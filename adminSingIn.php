<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.min2.css5" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css?v=1" rel="stylesheet">
    <link href="css/adminSingUp.css?v=1" rel="stylesheet">
</head>

<body>

    <div class="container mt-3">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="row jumbotron box8">
                <div class="col-sm-12 mx-t3 mb-4">
                    <h2 class="text-center text-info">Admin Login</h2>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email." required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="pass">Password</label>
                    <input type="password" name="password" class="form-control" id="pass" placeholder="Enter your password." required>
                </div>

                <style>
                    .login_button {
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                    }
                </style>

                <div class="col-sm-12 form-group mb-0 login_button">
                        <!--Hassing password retrive-->
                        <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

                        $email = $_POST['email'];
                        $enteredPassword = $_POST['password'];

                        // Fetch the hashed password associated with the provided email
                        $sql_fetch_password = "SELECT password FROM adminreg WHERE email = '$email'";
                        $result_password = $conn->query($sql_fetch_password);

                        if ($result_password->num_rows > 0) {
                            $row = $result_password->fetch_assoc();
                            $hashedPasswordFromDB = $row['password'];

                            // Verify the entered password with the hashed password from the database-----------------------------------------hashed
                            if (password_verify($enteredPassword, $hashedPasswordFromDB)) {
                                session_start();
                                $_SESSION['adminEmail'] = $email;

                                // Fetch the firstname associated with the provided email
                                $sql_fetch_firstname = "SELECT firstname FROM adminreg WHERE email = '$email'";
                                $result_firstname = $conn->query($sql_fetch_firstname);

                                if ($result_firstname->num_rows > 0) {
                                    $row = $result_firstname->fetch_assoc();
                                    $_SESSION['username'] = $row['firstname'];
                                }

                                // Set the image session here (Replace 'image_column_name' with the actual column name storing the image path)
                                $_SESSION['image'] = $_POST['image'];

                                header("Location: admIndex.php"); // Redirect to the appropriate URL
                                exit(); // Ensure that further code execution stops after the redirect
                            } else {
                                echo '<p class="text-danger">Invalid email or password</p>';
                            }
                        } else {
                            echo '<p class="text-danger">Invalid email or password</p>';
                        }

                        // Close the database connection
                        $conn->close();
                    }
                    ?>
                    <button type="submit" class="btn btn-primary float-right mt-4" id="submitButton">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="js/script.js"></script>
</body>

</html>