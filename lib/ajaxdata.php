<?php
require_once '../config.php'; 

if (isset($_POST['Catagory_name'])) {
    $ct = $_POST['Catagory_name'];
    $query = "SELECT * FROM `category` WHERE `category`='$ct';";
    $query_run_search = mysqli_query($Connector, $query);

    if (mysqli_num_rows($query_run_search) > 0) {

        echo '<option value="">Choose...</option>';
        while ($row = mysqli_fetch_array($query_run_search)) {
            echo '<option value=' . $row['idCt'] . '>' . $row['categorySub'] . '</option>';
        }
    } else {
        echo '<option value="">No Data</option>';
    }
}