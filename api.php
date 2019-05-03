<?php

include('includes/config.php');

// gather any general parameters
if(isset($_POST['action'])) {
    $action = $_POST['action'];
}
else {
    $action = "";
}

if(isset($_POST['apiKey'])) {
    $apiKey = $_POST['apiKey'];
}
else {
    $apiKey = "";
}

if($apiKey != 123) {
    $results = array(
        'error' => array(
            'errorCode' => 1,
            'errorMsg' => 'Sorry, you do NOT have permissions'
        )
    );
    //echo "<pre>"; print_r($results); echo "</pre>"; 
    echo json_encode($results);

    die();
}

// once the password is verified

switch($action) {
    case 'getAssets':
        $sql = file_get_contents ('sql/APIgetAllAssets.sql') ;
        $params = array();
        $statement = $database->prepare($sql);
        $statement->execute();
        
        $assets = $statement->fetchAll(PDO::FETCH_ASSOC);
        $results = $assets;
        break;
    case 'getBook':
        if(isset($_POST['isbn'])) {
            $isbn = $_POST['isbn'];
            
            $sql = "SELECT * FROM books where isbn = :isbn";
            $params = array(
                'isbn' => $isbn
            );
            $statement = $database->prepare($sql);
            $statement->execute($params);

            $books = $statement->fetchAll(PDO::FETCH_ASSOC);
            $results = $books[0];
        }
        else {
            $results = array(
                'error' => array(
                    'errorCode' => 2,
                    'errorMsg' => 'Sorry, you do NOT provide a valid VIN'
                )
            );
        }
        
        break;
    default: 
        $results = array(
            'error' => array(
                'errorCode' => 3,
                'errorMsg' => 'Sorry, you do NOT have a valid action'
            )
        );
        break;
}

//echo "<pre>"; print_r($results); echo "</pre>"; 
echo json_encode($results); 
