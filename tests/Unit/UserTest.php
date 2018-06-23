<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use App\MentorshipRequest;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A user has many mentorhisp requests.
     *
     * @return void
     */
    public function testAUserHasManyMentorshipRequests()
    {
        $user = factory(User::class)->create();

        $request = $user->mentorshipRequests()->create([
            'for' => 'mentor',
            'description' => 'desc',
            'pairing_time' => '20:00',
            'days' => 49,
            'session_duration' => 20,
            'mentorship_duration' => 20
        ]);

        $this->assertEquals($user->mentorshipRequests->count(), 1);
    }

    /**
     * A user has many interests.
     *
     * @return void
     */
    public function testAUserHasManyInterests()
    {
        $user = factory(User::class)->create();

        $user->interests()->create([
            'mentorship_request_id' => 1
        ]);

        $this->assertEquals($user->interests->count(), 1);
    }

    /**
     * A user can show interest in a mentorship request.
     *
     * @return void
     */
    public function testAUserCanShowInterestInARequest()
    {
        $request = factory(MentorshipRequest::class)->create();

        $user = factory(User::class)->create();

        $user->showInterest($request);

        $this->assertEquals($request->interests->count(), 1);

        $interest = $request->interests->first();

        $this->assertEquals($interest->user_id, $user->id);
    }

    /**
     * A user can show interest in a mentorship request only once.
     *
     * @return void
     */
    public function testAUserCanShowInterestInARequestOnlyOnce()
    {
        $request = factory(MentorshipRequest::class)->create();

        $user = factory(User::class)->create();

        $user->showInterest($request);
        $user->showInterest($request);


        $this->assertEquals($request->interests->count(), 1);
    }

    /**
     * A user can show interest in a mentorship request only if user did not create it.
     *
     * @return void
     */
    public function testAUserCanShowInterestInARequestOnlyIfUserDidnotCreateIt()
    {
        $user = factory(User::class)->create();

        $request = factory(MentorshipRequest::class)->create([
            'user_id' => $user->id
        ]);

        $user->showInterest($request);

        $this->assertEquals($request->interests->count(), 0);
    }

    /**
     * A user is interested in request.
     *
     * @return void
     */
    public function testAUserIsInterestedInRequest()
    {
        $request = factory(MentorshipRequest::class)->create();
        $request2 = factory(MentorshipRequest::class)->create();

        $user = factory(User::class)->create();

        $user->showInterest($request);

        $this->assertTrue($user->isInterestedIn($request));
        $this->assertFalse($user->isInterestedIn($request2));
    }
}
