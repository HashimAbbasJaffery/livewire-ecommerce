<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    public function infolist(\Filament\Infolists\Infolist $infolist): \Filament\Infolists\Infolist {
        return $infolist->schema([
            Section::make("Buyer's info")
                ->schema([
                    TextEntry::make("first_name"),
                    TextEntry::make("last_name"),
                    TextEntry::make("street_address"),
                    TextEntry::make("apartment"),
                    TextEntry::make("city"),
                    TextEntry::make("email"),
                    TextEntry::make("phone"),
                    TextEntry::make("order_placed")
                        ->getStateUsing(function($record) {
                            return \Carbon\Carbon::parse($record->created_at)->diffForHumans();
                        }),
                    TextEntry::make("order_notes")
                        ->getStateUsing(function($record) {
                            return ($record->order_notes ?? "-");
                        })
                        ->columnSpanFull()
                ])->columns(2),
            RepeatableEntry::make("products")
                ->schema([
                    TextEntry::make("title"),
                    TextEntry::make("price")
                        ->getStateUsing(function($record) {
                            $quantity = $record->pivot->quantity;
                            $price = $record->pivot->price;
                            return "{$quantity} x {$price} = " . $quantity*$price;
                        }),
                    TextEntry::make("quantity")
                        ->getStateUsing(function($record) {
                            return $record->pivot->quantity;
                        }),
                    ImageEntry::make("Image")
                        ->getStateUsing(function($record) {
                            dd($record->pivot);
                            return $record->pivot->variant ?? "dummy.jpg";
                        })
                ]),

            Section::make("Payment details")
                ->schema([
                    TextEntry::make("Subtotal")
                        ->getStateUsing(function($record) {
                            $total = 0;
                            foreach($record->products as $product) {
                                $total += $product->pivot->price * $product->pivot->quantity;
                            }
                            return $total . " RS";
                        }),
                    TextEntry::make("Total")
                        ->getStateUsing(function($record) {
                            $total = 0;
                            foreach($record->products as $product) {
                                $total += $product->pivot->price * $product->pivot->quantity;
                            }
                            return ($total + 250) . " RS";
                        })
                ])
        ]);
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
