<?php

namespace Backstage\Crm\Models\Concerns\Contact;

use Illuminate\Database\Eloquent\Model;

trait HasAttributes
{
    public static function bootHasAttributes()
    {
        static::retrieved(function (Model $model) {
            $model->append([
                'name',
            ]);
        });
    }

    public function getNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }
}
