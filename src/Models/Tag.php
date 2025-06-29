<?php

namespace Backstage\Crm\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    protected $table = 'crm_tags';

    protected $fillable = ['name', 'color'];

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
