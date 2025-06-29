<?php

namespace Backstage\Crm\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Backstage\Crm\Models\Concerns\Tag as Concerns;

class Tag extends Model
{
    use Concerns\HasRelations;
    
    protected $table = 'crm_tags';

    protected $fillable = ['name', 'color'];
}
