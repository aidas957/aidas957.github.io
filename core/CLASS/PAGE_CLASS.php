<?php
/* TODO */
/*
- Fix what do if template not found
*/
defined('_ACE3OTA') or die('ERROR'); // ���� ��������� �� ����������, ������ ���� ���������� ������� ��������
// ����c PAGEClass 
class PAGEClass{
	public $AR; 			// ������ �������
	private $TPLw; 			// ������ ��������
	private $TITLE; 		// ��������� ��������
	private $MENUi; 		    // ���� ��������
	private $CONTENT; 		// ���������� ��������
	private $PAGIN; 		// ���������� ������������� ������
	function PAGEClass($ARn){	
		$this->AR = $ARn; // ������ �������
		$this->AR['LOG']->LSET("PAGEClass: Constructor(...)");
	}
	// ������������ �������
	public function SETCONTENT($CON�n, $TPLn){
		$this->AR['LOG']->LSET("PAGEClass: SETCONTENT(..., ".$TPLn.")");
		// Fix what do if template not found
		$this->TPLw = LOADTPL($TPLn, $this->AR); // ��������� ������
		$this->CONTENT .= $CON�n; // ��������� � ���������� �������
	}
	// ���� �����
	public function SETMENU($MEn){
		$this->AR['LOG']->LSET("PAGEClass: SETMENU(...)");
		// Fix what do if template not found
		$this->MENUi .= $MEn; // ��������� � ���������� ����
	}
	// ������� �������� ��������� ��������
	public function SETTITLE($TTL){
		$this->AR['LOG']->WR("PAGEClass: SETTITLE(".$TTL.")");
		$this->TITLE .= $TTL; // ��������� � ����������
	}
	public function Pr(){ //����� ��������
		$this->AR['LOG']->LSET("PAGEClass: Pr()");
		$HTMLm = str_replace("[_tpl_path]", TPL_FOLDER, $this->TPLw); // �������� � ������� � ���� � �������� ����� � ��������� �������
		$HTMLm = str_replace("[_title]", $this->TITLE, $HTMLm); // ��������� ��������� ��������
		$HTMLm = str_replace("[_menu]", $this->MENUi, $HTMLm); // ��������� ���� ��������
		$HTMLm = str_replace("[_msg]", $this->AR['MSG']->Pr(), $HTMLm); // ��������� ���������
		$HTMLm = str_replace("[_content]", $this->CONTENT, $HTMLm); // ��������� ������� � ������� ��� ������ ������ ���
		$HTMLm = str_replace("[_paginat]", $this->PAGIN, $HTMLm); // ��������� ������������ ����� ��������
		// ����� ��������
		echo $HTMLm;	
	}
}
?>