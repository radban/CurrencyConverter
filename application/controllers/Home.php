<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$course = 0;
		$amount = 0;
		$this->load->model('mconverter');
		$this->data['result'] = $this->mconverter->apicall();
		$this->data['course'] = $course;
		$this->data['amount'] = $amount;
		$this->load->view('converter', $this->data);
	}
	public function convert($amount = '', $from = ''){
		$this->load->model('mconverter');
		$status = 0;
		$course = '';
		if (isset($_GET['amount'])){
			$convert = $this->mconverter->apicall();
			$amount = (int)$_GET['amount'];
			if ($convert){
				$conv = $amount * $convert['info']['quote'];
				$course = "<b>".$amount." ".$_GET['from']." = ".$conv." ".$_GET['to']."</b>";
				$status = 1;
			}else $status = 2;
		}
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output(json_encode(['status'=>$status, 'course' => $course]));
	}
}
