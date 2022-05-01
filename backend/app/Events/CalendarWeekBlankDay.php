<?php
namespace App\Events;

/**
* 余白を出力するためのクラス
*/
class CalendarWeekBlankDay extends CalendarWeek {

    function getClassName(){
		return "day-blank";
	}

	/**
	 * @return
	 */
	function render(){
		return '';
	}

}