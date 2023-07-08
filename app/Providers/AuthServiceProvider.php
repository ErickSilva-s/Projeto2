<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verificação de Email Feira na Mão')
                ->line("Olá,  obrigado por se cadastrar no Feira na Mão, mas pra continuar precisamos verificar seu email. Para isso, clique no botão abaixo. Caso ao apertar no botão  e já esteja logado, saia da sua conta, clique no botão novamente e faça seu login. ")
                ->action('Verificar Email', $url);
        });
    }


}
