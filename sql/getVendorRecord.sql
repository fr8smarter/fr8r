SELECT *
FROM vendors

JOIN
    statesUS
ON
(vendors.vendorStateID = statesUS.stateID)

JOIN 
    countryCodes
ON
(vendors.countryID = countryCodes.countryID)
WHERE 
    vendorID 
LIKE 
    :vendorID 