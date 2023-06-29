<?php
header('Content-Type: text/html; charset=utf-8');

function OpenConnection()
    {
        $serverName = "LAPTOP-4E0TA2GU";
       $connectionOptions = array(
    "Database" => "ClothingStoreDB",
    "CharacterSet" => "UTF-8"
);

        $conn = sqlsrv_connect($serverName, $connectionOptions);
        
        if($conn == false)
            die(FormatErrors(sqlsrv_errors()));

        return $conn;}
      
        $conn = OpenConnection(); ?>