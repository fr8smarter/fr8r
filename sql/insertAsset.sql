INSERT INTO assetMaster (
    userID, 
    assetCategory, 
    VIN, 
    currentValue, 
    asset,
    modelYear,
    currentMiles,
    acquireDate,
    assetStatus,
    oilInterval,
    engineOil, 
    oilQty,
    transmissionFluid,
    sparkPlug,
    oilFilter,
    airFilter,
    keyBattery,
    tireSize,
    notes
    )
VALUES(    
    :userID, 
    :assetCategory,
    :VIN, 
    :currentValue,
    :asset,
    :modelYear,
    :miles,
    :acquireDate,
    :assetStatus,
    :oilInterval,
    :engineOil, 
    :oilQty,
    :transmissionFluid,
    :sparkPlug,
    :oilFilter,
    :airFilter,
    :keyBattery,
    :tireSize,
    :notes
    )
