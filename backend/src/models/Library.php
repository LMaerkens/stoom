<?php

namespace App\Models;

class Library extends BaseModel {
    protected $table = 'libraries';

    public function getUserLibraries($userId) {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ?";
        return $this->query($sql, [$userId])->fetchAll();
    }

    public function addGame($libraryId, $gameId) {
        $sql = "INSERT INTO library_games (library_id, game_id) VALUES (?, ?)";
        return $this->query($sql, [$libraryId, $gameId]);
    }

    public function getGames($libraryId) {
        $sql = "SELECT g.* FROM games g 
                JOIN library_games lg ON g.id = lg.game_id 
                WHERE lg.library_id = ?";
        return $this->query($sql, [$libraryId])->fetchAll();
    }
}
