<?php

namespace Backstage\Crm\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Organization extends Model
{
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

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }
}
