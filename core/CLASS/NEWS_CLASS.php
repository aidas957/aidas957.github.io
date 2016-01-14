<?php
/* TODO */
/*
*/
defined('_CYOTA') or die('DISABLE'); // Disable run
class NEWSClass{
	public $AR; 			// SYS
	private $TPLw; 			// Template
	private $NEWSLIST;      // News list
	private $PAGOUT;        // Pagination out
	function NEWSClass($CONFn, $ARn){
		$this->CONF = $CONFn;
		$this->AR = $ARn; // SYS
		$this->TPLw['NEWS'] = $this->AR['TPL']->TLOAD('NEWS');
		$this->TPLw['PAGINATION'] = $this->AR['TPL']->TLOAD('PAGINATION');
	}
	// Greate list news
	public function GET($PARAM){
		$CUR_PAGE = clean($this->AR, $PARAM['PAGE'], "I");      // Current page
		$EXT['STNEWS'] = $this->paginationcomposer($CUR_PAGE);  // Start news
		$EXT['PPAGENEWS'] = $this->CONF['NEWS_OTA_PERPAGE'];    // Perpage news
		
		$NWSRAW = OTA_GET_API("NULL", 2, $EXT, $this->AR); // Get all build(limited)
		
		if($NWSRAW){ // If we have builds
			$this->NEWSLIST = $this->composenws($NWSRAW);
		}else{
			$this->AR['MSG']->SHOW($this->AR['LNG']->STR['msg_no_builds'], "I");
			$this->AR['LOG']->WR("NEWSClass: GET ALL NEWS - NO NEWS");
		}
	}
	// Compose pagination
	private function paginationcomposer($CUR_PAGE){
		$EXT['STNEWS'] = 0; // Start news
		$EXT['PPAGENEWS']= 0; // End news
		$ALLNEWSCNT = OTA_GET_API("", 3, $EXT,$this->AR); // All news(no limit)
		$PAGE_ALL = ceil($ALLNEWSCNT / $this->CONF['NEWS_OTA_PERPAGE']); // How page we hawe
		if($CUR_PAGE < 1){ // if current page < 1
			$CUR_PAGE = 1; // Set current page 1
		}
		if($CUR_PAGE > $PAGE_ALL AND $ALLNEWSCNT != 0){ //
			$CUR_PAGE = $PAGE_ALL; //
		}
		if($ALLNEWSCNT){
			$PG_LNK = "?page";
			$this->FIRSTNav($this->TPLw['PAGINATION'], $CUR_PAGE, $PG_LNK); // 
			$this->PREVNav($this->TPLw['PAGINATION'], $CUR_PAGE, $PG_LNK); // 
			$this->CURNav($this->TPLw['PAGINATION'], $CUR_PAGE, $PG_LNK); // 
			$this->NEXTNav($this->TPLw['PAGINATION'], $CUR_PAGE, $PG_LNK, $PAGE_ALL); // 
			$this->LASTNav($this->TPLw['PAGINATION'], $CUR_PAGE, $PG_LNK, $PAGE_ALL); //
		}
		$START_NEWS = ($CUR_PAGE - 1) * $this->CONF['NEWS_OTA_PERPAGE']; // Start news for DB
		
		return $START_NEWS;
	}
	
	private function FIRSTNav($TPL, $CUR_PAGE, $PG_LNK){ // FIRSTNav
		if($CUR_PAGE > 2){
			$NAV_OUT = str_replace("[_lnk]", "/index.php".$PG_LNK."=1", $TPL);
			$NAV_OUT = str_replace("[_ident]", "<<", $NAV_OUT);
		}else{
			$NAV_OUT = "";
		}
		$this->PAGOUT .= $NAV_OUT;	
	}
	
	private function PREVNav($TPL, $CUR_PAGE, $PG_LNK){ // PREVNav
		if($CUR_PAGE - 1 > 0){
			$NAV_OUT = str_replace("[_lnk]", "/index.php".$PG_LNK."=".($CUR_PAGE - 1)."", $TPL);
			$NAV_OUT = str_replace("[_ident]", "".($CUR_PAGE - 1)."", $NAV_OUT);
		}else{
			$NAV_OUT = "";
		}
		$this->PAGOUT .= $NAV_OUT;	
	}
	
	private function CURNav($TPL, $CUR_PAGE, $PG_LNK){ // CURNav
		$NAV_OUT = str_replace("[_lnk]", "/index.php".$PG_LNK."=".$CUR_PAGE."", $TPL);
		$NAV_OUT = str_replace("[_ident]", "<span>".$CUR_PAGE."</span>", $NAV_OUT);
		$this->PAGOUT .= $NAV_OUT;
	}
	
	private function NEXTNav($TPL, $CUR_PAGE, $PG_LNK, $PAGE_ALL){ // NEXTNav
		if($CUR_PAGE + 1 <= $PAGE_ALL){
			$NAV_OUT = str_replace("[_lnk]", "/index.php".$PG_LNK."=".($CUR_PAGE + 1)."", $TPL);
			$NAV_OUT = str_replace("[_ident]", "".($CUR_PAGE + 1)."", $NAV_OUT);
		}else{
			$NAV_OUT = "";
		}
		$this->PAGOUT .= $NAV_OUT;
	}
	
