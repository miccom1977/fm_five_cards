<?php

namespace App\Services;

use App\Models\{Level, Role, User};

class UserService {

    /** Metoda tworzy nowego gracza
     * @param array $userDataRequest
     * @return User
     */
    public function create(array $userDataRequest): User
    {
        $data = $userDataRequest;
        $data['role_id'] = Role::PLAYER;
        $data['level_points'] = 0;
        return User::create($data);
    }

    /** Metoda prezentuje dane gracza
     * @param User $user
     * @return array
     */
    public function getUserProfile(User $user): array
    {
        $levels = Level::orderBy('point_threshold', 'asc')->get();
        $userPoints = $user->level_points;
        $level = null;
        $nextLevel = null;

        foreach ($levels as $index => $currentLevel) {
            if ($userPoints >= $currentLevel->point_threshold) {
                $level = $currentLevel;
                $nextLevel = $levels[$index + 1] ?? null;
            }
        }

        return [
            'id' => $user->id,
            'username' => $user->username,
            'level' => $level->id,
            'level_points' => $user->level_points,
            'next_level_points' => $nextLevel->point_threshold,
            'cards' => $user->cards,
            'new_card_allowed' => ($user->cards->count() < 5),
        ];
    }
}
