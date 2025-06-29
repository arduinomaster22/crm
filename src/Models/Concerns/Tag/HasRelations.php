<?php

namespace Backstage\Crm\Models\Concerns\Tag;

use Backstage\Crm\Models\Contact;
use Backstage\Crm\Models\Department;
use Backstage\Crm\Models\Lead;
use Backstage\Crm\Models\Organization;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasRelations
{
    public function leads(): MorphToMany
    {
        return $this->morphedByMany(Lead::class, 'taggable', 'crm_taggables');
    }

    public function contacts(): MorphToMany
    {
        return $this->morphedByMany(Contact::class, 'taggable', 'crm_taggables');
    }

    public function organizations(): MorphToMany
    {
        return $this->morphedByMany(Organization::class, 'taggable', 'crm_taggables');
    }

    public function departments(): MorphToMany
    {
        return $this->morphedByMany(Department::class, 'taggable', 'crm_taggables');
    }
}
