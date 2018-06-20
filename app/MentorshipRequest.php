<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MentorshipRequest extends Model
{
    /**
     * Properties to protect from mass assignment.
     * @var array
     */
    protected $guarded = [];

    /**
     * A request belongs to a user
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A request belongs to many skills
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    /**
     * A request has many interests
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function interests()
    {
        return $this->hasMany(Interest::class);
    }

    /**
     * A Scope for querying only pending mentorship requests
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * A Scope for querying only mentorship requests in progress
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeProgress($query)
    {
        return $query->where('status', 'progress');
    }

    /**
     * A Scope for querying only ended mentorship requests
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeEnded($query)
    {
        return $query->where('status', 'ended');
    }
}
