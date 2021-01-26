<?php

namespace App\Helpers;

class Helper
{
	public static function transformTimeFormat($strtime, $wv = 0)
	{
		$time = strtotime($strtime);
		$n3w = time() + 3600 * 24 * 21;
		if ($wv && $time > $n3w)
			$time = $n3w;
		return date('Y-m-d H:i:s', $time);
	}

	public static function getDigits($subject)
	{
		$number = '';
		$pattern = '/[0-9]/';
		preg_match_all($pattern, $subject, $matches);
		foreach ($matches[0] as $val)
			$number .= $val;

		return $number;
	}
}
