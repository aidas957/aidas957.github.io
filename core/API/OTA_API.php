<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
// Get builds
function OTA_GET_API($DATAS, $PR, $EXT, $AR){
	// OTA
	if($PR == 0){ // All builds for device OTA only
		$AR['LOG']->WR("OTA_GET_API (ALL BUILD FOR DEVICE)");
		$OT = $AR['DB']->QUERY("SELECT * FROM cy_builds WHERE cy_builds_device = '$DATAS' ORDER BY cy_builds_id DESC"); // Get from db all builds
	}
	if($PR == 1){ // One build OTA only
		$AR['LOG']->WR("OTA_GET_API (ONE BUILD)");
		$OT = $AR['DB']->QUERY("SELECT * FROM cy_builds WHERE cy_builds_incremental = '$DATAS'"); // One build
	}
	// NEWS
	if($EXT){ // For pagination
		$START_NEWS = $EXT['STNEWS']; // Start news
		$CNT_NEWS = $EXT['PPAGENEWS']; // Per page news
	}
	if($PR == 2){ // All build for news
		$AR['LOG']->WR("OTA_GET_API (ALL BUILD)");
		$OT = $AR['DB']->QUERY("SELECT * FROM cy_builds ORDER BY cy_builds_id DESC LIMIT $START_NEWS, $CNT_NEWS"); // All build for news
	}
	if($PR == 3){ // All build count for news
		$AR['LOG']->WR("OTA_GET_API (ALL BUILD COUNTER)");
		$OT = $AR['DB']->QUERY("SELECT * FROM cy_builds ORDER BY cy_builds_id DESC"); // All build counter for pagination
		return $AR['DB']->NUMROW($OT);
	}
	if($AR['DB']->NUMROW($OT) == 0){ // 
		$AR['LOG']->WR("OTA_GET_API: NULL");
		return NULL; // 
	}else{
		return $OT; // 
	}
}
// Get device api
function OTA_GETDEVICE_API($DATAS, $AR){
	$OT = $AR['DB']->QUERY("SELECT * FROM cy_devices WHERE cy_devices_code = '$DATAS'"); // Get device desc
	if($AR['DB']->NUMROW($OT) == 0){ // 
		$AR['LOG']->WR("OTA_GETDEVICE_API: NULL");
		return NULL; // 
	}else{
		return $OT; // 
	}
}
// Get android api
function OTA_GETANDROID_API($DATAS, $AR){
	$OT = $AR['DB']->QUERY("SELECT * FROM cy_android WHERE cy_android_api = '$DATAS'"); // Get android
	if($AR['DB']->NUMROW($OT) == 0){ // 
		$AR['LOG']->WR("OTA_GETANDROID_API: NULL");
		return NULL; // 
	}else{
		return $OT; // 
	}
}
?>