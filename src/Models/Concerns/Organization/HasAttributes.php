<?php

namespace Backstage\Crm\Models\Concerns\Organization;

use Illuminate\Database\Eloquent\Model;

trait HasAttributes
{
    public static function bootHasAttributes()
    {
        static::retrieved(function (Model $model) {
            $model->append([
                'fullAddress',
                'fullMailingAddress',
            ]);
        });
    }

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
