<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // ���� ��������� �� ����������, ������ ���� ���������� ������� ��������
// ����c LNGClass 
class LNGClass{
	public $LP; 			// ������ ����� �����
	private $LNG_PATH_FILE; // ���������� ����� �����
	function LNGClass($CONFn, $ARn){
		$this->LNG_PATH_FILE .= $CONFn['LP_LNG']; // ����
		$this->LNG_PATH_FILE .= ".ini";
		$this->LP = parse_ini_file(LNG_FOLDER.$this->LNG_PATH_FILE);
		$ARn['LOG']->LSET("LNGClass: Constructor(".$this->LNG_PATH_FILE.", ...)");
	}	
}
?>