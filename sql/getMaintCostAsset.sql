SELECT
	assetMaster.asset,
	assetMaster.assetID,
	sum(cost)
FROM 
	maintRecords                  
JOIN 
    assetMaster
on 
	maintRecords.assetId = assetMaster.assetID
WHERE 
    asset
LIKE 
    :term 
and 
    assetMaster.userID = :user
group by 
	assetMaster.assetID
