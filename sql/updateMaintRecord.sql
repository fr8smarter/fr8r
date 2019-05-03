UPDATE maintRecords 
SET  
    serviceDate=:serviceDate,
    serviceDesc=:serviceDesc,
    vehicleSystem=:vehicleSystem,
    miles=:miles,
    cost=:cost,
    vendorID=:vendorID,
    maintCategory=:maintCategory,
    maintNotes =:maintNotes
WHERE 
    trxID=:trxID