<?php

class DB{
    private static $db = NULL;
    public static function getConnection(){        
        if (is_null(self::$db)){
            
            self::$db   = new PDO('sqlite:BD/whiteboard.db');
            if (!self::$db ) {                
                die("Eroare la deschiderea bazei de date: " . $db->lastErrorMsg());
            }
        }     
        return self::$db;   
    }
    public static function getData($sql, $params){
        if (is_null(self::$db)) self::getConnection();

        $stmt = self::$db->prepare($sql);
        $stmt->execute($params); 

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        return $rows;
    }

    public static function insertData($sql, $params){
        if (is_null(self::$db)) self::getConnection();
        $stm = self::$db->prepare($sql);

        if (count($params)>0){
            for($i=0; $i<count($params); $i++)
            {
                 $stm->bindValue($i+1,  $params[$i]);
            }
        }
        $res = $stm->execute();
    }    

    public static function justExec($sql){
        if (is_null(self::$db)) self::getConnection();
        $stm = self::$db->prepare($sql);       
        $stm->execute();             
    }
}

//  $data = DB::getData("SELECT id, nume FROM persoane WHERE varsta = ? ", [30]);
//  DB::insertData("INSERT INTO persoane(`nume`) values (?)", ["gigel"]);
//  DB::insertData("UPDATE persoane SET nume = ? WHERE id = ?", ["vasile",1]);
//  DB::insertData("DELETE FROM persoane WHERE id = ?", [1]);