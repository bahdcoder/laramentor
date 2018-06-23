<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MentorshipRequestInterestsTests extends TestCase
{
    use RefreshDatabase;
    /**
     * A user can show interest in a request.
     *
     * @return void
     */
    public function testAUserCanShowInterestInARequest()
    {
        $request = factory(MentorshipRequest::class);

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->post("requests/{$request->id}/interests");
        $response->assertStatus(200);

        $this->assertEquals($user->interests->count(), 1);
        $this->assertEquals($request->interests->count(), 1);
    }
}
