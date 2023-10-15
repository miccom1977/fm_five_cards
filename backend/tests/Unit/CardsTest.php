<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\CardService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CardsTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();

    }

    /** Testujemy, czy system poprawnie losuje nowe karty
     * @return void
     */
    public function test_get_random_cards(): void
    {
        $user = User::first();
        $this->actingAs($user);

        $result = (new CardService())->getNewCard($user);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('card', $result);
    }

    /** Testujemy, czy da się wylosować 6 kart
     * @return void
     */
    public function test_get_six_card(): void
    {
        $user = User::first();
        $this->actingAs($user);
        $response = [];
        for ($i = 0; $i < 6; $i++) {
            $response[] = (new CardService())->getNewCard($user);
        }
        $errorResponse = $response[5];
        $this->assertArrayHasKey('message', $errorResponse);
        $this->assertEquals('Osiągnięto limit 5 kart. Nie można dodać więcej kart.', $errorResponse['message']);

    }

}
