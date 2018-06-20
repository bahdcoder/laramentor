<?php

namespace Tests\Feature;

use App\MentorshipRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateMentorShipRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A user can create a mentorship request.
     *
     * @return void
     */
    public function testAUserCanCreateAMentorshipRequest()
    {
        $this->withoutExceptionHandling();
        $user = factory(\App\User::class)->create();

        $this->actingAs($user);

        $response = $this->post('requests', [
            'for'                 => 'mentor',
            'description'         => 'lorem ipsum',
            'mentorship_duration' => 50, // number of days
            'pairing_time'        => '23:00',
            'session_duration'    => 30, // duration in minutes.
            'days'                => 1011011, // 1 for ON_THIS_DATE, 0 for NOT_ON_THIS_DAY, 7 digits only, one for each day of the week.
        ]);

        $request = MentorshipRequest::first();

        $this->assertNotNull($request);
    }

    public function testDataIsValidatedBeforeSaving()
    {
        $user = factory(\App\User::class)->create();

        $this->actingAs($user);

        $response = $this->post('requests', [
            'pairing_time' => '23:00',
        ]);

        $response->assertSessionHasErrors([
            'for', 'description', 'days', 'mentorship_duration', 'session_duration',
        ]);
    }
}
