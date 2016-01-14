<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
class OTAClass{
	public $AR; 			// SYS
	public $TPLw; 		    // Template
	private $OTAREL; 		// Out
	// Constructor
	function OTAClass($ARn){	
		$this->AR = $ARn;   // SYS
		$this->TPLw['OTA_NULL'] = $this->AR['TPL']->TLOAD('OTA_NULL'); // Load tpl
		$this->TPLw['OTA_UPDATE'] = $this->AR['TPL']->TLOAD('OTA_UPDATE'); // Load tpl
	}
	// List all build
	public function GET($PARAMn){
		$PARSEARR = json_decode($PARAMn, true); // Decode raw post to array
		//$PARSEARR['params']['device'] = "logan";
		//$PARSEARR['params']['source_incremental']="";
		if($PARSEARR == true){ // If decode ok
			if(isset($PARSEARR['params']['device']) AND isset($PARSEARR['params']['source_incremental'])){ // If we want all builds list for device
				$this->AR['LOG']->WR("OTAClass: ALL BUILD");
				$DEVICE = $PARSEARR['params']['device']; // Get device name from post
				$this->AR['LOG']->WR("OTAClass: ALL BUILD device = ".$DEVICE."");
				$this->AR['LOG']->WR("OTAClass: ALL BUILD source_incremental = ".$PARSEARR['params']['source_incremental']."");
				$RAWNEW = OTA_GET_API($DEVICE, 0, NULL, $this->AR); // GEt from sql all build
				if($RAWNEW){
					$this->OTAREL .= $this->composerOTA($RAWNEW); // Create build
					$this->AR['LOG']->WR($this->OTAREL);
				}else{ // No builds for device
					$this->AR['LOG']->WR("OTAClass: NO BUILDS FOR DEVICE ".$DEVICE."");
					$this->OTAREL = $this->TPLw['OTA_NULL']; // Send null
				}
			}
			if(isset($PARSEARR['target_incremental'])){ // Get one build
				$this->AR['LOG']->WR("OTAClass: GET ".$PARSEARR['target_incremental']."");
				$HBUILD = $PARSEARR['target_incremental']; // Get need build
				$RAWB = OTA_GET_API($HBUILD, 1, NULL, $this->AR); // Get one build
				if($RAWB){ // if ok
					$this->OTAREL .= $this->composerOTA($RAWB); // Create
					$this->AR['LOG']->WR($this->OTAHTML);
				}else{
					$this->AR['LOG']->WR("OTAClass: CREATE() NO BUILD ".$HBUILD."");
					$this->OTAREL .= $this->TPLw['OTA_NULL'];
				}
			}	
		}else{
			$this->AR['LOG']->WR("OTAClass: ERROR decode RAW post");
			$this->OTAREL = $this->TPLw['OTA_NULL']; // Send null
		}
	}
	//
	function composerOTA($RAWNEW){
		$this->AR['LOG']->WR("OTAClass: composerOTA()");
		$TPLREL = NULL; // , - after build
		preg_match("/\[_ifota\](.*?)\[_ifota\]/s", $this->TPLw['OTA_UPDATE'], $TPLCUT); // Begin tpl
		while($RNEWS = $this->AR['DB']->FETCHARRAY($RAWNEW)){ // Create
			if($TPLREL != NULL){ // If not NULL, then its run not first
				// then add ,
				$TPLREL .= ",";
			}
			// Get from sql
			$DEV = $RNEWS['cy_builds_device'];
			$INC = $RNEWS['cy_builds_incremental'];
			$API = $RNEWS['cy_builds_api_level'];
			$URL = $RNEWS['cy_builds_url'];
			$TIME = $RNEWS['cy_builds_timestamp'];
			$MD5S = $RNEWS['cy_builds_md5sum'];
			$CHANG = $RNEWS['cy_builds_changes'];
			$CHAN = $RNEWS['cy_builds_channel'];
			$FILNM = $RNEWS['cy_builds_filename'];
			
			$this->AR['LOG']->WR("OTAClass: BUILD DEV = ".$DEV."");
			$this->AR['LOG']->WR("OTAClass: BUILD INC = ".$INC."");
			$this->AR['LOG']->WR("OTAClass: BUILD API = ".$API."");
			$this->AR['LOG']->WR("OTAClass: BUILD URL = ".$URL."");
			$this->AR['LOG']->WR("OTAClass: BUILD TIME = ".$TIME."");
			$this->AR['LOG']->WR("OTAClass: BUILD MD5S = ".$MD5S."");
			$this->AR['LOG']->WR("OTAClass: BUILD CHANG = ".$CHANG."");
			$this->AR['LOG']->WR("OTAClass: BUILD CHAN = ".$CHAN."");
			$this->AR['LOG']->WR("OTAClass: BUILD FILNM = ".$FILNM."");
			
			// Replace it in template
			$OUT = str_replace("[INC]", $INC, $TPLCUT[1]); // In $TPLCUT[1] we have template for replacing
			$OUT = str_replace("[API]", $API, $OUT); 
			$OUT = str_replace("[URL]", $URL, $OUT); 
			$OUT = str_replace("[TIME]", $TIME, $OUT);
			$OUT = str_replace("[MD5S]", $MD5S, $OUT); 
			$OUT = str_replace("[CHANG]", $CHANG, $OUT); 
			$OUT = str_replace("[CHAN]", $CHAN, $OUT); 
			$OUT = str_replace("[FILNM]", $FILNM, $OUT);
			
			$TPLREL .= $OUT;
		}
		$OTAr = preg_replace("/\[_ifota\].*?\[_ifota\]/s", $TPLREL, $this->TPLw['OTA_UPDATE']);	
		return $OTAr;
	}	
	// Print
	public function Pr(){ 
		return $this->OTAREL; // Print
	}
}	
?>