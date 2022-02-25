<?php

namespace Tests\Unit;

use App\Models\Favourite;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FavouriteTest extends TestCase
{
    use DatabaseTransactions;

    public function test_favourite_has_name_attribute()
    {
        $favourite = Favourite::factory()->make();

        $this->assertEquals($favourite->name, $favourite->name);
    }
}
