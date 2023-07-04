<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use mikehaertl\pdftk\Pdf;

class PdfServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Pdf::class, function () {
            return new Pdf();
        });
    }
}
