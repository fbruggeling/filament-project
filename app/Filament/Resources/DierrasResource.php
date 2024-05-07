<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DierrasResource\Pages;
use App\Filament\Resources\DierrasResource\RelationManagers;
use App\Models\dierras;
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

class DierrasResource extends Resource
{
    protected static ?string $model = Dierras::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('diertype_id')
                    ->label('Type Dier')
                    ->relationship('diertype', 'type')
                    ->placeholder('Selecteer een type dier')
                    ->preload()
                    ->required(),
                TextInput::make('ras')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('diertype.type')
                    ->label('Type'),
                TextColumn::make('ras')
                    ->label('Ras'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDierras::route('/'),
            'create' => Pages\CreateDierras::route('/create'),
            'edit' => Pages\EditDierras::route('/{record}/edit'),
        ];
    }
}
