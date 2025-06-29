<?php

namespace Backstage\Crm\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $table = 'crm_departments';

    protected $fillable = [
        'organization_id',
        'name',
        'email',
        'phone_number',
        'address',
        'mailing_address',
        'site',
        'branch',
        'total_employees',
    ];

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable', 'crm_taggables');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function contactMoments()
    {
        return $this->morphMany(ContactMoment::class, 'contactable');
    }
}
