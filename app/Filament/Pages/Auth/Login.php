<?php

namespace App\Filament\Auth;

use Filament\Auth\Pages\Login as BaseLogin;

// class Login extends BaseLogin
// {
//     protected function getRedirectUrl(): string
//     {
//         return session()->pull(
//             'login_redirect',
//             filament()->getUrl()
//         );
//     }

//     public function mount(): void
//     {
//         parent::mount();

//         if (request()->filled('redirect')) {
//             session([
//                 'login_redirect' => request('redirect'),
//             ]);
//         }
//     }
// }