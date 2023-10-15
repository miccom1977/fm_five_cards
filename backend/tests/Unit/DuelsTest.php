<?php

namespace Tests\Unit;

use App\Models\Duel;
use App\Models\User;
use App\Services\CardService;
use App\Services\DuelService;
use App\Services\RoundService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class DuelsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();

    }

    /** Testujemy utworzenie pojedynku
     * @return Duel
     */
    public function test_create_duel(): Duel
    {
        $user = User::first();
        $this->actingAs($user);
        $randomOpponent = (new DuelService())->getRandomOpponent($user->id);
        $this->assertNotNull($randomOpponent);

        $duel = (new DuelService())->createDuel($user->id, $randomOpponent->id);
        $this->assertNotNull($duel);
        return $duel;
    }

    /** Testujemy utworzenie rundy dla pojedynku
     * @return Duel
     */
    public function test_create_duel_round(): Duel
    {
        $newDuel = $this->test_create_duel();
        $newDuelWithRound = (new RoundService())->createRound($newDuel);
        $this->assertNotNull($newDuelWithRound);
        $roundsCount = $newDuelWithRound->rounds->count();

        $this->assertGreaterThan(0, $roundsCount);

        return $newDuel;

    }

    /** Testujemy wykonanie rundy w pojedynku
     * @return void
     */
    public function test_do_round(): void
    {
        $duel = $this->test_create_duel_round();
        $user = User::first();
        $this->actingAs($user);
        $newUserCard = (new CardService())->getNewCard($user);
        $this->assertIsArray($newUserCard);
        $this->assertArrayHasKey('card', $newUserCard);
        $requestData = [
            'duelId' => $duel['id'],
            'selectedCard' => $newUserCard['card']['id']
        ];
        $request = new Request($requestData);
        $result = (new RoundService())->doRound($request);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('info', $result);
        $this->assertEquals('OK', $result['info']);
    }

}
