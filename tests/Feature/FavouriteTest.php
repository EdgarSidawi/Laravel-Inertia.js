<?php

namespace Tests\Feature;

use App\Models\Favourite;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavouriteTest extends TestCase
{
    use DatabaseTransactions;

    public function test_users_can_view_favourites()
    {
        $favourite = Favourite::factory()->create();

        $response = $this->get('/');
        $response->assertOk();
    }
}
