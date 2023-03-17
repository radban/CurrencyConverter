<?php
class Converter_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	public function api($from, $to){
		$course = 0;
		$convert = file_get_contents('https://api.apilayer.com/exchangerates_data/convert?to='.$to.'&from='.$from.'&amount=1&apikey=k2w045XeYfk02HdNOAcoMprNJP7Zd8ov');
		$currency = json_decode($convert, true);
		if (count($currency['result'])){
			if (isset($currency['result']) && $currency['success'] == 1)
				$course = $currency['result'];
 		}
		return $course;
	}

}
