<?php

namespace Backstage\Crm\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

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
        return $this->morphToMany(Tag::class, 'taggable', 'crm_taggables');
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

    public function contactMoments()
    {
        return $this->morphMany(ContactMoment::class, 'contactable');
    }

    public static function getOrganizationRelations(): Collection
    {
        return new Collection([
            'interested' => 'Interested',
            'initiator' => 'Initiator',
            'not_applicable' => 'Not applicable',
            'partner' => 'Partner',
            'supplier' => 'Supplier',
            'customer' => 'Customer',
            'competitor' => 'Competitor',
            'other' => 'Other',
        ]);
    }

    public static function getOrganizationTypes(): Collection
    {
        return new Collection([
            'company' => __('Company'),
            'government' => __('Government'),
            'non_profit' => __('Non-profit'),
            'educational_institution' => __('Educational Institution'),
            'other' => __('Other'),
        ]);
    }

    public static function getOrganizationIndustries(): Collection
    {
        return new Collection([
            'construction' => __('Construction'),
            'culture_and_recreation' => __('Culture and Recreation'),
            'financial_services' => __('Financial Services'),
            'municipalities' => __('Municipalities'),
            'green_and_living_environment' => __('Green and Living Environment'),
            'hospitality' => __('Hospitality'),
            'it_and_innovation' => __('IT and Innovation'),
            'childcare' => __('Childcare'),
            'lifestyle' => __('Lifestyle'),
            'education' => __('Education'),
            'research' => __('Research'),
            'other' => __('Other'),
            'sports_and_exercise' => __('Sports and Exercise'),
            'nutrition' => __('Nutrition'),
            'work_and_income' => __('Work and Income'),
            'housing_construction' => __('Housing Construction'),
            'care_and_welfare' => __('Care and Welfare'),
        ]);
    }

    public static function getTotalEmployeesOptions(): Collection
    {
        return new Collection([
            'unknown' => __('Unknown'),
            '1-10' => '1-10',
            '11-50' => '11-50',
            '51-200' => '51-200',
            '201-500' => '201-500',
            '501-1000' => '501-1,000',
            '1001-5000' => '1,001-5,000',
            '5001-10000' => '5,001-10,000',
            '10001+' => '10,001+',
        ]);
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
