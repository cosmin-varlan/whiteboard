<?php
class LandingController extends Controller
{
	private $user;

    public function __construct($action, $params)
    {
		parent::__construct();
        if ($action=="none"){
            echo $this->view->displayLandingPage();
        }
	}
}