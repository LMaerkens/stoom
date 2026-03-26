<?php

namespace App\Models;

class User extends BaseModel {
    protected $table = 'users';

    public function create($username, $email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO {$this->table} (username, email, password_hash) VALUES (?, ?, ?)";
        return $this->query($sql, [$username, $email, $hash]);
    }

    public function findByUsername($username) {
        $sql = "SELECT * FROM {$this->table} WHERE username = ?";
        return $this->query($sql, [$username])->fetch();
    }
}
