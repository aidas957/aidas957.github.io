<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // ���� ��������� �� ����������, ������ ���� ���������� ������� ��������
// ����c MENUClass 
class MENUClass{
	public $AR; 			// ������ �������
	private $TPLw; 			// ������ ��������
	public $MENUw; 		// ������ ����
	function MENUClass($TPLn ,$ARn){	
		$this->AR = $ARn; // ������ �������
		$this->TPLw = LOADTPL($TPLn, $this->AR); 	// ��������� ������
		$this->AR['LOG']->LSET("MENUClass: Constructor(".$TPLn.")");
	}
	public function SET(){ // ��������� ����������� ����
		$this->AR['LOG']->LSET("MENUClass: SET()");
	}
	public function GET(){
		$this->AR['LOG']->LSET("MENUClass: GET()");
		$menu = API_MENU_GET($this->AR); // �������� ��� ����
		if($menu){		// ���� ���� ���, ������� ��������� � ������ �������
			while($RMEN = $this->AR['DB']->FETCHARRAY($menu)){ // ��������� �� ��� ��� ���� ���� ����
			    $tPL = $this->TPLw;
			
				$name = $RMEN['name'];
				$types = $RMEN['types'];
				$vars = $RMEN['vars'];
				
				$tmpm = str_replace("[_link]", $vars, $tPL);
				$tmpm = str_replace("[_name]", $name, $tmpm);
				$tmpm = str_replace("[_st]", "", $tmpm);
				
				$this->MENUw .= $tmpm;
			}
		}else{
			$this->AR['MSG']->SET($this->AR['LNG']->LP['w_nomenu'], "W"); // ������� ��������� �� ������ ��������� ������
			$this->MENUw .= "";
		}	
	}
	public function Pr(){ //����� ��������
		$this->AR['LOG']->LSET("MENUClass: Pr()");
		// ����� ��������
		return $this->MENUw;	
	}
}
?>