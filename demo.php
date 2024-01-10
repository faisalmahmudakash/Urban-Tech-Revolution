<html>

<head>
    <link href="../css/bootstrap2.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #idCard {
            width: 600px;
            /*height: 350px;*/
            border: 1px solid #ccc;
            margin: 20px auto;
            padding: 20px;
            box-sizing: border-box;
        }

        #industryName {
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        #userInfo {
            display: flex;
            align-items: center;
        }

        #userPicture {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-right: 20px;
        }

        #userData {
            flex: 1;
        }

        #userData p {
            margin: 5px 0;
        }

        .mb {
            margin-bottom: -15px;
        }
    </style>
</head>

<body>

    <div><!--from ctzRent, it redirect what page I was need--0000000000000000000000000000000000000000000000000000-->
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

                // Create a unique ID for each button using the houseId
                $buttonId = 'rentButton_' . $houseId;
        ?>
                <div class="col-lg-3 col-md-3 col-sm-12 mt-4">
                    <div class="card">
                        <h6 class="card-title bg-info text-white p-2 text-uppercase"><?php echo $product['name']; ?></h6>
                        <div class="card-body">
                            <img src="<?php echo $product['image']; ?>" alt="house" class="img-fluid mb-2">
                            <h6 style="color: black">&#2547; <?php echo $product['amount']; ?></h6>
                            <h6 style="color: black"><?php echo $product['date']; ?></h6>
                            <h6 style="color: black">House ID: <?php echo $houseId; ?></h6>
                        </div>
                        <div class="btn-group d-flex mb-0">
                            <!-- Take Rent Button with unique ID -->
                            <button id="<?php echo $buttonId; ?>" class="btn btn-success flex-fill">Take Rent</button>
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
    </div>


    <script src="../js/main.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>