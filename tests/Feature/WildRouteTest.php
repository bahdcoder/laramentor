<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WildRouteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A request to an unknown route renders the home view.
     *
     * @return void
     */
    public function testRendersHomeViewForUnknownRoutes()
    {
        $this->get('/UNREGISTERED_ROUTE')->assertViewIs('home');
        $this->get('/lorem/ipsum/dolor')->assertViewIs('home');
        $this->get('/lorem-ipsum-dolor')->assertViewIs('home');
    }
}
