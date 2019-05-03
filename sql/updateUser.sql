UPDATE users
SET  
    userID = :userID,
    fName = :fName,
    lName = :lName,
    email = :email,
    phone = :phone,
    address1 = address1,
    address2 = :address2,
    city = :city,
    stateID = :stateID,
    zip = :zip,
    countryID = :countryID
WHERE 
    userID=:userID