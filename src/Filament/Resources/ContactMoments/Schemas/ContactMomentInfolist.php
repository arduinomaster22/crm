<?php

namespace Backstage\Crm\Filament\Resources\ContactMoments\Schemas;

use BackedEnum;
use Backstage\Crm\Filament\Resources\ContactMoments\ContactMomentResource;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;

class ContactMomentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->columns(9)
                    ->schema([
                        Section::make(__('Contact Moment'))
                            ->icon(fn (): BackedEnum => ContactMomentResource::getNavigationIcon())
                            ->schema([
                                TextEntry::make('subject')
                                    ->label(__('Subject'))
                                    ->icon(fn (): BackedEnum => ContactMomentResource::getNavigationIcon()),

                                TextEntry::make('body')
                                    ->label(__('Body'))
                                    ->html(),
                            ])
                            ->columnSpan(6),

                        Grid::make()
                            ->columns(1)
                            ->schema([
                                Section::make(__('Organization / Department'))
                                    ->icon(fn (): BackedEnum => Heroicon::OutlinedUser)
                                    ->schema([
                                        TextEntry::make('contactableLabel')
                                            ->label(__('Contactable'))
                                            ->default(__('Deleted'))
                                            ->hintActions([
                                                Action::make('view')
                                                    ->label(__('View'))
                                                    ->visible(fn (Model $record): bool => $record->getAttribute('usableContactable'))
                                                    ->icon(fn (Model $record) => $record->getAttribute('contactableIcon'))
                                                    ->url(fn (Model $record): string => $record->getAttribute('contactableUrl')),
                                            ]),
                                    ])
                                    ->columnSpanFull(),

                                Section::make(__('Date'))
                                    ->icon(fn (): BackedEnum => Heroicon::OutlinedCalendarDateRange)
                                    ->schema([
                                        TextEntry::make('contact_date')
                                            ->label(__('Contact Date'))
                                            ->icon(fn (): BackedEnum => Heroicon::OutlinedCalendarDateRange)
                                            ->date(),
                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columnSpan(3),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
