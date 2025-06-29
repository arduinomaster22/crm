<?php

namespace Backstage\Crm\Models\Concerns\Department;

use Backstage\Crm\Models\ContactMoment;
use Backstage\Crm\Models\Organization;
use Backstage\Crm\Models\Tag;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasRelations
{
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
