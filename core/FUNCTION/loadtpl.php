<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // ���� ��������� �� ����������, ������ ���� ���������� ������� ��������
// �������� �������
function LOADTPL($TPLn, $AR){
	$AR['LOG']->LSET("TPLREAD(".$TPLn.")");
	$HTMLTPL = ""; // �������� ���������� �������
	$HTMLTPL = file("".TPL_FOLDER."".$TPLn.""); // ������ ����
		if($HTMLTPL == FALSE){ // ���� ���� �� ��������
			return FALSE; // ��� �����
		}else{ 			  // ���� ������� ��������
			$HTMLTPL = implode("", $HTMLTPL); // ��������� � ���� ����������
		}
	return $HTMLTPL; // ���� ���������� NULL ������ �� ������ � �����
}
?>