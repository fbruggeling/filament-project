<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\dierras;
use App\Models\diertype;
use App\Models\Patient;
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


class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Naam')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan('full'),
                DatePicker::make('date_of_birth')
                    ->label('Geboortedatum')
                    ->required()
                    ->maxDate(now()),
                Select::make('owner_id')
                    ->label('Eigenaar')
                    ->relationship('owner', 'Voornaam')
                    // ->formatStateUsing(function ($state, Patient $patient) {
                    //     return $patient->owner->Voornaam . ' ' . $patient->owner->Tussenvoegsel . ' ' . $patient->owner->Achternaam;
                    // })
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('status')
                  ->label('Status')
                  ->placeholder('Selecteer een status')
                  ->options([
                      'gezond' => 'Gezond',
                      'in behandeling' => 'In behandeling',
                      'afgemeld' => 'Afgemeld',
                  ])
                  ->required(),
                Section::make('Type & Ras')
                ->schema([
                    Select::make('diertype_id')
                        ->label('Type')
                        ->relationship('diertype', 'type')
                        ->placeholder('Selecteer een type')
                        ->options(diertype::pluck('type', 'id'))
                        ->preload()
                        ->live()
                        ->createOptionForm([
                            TextInput::make('type')
                                ->label('Type Dier')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan('full'),
                        ])
                        ->required(),
                    Select::make('dierras_id')
                            ->label('Ras')
                            ->placeholder('Selecteer een ras/soort')
                            ->relationship('dierras', 'ras')
                            ->options(fn(forms\Get $get) => dierras::where('diertype_id', $get('diertype_id'))->pluck('ras', 'id'))
                            ->disabled(fn(forms\Get $get) : bool => ! filled($get('diertype_id')))
                            ->createOptionForm([
                                TextInput::make('ras')
                                    ->label('Ras')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan('full'),
                                Select::make('diertype_id')
                                    ->label('Type Dier')
                                    ->relationship('diertype', 'type')
                                    ->placeholder('Selecteer een type dier')
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
                    ->label('Naam')
                    ->searchable(),
                TextColumn::make('diertype.type')
                    ->label('Type'),
                TextColumn::make('dierras.ras')
                    ->label('Ras/Soort'),
                TextColumn::make('date_of_birth')
                    ->label('Geboortedatum')
                    ->sortable(),
                TextColumn::make('owner.id')
                    ->label('Eigenaar')
                    ->formatStateUsing(function ($state, Patient $patient) {
                        return $patient->owner->Voornaam . ' ' . $patient->owner->Tussenvoegsel . ' ' . $patient->owner->Achternaam;
                    }),
            ])
            ->filters([
                SelectFilter::make('diertype.type'),
                SelectFilter::make('dierras.ras')
                    
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
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
