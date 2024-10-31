<?php
/*Cienna Gin-Naccarato
* Student ID: 260965061
*/
echo "hello";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "here";
   //retrieve data from form 
   $fname = htmlspecialchars($_POST['fname']);
   $lname = htmlspecialchars($_POST['lname']);
   $email = htmlspecialchars($_POST['email']);
   $phone = htmlspecialchars($_POST['phone']);
   $book = htmlspecialchars($_POST['books']);
   $os = htmlspecialchars($_POST['os']);


    //add data to csv form
    $csv_file = __DIR__ . '/mini5.csv';
    if(!file_exists($csv_file)){
        echo "making file";

        //create new file and add headers
        $f = fopen($csv_file, 'w');
        $header= "First Name, Last Name, Email, Phone, Book, OS\n";
        fwrite($f, $header);
        fclose($f)
       
    }
    //otherwise open in append mode 
    $f = open($csv_file, 'a');
   
    //create array of things to add and append to csv file 
    $csv_row = array($fname, $lname, $email, $phone, $book, $os);
    fputcsv($f, $csv_row);
    $csv_to_write = array_map('str_getcsv', file($csv_file));

    fclose($f);
    echo "data has been successfully added to the csv file";
    
    // render csv records and overwrite initial form 
    echo "<!DOCTYPE html>
    <html>
        <style>
            tr:nth-child(even) {
                background-color: #e2dfdf;
            }
        </style>

        <body>
            <h1> CSV Form Submission Records <h1>
            <table>";
    
    // table rows 
    foreach ($csv_to_write as $row){
        echo "<tr>";
        foreach($row as $field){
            echo "<td> . htmlspecialchars($field) . </td>";
        }
        echo "</tr>";
    }

    echo "</table> <br>
            <a href='mini5.html'>Submit another record here.</a>
        </body>
    </html>";
}

?>
