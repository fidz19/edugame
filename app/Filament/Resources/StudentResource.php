<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Siswa';

    protected static ?string $modelLabel = 'Siswa';

    protected static ?string $pluralModelLabel = 'Siswa';

    protected static ?string $navigationGroup = 'Manajemen Pengguna';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Siswa')
                    ->schema([
                        Forms\Components\TextInput::make('nama_anak')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('kelas')
                            ->label('Kelas')
                            ->options([
                                1 => 'Kelas 1',
                                2 => 'Kelas 2',
                                3 => 'Kelas 3',
                                4 => 'Kelas 4',
                                5 => 'Kelas 5',
                                6 => 'Kelas 6',
                            ])
                            ->required(),

                        Forms\Components\Select::make('parent_id')
                            ->label('Orang Tua')
                            ->relationship('parent', 'parent_name')
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_anak')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('kelas')
                    ->label('Kelas')
                    ->badge()
                    ->color('success')
                    ->formatStateUsing(fn($state) => "Kelas {$state}")
                    ->sortable(),

                Tables\Columns\TextColumn::make('parent.parent_name')
                    ->label('Orang Tua')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Terdaftar')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kelas')
                    ->label('Kelas')
                    ->options([
                        1 => 'Kelas 1',
                        2 => 'Kelas 2',
                        3 => 'Kelas 3',
                        4 => 'Kelas 4',
                        5 => 'Kelas 5',
                        6 => 'Kelas 6',
                    ]),

                Tables\Filters\SelectFilter::make('parent')
                    ->relationship('parent', 'parent_name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
