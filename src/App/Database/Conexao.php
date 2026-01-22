<?php
    namespace App\Database;

    use PDO;
    use PDOException;

    class Conexao{

        public static function Connection(): PDO
        {
            try{
                return new PDO(
                "",
                "",
                "",
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]
            );
            
            }catch(PDOException $e ){
                die('Erro no banco'. $e->getMessage());

            }
        }


    }







?>