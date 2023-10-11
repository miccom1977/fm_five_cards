<?php

namespace App\Policies;

use App\Models\{Card, Role, User};

class CardPolicy
{
    /**
     * Admin ma prawo do wszystkich operacji.
     * @param User $user
     * @return bool|null
     */
    public function before(User $user): ?bool
    {
        // Jeśli użytkownik jest administratorem, to ma dostęp do wszystkich poniższych operacji
        if ($user->role_id === Role::ADMIN) {
            return true;
        }
    }

    /**
     * Określamy czy użytkownik może przeglądać daną kartę
     * @param User $user
     * @param Card $card
     * @return bool
     */
    public function view(User $user, Card $card): bool
    {
        // przeglądać karty można swoje lub jeśli jesteś adminem to wszystkie
        return $user->id === $card->user_id;
    }

    /**
     * Kto może tworzyć karty.
     * @return bool
     */
    public function create(): bool
    {
        // Tylko administrator może tworzyć nowe karty
        return false;
    }

    /**
     * Kto może edytować karty.
     * @return bool
     */
    public function update(): bool
    {
        // Tylko administrator może edytować karty
        return false;
    }

    /**
     * Kto może usuwać karty.
         * @return bool
     */
    public function delete()
    {
        // Tylko administrator może usuwać karty
        return false;
    }
}
