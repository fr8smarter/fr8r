SELECT *
FROM assetMaster
WHERE asset LIKE :term
and
userID = :userID