<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make("title")
                    ->required(),
                TextInput::make("price")
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0)
                    ->suffix("PKR"),
                TextInput::make("new_price")
                    ->suffix("PKR")
                    ->numeric()
                    ->minValue(0)
                    ->default(0)
                    ->nullable(),
                TextInput::make("quantity")
                    ->default(0),
                Textarea::make("description")
                    ->required()
                    ->minLength(25)
                    ->maxLength(500),
                Toggle::make("status"),
                RichEditor::make("extra_description")
                    ->required()
                    ->minLength(25)
                    ->maxLength(500),
                Repeater::make('images')
                    ->relationship("images")
                    ->schema([
                        FileUpload::make("image")
                            ->multiple(false)
                            ->required()
                            ->maxFiles(1),
                        Select::make("color")
                            ->options(
                                \App\Models\Color::pluck('color', 'id')->toArray()
                            )
                            ->required()
                            ->searchable()
                            ->createOptionForm([
                                TextInput::make("color")
                            ])
                            ->createOptionUsing(function($data) {
                                $color = \App\Models\Color::create([
                                    "color" => $data["color"]
                                ]);
                                return $color->id;
                            })
                    ]),
                Select::make("categories")
                    ->label("Categories")
                    ->relationship("categories")
                    ->multiple()
                    ->options(
                        Category::pluck("category", "id")->toArray()
                    )
                    ->searchable()
                    ->getSearchResultsUsing(function (string $search) {
                        return Category::where('category', 'like', "%{$search}%")->limit(50)->pluck("category", "id")->toArray();
                    })
                    ->getOptionLabelsUsing(function (array $values) {
                        return Category::where("id", $values)->pluck("category", "id")->toArray();
                    }),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make("images.image")
                    ->label("Products")
                    ->square()
                    ->stacked(),
                TextColumn::make("title"),
                TextColumn::make("price")
                    ->formatStateUsing(function($record) {
                        if($record->price) {
                            return $record->price . " PKR";
                        }
                    }),
                TextColumn::make("new_price")
                    ->formatStateUsing(function($record) {
                        if($record->new_price) {
                            return $record->new_price . " PKR";
                        }
                    }),
                TextColumn::make("quantity")->default("-"),
                BooleanColumn::make("status")
                    ->action(function($record) {
                        $record->status = !$record->status;
                        $record->save();
                    }),

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
            ])
            ->paginated();
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
