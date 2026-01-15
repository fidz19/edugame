<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameTemplateResource\Pages;
use App\Models\GameTemplate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class GameTemplateResource extends Resource
{
    protected static ?string $model = GameTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static ?string $navigationLabel = 'Template Game';

    protected static ?string $pluralLabel = 'Template Game';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Game Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Template')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Informasi Dasar')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Section::make('Informasi Template')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Nama Template')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),

                                        Forms\Components\TextInput::make('slug')
                                            ->label('Slug')
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->maxLength(255)
                                            ->helperText('URL-friendly name (auto-generated)'),

                                        Forms\Components\Select::make('template_type')
                                            ->label('Jenis Template')
                                            ->required()
                                            ->options(GameTemplate::getAvailableTypes())
                                            ->searchable(),

                                        Forms\Components\TextInput::make('icon')
                                            ->label('Icon/Emoji')
                                            ->maxLength(255)
                                            ->helperText('Contoh: 🎮, 📝, 🎯'),

                                        Forms\Components\Textarea::make('description')
                                            ->label('Deskripsi')
                                            ->rows(3)
                                            ->columnSpanFull(),

                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Aktif')
                                            ->default(true),
                                    ])
                                    ->columns(2),
                            ]),

                        Forms\Components\Tabs\Tab::make('Kode Template')
                            ->icon('heroicon-o-code-bracket')
                            ->schema([
                                Forms\Components\Section::make('HTML Template')
                                    ->description('Tulis kode HTML untuk tampilan game. Gunakan placeholder {{questions}} untuk posisi soal.')
                                    ->schema([
                                        Forms\Components\Textarea::make('html_template')
                                            ->label('HTML Code')
                                            ->rows(15)
                                            ->placeholder('<!DOCTYPE html>
<html>
<head>
    <title>Game Template</title>
</head>
<body>
    <div id="game-container">
        {{questions}}
    </div>
</body>
</html>')
                                            ->columnSpanFull(),
                                    ])
                                    ->collapsible(),

                                Forms\Components\Section::make('CSS Style')
                                    ->description('Tulis kode CSS untuk styling game.')
                                    ->schema([
                                        Forms\Components\Textarea::make('css_style')
                                            ->label('CSS Code')
                                            ->rows(15)
                                            ->placeholder('/* Style untuk game */
#game-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.question {
    background: #f5f5f5;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 15px;
}')
                                            ->columnSpanFull(),
                                    ])
                                    ->collapsible()
                                    ->collapsed(),

                                Forms\Components\Section::make('JavaScript Code')
                                    ->description('Tulis kode JavaScript untuk logika game.')
                                    ->schema([
                                        Forms\Components\Textarea::make('js_code')
                                            ->label('JavaScript Code')
                                            ->rows(15)
                                            ->placeholder('// Game logic
document.addEventListener("DOMContentLoaded", function() {
    // Initialize game
    initGame();
});

function initGame() {
    // Your game logic here
}

function checkAnswer(selected, correct) {
    return selected === correct;
}')
                                            ->columnSpanFull(),
                                    ])
                                    ->collapsible()
                                    ->collapsed(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Konfigurasi Lanjutan')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                Forms\Components\Section::make('Preview & Config')
                                    ->schema([
                                        Forms\Components\FileUpload::make('preview_image')
                                            ->label('Preview Image')
                                            ->image()
                                            ->directory('template-previews')
                                            ->helperText('Upload gambar preview untuk template ini'),

                                        Forms\Components\Textarea::make('config_schema')
                                            ->label('Config Schema (JSON)')
                                            ->rows(10)
                                            ->helperText('JSON schema untuk konfigurasi template ini')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Template')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('icon')
                    ->label('Icon'),

                Tables\Columns\TextColumn::make('template_type')
                    ->label('Jenis')
                    ->badge()
                    ->formatStateUsing(fn($state) => GameTemplate::getAvailableTypes()[$state] ?? $state)
                    ->color('info'),

                Tables\Columns\TextColumn::make('games_count')
                    ->label('Jumlah Game')
                    ->counts('games')
                    ->badge()
                    ->color('success'),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('template_type')
                    ->label('Jenis Template')
                    ->options(GameTemplate::getAvailableTypes()),

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
            'index' => Pages\ListGameTemplates::route('/'),
            'create' => Pages\CreateGameTemplate::route('/create'),
            'edit' => Pages\EditGameTemplate::route('/{record}/edit'),
        ];
    }
}
