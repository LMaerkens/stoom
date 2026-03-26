<?php

use App\Models\Game;
use App\Models\User;

return [
    '/api/games' => function() {
        $model = new Game();
        return $model->all();
    },
    '/api/users' => function() {
        $model = new User();
        return $model->all();
    },
    '/api/status' => function() {
        return ["status" => "online", "message" => "Backend is actief"];
    }
];
