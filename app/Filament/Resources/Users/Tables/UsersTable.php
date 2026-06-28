<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('email')
                    ->searchable()
                    ->toggleable(),

                BadgeColumn::make('role')
                    ->label('Tipe')
                    ->colors([
                        'primary' => 'ga',
                        'success' => 'staf',
                    ])
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'ga' => 'General Affair',
                        'staf' => 'Staf',
                    }),

                BadgeColumn::make('gender')
                    ->label('Gender')
                    ->colors([
                        'info' => 'M',
                        'danger' => 'F',
                    ])
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'M' => 'Laki-laki',
                        'F' => 'Perempuan',
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
            //
        ])
            ->recordActions([
            EditAction::make(),
        ])
            ->toolbarActions([
            BulkActionGroup::make([
                    DeleteBulkAction::make(),
            ]),
        ]);
    }
}
