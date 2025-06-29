<?php

namespace Backstage\Crm\Models\Concerns\Organization;

use Backstage\Crm\Models\Contact;
use Backstage\Crm\Models\ContactMoment;
use Backstage\Crm\Models\Department;
use Backstage\Crm\Models\Lead;
use Backstage\Crm\Models\Tag;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasRelations
{
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable', 'crm_taggables');
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    public function contactMoments()
    {
        return $this->morphMany(ContactMoment::class, 'contactable');
    }
}
