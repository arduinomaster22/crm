<?php

namespace Backstage\Crm\Models;

use Backstage\Crm\Models\Concerns\ContactMoment as Concerns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactMoment extends Model
{
    use Concerns\HasRelations;
    use SoftDeletes;

    protected $table = 'crm_contact_moments';

    protected $fillable = [
        'contactable_type',
        'contactable_id',
        'subject',
        'body',
        'contact_date',
    ];
}
