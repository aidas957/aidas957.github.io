<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // ���� ��������� �� ����������, ������ ���� ���������� ������� ��������
// ����c NEWSClass
class NEWSClass{
	public $AR; 			// ������ �������
	private $TPLw; 			// ������ ��������
	public $MENUw; 		    // ������ ��������
	public $ONEWS;
	function NEWSClass($TPLn ,$ARn){
		$this->AR = $ARn; // ������ �������
		$this->TPLw = LOADTPL($TPLn, $this->AR); 	// ��������� ������
		$this->AR['LOG']->LSET("NEWSClass: Constructor(".$TPLn.")");
	}
	public function CREATE(){
		$this->AR['LOG']->LSET("NEWSClass: CREATE");
		// �������� ��� �������
		$NWSRAW = API_NEWS_GET($this->AR);
		if($NWSRAW){ // ���� ���� ������ 1 �������
			while($R_NEWS = $this->AR['DB']->FETCHARRAY($NWSRAW)){
				$this->ONEWS .= $this->composen($R_NEWS);
			}
		}else{
			$this->AR['MSG']->SET($this->AR['LNG']->LP['w_nonews'], "W"); // ������� ��������� �� ������ ��������� ������
		}
	}
	public function composen($REWS){ //����� ��������
		$this->AR['LOG']->LSET("NEWSClass: compose(...)");
		preg_match("/\[_ifmini\](.*?)\[_ifmini\]/s", $this->TPLw, $CUT); // �������� ��� ����� [_ifmini] � �������� � CUT[1]
		
		$HTPl = $this->TPLw; // �������� ������
		
		$HTPl = preg_replace("/\[_while\].*?\[_while\]/s", $CUT[1], $HTPl); // �������� ��������� � �������
		
		$ID_NEWS 	= $REWS['news_id']; 		// ID �������
		$FAV_NEWS 	= $REWS['news_fav']; 		// ������������� ������� �� �������
		$CAT_NEWS 	= $REWS['news_cat']; 		// ��������� ������� ID
		$TITLE_NEWS = $REWS['news_title']; 	    // ���������
		$TEXT_NEWS	= $REWS['news_text']; 	    // �����
		$AUTOR_NEWS = $REWS['news_author']; 	// ����� ID
		$DATE_NEWS 	= $REWS['news_date_a']; 	// ����	
		
		$TEXT = explode("[end]", $TEXT_NEWS); // ����� ���� �� 2 ����� �� [end] � ����� (text[0] - �� [end])
		$NEWS_OUT = str_replace("[_text]", $TEXT[0], $HTPl); // �������� ����� �� [end] � �������
		
		$NEWS_OUT = str_replace("[_title]", $TITLE_NEWS, $NEWS_OUT);
		$NEWS_OUT = str_replace("[_author]", $AUTOR_NEWS, $NEWS_OUT);
		$NEWS_OUT = str_replace("[_date_b]", $DATE_NEWS, $NEWS_OUT);
		$NEWS_OUT = str_replace("[_id]", $ID_NEWS, $NEWS_OUT);
		// ��������� ��������� ��������� � ����������
		return $NEWS_OUT;
		
	}
	public function Pr(){ //����� ��������
		$this->AR['LOG']->LSET("NEWSClass: Pr()");
		return $this->ONEWS;
	}
}
?>