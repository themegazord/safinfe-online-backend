<?php

namespace App\Providers;

use App\Repositories\Interfaces\Usuario\IUsuario;
use App\Repositories\Repository\Eloquent\Usuario\UsuarioRepository;
use App\Services\Autenticacao\CadastroService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->scoped(CadastroService::class, function (Application $app) {
            $usuarioRepository = $app->make(IUsuario::class);
            return new CadastroService($usuarioRepository);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(IUsuario::class, UsuarioRepository::class);
    }
}
