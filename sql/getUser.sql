SELECT *
FROM users

JOIN
statesUS
ON
(users.stateID = statesUS.stateID)

JOIN 
countryCodes
ON
(users.countryID = countryCodes.countryID)

WHERE userID = :userID