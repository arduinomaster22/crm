<?php

namespace Backstage\Crm\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Lead extends Model
{
    use SoftDeletes;

    protected $table = 'crm_leads';

    protected $fillable = [
        'organization_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'source',
        'status',
        'notes',
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
