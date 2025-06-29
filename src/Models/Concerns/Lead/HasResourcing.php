<?php

namespace Backstage\Crm\Models\Concerns\Lead;

use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;

trait HasResourcing
{
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
