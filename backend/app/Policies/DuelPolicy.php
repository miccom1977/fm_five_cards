<?php

namespace App\Policies;

use App\Models\{Duel, User};
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class DuelPolicy
{
    use HandlesAuthorization;

    /**
     * Rozpoczęcie nowej gry.
     * @return bool
     */
    public function start(): bool
    {
        // Rozpocząć nową grę może każdy zalogowany użytkownik
        return Auth::check();
    }

    /**
     * Dołączenie do trwającej gry.
     * @param Duel $game
     * @return bool
     */
    public function join(Duel $duel): bool
    {
        // Pobierz liczbę użytkowników w danej grze
        $numberOfUsers = $duel->users()->count();
        // jeśli liczba użytkowników w grze jest mniejsza niż 2 można dołączyć się do gry
        return Auth::check() && $numberOfUsers < 2;
    }

    /**
     * Wybór karty.
     * @param User $user
     * @param Duel $duel
     * @return bool
     */
    public function chooseCard(User $user, Duel $duel): bool
    {
        // Dostęp do wyboru karty w trakcie gry mają użytkownicy, którzy są uczestnikami gry.
        return Auth::check() && $duel->hasParticipant($user);
    }

    /**
     * Wyświetlanie gry.
     * @param User $user
     * @param Duel $duel
     * @return bool
     */
    public function view(User $user, Duel $duel): bool
    {
        // Dostęp do przeglądania informacji o grze mają tylko uczestnicy gry
        return Auth::check() && $duel->hasParticipant($user);
    }

}
