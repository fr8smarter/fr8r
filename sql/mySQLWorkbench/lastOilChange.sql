SELECT *
FROM maintRecords
JOIN 
	assetMaster
ON (maintRecords.assetID = assetMaster.assetID)

JOIN
    vendors
ON 
    (maintRecords.vendorID = vendors.vendorID)

WHERE 
    assetMaster.assetID=2

AND

serviceDesc

LIKE 'oil change'

ORDER BY 
miles
DESC