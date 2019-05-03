<?php

class User  {
    protected $database;
    protected $userID;
    protected $fName;
    protected $lName;
    protected $email;
    protected $phone;
    protected $address1;
    protected $address2;
    protected $city;
    protected $state;
    protected $stateID;
    protected $zip;
    protected $countryID;
    protected $country;
    protected $MCnumber;
   

    

    function __construct($database, $userID) {

        //get user from DB
        $sql = file_get_contents('sql/getUser.sql');
        $params = array(
            'userID' => $userID
        );
        $statement = $database->prepare($sql);
        $statement -> execute($params);
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        $user = $users[0];


        $this->userID = $user['userID'] ;
        $this->fName = $user['fName'];
        $this->lName = $user['lName'] ;
        $this->email = $user['email'] ;
        $this->phone = $user['phone'] ;
        $this->address1 = $user['address1'] ;
        $this->address2 = $user['address2'] ;
        $this->city = $user['city'] ;
        $this->stateID = $user['stateID'] ;
        $this->state = $user['stateCase'] ;
        $this->zip = $user['zip'] ;
        $this->countryID = $user['countryID'] ;
        $this->country = $user['countryName'] ;
        $this->MCnumber = $user['MCnumber'] ;

    }
         

    
    function get_fName() {
        return $this->fName;
    }

    function get_userID() {
        return $this->userID;
    }
      
    function get_lName() {
        return $this->lName;
    }
    function get_email() {
        return $this->email;
    }

    function get_phone() {
        return $this->phone;
    }

    function get_address1() {
        return $this->address1;
    }

    function get_address2() {
        return $this->address2;
    }
    function get_city() {
        return $this->city;
    }


    function get_stateID() {
        return $this->stateID;
    }

    function get_state() {
        return $this->state;
    }

    function get_zip() {
        return $this->zip;
    }

    function get_countryID() {
        return $this->countryID;
    }
    

    function get_country() {
        return $this->country;
    }
    
    function get_MCnumber() {
        return $this->MCnumber;
    }
    

}

?>
