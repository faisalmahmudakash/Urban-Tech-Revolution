<?php
        // Check if the houseId is set in the URL
        if (isset($_GET['id'])) {
            // Retrieve the houseId from the URL
            $houseId = $_GET['id'];

            // Perform the deletion query
            // Assuming you have a database connection established
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

            // SQL query to delete a record based on houseId
            $sql = "DELETE FROM rentalinfo WHERE houseId = '$houseId'";

            if ($conn->query($sql) === TRUE) {
                echo "Record deleted successfully";
                header('Location: rent.php');
            } else {
                echo "Error deleting record: " . $conn->error;
            }

            $conn->close();
        } else {
            echo "Invalid request";
        }
        ?>