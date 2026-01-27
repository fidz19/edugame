<?php

namespace App\Filament\Resources\GameResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'Questions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pertanyaan')
                    ->schema([
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question_text')
            ->columns([
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
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
