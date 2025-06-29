<?php

namespace Backstage\Crm\Models\Concerns\ContactMoment;

use Backstage\Crm\Models\Contact;
use Backstage\Crm\Models\Organization;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRelations
{
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
}
