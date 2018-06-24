<?php

namespace Tests\Feature;

use Cache;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewSharesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * All skills are cached and shared with all views.
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