	private function LASTNav($TPL, $CUR_PAGE, $PG_LNK, $PAGE_ALL){ // LASTNav
		if($CUR_PAGE < ($PAGE_ALL - 1)){
			$NAV_OUT = str_replace("[_lnk]", "/index.php".$PG_LNK."=".$PAGE_ALL."", $TPL);
			$NAV_OUT = str_replace("[_ident]", ">>", $NAV_OUT);
		}else{
			$NAV_OUT = "";
		}
		$this->PAGOUT .= $NAV_OUT;
	}
	
	// Build list
	private function composenws($NWSRAW){
		$RTNEWS = "";
		preg_match("/\[_ifnews\](.*?)\[_ifnews\]/s", $this->TPLw['NEWS'], $CUTEDNEWS_ALL); // Get template (All template) from TPLw from [_ifnews]*[_ifnews]
		
		$WS = str_replace("[d_device]", $this->AR['LNG']->STR['d_device'], $CUTEDNEWS_ALL[1]);
		$WS = str_replace("[d_date]", $this->AR['LNG']->STR['d_date'], $WS);
		$WS = str_replace("[d_codename]", $this->AR['LNG']->STR['d_codename'], $WS);
		$WS = str_replace("[d_cmversion]", $this->AR['LNG']->STR['d_cmversion'], $WS);
		$WS = str_replace("[d_cmcode]", $this->AR['LNG']->STR['d_cmcode'], $WS);
		$WS = str_replace("[d_changelog]", $this->AR['LNG']->STR['d_changelog'], $WS);
		$WS = str_replace("[d_download]", $this->AR['LNG']->STR['d_download'], $WS);
		
		preg_match("/\[_ifnews_data\](.*?)\[_ifnews_data\]/s", $this->TPLw['NEWS'], $CUTEDNEWS); // Get template from from [_ifnews_data]*[_ifnews_data]
		// Replace data in [_ifnews_data]*[_ifnews_data]
		while($R_NEWS = $this->AR['DB']->FETCHARRAY($NWSRAW)){
			$N_DATA = $R_NEWS['cy_builds_addtime'];
			$N_INC 	= $R_NEWS['cy_builds_incremental'];
			$N_DEV 	= $R_NEWS['cy_builds_device'];
			$N_DROID 	= $R_NEWS['cy_builds_api_level'];
			$N_DWNLINK 	= $R_NEWS['cy_builds_url'];
			$N_WIEVLINK = $R_NEWS['cy_builds_changes'];
			
			$N_DATA = date("j.m.Y", $N_DATA);
			
			// Get name device
			$RAWDEVC = OTA_GETDEVICE_API($N_DEV, $this->AR);
			if($RAWDEVC){
				$R_DEV = $this->AR['DB']->FETCHARRAY($RAWDEVC);
				$N_DEVNAME = $R_DEV['cy_devices_name'];
			}else{
				$this->AR['LOG']->WR("NEWSClass: NO DEVICE DESC SET UNKNOWN");
				$N_DEVNAME = "-";
			}
			// Get android api
			$RAWDROID = OTA_GETANDROID_API($N_DROID, $this->AR);
			if($RAWDROID){
				$R_DROID = $this->AR['DB']->FETCHARRAY($RAWDROID);
				$R_DROIDNAME = $R_DROID['cy_android_version'];
				$R_DROIDNAMECM = $R_DROID['cy_android_cmversion'];
			}else{
				$this->AR['LOG']->WR("NEWSClass: NO ANDROID SET UNKNOWN");
				$R_DROIDNAME = "-";
				$R_DROIDNAMECM = "-";
			}
			
			$RT = str_replace("[_b_codename]", $N_DEV, $CUTEDNEWS[1]);
			$RT = str_replace("[_b_date]", $N_DATA, $RT);
			$RT = str_replace("[_b_changelog]", $this->AR['LNG']->STR['d_wiev'], $RT);
			$RT = str_replace("[_b_download]", $this->AR['LNG']->STR['d_download'], $RT);
			$RT = str_replace("[_b_downlink]", $N_DWNLINK, $RT);
			$RT = str_replace("[_b_wievlink]", $N_WIEVLINK, $RT);
			$RT = str_replace("[_b_cmversion]", $R_DROIDNAME."(".$R_DROIDNAMECM.")", $RT);
			$RT = str_replace("[_b_device]", $N_DEVNAME, $RT);
			
			$RTNEWS .= str_replace("[_b_cmcode]", $N_INC, $RT);
		}
		// Now all redy from [_ifnews_data]*[_ifnews_data] and stored in $CUTEDNEWS[1]
		// Replace ready data $CUTEDNEWS[1] in all template
		$REZUl = preg_replace("/\[_ifnews_data\].*?\[_ifnews_data\]/s", $RTNEWS, $WS);
		return $REZUl;
	}
	// Print
	public function Pr($MODE){ //Вывод страницы
		switch($MODE){
			case "NEWS":
				return $this->NEWSLIST;
			break;
			case "PAGINATION":
				return $this->PAGOUT;
			break;
		}
	}
}
?>