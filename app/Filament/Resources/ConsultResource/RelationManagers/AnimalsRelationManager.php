<?php

namespace App\Filament\Resources\ConsultResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnimalsRelationManager extends RelationManager
{
    protected static string $relationship = 'animals';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    // ->label('Naam')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type.type'),
                    // ->label('Type'),
                Tables\Columns\TextColumn::make('breed.breed'),
                    // ->label('Ras/Soort'),
                Tables\Columns\TextColumn::make('date_of_birth')
                    // ->label('Geboortedatum')
                    ->sortable(),
                // Tables\Columns\TextColumn::make('owner.id')
                //     // ->label('Eigenaar')
                //     ->formatStateUsing(function ($state, Animal $patient) {
                //         return $patient->owner->first_name . ' ' . $patient->owner->preposition . ' ' . $patient->owner->last_name;
                //     }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
                Tables\Actions\DetachAction::make()
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
