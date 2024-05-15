<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnimalResource\Pages;
use App\Filament\Resources\AnimalResource\RelationManagers;
use App\Models\Breed;
use App\Models\Type;
use App\Models\Animal;
use Closure;
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


class AnimalResource extends Resource
{
    protected static ?string $model = Animal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // protected static ?string $title = 'Dieren';

    // protected static ?string $navigationLabel = 'Dieren';

    // protected static ?string $slug = 'dieren';

    // protected ?string $heading = 'Dieren';

    // protected ?string $subheading = 'Dieren';

    // use Translatable;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    // ->label('Naam')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan('full'),
                    Select::make('gender')
                    ->placeholder('Select a gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->required(),
                DatePicker::make('date_of_birth')
                    // ->label('Geboortedatum')
                    ->required()
                    ->maxDate(now()),
                Select::make('owner_id')
                    // ->label('Eigenaar')
                    ->relationship('owner', 'first_name')
                    ->formatStateUsing(function (Animal $animal) {
                        // $owner = $animal->owner;
                        if ($animal->owner) {
                            return $animal->owner->first_name . ' ' . $animal->owner->preposition . ' ' . $animal->owner->last_name;
                        } else {
                            return null; // Of een fallback-waarde die je wilt weergeven als de eigenaar niet beschikbaar is
                        }
                    })
                    ->searchable()
                    ->preload()
                    ->required(),                
                Select::make('status')
                //   ->label('Status')
                  ->placeholder('Select a status')
                  ->options([
                      'alive' => 'Alive',
                      'death' => 'Death',
                  ])
                  ->required(),
                Section::make('Type & Breed')
                ->schema([
                    Select::make('type_id')
                        ->relationship('type', 'type')
                        ->placeholder('Select a type')
                        ->options(Type::pluck('type', 'id'))
                        ->preload()
                        ->live()
                        ->createOptionForm([
                            TextInput::make('type')
                                ->label('Animal type')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan('full'),
                        ])
                        ->required(),
                    Select::make('breed_id')
                            ->placeholder('Select a breed')
                            ->relationship('breed', 'breed')
                            ->options(fn(forms\Get $get) => breed::where('type_id', $get('type_id'))->pluck('breed', 'id'))
                            ->disabled(fn(forms\Get $get) : bool => ! filled($get('type_id')))
                            ->createOptionForm([
                                TextInput::make('breed')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan('full'),
                                Select::make('type_id')
                                    ->label('Animal type')
                                    ->relationship('type', 'type')
                                    ->placeholder('Select a animal type')
                                    ->required(),
                            ])
                            ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    // ->label('Naam')
                    ->searchable(),
                TextColumn::make('type.type'),
                    // ->label('Type'),
                TextColumn::make('breed.breed'),
                    // ->label('Ras/Soort'),
                TextColumn::make('date_of_birth')
                    // ->label('Geboortedatum')
                    ->sortable(),
                TextColumn::make('owner.id')
                    // ->label('Eigenaar')
                    ->formatStateUsing(function ($state, Animal $patient) {
                        return $patient->owner->first_name . ' ' . $patient->owner->preposition . ' ' . $patient->owner->last_name;
                    }),
            ])
            ->filters([
                SelectFilter::make('type.type'),
                SelectFilter::make('breed.breed')
                    
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
            'index' => Pages\ListAnimals::route('/'),
            'create' => Pages\CreateAnimal::route('/create'),
            'edit' => Pages\EditAnimal::route('/{record}/edit'),
        ];
    }

    // public static function getModelLabel(): string
    // {
    //     return __('Animal');
    // }

    // public static function getPluralModelLabel(): string
    // {
    //     return __('Animals');
    // }
}