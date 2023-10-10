<?php

namespace App\Providers;

use App\Repositories\Interfaces\Contador\IContador;
use App\Repositories\Interfaces\Usuario\IUsuario;
use App\Repositories\Repository\Eloquent\Contador\ContadorRepository;
use App\Repositories\Repository\Eloquent\Usuario\UsuarioRepository;
use App\Services\Autenticacao\CadastroService;
use App\Services\Autenticacao\LoginService;
use App\Services\Contador\ContadorService;
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
        $this->app->scoped(LoginService::class, function (Application $app) {
            $usuarioRepository = $app->make(IUsuario::class);
            return new LoginService($usuarioRepository);
        });
        $this->app->scoped(ContadorService::class, function (Application $app) {
            $contadorRepository = $app->make(IContador::class);
            $cadastroService = $app->make(CadastroService::class);
            return new ContadorService($contadorRepository, $cadastroService);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(IUsuario::class, UsuarioRepository::class);
        $this->app->bind(IContador::class, ContadorRepository::class);
    }
}
