<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationLabel = 'Pertanyaan';

    protected static ?string $modelLabel = 'Pertanyaan';

    protected static ?string $pluralModelLabel = 'Pertanyaan';

    protected static ?string $navigationGroup = 'Manajemen Game';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pertanyaan')
                    ->schema([
                        Forms\Components\Select::make('game_id')
                            ->label('Game')
                            ->relationship('game', 'title')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Forms\Components\Textarea::make('question_text')
                            ->label('Teks Pertanyaan')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar Pertanyaan')
                            ->image()
                            ->imageEditor()
                            ->directory('questions/images')
                            ->maxSize(2048)
                            ->helperText('Opsional. Upload jika pertanyaan memerlukan gambar'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Jawaban')
                    ->schema([
                        Forms\Components\TextInput::make('correct_answer')
                            ->label('Jawaban Benar')
                            ->required()
                            ->helperText('Jawaban yang benar untuk pertanyaan ini'),

                        Forms\Components\KeyValue::make('options')
                            ->label('Pilihan Jawaban')
                            ->keyLabel('Opsi')
                            ->valueLabel('Nilai')
                            ->addActionLabel('Tambah Opsi')
                            ->helperText('Opsional. Untuk soal pilihan ganda')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\TextInput::make('points')
                            ->label('Poin')
                            ->numeric()
                            ->default(10)
                            ->required()
                            ->minValue(1)
                            ->maxValue(100),

                        Forms\Components\Select::make('difficulty')
                            ->label('Tingkat Kesulitan')
                            ->options([
                                'easy' => 'Mudah',
                                'medium' => 'Sedang',
                                'hard' => 'Sulit',
                            ])
                            ->default('medium')
                            ->required(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('game.title')
                    ->label('Game')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('question_text')
                    ->label('Pertanyaan')
                    ->searchable()
                    ->limit(50)
                    ->wrap(),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->circular()
                    ->defaultImageUrl(url('/images/no-image.png')),

                Tables\Columns\TextColumn::make('difficulty')
                    ->label('Kesulitan')
                    ->badge()
                    ->colors([
                        'success' => 'easy',
                        'warning' => 'medium',
                        'danger' => 'hard',
                    ]),

                Tables\Columns\TextColumn::make('points')
                    ->label('Poin')
                    ->sortable()
                    ->badge()
                    ->color('info'),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('game')
                    ->relationship('game', 'title')
                    ->searchable()
                    ->preload(),

                Tables\Filters\SelectFilter::make('difficulty')
                    ->label('Kesulitan')
                    ->options([
                        'easy' => 'Mudah',
                        'medium' => 'Sedang',
                        'hard' => 'Sulit',
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('Semua')
                    ->trueLabel('Aktif')
                    ->falseLabel('Nonaktif'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'view' => Pages\ViewQuestion::route('/{record}'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
