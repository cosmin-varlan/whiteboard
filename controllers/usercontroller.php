<?php
class UserController extends Controller
{
    public function __construct($action, $params)
    {
		parent::__construct();
        if ($action=="auth") $this->auth($params);
        if ($action=="register") $this->register($params);

        // la astea nu poate ajunge decat daca este setat userul (vezi index.php)
        if ($action=="showWhiteBoard") $this->showWhiteBoard($params);
        if ($action=="addWhiteBoard")  $this->addWhiteBoard($params);
	}

    private function auth($params){
        $user = $this->model->getDataByEmail($params["email"]);
        if (count($user)>0 && password_verify($params["parola"], $user[0]["password"]))
        {
            $_SESSION["user"] = $user[0];
        }      
        
        header('Location: '.$_SESSION["siteAddress"]."UserController/showWhiteBoard");    
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

    private function showWhiteBoard($whiteBoardID=NULL){
        $availableWhiteBoards = $this->model->getAccessibleWhiteBoards($_SESSION["user"]["id"]);
        if ($whiteBoardID!=NULL)
        {
            $whiteBoardContent = $this->model->getWhiteBoardContent($whiteBoardID[0]);
        }
        else
        {
            $whiteBoardContent[0]["name"] = "Admin";
            $whiteBoardContent[0]["message"] = "Va rog selectati un WhiteBoard din lista aflata in partea stanga.";
        }

        echo $this->view->showWhiteBoard($availableWhiteBoards, $whiteBoardContent);        
    }

    private function addWhiteBoard($params){
        //print_rr($params);
        $this->model->addWhiteBoard($params);
        header('Location: '.$_SESSION["siteAddress"]."UserController/showWhiteBoard");  
    }

     
}