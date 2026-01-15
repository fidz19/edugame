<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Jadwal Les';

    protected static ?string $pluralLabel = 'Jadwal Les';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Academic';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Jadwal')
                    ->schema([
                        Forms\Components\Select::make('student_id')
                            ->label('Siswa')
                            ->required()
                            ->relationship('student', 'nama_anak')
                            ->searchable()
                            ->preload()
                            ->getOptionLabelFromRecordUsing(fn(Student $record) => "{$record->nama_anak} (Kelas {$record->kelas})"),

                        Forms\Components\Select::make('teacher_id')
                            ->label('Guru')
                            ->required()
                            ->relationship('teacher', 'name')
                            ->searchable()
                            ->preload()
                            ->getOptionLabelFromRecordUsing(fn(Teacher $record) => "{$record->name} - {$record->subject}"),

                        Forms\Components\TextInput::make('subject')
                            ->label('Mata Pelajaran')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('day_of_week')
                            ->label('Hari')
                            ->required()
                            ->options([
                                1 => 'Senin',
                                2 => 'Selasa',
                                3 => 'Rabu',
                                4 => 'Kamis',
                                5 => 'Jumat',
                                6 => 'Sabtu',
                                7 => 'Minggu',
                            ]),

                        Forms\Components\TimePicker::make('start_time')
                            ->label('Jam Mulai')
                            ->required()
                            ->seconds(false),

                        Forms\Components\TimePicker::make('end_time')
                            ->label('Jam Selesai')
                            ->required()
                            ->seconds(false)
                            ->after('start_time'),

                        Forms\Components\TextInput::make('location')
                            ->label('Lokasi')
                            ->maxLength(255),

                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.nama_anak')
                    ->label('Siswa')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('student.kelas')
                    ->label('Kelas')
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('teacher.name')
                    ->label('Guru')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('subject')
                    ->label('Mata Pelajaran')
                    ->searchable(),

                Tables\Columns\TextColumn::make('day_of_week')
                    ->label('Hari')
                    ->formatStateUsing(fn($state) => [
                        1 => 'Senin',
                        2 => 'Selasa',
                        3 => 'Rabu',
                        4 => 'Kamis',
                        5 => 'Jumat',
                        6 => 'Sabtu',
                        7 => 'Minggu',
                    ][$state] ?? '-')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('start_time')
                    ->label('Jam')
                    ->formatStateUsing(fn($record) => $record->getTimeRange()),

                Tables\Columns\TextColumn::make('location')
                    ->label('Lokasi')
                    ->toggleable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('day_of_week')
                    ->label('Hari')
                    ->options([
                        1 => 'Senin',
                        2 => 'Selasa',
                        3 => 'Rabu',
                        4 => 'Kamis',
                        5 => 'Jumat',
                        6 => 'Sabtu',
                        7 => 'Minggu',
                    ]),

                Tables\Filters\SelectFilter::make('teacher_id')
                    ->label('Guru')
                    ->relationship('teacher', 'name'),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('Semua')
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('day_of_week', 'asc');
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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
