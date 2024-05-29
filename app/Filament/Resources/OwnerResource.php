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
// use Filament\Resources\Concerns\Translatable;

class OwnerResource extends Resource
{
    protected static ?string $model = Owner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('preposition')
                    ->maxLength(7),
                TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                Select::make('gender')
                    ->label('Gender')
                    ->placeholder('Select a gender')
                    // Options from options table
                    ->relationship('option', 'optionvalue', function ($query) {
                        $query->where('optionname', '=', 'OwnerGender');
                    })
                    // Hardcoded Options
                    // ->options([
                    //     'male' => 'Male',
                    //     'female' => 'Female',
                    //     'other' => 'Other'
                    // ])
                    ->required(),
                TextInput::make('email')
                    ->required()
                    ->email()
                    // ->label('Email Adres')
                    ->maxLength(255),
                TextInput::make('phone_number')
                    // ->label('Telefoonnummer')
                    ->tel()
                    ->required(),
                TextInput::make('street')
                    ->required()
                    ->maxLength(255),
                TextInput::make('house_number')
                    ->required()
                    ->maxLength(3),
                TextInput::make('postal_code')
                    ->required()
                    ->maxLength(6),
                TextInput::make('city')
                    ->required()
                    ->maxLength(255),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Name')
                    // Formatting for whole name in 1 column instead of 3 seperate columns
                    ->formatStateUsing(function ($state, Owner $owner) {
                        return $owner->first_name . ' ' . $owner->preposition . ' ' . $owner->last_name;
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('street')
                    ->searchable(),
                Tables\Columns\TextColumn::make('house_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('postal_code')
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
            // Relationmanager for animal relations
            RelationManagers\AnimalRelationManager::class,
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
