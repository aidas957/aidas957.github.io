<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // ���� ��������� �� ����������, ������ ���� ���������� ������� ��������
include("".CORE_FOLDER."".CONFIG_FILE.""); 			// ���������� ���� ��������
include("".FUNCTION_PATH."".LOADTPL_FUNCTION."");	// ���������� ���� ������� LOADTPL
include("".CLASS_PATH."".LOG_CLASS."");		// ���������� ���� ��������� �����
include("".CLASS_PATH."".DB_CLASS."");		// ���������� ���� ��������� �������� � ��
include("".CLASS_PATH."".OTA_CLASS."");		// ���������� ���� ��������� OTA
include("".CLASS_PATH."".STAT_CLASS."");	// ���������� ���� ��������� ����������
include("".CLASS_PATH."".MSG_CLASS."");	    // ���������� ���� ��������� ��������� � ������
include("".CLASS_PATH."".LNG_CLASS."");	    // ���������� ���� ��������� �����
include("".CLASS_PATH."".PAGE_CLASS."");	// ���������� ���� ��������� ��������
include("".API_PATH."".API_OTA."");			// ���������� ���� API OTA
include("".API_PATH."".API_STAT."");		// ���������� ���� API ����������
?>