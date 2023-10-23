<?php

namespace App\Providers;

use App\Models\DadosXML;
use App\Repositories\Interfaces\Cliente\ICliente;
use App\Repositories\Interfaces\Contador\IContador;
use App\Repositories\Interfaces\Usuario\IUsuario;
use App\Repositories\Interfaces\XML\DadosXML\IDadosXML;
use App\Repositories\Interfaces\XML\DetalhesXML\IDetalhesXML;
use App\Repositories\Interfaces\XML\IXML;
use App\Repositories\Interfaces\XML\XMLEventos\IXMLEventos;
use App\Repositories\Repository\Eloquent\Cliente\ClienteRepository;
use App\Repositories\Repository\Eloquent\Contador\ContadorRepository;
use App\Repositories\Repository\Eloquent\Usuario\UsuarioRepository;
use App\Repositories\Repository\Eloquent\XML\DadosXML\DadosXMLRepository;
use App\Repositories\Repository\Eloquent\XML\DetalhesXML\DetalhesXMLRepository;
use App\Repositories\Repository\Eloquent\XML\XMLEventos\XMLEventosRepository;
use App\Repositories\Repository\Eloquent\XML\XMLRepository;
use App\Services\Autenticacao\CadastroService;
use App\Services\Autenticacao\LoginService;
use App\Services\Cliente\ClienteService;
use App\Services\Contador\ContadorService;
use App\Services\XML\DadosXML\DadosXMLService;
use App\Services\XML\DetalhesXML\DetalhesXMLService;
use App\Services\XML\XMLEventos\XMLEventosService;
use App\Services\XML\XMLService;
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
        $this->app->scoped(ClienteService::class, function (Application $app) {
            $clienteRepository = $app->make(ICliente::class);
            $cadastroService = $app->make(CadastroService::class);
            $contadorService = $app->make(ContadorService::class);
            return new ClienteService($clienteRepository, $cadastroService, $contadorService);
        });
        $this->app->scoped(XMLService::class, function (Application $app) {
            $XMLRepository = $app->make(IXML::class);
            return new XMLService($XMLRepository);
        });
        $this->app->scoped(DadosXMLService::class, function (Application $app) {
            $dadosXMLRepository = $app->make(IDadosXML::class);
            $clienteService = $app->make(ClienteService::class);
            return new DadosXMLService($dadosXMLRepository, $clienteService);
        });
        $this->app->scoped(DetalhesXMLService::class, function (Application $app) {
            $detalhesXMLRepository = $app->make(IDetalhesXML::class);
            return new DetalhesXMLService($detalhesXMLRepository);
        });
        $this->app->scoped(XMLEventosService::class, function (Application $app) {
            $XMLEventosRepository = $app->make(IXMLEventos::class);
            return new XMLEventosService($XMLEventosRepository);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(IUsuario::class, UsuarioRepository::class);
        $this->app->bind(IContador::class, ContadorRepository::class);
        $this->app->bind(ICliente::class, ClienteRepository::class);
        $this->app->bind(IXML::class, XMLRepository::class);
        $this->app->bind(IDadosXML::class, DadosXMLRepository::class);
        $this->app->bind(IDetalhesXML::class, DetalhesXMLRepository::class);
        $this->app->bind(IXMLEventos::class, XMLEventosRepository::class);
    }
}
