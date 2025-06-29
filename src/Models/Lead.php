<?php

namespace Backstage\Crm\Models;

use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes;

    protected $table = 'crm_leads';

    protected $fillable = [
        'organization_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'source',
        'status',
        'notes',
    ];

    public function getNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable', 'crm_taggables');
    }

    public static function getAvailableStatuses(): array
    {
        return [
            'new' => __('New'),
            'contacted' => __('Contacted'),
            'qualified' => __('Qualified'),
            'unqualified' => __('Unqualified'),
            'converted' => __('Converted'),
            'lost' => __('Lost'),
        ];
    }

    public static function getAvailableStatusesColors(): array
    {
        return [
            'new' => Color::Blue,
            'contacted' => Color::Amber,
            'qualified' => Color::Emerald,
            'unqualified' => Color::Rose,
            'converted' => Color::Indigo,
            'lost' => Color::Zinc,
        ];
    }

    public static function getAvailableStatusesIcons(): array
    {
        return [
            'new' => Heroicon::OutlinedLink,
            'contacted' => Heroicon::OutlinedPhone,
            'qualified' => Heroicon::OutlinedCheckCircle,
            'unqualified' => Heroicon::OutlinedXCircle,
            'converted' => Heroicon::OutlinedCheck,
            'lost' => Heroicon::OutlinedXMark,
        ];
    }

    public static function getAvailableSources(): array
    {
        return [
            'website' => __('Website'),
            'referral' => __('Referral'),
            'social_media' => __('Social Media'),
            'event' => __('Event'),
            'other' => __('Other'),
        ];
    }

    public static function getAvailableSourcesIcons(): array
    {
        return [
            'website' => Heroicon::OutlinedGlobeAlt,
            'referral' => Heroicon::OutlinedUserGroup,
            'social_media' => Heroicon::OutlinedChatBubbleLeftEllipsis,
            'event' => Heroicon::OutlinedCalendar,
            'other' => Heroicon::OutlinedDocumentText,
        ];
    }

    public static function getAvailableSourcesColors(): array
    {
        return [
            'website' => Color::Blue,
            'referral' => Color::Green,
            'social_media' => Color::Purple,
            'event' => Color::Orange,
            'other' => Color::Gray,
        ];
    }
}
