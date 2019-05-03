SELECT *
FROM maintRecords
JOIN 
	assetMaster
ON (maintRecords.assetID = assetMaster.assetID)

WHERE 
    asset 

LIKE 
    :term 
and 
    maintRecords.userID = :user

ORDER BY assetMaster.assetID DESC, maintRecords.miles DESC