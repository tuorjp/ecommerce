<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Actions\Action as ActionsAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 2;
    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('Order ID')
                    ->sortable(),
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('grand_total')
                    ->money('BRL'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state):string => match($state){
                        'new' => 'info',
                        'processing' => 'warning',
                        'shipped' => 'success',
                        'delivered' => 'success',
                        'canceled' => 'canceled',
                    })
                    ->icon(fn(string $state):string => match($state){
                        'new' => 'heroicon-m-sparkles',
                        'processing' => 'heroicon-m-arrow-path',
                        'shipped' => 'heroicon-m-truck',
                        'delivered' => 'heroicon-m-home',
                        'canceled' => 'heroicon-m-x-circle',
                    })
                    ->sortable(),

                TextColumn::make('payment_method')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('payment-status')
                    ->sortable()
                    ->searchable()
                    ->badge(),
                
                TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime(),
            ])
            ->actions([
                ActionsAction::make('View Order')
                ->url(fn (Order $record):string => OrderResource::getUrl('view', ['record' => $record]))
                ->icon('heroicon-m-eye')
            ]);
    }
}