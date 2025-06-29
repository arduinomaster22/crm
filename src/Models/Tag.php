<?php

namespace Backstage\Crm\Models;

use Backstage\Crm\Models\Concerns\Tag as Concerns;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Concerns\HasRelations;

    protected $table = 'crm_tags';

    protected $fillable = ['name', 'color'];
}
