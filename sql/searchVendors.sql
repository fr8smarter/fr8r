SELECT *
FROM vendors

JOIN
statesUS
on
(vendors.vendorStateID = statesUS.stateID)

JOIN 
countryCodes
on
(vendors.countryID = countryCodes.countryID)

WHERE vendorName LIKE :term