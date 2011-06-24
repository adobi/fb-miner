<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'MY_Controller.php';

class Welcome extends MY_Controller {

	public function index()
	{
		$this->template->build('welcome/welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */