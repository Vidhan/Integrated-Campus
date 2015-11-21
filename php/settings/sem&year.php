<?php
	$month = date('M');
		if ($month == 'Jan'||$month == 'Feb'||$month == 'Mar'||$month == 'Apr'||$month == 'May')
			$sem= 'Winter';
		elseif($month == 'Jun' ||$month =='Jul')
			$sem=  'Summer';
		else $sem=  'Autumn';
define ('PRESENT_YEAR', date('Y'));
define ('PRESENT_SEM', $sem);


?>