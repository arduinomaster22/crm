<?php

namespace Backstage\Crm\Models;

use Backstage\Crm\Models\Concerns\Department as Concerns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use Concerns\HasRelations;
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
}
