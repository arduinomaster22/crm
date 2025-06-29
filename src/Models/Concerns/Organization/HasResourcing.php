<?php

namespace Backstage\Crm\Models\Concerns\Organization;

use Illuminate\Support\Collection;

trait HasResourcing
{
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
}
