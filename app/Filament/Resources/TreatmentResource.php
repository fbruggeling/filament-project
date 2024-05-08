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
// use Filament\Resources\Concerns\Translatable;

class TreatmentResource extends Resource
{
    protected static ?string $model = Treatment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // protected static ?string $title = 'Behandelingen';

    // protected static ?string $navigationLabel = 'Behandelingen';

    // protected static ?string $slug = 'behandelingen';

    // protected ?string $heading = 'Behandelingen';

    // protected ?string $subheading = 'Behandelingen';

    // use Translatable;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('treatment')
                    // ->label('Behandeling')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan('full'),
                Forms\Components\Textarea::make('notes')
                    // ->label('Beschrijving')
                    ->maxLength(65535)
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('price')
                    // ->label('Prijs')
                    ->numeric()
                    ->prefix('€')
                    ->maxValue(42949672.95),
                Forms\Components\TextInput::make('duration')
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
                Tables\Columns\TextColumn::make('treatment'),
                    // ->label('Behandeling'),
                Tables\Columns\TextColumn::make('price')
                    // ->label('Prijs')
                    ->money('EUR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration')
                    // ->label('Behandeltijd')
                    ->suffix(' Minutes')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
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
