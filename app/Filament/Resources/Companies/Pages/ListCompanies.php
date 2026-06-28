<?php

namespace App\Filament\Resources\Companies\Pages;
 
use App\Filament\Resources\Companies\CompanyResource;
use App\Livewire\Companies\MobileCompanyCardList;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;

class ListCompanies extends ListRecords
{
    protected static string $resource = CompanyResource::class;

     protected function isMobile(): bool
    {
        return request()->header('User-Agent')
            && preg_match('/Mobile|Android|iPhone|iPad/i', request()->userAgent());
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getFooter(): ?View
    {
        return view('filament.companies.mobile-footer');
    }
}
