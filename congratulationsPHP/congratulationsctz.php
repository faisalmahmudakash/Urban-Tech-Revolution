<?php
// Database connection details
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Urban Tech Revolution</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            width: 100%;
            height: 100%;

        }

        .contain {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, #189086, #2f8198);
            background-image: linear-gradient(to bottom right, #02b3e4, #02ccba);
        }

        .contain h1 {
            font-family: 'Julius Sans One', sans-serif;
            font-size: 1.4em;
            color: #02b3e4;
        }

        .congrats {
            position: relative;
            left: 50%;
            top: 50%;
            max-width: 800px;
            transform: translate(-50%, -50%);
            width: 80%;
            min-height: 300px;
            max-height: 900px;
            border: 2px solid white;
            border-radius: 5px;
            box-shadow: 12px 15px 20px 0 rgba(46, 61, 73, .3);
            background-image: linear-gradient(to bottom right, #02b3e4, #02ccba);
            background: #fff;
            text-align: center;
            font-size: 2em;
            color: #189086;
        }

        .text {
            position: relative;
            font-weight: normal;
            left: 0;
            right: 0;
            margin: auto;
            width: 80%;
            max-width: 800px;

            font-family: 'Lato', sans-serif;
            font-size: 0.6em;

        }


        .circ {
            opacity: 0;
            stroke-dasharray: 130;
            stroke-dashoffset: 130;
            -webkit-transition: all 1s;
            -moz-transition: all 1s;
            -ms-transition: all 1s;
            -o-transition: all 1s;
            transition: all 1s;
        }

        .tick {
            stroke-dasharray: 50;
            stroke-dashoffset: 50;
            -webkit-transition: stroke-dashoffset 1s 0.5s ease-out;
            -moz-transition: stroke-dashoffset 1s 0.5s ease-out;
            -ms-transition: stroke-dashoffset 1s 0.5s ease-out;
            -o-transition: stroke-dashoffset 1s 0.5s ease-out;
            transition: stroke-dashoffset 1s 0.5s ease-out;
        }

        .drawn svg .path {
            opacity: 1;
            stroke-dashoffset: 0;
        }

        .regards {
            font-size: .7em;
        }

        .goBack{
            list-style-type: none;
            text-decoration: none;
            border: 1px solid green;
            background-color: rgb(176, 211, 176);
            color: black;
            padding: 0px 10px;
        }

        .goBack:hover{
            border: 1px solid greenyellow;
            background-color: rgb(21, 143, 21);
        }


        @media (max-width:600px) {
            .congrats h1 {
                font-size: 1.2em;
            }

            .text {
                font-size: 0.5em;
            }

            .regards {
                font-size: 0.6em;
            }
        }

        @media (max-width:500px) {
            .congrats h1 {
                font-size: 1em;
            }

        }

        @media (max-width:410px) {
            .congrats h1 {
                font-size: 1em;
            }

            .congrats .hide {
                display: none;
            }

            .congrats {
                width: 100%;
            }

            .regards {
                font-size: 0.55em;
            }
        }
    </style>
</head>

<body>
    <!-- Congratulations area start -->
<?php
// Fetching data from the database
$sql = "SELECT firstname, lastname, country, registrationdate FROM citizenreg";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Merge firstname and lastname
        $name = $row["firstname"] . " " . $row["lastname"];
        $country = $row["country"];
        // Assuming registrationdate is in 'Y-m-d H:i:s' format, converting it to 'h:i A' format
        $time = date("h:i A", strtotime($row["registrationdate"]));

        // Displaying the data in the provided HTML structure
        echo '<div class="contain">
            <div class="congrats">
                <h1>Congratulations !</h1>
                <p ><i class="fa-solid fa-circle-check fa-2xl" style="color: #63e6be;"></i></p>
                <div class="text">
                    <p>"' . $name . '" are successfully registered as a Citizen. <br>' .
                    'Country: ' . $country . '<br>' . // Corrected concatenation operator here
                    //'Time: ' . date("h:i:s A", strtotime($row["registrationdate"])) . '<br>' . // Displaying time including minutes and seconds
                    'Date: ' . date("Y-m-d", strtotime($row["registrationdate"])) . '<br></p>' . // Displaying date
                    '</p>
                </div>

                <div>
                    <a class="goBack" href="../index.php">OK</a>
                </div>

                <p class="regards">Regards, Urban Tech Revolution</p>
            </div>
        </div>';
    }
} else {
    echo "No records found";
}

// Close the database connection
$conn->close();

?>

    <!-- Congratulations area end -->
</body>

</html>