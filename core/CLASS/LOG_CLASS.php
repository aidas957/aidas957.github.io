<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // ���� ��������� �� ����������, ������ ���� ���������� ������� ��������
// ����c LOGClass 
class LOGClass{
	public $L_FILE;	// ��� ����
	// ����������� �����
	function LOGClass($CONFn){
		 $this->L_FILE = $CONFn['LOG_NAME']; // ��� ��� �����
		 //file_put_contents("".LOG_FOLDER."".$this->L_FILE."", ""); // ������ ���� �� ������� �������	
	}
	// �������� ������ � ����
	public function LSET($TEXT){ // WR("�����")
		file_put_contents("".LOG_FOLDER."".$this->L_FILE."", date("H:i:s").": ", FILE_APPEND);
		file_put_contents("".LOG_FOLDER."".$this->L_FILE."", $TEXT, FILE_APPEND);
		file_put_contents("".LOG_FOLDER."".$this->L_FILE."", "\r\n", FILE_APPEND);		
	}	
}
?>