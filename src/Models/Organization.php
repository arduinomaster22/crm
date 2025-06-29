<?php

namespace Backstage\Crm\Models;

use Backstage\Crm\Models\Concerns\Organization as Concerns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use Concerns\HasAttributes;
    use Concerns\HasRelations;
    use Concerns\HasResourcing;
    use SoftDeletes;

    protected $table = 'crm_organizations';

    protected $fillable = [
        'name',
        'logo',
        'body',
        'website',
        'address_street',
        'address_zipcode',
        'type',
        'email',
        'total_employees',
        'phone',
        'branch',
        'mailing_address_street',
        'relation',
        'address_house_number',
        'address_city',
        'address_country',
        'mailing_address_house_number',
        'mailing_address_zipcode',
        'mailing_address_city',
        'mailing_address_country',
    ];
}
