<?php

namespace Backstage\Crm\Models\Concerns\ContactMoment;

use Backstage\Crm\Filament\Resources\Departments\DepartmentResource;
use Backstage\Crm\Filament\Resources\Organizations\OrganizationResource;
use Backstage\Crm\Models\Department;
use Backstage\Crm\Models\Organization;
use Illuminate\Database\Eloquent\Model;

trait HasAttributes
{
    public static function bootHasAttributes()
    {
        static::retrieved(function (Model $model) {
            $model->append([
                'contactableLabel',
                'contactableUrl',
                'usableContactable',
                'contactableIcon',
            ]);
        });
    }

    public function getContactableLabelAttribute()
    {
        $contactable = $this->contactable;

        if ($contactable instanceof Department) {
            return $contactable->name . ' (' . __('department') . ')';
        }

        if ($contactable instanceof Organization) {
            return $contactable->name . ' (' . __('organization') . ')';
        }
    }

    public function getContactableUrlAttribute()
    {
        $contactable = $this->contactable;

        if ($contactable instanceof Department) {
            return DepartmentResource::getUrl('view', [
                'record' => $contactable,
            ]);
        }

        if ($contactable instanceof Organization) {
            return OrganizationResource::getUrl('view', [
                'record' => $contactable,
            ]);
        }

        return null;
    }

    public function getUsableContactableAttribute()
    {
        return $this->getAttribute('contactableUrl') ?? false;
    }

    public function getContactableIconAttribute()
    {
        $contactable = $this->contactable;

        if ($contactable instanceof Department) {
            return DepartmentResource::getNavigationIcon();
        }

        if ($contactable instanceof Organization) {
            return OrganizationResource::getNavigationIcon();
        }

        return null;
    }
}
