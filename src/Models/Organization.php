<?php

namespace Backstage\Crm\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Backstage\Crm\Models\Concerns\Organization as Concerns;

class Organization extends Model
{
    use Concerns\HasRelations;
    use Concerns\HasResourcing;
    use Concerns\HasAttributes;
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

    public function getFullAddressAttribute(): string
    {
        $addressParts = [
            $this->address_street,
            $this->address_house_number,
            $this->address_zipcode,
            $this->address_city,
            $this->address_country,
        ];

        return implode(', ', array_filter($addressParts));
    }

    public function getFullMailingAddressAttribute(): string
    {
        $mailingAddressParts = [
            $this->mailing_address_street,
            $this->mailing_address_house_number,
            $this->mailing_address_zipcode,
            $this->mailing_address_city,
            $this->mailing_address_country,
        ];

        return implode(', ', array_filter($mailingAddressParts));
    }
}
