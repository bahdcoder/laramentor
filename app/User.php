<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * A user has many mentorship requests.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mentorshipRequests()
    {
        return $this->hasMany(MentorshipRequest::class);
    }

    /**
     * Check if this user has shown interest in a mentorship request.
     *
     * @param MentorshipRequest $mentorshipRequest
     *
     * @return bool
     */
    public function isInterestedIn(MentorshipRequest $mentorshipRequest)
    {
        return $this->interests()->whereMentorshipRequestId($mentorshipRequest->id)->first() !== null;
    }

    /**
     * A user has many interests.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function interests()
    {
        return $this->hasMany(Interest::class);
    }

    /**
     * Show interest in a mentorship request.
     *
     *  @param MentorshipRequest $mentorshipRequest
     *
     *  @return MentorshipRequest $mentorshipRequest
     */
    public function showInterest(MentorshipRequest $mentorshipRequest)
    {
        if (!$this->isInterestedIn($mentorshipRequest) && $mentorshipRequest->user_id !== $this->id) {
            return $mentorshipRequest->interests()->create([
                'user_id' => $this->id,
            ]);
        } else {
            return $mentorshipRequest;
        }
    }
}
