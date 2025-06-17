<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // <-- Tambahkan ini!

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $view->with('adminlte_user', (object)[
                'name' => 'Kelompok 14',
                'image' => 'https://i.pinimg.com/736x/1a/cb/01/1acb015b92c3458832128d3516da2422.jpg',
                'desc' => 'Sistem POS',
            ]);
        });
    }
}
