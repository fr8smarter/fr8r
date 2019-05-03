UPDATE assetMaster 
SET  
    assetCategory=:assetCategory,
    VIN=:VIN,
    currentValue=:currentValue,
    asset=:asset,
    modelYear=:modelYear,
    currentMiles=:miles,
    acquireDate=:acquireDate,
    assetStatus=:assetStatus,
    oilInterval=:oilInterval,
    engineOil=:engineOil,
    oilQty=:oilQty,
    transmissionFluid=:transmissionFluid,
    sparkPlug=:sparkPlug,
    oilFilter=:oilFilter,
    airFilter=:airFilter,
    keyBattery=:keyBattery,
    tireSize=:tireSize,
    notes=:notes

WHERE 
    assetID=:assetID