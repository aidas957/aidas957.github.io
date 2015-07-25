<?php
/* TODO */
/*
-
*/
defined('_ACE3OTA') or die('ERROR'); // Если константы не существует, значит файл попытались открыть напрямую
// Класc MSGClass 
class MSGClass{
	private $OUT;	// Переменная общего вывода
	function MSGClass(){
	}	
	// Функция создания сообщения
	public function SET($MSGIn, $LVL){
		switch($LVL){
			// Информационные сообщения
			case "I": // Информационные сообщения
				$this->OUT .= "<div class='notice'><font color='green'>".$MSGIn."</font></div>"; // Добавляем сообщение в переменную вывода
			break;
			case "W": // Предупреждающие сообщения
				$this->OUT .= "<div class='notice'><font color='blue'>".$MSGIn."</font></div>";	// Добавляем сообщение в переменную вывода
			break;
			// Критическая ошибка
			case "C": // Критические ошибки
				$this->OUT .= "<div class='error'><font color='red'>".$MSGIn."</font></div>"; // Добавляем сообщение в переменную вывода
			break;
		}
	}
	// Функция вывода всех сообщений
	public function Pr(){ 
		return $this->OUT; // Возвращаем переменную со всеми сообщениями
	}	
}
?>