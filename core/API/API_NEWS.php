<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // ���� ��������� �� ����������, ������ ���� ���������� ������� ��������
// ��������� ���� �������� � ����
function API_NEWS_GET($AR){
	$AR['LOG']->LSET("API_NEWS_GET(...)");
	$news = $AR['DB']->QUERY("SELECT * FROM news WHERE news_fav = '1' ORDER BY news_id DESC"); // �������� ��� ������� ��������� ��� ������ �� �������
	if($AR['DB']->NUMROW($news) == 0){ // ���� ���� ��������� ��� ������� 0 �����
		return NULL; // ���������� NULL - �������� ���
	}else{
		return $news; // ���� �� 0 - �� ������ ���� �������, ���������� �������
	}
}
?>