<?php

namespace Tests\Feature;

use Cache;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewSharesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * All skills are cached and shared with all views
     *
     * @return void
     */
    public function testCachedSkillsAreSharedWithAllViews()
    {
        Cache::shouldReceive('remember')
                    ->with('skills', 1440, \Closure::class);

        $response = $this->get('/request-pool');

        $response->assertViewIs('home')
            ->assertViewHas('skills');
    }
}
