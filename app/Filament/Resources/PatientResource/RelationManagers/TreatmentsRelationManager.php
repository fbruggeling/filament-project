<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TreatmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'treatments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->label('Behandeling')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan('full'),
                Forms\Components\Textarea::make('notes')
                    ->label('Beschrijving')
                    ->maxLength(65535)
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('price')
                    ->label('Prijs')
                    ->numeric()
                    ->prefix('€')
                    ->maxValue(42949672.95),
                Forms\Components\TextInput::make('duration')
                    ->label('Behandeltijd')
                    ->suffix('Minuten')
                    ->numeric()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->label('Behandeling'),
                Tables\Columns\TextColumn::make('price')
                    ->label('Prijs')
                    ->money('EUR')
                    ->sortable(),
                    Tables\Columns\TextColumn::make('duration')
                    ->label('Behandeltijd')
                    ->suffix(' Minuten')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Aangemaakt op'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
