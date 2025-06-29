<?php

namespace Backstage\Crm\Models;

use Backstage\Crm\Models\Concerns\Lead as Concerns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use Concerns\HasAttributes;
    use Concerns\HasRelations;
    use Concerns\HasResourcing;
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
}
