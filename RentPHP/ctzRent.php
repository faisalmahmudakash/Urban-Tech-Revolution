<?php
// Start the session
session_start();
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min2.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="rent.css">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="../ctzIndex.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Urban Tech</h3>
                </a>

                <div class="navbar-nav w-100">
                    <a href="../ctzIndex.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="sidebarCall" id="sidebarCall">

                        <!--?php include "../sidebarContent.php" ?-->

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Profile</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="../ebill/index.php" class="dropdown-item">Payment</a>
                                <a href="../index.php" class="dropdown-item">Log Out</a>
                            </div>
                        </div>
                        <a href="ctzRent.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Rent</a>
                        <a href="../SpectacularPlace/ctzRent.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Spectacular Place</a>
                        <a href="../shopping/login.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Shopping</a>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="">
                    <p class="pp">CITIZEN</p>
                    <style>
                        .pp {
                            color: goldenrod;
                            font-weight: 900;
                            font-size: 25px;
                            padding: 13px 0px 0px 10px;
                        }

                        .messateTxt {
                            color: black;
                        }
                    </style>
                </div>
                <div class="navbar-nav align-items-center ms-auto">
                    
                    <!--FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF-->
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

                    // Check if the user is logged in and the email is set in the session
                    if (isset($_SESSION['citizenEmail'])) {
                        $email = $_SESSION['citizenEmail'];

                        // Query to fetch user information based on email
                        $sql = "SELECT firstname, lastname, image FROM citizenreg WHERE email = '$email'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $userImage = $row['image'];
                            $userName = $row['firstname'];
                            $userLastName = $row['lastname'];
                        }
                    }
                    ?>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <?php if (isset($userImage)) : ?>
                                <img class="rounded-circle me-lg-2" src="../<?php echo $userImage; ?>" alt="" style="width: 40px; height: 40px;">
                            <?php else : ?>
                                <img class="rounded-circle me-lg-2" src="../img/default-img.jpg" alt="" style="width: 40px; height: 40px;">
                            <?php endif; ?>
                            <span class="d-none d-lg-inline-flex">
                                <?php
                                // marge first_Name and Last_Name (Allah map koro... r pari na);
                                if (isset($userName) && isset($userLastName)) {
                                    echo $userName . ' ' . $userLastName;
                                } elseif (isset($userName)) {
                                    echo $userName;
                                } else {
                                    echo '';
                                }
                                ?>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="../ctzMyProfile.php" class="dropdown-item">My Profile</a>
                            <a href="../index.php" class="dropdown-item" name="logout">Log Out</a>
                        </div>

                        <?php
                        if (isset($_POST["logout"])) {
                            session_destroy();
                            header("location: index.php");
                            exit();
                        }
                        ?>
                    </div>

                    <!--FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF (done after try 47 times :)-->


                </div>
            </nav>
            <!-- Navbar End -->
            <style>
                .formatting .h6 {
                    text-align: center;
                    margin: auto;
                }

                .formatting h6 {
                    padding-top: 93px;
                }
            </style>

            <!-- clender and vgtID Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-2">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4 formatting">
                                <h6 class="mb-0 logsubtxt h6">Rent Setting</h6>
                            </div>
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action">Search House</a>
                            </div>
                        </div>
                    </div>

                    <!--ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff--->
                    <div class="col-10">
                        <div class="h-100 bg-secondary rounded p-4">
                            <h1 class="text-center text-danger " style="font-family: 'Abril Fatface', cursive;"> Urban City</h1>

                            <div class="addFromjs" id="addForm">

                            </div>

                            <div class="row">
                                <!--update v=0.2--------------Start-->
                                <?php
                                $con = mysqli_connect('localhost', 'root', '', 'urbancityrevolution');

                                if (!$con) {
                                    echo "Connection failed: " . mysqli_connect_error();
                                }

                                $query = "SELECT houseId, name, image, date, time, amount FROM renthouse ORDER BY id DESC";
                                $queryfire = mysqli_query($con, $query);

                                if ($queryfire) {
                                    while ($product = mysqli_fetch_assoc($queryfire)) {
                                        $houseId = $product['houseId']; // Get the houseId

                                        // Query to check if the houseId exists in the rentalinfo table
                                        $checkQuery = "SELECT * FROM rentalinfo WHERE houseId = $houseId";
                                        $checkResult = mysqli_query($con, $checkQuery);
                                        $houseExists = mysqli_num_rows($checkResult) > 0;

                                        // Create a unique ID for each button using the houseId
                                        $buttonId = 'rentButton_' . $houseId;
                                ?>
                                        <div class="col-lg-3 col-md-3 col-sm-12 mt-4">
                                            <div class="card">
                                                <h6 class="card-title bg-info text-white p-2 text-uppercase"><?php echo $product['name']; ?></h6>
                                                <div class="card-body">
                                                    <img  src="<?php echo $product['image']; ?>" alt="house" class="img-fluid mb-2">
                                                    <h6 style="color: black">&#2547; <?php echo $product['amount']; ?></h6>
                                                    <h6 style="color: black"><?php echo $product['date']; ?></h6>
                                                    <h6 style="color: black">House ID: <?php echo $houseId; ?></h6>
                                                </div>
                                                <div class="btn-group d-flex mb-0">
                                                    <!-- Take Rent Button with unique ID -->
                                                    <button id="<?php echo $buttonId; ?>" class="btn <?php echo $houseExists ? 'btn-danger' : 'btn-success'; ?> flex-fill" <?php echo $houseExists ? 'disabled' : ''; ?>>
                                                        <?php echo $houseExists ? '<span style="color: white;">Not Available</span>' : 'Take Rent'; ?>
                                                    </button>
                                                    <script>
                                                        // JavaScript for the unique button ID
                                                        const rentButton_<?php echo $houseId; ?> = document.getElementById('<?php echo $buttonId; ?>');
                                                        rentButton_<?php echo $houseId; ?>.addEventListener('click', function() {
                                                            window.location.href = 'takeRent.php?id=<?php echo $houseId; ?>'; // Pass houseId as a parameter
                                                        });
                                                    </script>
                                                    <!-- Take Rent Button END -->

                                                    <button class="btn btn-warning flex-fill text-white">More Details</button>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "Error: " . $query . "<br>" . mysqli_error($con);
                                }

                                // Close the database connection
                                mysqli_close($con);
                                ?>

                                <!--update v=0.2--------------END-->


                            </div>

                        </div>
                        <!--ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff--->
                    </div>
                </div>
                <!-- Clender and vgtID End -->

                <!-- Footer Start -->
                <?php include "../footer.php"; ?>
                <!-- Footer End -->
            </div>
            <!-- Content End -->

            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div>


        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/chart/chart.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="../js/main.js"></script>
        <script src="../js/script.js"></script>
        <script src="rent.js"></script>
</body>

</html>