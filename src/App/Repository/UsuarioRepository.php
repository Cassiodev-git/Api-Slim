<?php
    namespace App\Repository;

    use PDO;

    class UsuarioRepository {
        private PDO $pdo;

        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }

        public function getUsuarios(): array {
            $stmt = $this->pdo->prepare("SELECT id, nome FROM usuarios");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function setUsuario($nome, $email){
            $sql = "
                insert into usuarios (nome, email) values (:nome, :email)
            ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':email', $email);
            $stmt->execute();

            return [
                "Success" => true,
                "id" => $this->pdo->lastInsertId()//mostra o id do ultimo registro no banco
            ];
            
        }
    }

?>