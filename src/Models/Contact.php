<?php

namespace Backstage\Crm\Models;

use Backstage\Crm\Models\Concerns\Contact as Concerns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use Concerns\HasAttributes;
    use Concerns\HasRelations;
    use SoftDeletes;

    protected $table = 'crm_contacts';

    protected $fillable = [
        'organization_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'job_title',
        'address_street',
        'address_zipcode',
        'address_city',
        'address_country',
        'notes',
    ];
}
