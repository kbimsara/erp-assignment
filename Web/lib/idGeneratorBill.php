<?php
class IdGenerator
{
    // Function to generate a random item ID
    function billNoGen()
    {
        // Generate a random 10-digit padded number prefixed with 'itm'
        $id = str_pad(rand(0, 9999999999), 7, '0', STR_PAD_LEFT);
        return $id;
    }

    // Function to check if the generated ID already exists in the database
    function checkItemId($billNo )
    {
        require './config.php'; // Make sure this file defines $Connector correctly

        // Fixed: removed extra space in column name 'itemCode'
        $query_check = "SELECT * FROM `bill` WHERE `billNo` = '$billNo ' LIMIT 1";
        $query_check_run = mysqli_query($Connector, $query_check);

        if (!$query_check_run) {
            // Optional: handle SQL error
            die("Database query failed: " . mysqli_error($Connector));
        }

        // Return true if ID not found (unique), false if exists
        return (mysqli_num_rows($query_check_run) < 1);
    }

    // Function to repeatedly generate until a unique ID is found
    function generateUniqueItemId()
    {
        do {
            $newId = $this->billNoGen();
        } while (!$this->checkItemId($newId));

        return $newId;
    }
}
?>
