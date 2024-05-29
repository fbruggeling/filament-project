<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsultResource\Pages;
use App\Filament\Resources\ConsultResource\RelationManagers;
use App\Models\Consult;
use App\Models\Owner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;

class ConsultResource extends Resource
{
    protected static ?string $model = Consult::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Consult')
                    ->required(),
                Textarea::make('notes')
                    ->required()
                    ->columnSpan('full'),
                Datepicker::make('date')
                    ->required(),
                Select::make('status')
                    // Options from database table options
                    ->options(function () {
                        return \App\Models\Option::where('optionname', 'ConsultStatus')
                            ->pluck('optionvalue', 'optionvalue')
                            ->toArray();
                    })
                    // Hardcoded Options
                    // ->options([
                    //     'planned' => 'Planned',
                    //     'in treatment' => 'In Treatment',
                    //     'done' => 'Done'
                    // ])
                    ->required(),
                Section::make('Details')
                ->schema([
                    Select::make('owner_id')
                        // Making the relationship between consult and owner
                        ->relationship('owner', 'first_name')
                        // Making sure the full name is shown in the select field
                        ->options(function () {
                            return Owner::withFullName()->get()->pluck('full_name', 'id');
                        })
                        ->placeholder('Select a Owner')
                        ->preload()
                        ->required(),
                    Select::make('animal_id')
                        // Making the relationship between consult and animal
                        ->relationship('animal', 'name')
                        // Putting a placeholder in the select field
                        ->placeholder('Select a animal')
                        ->preload()
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('owner.id')
                    ->formatStateUsing(function ($state, Consult $patient) {
                        return $patient->owner->first_name . ' ' . $patient->owner->preposition . ' ' . $patient->owner->last_name;
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
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
            RelationManagers\TreatmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConsults::route('/'),
            'create' => Pages\CreateConsult::route('/create'),
            'edit' => Pages\EditConsult::route('/{record}/edit'),
        ];
    }
}
