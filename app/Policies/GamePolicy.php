<?php

namespace App\Policies;

use App\Models\{Game, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class GamePolicy
{
    use HandlesAuthorization;

    /**
     * Rozpoczęcie nowej gry.
     * @return bool
     */
    public function start(): bool
    {
        // Rozpocząć nowej gry ma każdy zalogowany użytkownik
        return Auth::check();
    }

    /**
     * Dołączenie do trwającej gry.
     * @param Game $game
     * @return bool
     */
    public function join(Game $game)
    {
        // Pobierz liczbę użytkowników w danej grze
        $numberOfUsers = $game->users()->count();
        // jeśli liczba użytkowników w grze jest mniejsza niż 2 mozna dołaczyć się do gry
        return Auth::check() && $numberOfUsers < 2;
    }

    /**
     * Wybór karty.
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function chooseCard(User $user, Game $game)
    {
        // Dostęp do wyboru karty w trakcie gry mają użytkownicy, którzy są uczestnikami gry.
        return Auth::check() && $game->hasParticipant($user);
    }

    /**
     * Wyświetlanie gry.
     * @param User $user
     * @param Game $game
     * @return bool
     */
    public function view(User $user, Game $game)
    {
        // Dostęp do przeglądania informacji o grze mają tylko uczestnicy gry
        return Auth::check() && $game->hasParticipant($user);
    }

}
