<?php
class UserController extends Controller
{
    public function __construct($action, $params)
    {
		parent::__construct();
        if ($action=="auth") $this->auth($params);
        if ($action=="register") $this->register($params);

	}

    private function auth($params){
        $user = $this->model->getDataByEmail($params["email"]);
        if (count($user)>0 && password_verify($params["parola"], $user[0]["password"]))
        {
            unset($user[0]["password"]);
            $_SESSION["user"] = $user[0];
        }      
        
        header('Location: '.$_SESSION["siteAddress"]."WhiteBoardController/showWhiteBoard");    
    }

    private function register($params){        
        if ($params["parola"]!=$params["parola2"]) 
        {
            echo "Parolele sunt diferite";
            exit();            
        }
        $this->model->register($params);
        $this->auth($params);
    }

     
}