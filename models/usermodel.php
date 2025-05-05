<?php
class UserModel 
{
    public function __construct()
    {

    }    

    public function getDataByEmail($email){        
        $data = DB::getData("select id, name, nick, email, password from users where email=?",[$email]);
        return $data;
    }    

    public function register($params){
        $hash_parola = password_hash($params["parola"], PASSWORD_DEFAULT);
        DB::insertData("INSERT INTO users('name', 'nick', 'email', 'password', 'created_at', 'updated_at') values (?,?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)", [$params["nume"], $params["nume"], $params["email"], $hash_parola]);
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
        $mesaje = DB::getData("select name, message from messages join users on users.id=messages.userID where whiteboardID=?",[$id]);
        return $mesaje;
    }
}

