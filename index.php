<?php
require("connection.php");
?>
<?php
session_start();

// Check if the card has been created
if (isset($_SESSION['card_created']) && $_SESSION['card_created'] === true) {
    // Display the message
    echo '<script>window.onload = function() { alert("Card Created!"); }</script>';
    // Unset the session variable
    unset($_SESSION['card_created']);
}
?>

<!-- Your HTML code -->


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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.min2.css5" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Urban Tech</h3>
                </a>

                <!--get image-------------------------------------------- -->

                <!--get image---------------------------------------- END -->


                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <!--<div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Profile</a>
                        <div class="dropdown-menu bg-transparent border-0">
                           
                            <a href="#" class="dropdown-item">Payment</a>
                        </div>
                    </div>
                    <a href="#" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Rent</a>
                    <a href="#" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Spectacular Place</a>
                    <a href="#" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Shopping</a>
                    <a href="#" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Setting</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Others</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="#" class="dropdown-item">404 Error</a>
                            <a href="#" class="dropdown-item">Blank Page</a>
                        </div>
                    </div>-->

                    <div class="sidebarCall" id="sidebarCall">
                        <?php //include "sidebarContentPHP/sidebarContent.php"
                        ?>
                    </div>

                    <?php //include "sidebarContent.html" 
                    ?>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
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
                    <p class="pp">YOU ARE LOGOUT</p>
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
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-circle-user"></i>
                            <span class="d-none d-lg-inline-flex">Profile</span>
                        </a>
                    </div>
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">

                    <!--admin registration-->
                    <div class="col-sm-6 col-xl-3">
                        <a href="#" id="loadPage">
                            <div class="bg-secondary  rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-solid fa-user-gear fa-3x" style="color: #e6df0f;"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Admin</p>
                                    <h6 class="mb-0 logsubtxt">Registration</h6>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!--citizen registration-->
                    <div class="col-sm-6 col-xl-3">
                        <a href="" id="loadPage3">
                            <div class="bg-secondary d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-solid fa-users-gear fa-3x" style="color: #20cbc0;"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Citizen</p>
                                    <h6 class="mb-0 logsubtxt">Registration</h6>
                                </div>
                            </div>
                        </a>
                    </div>


                    <div class="col-sm-6 col-xl-3">
                        <a href="" id="loadPage2">
                            <div class="bg-secondary d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-solid fa-user-shield fa-3x" style="color: #bd51af;"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Admin Login</p>
                                    <h6 class="mb-0 logsubtxt">Log your Profile</h6>
                                </div>
                            </div>
                        </a>
                    </div>


                    <div class="col-sm-6 col-xl-3">
                        <a href="" id="loadPage4">
                            <div class="bg-secondary d-flex align-items-center justify-content-between p-4">
                                <!--<i class="fa fa-chart-pie fa-3x text-primary"></i>-->
                                <i class="fa fa-solid fa-users fa-3x" style="color: #20cbc0;"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Citizen Login</p>
                                    <h6 class="mb-0 logsubtxt">Log your Profile</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->

            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <h6 style="color:black">Registation From</h6>
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <!--<h6 class="mb-0 logsubtxt">Recent Salse</h6>-->
                        <div id="adminSing">
                            <?php //include 'adminSingUp.php' 
                            ?>
                        </div>

                        <!--code here-->
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->


            <!-- Rent Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-6">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0 logsubtxt">Calender</h6>
                                <a href="">Show All</a>
                            </div>
                            <div id="calender"></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0 logsubtxt">Urban Visitor</h6>
                            </div>
                            <style>
                                .close-icon {
                                    cursor: pointer;
                                    color: #333;
                                    /* Icon color */
                                    font-size: 18px;
                                    /* Icon size */
                                    margin-left: 5px;
                                    /* Adjust margin */
                                }
                            </style>


                            <!--GEt visitor ID---->
                            <div>
                                <div class="d-flex justify-content-center">
                                    <!-- Button to get visitor ID -->
                                    <button id="getVisitorIDBtn" onclick="getVisitorID()">Get Visitor ID</button>
                                </div>

                                <!-- Include a container to display visitorCard.php content -->
                                <div id="visitorCardContainer"></div>
                            </div>

                            <script>
                                function getVisitorID() {
                                    // Fetch visitorCard.php content and display it in the container
                                    fetch('visitorCard.php')
                                        .then(response => response.text())
                                        .then(data => {
                                            document.getElementById('visitorCardContainer').innerHTML = data;
                                            // Add a close icon when visitorCard.php content is displayed
                                            document.getElementById('visitorCardContainer').innerHTML += `<span class="close-icon" onclick="hideVisitorCard()">Close</span>`;
                                        })
                                        .catch(error => console.error('Error:', error));
                                }

                                function hideVisitorCard() {
                                    // Hide the visitorCard.php content
                                    document.getElementById('visitorCardContainer').innerHTML = '';
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Rent End -->

            <!-- Footer Start -->
            <?php include "footer.php"; ?>
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
    <script src="js/main.js"></script>
    <script src="js/script.js"></script>
</body>

</html>