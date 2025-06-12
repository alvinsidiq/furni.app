<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FurnituresResource\Pages;
use App\Filament\Resources\FurnituresResource\RelationManagers;
use App\Models\Furnitures;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FurnituresResource extends Resource
{
    protected static ?string $model = Furnitures::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\FileUpload::make('image')
                ->image()
                ->disk('public')
                ->directory('images')
                ->downloadable()
                ->deletable()
                ->preserveFilenames()
                ->previewable(false) // nonaktifkan preview
                ->openable(false),  
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('image')
                ->label('Gambar')
                ->getStateUsing(fn ($record) => asset('storage/' . $record->image))
                ->formatStateUsing(fn ($state) => '<img src="' . $state . '" loading="lazy" class="w-16 h-16 object-cover rounded-md" />')
                ->html(),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListFurnitures::route('/'),
            'create' => Pages\CreateFurnitures::route('/create'),
            'edit' => Pages\EditFurnitures::route('/{record}/edit'),
        ];
    }
}
