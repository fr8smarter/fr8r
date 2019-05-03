<?php
//Memory usage override
ini_set('memory_limit', '-1');

// get HELPER FUNCTION
function get($key) { 
	if(isset($_GET[$key]))
		return $_GET[$key];
	else return '';
}

function fleetValue($userID, $term, $database) {
	$term = '%'. $term . '%';
	$sql = file_get_contents('sql/getFleetValue.sql');
	$params = array(
		'term' => $term,
		'userID' => $userID
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$fleetValue = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $fleetValue;

}

function getAllAssets($userID, $database) {
	// Get list of all assets for user

	$sql = file_get_contents('sql/getAllAssets.sql');
	$params = array(
		'userID' => $userID
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$assets = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $assets;
}

function searchAssets($userID, $term, $database) {
	// Get list of assets
	$term = '%'. $term . '%';
	$sql = file_get_contents('sql/getAssets.sql');
	$params = array(
		'term' => $term,
		'userID' => $userID
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$assets = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $assets;
}

function searchAsset($assetID, $database) {
	// Get asset
	$sql = file_get_contents('sql/getAsset.sql');
	$params = array(
		'assetID' => $assetID
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$assets = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $assets;
}

function searchUser($userID, $database) {
	// Get user
	$sql = file_get_contents('sql/getUser.sql');
	$params = array(
		'userID' => $userID
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$users = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $users;
}

function verifyUserEmail($email, $database) {
	// Get user
	$sql = file_get_contents('sql/verifyUserEmail.sql');
	$params = array(
		'email' => $email
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$users = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $users;
}

function insertAsset($database, $userID, $assetName, $modelYear, $miles, $acquireDate,  $assetCategory, $assetStatus,
$oilInterval, $engineOil, $oilQty, $currentValue, $transmissionFluid, $sparkPlug, $oilFilter,
$airFilter, $VIN, $keyBattery, $tireSize, $notes){
	// add asset
	$sql = file_get_contents('sql/insertAsset.sql');
		$params = array(
			'userID' => $userID,
			'asset' => $assetName,
			'modelYear' => $modelYear,
			'miles' => milesFormat($miles),
			'acquireDate' => $acquireDate,
			'assetCategory' => $assetCategory,
			'assetStatus' => $assetStatus,
			'oilInterval' => oilIntervalFormat($oilInterval),
			'engineOil' => $engineOil,
			'oilQty' => $oilQty,
			'currentValue' => currentValueFormat($currentValue),
			'transmissionFluid' => $transmissionFluid,
			'sparkPlug' => $sparkPlug,
			'oilFilter' => $oilFilter,
			'airFilter' => $airFilter,
			'VIN' => $VIN,
			'keyBattery' => $keyBattery,
			'tireSize' => $tireSize,
			'notes' => $notes,
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
}

function getAssetCategories ($database) {
	// Get categories
	$sql = file_get_contents('sql/getAssetCategories.sql');
	$params = array();
	$statement = $database->prepare($sql);
	$statement->execute();
	$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $categories;
}

function getAssetStatuses($database) {
	$sql = file_get_contents('sql/getAssetStatuses.sql');
	$params = array();
	$statement = $database->prepare($sql);
	$statement->execute();
	$statuses = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $statuses;
}

function updateAsset ($database, $assetID, $assetName, $modelYear, $miles, $acquireDate,  $assetCategory, $assetStatus,
$oilInterval, $engineOil, $oilQty, $currentValue, $transmissionFluid, $sparkPlug, $oilFilter,
$airFilter, $VIN, $keyBattery, $tireSize, $notes) {
	// Update asset data
	$sql = file_get_contents('sql/updateAsset.sql');
		$params = array(
			'assetID' => $assetID,
			'asset' => $assetName,
			'modelYear' => $modelYear,
			'miles' => milesFormat($miles),
			'acquireDate' => $acquireDate,
			'assetCategory' => $assetCategory,
			'assetStatus' => $assetStatus,
			'oilInterval' => oilIntervalFormat($oilInterval),
			'engineOil' => $engineOil,
			'oilQty' => $oilQty,
			'currentValue' => currentValueFormat($currentValue),
			'transmissionFluid' => $transmissionFluid,
			'sparkPlug' => $sparkPlug,
			'oilFilter' => $oilFilter,
			'airFilter' => $airFilter,
			'VIN' => $VIN,
			'keyBattery' => $keyBattery,
			'tireSize' => $tireSize,
			'notes' => $notes,

		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
}

function getLastAsset($database) {
	$sql = file_get_contents('sql/getLastAsset.sql');
	$params = array(
	);
	$statement = $database->prepare($sql);
	$statement->execute();
	$lastAsset = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $lastAsset;
}

function getLastMaintRecord($database) {
	$sql = file_get_contents('sql/getLastMaintRecord.sql');
	$params = array(
	);
	$statement = $database->prepare($sql);
	$statement->execute();
	$lastMaintRecord = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $lastMaintRecord;
}

function updateAssetImageURL($database,$lastAssetID,$imageURL) {
	$sql = file_get_contents('sql/updateAssetImageURL.sql');
		$params = array(
			'assetID' => $lastAssetID,
			'imageURL' => $imageURL,
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
	}

function updateMaintRecordImageURL($database,$trxID,$imageURL) {
	$sql = file_get_contents('sql/updateMaintRecordImageURL.sql');
		$params = array(
			'trxID' => $trxID,
			'imageURL' => $imageURL,
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
	}

function createUser($database, $fName, $lName, $email, $pwd, $phone, $address1, $address2,  $city, $stateID,
$zip, $countryID, $MC){
	// add book
	$sql = file_get_contents('sql/createUser.sql');
		$params = array(
			'fName' => $fName,
			'lName' => $lName,
			'pwd' => $pwd,
			'address1' => $address1,
			'address2' => $address2,
			'city' => $city,
			'stateID' => $stateID,
			'zip' => $zip,
			'countryID' => $countryID,
			'email' => $email,
			'phone' => phoneNumberFormat($phone),
			'MC' => $MC
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
}

function get_Users($database) {
	$sql = file_get_contents('sql/getRegisteredUsers.sql');
	$params = array();
	$statement = $database->prepare($sql);
	$statement->execute();
	$registeredUsers = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $registeredUsers;
}

function updateOdometer($database,$assetID, $miles) {
	$sql = file_get_contents('sql/updateOdometer.sql');
		$params = array(
			'assetID' => $assetID,
			'miles' => milesFormat($miles),
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
}

function updatePassword($database, $email, $pwd) {
	$sql = file_get_contents('sql/updatePassword.sql');
		$params = array(
			'email' => $email,
			'pwd' => $pwd,
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
}

function updateUser ($database,
$userID, $fName, $lName, $email, $phone, $address1, $address2,$city, $stateID,
$zip, $countryID) {
	// Update asset data
	$sql = file_get_contents('sql/updateUser.sql');
		$params = array(
			'userID' => $userID,
			'fName' => $fName,
			'lName' => $lName,
			'email' => $email,
			'phone' => phoneNumberFormat($phone),
			'address1' => $address1,
			'address2' => $address2,
			'city' => $city,
			'stateID' =>  $stateID,
			'zip' => $zip,
			'countryID' => $countryID	
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
}

//Search Maintenance records
function searchMaint($term, $userID, $database) {
	// Get list of main records
	$term = '%'. $term . '%';
	$sql = file_get_contents('sql/getMaint.sql');
	$params = array(
		'term' => $term,
		'user' => $userID
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$records = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $records;
}

function getMaintCostGroupByAsset($database ,$term, $userID) {
	$term = '%'. $term . '%';
	$sql = file_get_contents('sql/getMaintCostAsset.sql');
	$params = array(
		'term' => $term,
		'user' => $userID
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$maintCost = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $maintCost;
}

function getMaintRecord($trxID, $database) {
	// Get maint record
	$sql = file_get_contents('sql/getMaintRecord.sql');
	$params = array(
		'trxID' => $trxID
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$records = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $records;
}

function getOilRecord($assetID, $database) {
	// Get maint record
	$sql = file_get_contents('sql/getOilRecord.sql');
	$params = array(
		'assetID' => $assetID
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$records = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $records;
}

function getMaintCategories ($database) {
	// Get categories
	$sql = file_get_contents('sql/getMaintCategories.sql');
	$params = array();
	$statement = $database->prepare($sql);
	$statement->execute();
	$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $categories;
}

Function getVendors ($database) {
	// Get categories
	$sql = file_get_contents('sql/getVendors.sql');
	$params = array();
	$statement = $database->prepare($sql);
	$statement->execute();
	$vendors = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $vendors;
}

Function getSystems ($database) {
	// Get categories
	$sql = file_get_contents('sql/getSystems.sql');
	$params = array();
	$statement = $database->prepare($sql);
	$statement->execute();
	$systems = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $systems;
}

function insertMaintRecord($database, $assetID, $userID, $serviceDate, 
$serviceDesc, $vehicleSystem, $miles, $cost, $vendor,
$maintCategory, $maintNotes) {
	// add maintenance Record
	$sql = file_get_contents('sql/insertMaintRecord.sql');
		$params = array(
			'assetID' => $assetID,
			'userID' => $userID,
			'serviceDate' => $serviceDate,
			'serviceDesc' => $serviceDesc,
			'vehicleSystem' => $vehicleSystem,
			'miles' => milesFormat($miles),
			'cost' => costFormat($cost),
			'vendorID' => $vendor,
			'maintCategory' => $maintCategory,
			'maintNotes' => $maintNotes
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
}

function updateMaintRecord ($database, $trxID, $serviceDate, 
$serviceDesc, $vehicleSystem, $miles, $cost, $vendor,
$maintCategory, $maintNotes) {
	// Update maintenance record
	$sql = file_get_contents('sql/updateMaintRecord.sql');
		$params = array(
			'trxID' => $trxID,
			'serviceDate' => $serviceDate,
			'serviceDesc' => $serviceDesc,
			'vehicleSystem' => $vehicleSystem,
			'miles' => milesFormat($miles),
			'cost' => costFormat($cost),
			'vendorID' => $vendor,
			'maintCategory' => $maintCategory,
			'maintNotes' => $maintNotes
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
}

function deleteMaintRecord($database, $recordID) {
	// Delete maintenance record
	$sql = file_get_contents('sql/deleteMaintRecord.sql');
		$params = array(
			'recordID' => $recordID,
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
}

function deleteAssetRecord($database, $recordID) {
	// Delete maintenance record
	$sql = file_get_contents('sql/deleteAssetRecord.sql');
		$params = array(
			'recordID' => $recordID,
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
}


function deleteVendorRecord($database, $recordID) {
	// Delete maintenance record
	$sql = file_get_contents('sql/deleteVendorRecord.sql');
		$params = array(
			'recordID' => $recordID,
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
}

function insertVendor($database, $vendorName,
$vendorContact, $email, $website, $phone, $address1, $address2, $vendorCity,
$vendorStateID, $zip, $countryID, $vendorNotes) {
	// add book
	$sql = file_get_contents('sql/insertVendor.sql');
		$params = array(
			'vendorName' =>$vendorName,
			'vendorContact' =>$vendorContact, 
			'email' =>$email, 
			'website' =>$website,
			'phone' =>phoneNumberFormat($phone), 
			'address1' =>$address1, 
			'address2' =>$address2, 
			'vendorCity' =>$vendorCity,
			'vendorStateID' =>$vendorStateID, 
			'zip' =>$zip, 
			'countryID' =>$countryID, 
			'vendorNotes' =>$vendorNotes
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
}

function updateVendor ($database, $vendorID, $vendorName,
$vendorContact, $email, $website, $phone, $address1, $address2, $vendorCity,
$vendorStateID, $zip, $countryID, $vendorNotes) {
	// Update maintenance record
	$sql = file_get_contents('sql/updateVendor.sql');
		$params = array(
			'vendorID' => $vendorID,
			'vendorName' =>$vendorName,
			'vendorContact' =>$vendorContact, 
			'email' =>$email, 
			'website' =>$website,
			'phone' =>phoneNumberFormat($phone), 
			'address1' =>$address1, 
			'address2' =>$address2, 
			'vendorCity' =>$vendorCity,
			'vendorStateID' =>$vendorStateID, 
			'zip' =>$zip, 
			'countryID' =>$countryID, 
			'vendorNotes' =>$vendorNotes
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
}

//Search Vendor records
function searchVendors($term, $database) {
	// Get list of vendors
	$term = '%'. $term . '%';
	$sql = file_get_contents('sql/searchVendors.sql');
	$params = array(
		'term' => $term,
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$vendors = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $vendors;
}

function getVendorRecord($vendorID, $database) {
	// Get vendor record
	$sql = file_get_contents('sql/getVendorRecord.sql');
	$params = array(
		'vendorID' => $vendorID
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$vendors = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $vendors;
}

function getCountries($database) {
	$sql = file_get_contents('sql/getCountries.sql');
	$params = array();
	$statement = $database->prepare($sql);
	$statement->execute();
	$countries = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $countries;
}

function getStatesUS($database) {
	$sql = file_get_contents('sql/getStatesUS.sql');
	$params = array();
	$statement = $database->prepare($sql);
	$statement->execute();
	$states = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $states;
}

function phoneNumberFormat($phone) {
	$phone = preg_replace('/[^\d]/', "",$phone);
	$length =strlen($phone);
	if($length == 10) {
        $phone = preg_replace('/^1?(\d{3})(\d{3})(\d{4})$/', "$1-$2-$3", $phone);
    }
	return $phone;
	}

function milesFormat($miles) {
	$miles = preg_replace('/[^\d]/', "",$miles);
	
	return $miles;
	}

function oilIntervalFormat($oilInterval) {
	$oilInterval = preg_replace('/[^\d]/', "",$oilInterval);
	
	return $oilInterval;
	}

function currentValueFormat($currentValue) {
	$currentValue = preg_replace('/[^\d]/', "",$currentValue);
	
	return $currentValue;
	}

function costFormat($cost) {
	$cost = str_replace('$', '',$cost);
	
	return $cost;
	}

	function isValidZipCode($zip) {
        return (preg_match('#^[0-9]{5}(-[0-9]{4})?$#', $zip)) ? 'yes' : 'no';
	}
	
	function compress_image($source_url, $destination_url, $quality) {

		$info = getimagesize($source_url);

    		if ($info['mime'] == 'image/jpeg')
        			$image = imagecreatefromjpeg($source_url);

    		elseif ($info['mime'] == 'image/gif')
        			$image = imagecreatefromgif($source_url);

   		elseif ($info['mime'] == 'image/png')
        			$image = imagecreatefrompng($source_url);

    		imagejpeg($image, $destination_url, $quality);
		return $destination_url;

	}
	
/* function getBookCategories ($isbn, $database) {
	// Get book 
	$sql = file_get_contents('sql/getBookCategories.sql');
	$params = array(
		'isbn' => $isbn
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $categories;
}


function deleteCategories ($isbn, $database) {
	// delete book categories on action = edit
	$sql = file_get_contents('sql/deleteCategories.sql');
	$params = array(
		'isbn' => $isbn,
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
}


function setCategories ($isbn, $book_categories, $database) {
	// insert book categories on add or edit
	$sql = file_get_contents('sql/insertBookCategory.sql');
	$statement = $database->prepare($sql);
	foreach($book_categories as $category) {
		$params = array(
			'isbn' => $isbn,
			'categoryid' => $category
		);
		$statement->execute($params);
	}
}
 */