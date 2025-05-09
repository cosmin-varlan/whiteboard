<?php
class WhiteBoardModel 
{
    public function __construct()
    {

    }    

    public function getAccessibleWhiteBoards($userId){
        $data = DB::getData("select whiteboardID, topic, ownerID from access join whiteboards on whiteboardID = whiteboards.id where userID=?",[$userId]);
        return $data;
    }

    public function addWhiteBoard($params){
        // vreau sa citesc IDul whiteboardului adaugat si pentru asta am nevoie sa ma asigur ca nu isi baga altcineva nasul... asa ca fac tranzactie
        DB::getConnection()->beginTransaction();        
        DB::insertData("INSERT INTO whiteboards('topic', 'ownerID', 'created_at', 'updated_at') values (?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)", [$params["wb_topic"], $_SESSION["user"]["id"]]);                
        $wb = DB::getData("select max(id) as \"maxid\" from whiteboards where ownerID=?",[$_SESSION["user"]["id"]]);        
        DB::insertData("INSERT INTO access('userID', 'whiteboardID', 'created_at', 'updated_at') values (?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)", [$_SESSION["user"]["id"], $wb[0]["maxid"]]);                
        DB::getConnection()->commit();
    }

    public function getWhiteBoardContent($id){
        $mesaje = DB::getData("select name, message from messages join users on users.id=messages.userID where whiteboardID=? order by messages.created_at desc",[$id]);
        return $mesaje;
    }

    public function addMessage($params){
        DB::insertData("INSERT INTO messages('userID', 'whiteboardID', 'message', 'created_at', 'updated_at') values (?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)", [$_SESSION["user"]["id"], $params["whiteboard"], $params["message"]]);                
    }
}

