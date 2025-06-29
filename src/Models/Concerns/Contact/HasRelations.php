<?php

namespace Backstage\Crm\Models\Concerns\Contact;

use Backstage\Crm\Models\ContactMoment;
use Backstage\Crm\Models\Organization;
use Backstage\Crm\Models\Tag;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasRelations
{
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable', 'crm_taggables');
    }

    public function contactMoments(): BelongsToMany
    {
        return $this->belongsToMany(ContactMoment::class, 'crm_contact_moment_contact');
    }
}
