<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OwnerResource\Pages;
use App\Filament\Resources\OwnerResource\RelationManagers;
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

class OwnerResource extends Resource
{
    protected static ?string $model = Owner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('Voornaam')
                    ->required()
                    ->maxLength(255),
                TextInput::make('Tussenvoegsel')
                    ->maxLength(3),
                TextInput::make('Achternaam')
                    ->required()
                    ->maxLength(255),
                TextInput::make('Emailadres')
                    ->required()
                    ->email()
                    ->label('Email Adres')
                    ->maxLength(255),
                TextInput::make('Telefoonnummer')
                    ->label('Telefoonnummer')
                    ->tel()
                    ->required(),
                TextInput::make('Woonplaats')
                    ->required()
                    ->maxLength(255),
                TextInput::make('Straat')
                    ->required()
                    ->maxLength(255),
                TextInput::make('Huisnummer')
                    ->required()
                    ->maxLength(3),
                TextInput::make('Postcode')
                    ->required()
                    ->maxLength(6),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Voornaam')
                    ->label('Naam')
                    ->formatStateUsing(function ($state, Owner $owner) {
                        return $owner->Voornaam . ' ' . $owner->Tussenvoegsel . ' ' . $owner->Achternaam;
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('Emailadres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Telefoonnummer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Woonplaats')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Straat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Huisnummer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Postcode')
                    ->searchable(),
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
            RelationManagers\PatientsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOwners::route('/'),
            'create' => Pages\CreateOwner::route('/create'),
            'edit' => Pages\EditOwner::route('/{record}/edit'),
        ];
    }
}
