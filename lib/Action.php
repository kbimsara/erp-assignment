<?php
require_once './idGeneratorUser.php';
require_once '../config.php';

// delete data from database
if (isset($_GET['del'])) {

    $id = $_GET["del"];

    // echo "<script>alert(" . $id . ");</script>";

    $sql = "DELETE FROM `customers` WHERE `customers`.`id` = '$id';";
    $result = mysqli_query($Connector, $sql);

    echo "
                <script>
                Swal.fire(
                    'Deleted!',
                    'User Deleted Successfully.',
                    'success'
                );
                </script>
            ";
    header('location: ../index.php');
}
