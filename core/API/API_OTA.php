<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // ���� ��������� �� ����������, ������ ���� ���������� ������� ��������
// ��������� ���� � ����
function API_OTA_GET($DATAS, $PR, $AR){
	$AR['LOG']->LSET("API_OTA_GET(".$DATAS.", ..., ...)");
	// 0 - get all builds for device
	// 1 - get build by hash
	if($PR == 0){
		$AR['LOG']->LSET("API_OTA_GET (ALL BUILD)");
		$ota = $AR['DB']->QUERY("SELECT * FROM builds WHERE builds_device = '$DATAS' ORDER BY builds_id DESC");
	}
	if($PR == 1){
		$AR['LOG']->LSET("API_OTA_GET (ONE BUILD)");
		$ota = $AR['DB']->QUERY("SELECT * FROM builds WHERE builds_incremental = '$DATAS'");
	}
	if($AR['DB']->NUMROW($ota) == 0){ // ���� ���� ��������� ��� ������� 0 �����
		$AR['LOG']->LSET("API_OTA_GET(): NULL");
		return NULL; // ���������� NULL - �������� ���
	}else{
		return $ota; // ���� �� 0 - �� ������ ����
	}
}
?>