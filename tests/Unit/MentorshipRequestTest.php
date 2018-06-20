<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MentorshipRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAMentorshipRequestBelongsToAUser()
    {
        $user = factory(\App\User::class)->create();

        $mentorshipRequest = factory(\App\MentorshipRequest::class)->create([
            'user_id' => $user->id,
        ]);

        $this->assertEquals($user->name, $mentorshipRequest->user->name);
    }
}
