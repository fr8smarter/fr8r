UPDATE vendors
SET  
    vendorName = :vendorName,
    vendorContact = :vendorContact, 
    email = :email, 
    website = :website,
    phone = :phone, 
    address1 = :address1, 
    address2 = :address2, 
    vendorCity = :vendorCity,
    vendorStateID = :vendorStateID, 
    zip = :zip, 
    countryID = :countryID, 
    vendorNotes = :vendorNotes
WHERE 
    vendorID=:vendorID