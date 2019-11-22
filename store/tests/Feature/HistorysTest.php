<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HistorysTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testListHistory()
    {
        $response = $this->get('/store/api/v1/history');

        $response->assertStatus(200);
    }
}
