<?php
/* TODO */
/*
- Fix it: need cms
- Fix it: Need rebuild statistic system 
- Fix it: Need clean tpl css, and html 
*/
define('_ACE3OTA', 1);  // ��������� ��������� ��� �������������� ������� ������� � ������������ ������
/* ��������� �������� ���������� */
$RAWPOST = file_get_contents("php://input"); // RAW POST
if($RAWPOST != ""){$PARAM['RAW'] = $RAWPOST;}else{$PARAM['RAW'] = NULL;} 	// ��������� ���� �� RAW POST
/* ����� */
/* ����������� ������ */
include("core/def.php"); 	// ���������� ���� ��������
include("core/static.php"); // ���������� ���� � ��������� ������� � �������
/* ������������� ������� */
$AR['LOG'] = new LOGClass($CONF);     								// ����� ������ � �����
$AR['DB']  = new DBClass($CONF, $AR);  								// ����� ������ � ����� ������
$AR['MSG'] = new MSGClass();										// ����� ������ � ����������� �������
$AR['STAT'] = new STATClass($AR); 									// ����� ������ � ����������� ����������
$AR['LNG'] = new LNGClass($CONF ,$AR); 								// ����� ������ � �������� �������
$AR['OTA'] = new OTAClass(OTANULL_TPL, OTARELIZE_TPL, $AR); 		// ����� ������ � OTA
$AR['PG']  = new PAGEClass($AR); 									// ����� ������ � ���������
$AR['MENU'] = new MENUClass(MENU_TPL, $AR); 						// ����� ������ � ����
$AR['NEWS'] = new NEWSClass(NEWS_TPL, $AR); 						// ����� ������ � ���������
/* ���������� �������� */
$AR['LOG']->LSET("INDEX: BEGIN");
$AR['DB']->CONNECT(); // ������������ � ���� ������ ��� ���������� ��������
/* ���������� �������� */
if($PARAM['RAW'] != NULL){ // ��������� ���
	$AR['OTA']->CREATE($PARAM['RAW']); // ������� ��� ����������, �� ��������� ��������� RAW 
	$AR['PG']->SETCONTENT($AR['OTA']->OTAPr(), OTAINDEX_TPL); // ������������� ������� ��� ����� ��� �����������, � �������� ������ ��� ��� ������� ��������
	// Fix it: Need rebuild statistic system 
	//$AR['STAT']->Pr(); // �������� ����������
	$AR['PG']->Pr(); // ����� ��������	
}else{ 						// ��������� ����
	// Fix it: need cms 
	$AR['MENU']->GET(); // ��������� ���� � ����
	$AR['NEWS']->CREATE(); // ��������� ������� � ����
	$AR['PG']->SETCONTENT($AR['NEWS']->Pr(), INDEX_TPL); // ������������� �������, � �������� ��� ������� �������� ��� �������������
	$AR['PG']->SETMENU("".$AR['MENU']->Pr().""); // ������������� ����
	$AR['PG']->Pr(); // ����� ��������
}
/* ����� �������� */
$AR['DB']->CLOSE();   // ��������� ���������� � ����� �����
$AR['LOG']->LSET("INDEX: END");
?>