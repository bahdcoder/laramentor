<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowMentorshipInterestTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAUserCanShowInterestInAMentorshipRequest()
    {
        $this->withoutExceptionHandling();
        $user = factory(\App\User::class)->create();

        $mentorshipRequest = factory(\App\MentorshipRequest::class)->create([
            'user_id' => $user->id
        ]);

        $userInterested = factory(\App\User::class)->create();

        $this->actingAs($userInterested);

        $response = $this->post("requests/{$mentorshipRequest->id}/interests");

        $response->assertStatus(200);

        $interest = $mentorshipRequest->interests->first();

        $this->assertEquals($userInterested->name, $interest->user->name);
        $this->assertEquals($interest->status, 'pending');
    }
}
