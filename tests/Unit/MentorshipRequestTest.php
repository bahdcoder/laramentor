<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\MentorshipRequest;
use  Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MentorshipRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A mentorship request belongs to a user
     *
     * @return void
     */
    public function testAMentorshipRequestBelongsToAUser()
    {
        $user = factory(\App\User::class)->create();

        $mentorshipRequest = factory(MentorshipRequest::class)->create([
            'user_id' => $user->id,
        ]);

        $this->assertEquals($user->name, $mentorshipRequest->user->name);
    }

    /**
     * A mentorship request belongs to many skills
     *
     * @return void
     */
    public function testAMentorshipRequestBelongsToManySkills()
    {
        $relationship = (new MentorshipRequest())->skills();
        $this->assertInstanceOf(BelongsToMany::class, $relationship);
    }

    /**
     * Test the mentorship request pending scope.
     *
     * @return void
     */
    public function testMentorshipRequestPendingScope()
    {
        factory(MentorshipRequest::class, 4)->states('pending')->create();
        factory(MentorshipRequest::class, 4)->states('ended')->create();

        $pendingRequests = MentorshipRequest::pending()->get();

        $this->assertEquals($pendingRequests->count(), 4);
    }

    /**
     * Test the mentorship request progress scope.
     *
     * @return void
     */
    public function testMentorshipRequestProgressScope()
    {
        factory(MentorshipRequest::class, 4)->states('progress')->create();
        factory(MentorshipRequest::class, 3)->states('ended')->create();

        $pendingRequests = MentorshipRequest::progress()->get();

        $this->assertEquals($pendingRequests->count(), 4);
    }

    /**
     * Test the mentorship request ended scope.
     *
     * @return void
     */
    public function testMentorshipRequestEndedScope()
    {
        factory(MentorshipRequest::class, 4)->states('progress')->create();
        factory(MentorshipRequest::class, 3)->states('ended')->create();

        $pendingRequests = MentorshipRequest::ended()->get();

        $this->assertEquals($pendingRequests->count(), 3);
    }

    /**
     * Test the mentorship request has many interests.
     *
     * @return void
     */
    public function testMentorshipRequestHasManyInterests()
    {
        $mentorshipRequest = factory(MentorshipRequest::class)->create();

        $mentorshipRequest->interests()->create([
            'user_id' => 1
        ]);

        $this->assertEquals($mentorshipRequest->count(), 1);
    }
}
