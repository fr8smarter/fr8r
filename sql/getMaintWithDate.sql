UPDATE
    maintRecords
SET
    monthsAgo = TIMESTAMPDIFF(MONTH,NOW(),servicedate)

SELECT *
FROM maintRecords
JOIN 
	assetMaster
ON (maintRecords.assetID = assetMaster.assetID)

JOIN     
    maintCategory
ON	(maintRecords.maintCategory = maintCategory.categoryID)  

JOIN    
    systems
ON 
    (maintRecords.vehicleSystem = systems.systemID)    

JOIN
    vendors
ON 
    (maintRecords.vendorID = vendors.vendorID)

WHERE assetMaster.userID LIKE :userID 
    AND
    monthsAgo <= 6
    
