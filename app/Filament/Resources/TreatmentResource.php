<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TreatmentResource\Pages;
use App\Filament\Resources\TreatmentResource\RelationManagers;
use App\Models\Treatment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Section;

class TreatmentResource extends Resource
{
    protected static ?string $model = Treatment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('treatment')
                    // ->label('Behandeling')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan('full'),
                Textarea::make('notes')
                    // ->label('Beschrijving')
                    ->maxLength(65535)
                    ->columnSpan('full'),
                TextInput::make('price')
                    // ->label('Prijs')
                    ->numeric()
                    ->prefix('€')
                    ->maxValue(42949672.95),
                TextInput::make('duration')
                    // ->label('Behandeltijd')
                    ->suffix('Minutes')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('treatment'),
                    // ->label('Behandeling'),
                TextColumn::make('price')
                    // ->label('Prijs')
                    ->money('EUR')
                    ->sortable(),
                TextColumn::make('duration')
                    // ->label('Behandeltijd')
                    ->suffix(' Minutes')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    // ->label('Aangemaakt op')
                    ->dateTime(),
            ])
            ->filters([
                
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTreatments::route('/'),
            'create' => Pages\CreateTreatment::route('/create'),
            'edit' => Pages\EditTreatment::route('/{record}/edit'),
        ];
    }

    // public static function getModelLabel(): string
    // {
    //     return __('Treatment');
    // }

    // public static function getPluralModelLabel(): string
    // {
    //     return __('Treatments');
    // }
}
