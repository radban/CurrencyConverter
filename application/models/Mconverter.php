<?php
class Mconverter extends CI_Model {

	public function __construct(){
	}
	public function apicall(){
		$curl = curl_init();
		if (empty($date))
			$date = date('Y-m-d');
		$date2 = strtotime($date.' +1 days');
		$cmd = 'list'; // list of currencies
		// if has amount params - convert
		if (isset($_GET['amount'])){
			if ( is_numeric($_GET['amount'])){
				$amount = (int)$_GET['amount'];
				$to = $_GET['to'];
				$from = $_GET['from'];
				$cmd = 'convert?to='.$to.'&from='.$from.'&amount='.$amount;
				if (!empty($_GET['date'])){
					$dt = explode('/', $_GET['date']);
					$date = $dt[2].'-'.$dt[0].'-'.$dt[1];
					$cmd .= '&date='.$date;
				}
			}else {
				return false;
			}
		}
		$end = date('Y-m-d', $date2);
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.apilayer.com/currency_data/".$cmd,
			CURLOPT_HTTPHEADER => array(
				"Content-Type: text/plain",
				"apikey: k2w045XeYfk02HdNOAcoMprNJP7Zd8ov"
			),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET"
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$response = json_decode($response, true);
		if ($response['success'] == 1)
			return $response;
		return false;
	}
}
