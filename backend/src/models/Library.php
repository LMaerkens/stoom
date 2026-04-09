<?php

namespace App\Models;

class Library extends BaseModel {
    protected $table = 'libraries';

    public function getUserLibraries($userId) {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ?";
        return $this->query($sql, [$userId])->fetchAll();
    }

    public function createLibrary(int $userId, string $name, ?string $description = null, bool $isPublic = false) {
        $sql = "INSERT INTO {$this->table} (user_id, name, description, is_public) VALUES (?, ?, ?, ?)";
        return $this->query($sql, [$userId, $name, $description, $isPublic ? 1 : 0]);
    }

    public function deleteLibrary(int $userId, int $libraryId) {
        $sql = "DELETE FROM {$this->table} WHERE id = ? AND user_id = ?";
        return $this->query($sql, [$libraryId, $userId]);
    }

    public function getLibrary(int $userId, int $libraryId) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ? AND user_id = ?";
        return $this->query($sql, [$libraryId, $userId])->fetch();
    }

    public function addGame($libraryId, $gameId) {
        $sql = "INSERT IGNORE INTO library_games (library_id, game_id) VALUES (?, ?)";
        return $this->query($sql, [$libraryId, $gameId]);
    }

    public function removeGame(int $libraryId, int $gameId) {
        $sql = "DELETE FROM library_games WHERE library_id = ? AND game_id = ?";
        return $this->query($sql, [$libraryId, $gameId]);
    }

    public function getGames($libraryId) {
        $sql = "SELECT g.* FROM games g 
                JOIN library_games lg ON g.id = lg.game_id 
                WHERE lg.library_id = ?";
        return $this->query($sql, [$libraryId])->fetchAll();
    }
}
