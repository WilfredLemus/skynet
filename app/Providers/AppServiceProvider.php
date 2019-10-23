<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Schema::defaultStringLength(191);
        // Route::resourceVerbs([
        //     'create' => 'crear',
        //     'edit' => 'editar',
        // ]);

        // Audit::creating(function (Audit $model) {
        //     if (empty($model->old_values) && empty($model->new_values)) {
        //         return false;
        //     }
        // });
        // setlocale(LC_ALL, 'es_GT.utf8');
        // Carbon::setLocale(config('app.locale'));
    }
}
