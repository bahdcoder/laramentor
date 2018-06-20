<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    /**
     * Properties to protect from mass assignment.
     * @var array
     */
    protected $guarded = [];

    /**
     * A skill belongs to many requests
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function mentorshipRequests()
    {
        return $this->belongsToMany(MentorshipRequest::class);
    }
}
