<?php

class Uptime{

  public function getUpTime(){

	$time = microtime(true) - \pocketmine\START_TIME;

	$seconds = floor($time % 60);
	$minutes = null;
	$hours = null;
	$days = null;

	if($time >= 60){
		$minutes = floor(($time % 3600) / 60);

		if($time >= 3600){
			$hours = floor(($time % (3600 * 24)) / 3600);
			
			if($time >= 3600 * 24){
				$days = floor($time / (3600 * 24));

			}
		}
	}

	$uptime =
		($minutes !== null ?
		($hours !== null ?
		($days !== null ?
			"$days 日 "
			: "") . "$hours 時間 "
			: "") . "$minutes 分 "
			: "") . "$seconds 秒";

	return $uptime;
  }
}
