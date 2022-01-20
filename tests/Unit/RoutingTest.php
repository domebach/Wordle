<?php

namespace Tests\Unit;

use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function it_shows_index_page()
    {
        $this->get(route('index'))->assertStatus(200);
    }
}
