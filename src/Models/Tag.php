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
        return $this->morphedByMany(Lead::class, 'taggable');
    }

    public function contacts(): MorphToMany
    {
        return $this->morphedByMany(Contact::class, 'taggable');
    }

    public function organizations(): MorphToMany
    {
        return $this->morphedByMany(Organization::class, 'taggable');
    }

    public function departments(): MorphToMany
    {
        return $this->morphedByMany(Department::class, 'taggable');
    }
}
