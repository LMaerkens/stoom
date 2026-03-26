<?php

namespace App\Models;

class Game extends BaseModel {
    protected $table = 'games';

    public function search($query) {
        $sql = "SELECT * FROM {$this->table} WHERE title LIKE ?";
        return $this->query($sql, ["%$query%"])->fetchAll();
    }

    public function getWithGenres($id) {
        $sql = "SELECT g.*, GROUP_CONCAT(ge.name) as genres 
                FROM games g 
                LEFT JOIN game_genres gg ON g.id = gg.game_id 
                LEFT JOIN genres ge ON gg.genre_id = ge.id 
                WHERE g.id = ? 
                GROUP BY g.id";
        return $this->query($sql, [$id])->fetch();
    }
}
