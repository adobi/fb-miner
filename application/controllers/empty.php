<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'MY_Controller.php';

class  extends MY_Controller {

	public function index()
	{
		$this->template->build('/index');
	}
}

