<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // ���� ��������� �� ����������, ������ ���� ���������� ������� ��������
// �������� ����������
function API_STAT_WRITE($DATADB, $AR){
	$AR['LOG']->LSET("API_STAT_WRITE(..., ...)");
	
	$stat_time = $DATADB['stats_time'];
	$stat_ip = $DATADB['stats_ip'];
	$stat_dev = $DATADB['stats_device'];
	$stat_build = $DATADB['stats_build'];
	$stat_work = $DATADB['stats_work'];
	
	$news = $AR['DB']->QUERY("INSERT INTO stats (stats_time, stats_ip, stats_device, stats_build, stats_work) 
		VALUES ('$stat_time','$stat_ip','$stat_dev','$stat_build','$stat_work')"); // ���������
	
	if($AR['DB']->AFFROW()){ // ���� ���� ��������� ��� ������� 0 �����
		return NULL; // ���������� NULL - ������
	}else{
		return TRUE; // ���� �� 0 - �� ������ �������� �������
	}
}
?>