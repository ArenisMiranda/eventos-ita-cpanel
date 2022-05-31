<?php
/*
$conn = mysqli_connect(
    'localhost',
    'root',
    '1423',
    'cursos'
); 
*/
class Database{
    static public function conectar(){
        try{
           $pdo = new PDO("mysql:host=localhost;port=3306;dbname=conveni2_eventos", "conveni2_vinculacion" , "JA^*Ui!&SSr#");
           // $pdo = new PDO("mysql:host=localhost;port=3306;dbname=conferencias", "root" , "1423");
            $pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
            $pdo -> exec("set names utf8");
            
            return $pdo;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }
    }

}
