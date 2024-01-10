<?php
$conn = mysqli_connect("localhost", "root", "", "urbancityrevolution");

if (mysqli_connect_error()) {
    echo "Connection failed: " . mysqli_connect_error();
}
?>