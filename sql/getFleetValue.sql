SELECT sum(currentValue)
FROM 
assetMaster
WHERE
userID=:userID

AND
assetStatus = 1

AND
asset LIKE :term