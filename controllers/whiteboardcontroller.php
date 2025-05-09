<?php
class WhiteBoardController extends Controller
{
    public function __construct($action, $params)
    {
		parent::__construct();

        // la astea nu poate ajunge decat daca este setat userul (vezi index.php)
        if ($action=="showWhiteBoard") $this->showWhiteBoard($params);
        if ($action=="addWhiteBoard")  $this->addWhiteBoard($params);
        if ($action=="addMessage") $this->addMessage($params);
	}

    private function showWhiteBoard($whiteBoardID=NULL){
        $availableWhiteBoards = $this->model->getAccessibleWhiteBoards($_SESSION["user"]["id"]);
        if ($whiteBoardID!=NULL && $whiteBoardID[0] != 0)
        {
            $whiteBoardContent = $this->model->getWhiteBoardContent($whiteBoardID[0]);
        }
        else
        {
            $whiteBoardID[0] = 0;
            $whiteBoardContent[0]["name"] = "Admin";
            $whiteBoardContent[0]["message"] = "Va rog selectati un WhiteBoard din lista aflata in partea stanga.";
        }

        echo $this->view->showWhiteBoard($availableWhiteBoards, $whiteBoardContent, $whiteBoardID[0]);        
    }

    private function addWhiteBoard($params){
        //print_rr($params);
        $this->model->addWhiteBoard($params);
        header('Location: '.$_SESSION["siteAddress"]."WhiteBoardController/showWhiteBoard");  
    }

    private function addMessage($params){
        if ($params["message"]!='') $this->model->addMessage($params);
        header('Location: '.$_SESSION["siteAddress"]."WhiteBoardController/showWhiteBoard/".$params["whiteboard"]);        
    }
}