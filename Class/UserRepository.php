<?php

class UserRepository extends Repository
{   
    const tableName = 'users'; 
    public function __construct()
    {
        return parent::__construct(self::tableName);
    }
     public function findByEmail(string $email): ?User {
        $stmt = $this->db->prepare("SELECT * FROM {$this->tableName} WHERE email = ?");
        $stmt->execute([$email]);
        $data = $stmt->fetch(PDO::FETCH_OBJ);

        if ($data) {
            return new User($data->id, $data->email, $data->password,$data->role);
        }
        return null;
    }

}