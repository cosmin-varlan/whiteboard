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

}

