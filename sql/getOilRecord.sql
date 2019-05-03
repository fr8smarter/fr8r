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
    assetMaster.assetID = :assetID

AND

serviceDesc

LIKE 'oil change'

ORDER BY 
miles
DESC