<?php

namespace App\Policies;

use App\Models\{Role, User};

class AdminPolicy
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
     * Dodawanie kart jako admin.
     *
     * @return bool
     */
    public function addCards(): bool
    {
        // Tylko administrator może dodawać karty użytkowników
        return false;
    }

    /**
     * Usuwanie kart jako admin.
     *
     * @return bool
     */
    public function removeCards(): bool
    {
        // Tylko administrator może usuwać karty od użytkowników
        return false;
    }

    /**
     * Podgląd kart jako admin.
     *
     * @return bool
     */
    public function viewCards(): bool
    {
        // Tylko administrator może przeglądać karty użytkowników
        return false;
    }
}
