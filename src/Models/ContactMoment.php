<?php

namespace Backstage\Crm\Models;

use Backstage\Crm\Filament\Resources\Departments\DepartmentResource;
use Backstage\Crm\Filament\Resources\Organizations\OrganizationResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactMoment extends Model
{
    use SoftDeletes;

    protected $table = 'crm_contact_moments';

    protected $appends = [
        'contactableLabel',
        'contactableUrl',
        'usableContactable',
        'contactableIcon',
    ];

    protected $fillable = [
        'contactable_type',
        'contactable_id',
        'subject',
        'body',
        'contact_date',
    ];

    /**
     * @return Organization|Department
     */
    public function contactable()
    {
        return $this->morphTo();
    }

    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class, 'crm_contact_moment_contact');
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
