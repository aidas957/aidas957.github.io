<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // ���� ��������� �� ����������, ������ ���� ���������� ������� ��������
// ������� ������
function CLEAN($DATA, $AR, $MODE){
	$AR['LOG']->LSET("CLEAN(".$DATA.", ..., ".$MODE.")");
	switch($MODE){
		case "I": // ������������ ����� 
			$DATA = (int)$DATA; // ������������ ��� � �����
		break;
		case "S": // ������������ �����	
		default:  // �� ��������� ������������ �����
			$DATA = trim(strip_tags(htmlspecialchars($DATA, ENT_QUOTES, "cp1251")));
		break;
	}
	return $DATA;
}
?>