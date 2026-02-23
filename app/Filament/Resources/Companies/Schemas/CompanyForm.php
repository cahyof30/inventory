<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 TextInput::make('slug')
                    ->label('Singkatan')
                    ->required(),
                 TextInput::make('company_name')
                    ->label('Nama Perusahaan')
                    ->required(),
            ]);
    }
}
