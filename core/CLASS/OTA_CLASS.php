<?php
/* TODO */
/*
- Fix what do if template not found
*/
defined('_ACE3OTA') or die('ERROR'); // ���� ��������� �� ����������, ������ ���� ���������� ������� ��������
// ����c OTAClass 
class OTAClass{
	public $AR; 			// ������ �������
	public $TPLNULL; 		// ��� ���������� - ������
	public $TPLRELIZE; 		// ���� ���������� - ������
	private $OTAHTML; 		// �����
	function OTAClass($TPLNULLn, $TPLRELIZEn, $ARn){	
		$this->AR = $ARn; // ������ �������
		// Fix what do if template not found
		$this->TPLNULL = LOADTPL($TPLNULLn, $this->AR); 		// ��������� ������
		$this->TPLRELIZE = LOADTPL($TPLRELIZEn, $this->AR); 	// ��������� ������
		$this->AR['LOG']->LSET("OTAClass: Constructor(".$TPLNULLn.", ".$TPLRELIZEn.", ...)");
	}
	// Create OTA list
	public function CREATE($PARAMn){ 
		$this->AR['LOG']->LSET("OTAClass: CREATE()");
		$PARSEARR = json_decode($PARAMn, true); // Decode
		if($PARSEARR == true){ // ���� ������������
			if(isset($PARSEARR['params']['device']) AND isset($PARSEARR['params']['source_incremental'])){ // ���� ���� ���������� �� ���������� � ������� �����
				$this->AR['LOG']->LSET("OTAClass: CREATE(): ALL BUILDS");
				$DEVICE = $PARSEARR['params']['device']; // �������� ��� ����������
				$RAWNEW = API_OTA_GET($DEVICE, 0, $this->AR); // ������ ������ � ���� ( 0 - ��� �����, 1 - ���� �� ����)
				if($RAWNEW){ // ���� ����� �� NULL
					$this->OTAHTML .= $this->composerOTA($RAWNEW); // ���������� ����� �� ������� ������
					//$this->AR['STAT']->SETFILD("DEVICE", $DEVICE); // ��������� � ����������
					//$this->AR['STAT']->SETFILD("BUILD", $PARSEARR['params']['source_incremental']); // ��������� � ����������
					//$this->AR['STAT']->SETFILD("WORK", "chek"); // ��������� � ����������
					$this->AR['LOG']->LSET($this->OTAHTML);
				}else{ // ���� ����� NULL
					$this->AR['LOG']->LSET("OTAClass: CREATE() NO BUILDS FOR DEVICE ".$DEVICE."");
					$this->OTAHTML .= $this->TPLNULL; // ������������� ���������� ����������
				}		
			}
			if(isset($PARSEARR['target_incremental'])){ // ���� ���� ���������� �� �������� �����
				$this->AR['LOG']->LSET("OTAClass: CREATE() GET ".$PARSEARR['target_incremental']."");
				$HBUILD = $PARSEARR['target_incremental']; // �������� ����
				$RAWB = API_OTA_GET($HBUILD, 1, $this->AR); // ������ ������ � ���� � target_incremental( 0 - ��� �����, 1 - ���� �� ����)
				if($RAWB){ // ���� ��
					$this->OTAHTML .= $this->composerOTA($RAWB); // ��������� �����
					$this->AR['LOG']->LSET($this->OTAHTML);
				}else{
					$this->AR['LOG']->LSET("OTAClass: CREATE() NO BUILD ".$HBUILD."");
					$this->OTAHTML .= $this->TPLNULL;
				}	
			}	
		}else{ // ���� ������������ ������
			$this->AR['LOG']->LSET("OTAClass: CREATE(): DECODE ERROR");
			$this->OTAHTML .= $this->TPLNULL; // ������������� ���������� ����������
			return 0;
		}	
	}
	// ����������� ������ ��� �������
	function composerOTA($RAWNEW){
		$this->AR['LOG']->LSET("OTAClass: composerOTA()");
		$TPLREL = NULL; // ������� ����� ������� � ������ � ������ ������
		// �������� � ������� ��� �����	_ifota		
		preg_match("/\[_ifota\](.*?)\[_ifota\]/s", $this->TPLRELIZE, $TPLCUT);
		// ���� ���������� ���������� ���� �� �������
		while($RNEWS = $this->AR['DB']->FETCHARRAY($RAWNEW)){ // ��������� �� ��� ��� ���� ���� �������
			if($TPLREL != NULL){
				// ���� �� NULL ������ ���� ������� �� ������ ���, � ������ ����� ������� ���� �������
				$TPLREL .= ",";
			}
			// �������� � ���� ����� ��� ������		
			$DEV = $RNEWS['builds_device'];
			$TYPES = $RNEWS['builds_type'];
			$INC = $RNEWS['builds_incremental'];
			$API = $RNEWS['builds_api_level'];
			$URL = $RNEWS['builds_url'];
			$TIME = $RNEWS['builds_timestamp'];
			$MD5S = $RNEWS['builds_md5sum'];
			$CHANG = $RNEWS['builds_changes'];
			$CHAN = $RNEWS['builds_channel'];
			$FILNM = $RNEWS['builds_filename'];
			// �������� � ������			
			$OUT = str_replace("[INC]", $INC, $TPLCUT[1]); 
			$OUT = str_replace("[API]", $API, $OUT); 
			$OUT = str_replace("[URL]", $URL, $OUT); 
			$OUT = str_replace("[TIME]", $TIME, $OUT);
			$OUT = str_replace("[MD5S]", $MD5S, $OUT); 
			$OUT = str_replace("[CHANG]", $CHANG, $OUT); 
			$OUT = str_replace("[CHAN]", $CHAN, $OUT); 
			$OUT = str_replace("[FILNM]", $FILNM, $OUT);
			// �������� �� ��������� ����������			
			$TPLREL .= $OUT;			
		}
		// ����� ���� ���������� ����� �������� ������������ � ������� � �������� �� �������� ���
		$OTAr = preg_replace("/\[_ifota\].*?\[_ifota\]/s", $TPLREL, $this->TPLRELIZE);
		// ���������� ������� �����
		return $OTAr;
	}
	// OTA Print
	public function OTAPr(){ 
		$this->AR['LOG']->LSET("OTAClass: OTAPr()");
		return $this->OTAHTML; // ����� ������
	}	
}
?>