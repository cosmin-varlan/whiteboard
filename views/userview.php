<?php
class UserView 
{

    public function __construct(){

	}
    
    public function showWhiteBoard($availableWhiteBoards, $content){
        $template = new Template(DIRECTOR_SITE.SLASH."views".SLASH."TPL".SLASH."whiteboard.tpl");        
    
        $whiteBoards = "";
        for($i=0; $i<count($availableWhiteBoards); $i++){
            $whiteBoards.=("<a href=\"".$_SESSION["siteAddress"]."UserController/showWhiteBoard/".$availableWhiteBoards[$i]["whiteboardID"]."\">".$availableWhiteBoards[$i]["topic"]."</a><br>");
        }
        
        $whiteBoardContent="";
        for($i=0; $i<count($content); $i++){
            $whiteBoardContent.=($content[$i]["name"].": ".$content[$i]["message"]."<br>\n");
        }

        $template->assign('WhiteBoards', $whiteBoards);
        $template->assign('ThisWhiteBoard', $whiteBoardContent);
        $template->assign('SiteAddress', $_SESSION["siteAddress"]);

        ob_start();
        echo $template->show();        
        $this->output = ob_get_contents();
        ob_end_clean();        
        return $this->output;
    }
}