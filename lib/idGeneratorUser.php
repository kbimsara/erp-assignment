<?php
class IdGenerator
{
    // Function to generate a random user ID
    function userGen()
    {
        // Use string concatenation (.)
        // and pad random number to ensure consistent length
        $id = 'cst' . str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);
        return $id;
    }

    // Function to check if the generated ID already exists in the database
    function checkUserId($userId)
    {
        require './config.php'; // make sure this file defines $Connector correctly

        $query_check = "SELECT * FROM `customers` WHERE `id` = '$userId' LIMIT 1";
        $query_check_run = mysqli_query($Connector, $query_check);

        if (!$query_check_run) {
            // optional: handle SQL error
            die("Database query failed: " . mysqli_error($Connector));
        }

        // return true if ID not found (unique), false if exists
        return (mysqli_num_rows($query_check_run) < 1);
    }

    // Function to repeatedly generate until a unique ID is found
    function generateUniqueUserId()
    {
        do {
            $newId = $this->userGen();
        } while (!$this->checkUserId($newId));

        return $newId;
    }
}
