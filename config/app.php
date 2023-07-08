<?php

use Illuminate\Support\Facades\Facade;

return [

    /*
    |--------------------------------------------------------------------------
    | Nome da Aplicação
    |--------------------------------------------------------------------------
    |
    | Este valor é o nome da sua aplicação. Ele é usado quando o framework
    | precisa exibir o nome da aplicação em uma notificação ou em qualquer
    | outra localização conforme exigido pela aplicação ou seus pacotes.
    |
    */

    'name' => env('APP_NAME', 'Feira na Mão'),

    /*
    |--------------------------------------------------------------------------
    | Ambiente da Aplicação
    |--------------------------------------------------------------------------
    |
    | Este valor determina o "ambiente" em que a sua aplicação está sendo
    | executada. Isso pode determinar como você prefere configurar vários
    | serviços utilizados pela aplicação. Defina isso no arquivo ".env".
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Modo de Depuração da Aplicação
    |--------------------------------------------------------------------------
    |
    | Quando a sua aplicação está no modo de depuração, mensagens de erro detalhadas
    | com rastreamentos de pilha serão exibidas em cada erro que ocorrer na
    | aplicação. Se desativado, uma página de erro genérica simples será exibida.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | URL da Aplicação
    |--------------------------------------------------------------------------
    |
    | Esta URL é usada pelo console para gerar corretamente URLs ao usar
    | a ferramenta de linha de comando Artisan. Você deve definir isso como
    | a raiz da sua aplicação para que seja usada ao executar tarefas do Artisan.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL'),

    /*
    |--------------------------------------------------------------------------
    | Timezone da Aplicação
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar o fuso horário padrão da sua aplicação,
    | que será usado pelas funções de data e hora do PHP. Já definimos um
    | valor padrão razoável para você.
    |
    */

    'timezone' => 'America/Sao_Paulo',

    /*
    |--------------------------------------------------------------------------
    | Configuração de Localidade da Aplicação
    |--------------------------------------------------------------------------
    |
    | A localidade da aplicação determina a localidade padrão que será usada
    | pelo provedor de serviços de tradução. Você pode definir este valor
    | para qualquer uma das localidades que serão suportadas pela aplicação.
    |
    */

    'locale' => 'pt-BR',

    /*
    |--------------------------------------------------------------------------
    | Localidade de Fallback da Aplicação
    |--------------------------------------------------------------------------
    |
    | A localidade de fallback determina a localidade a ser usada quando a
    | localidade atual não estiver disponível. Você pode alterar o valor para
    | corresponder a qualquer uma das pastas de idioma fornecidas pela aplicação.
    |
    */

    'fallback_locale' => 'pt-BR',

    /*
    |--------------------------------------------------------------------------
    | Localidade do Faker
    |--------------------------------------------------------------------------
    |
    | Esta localidade será usada pela biblioteca Faker PHP ao gerar dados falsos
    | para as suas sementes de banco de dados. Por exemplo, isso será usado para
    | obter números de telefone localizados, informações de endereço, etc.
    |
    */

    'faker_locale' => 'pt_BR',

    /*
    |--------------------------------------------------------------------------
    | Chave de Criptografia
    |--------------------------------------------------------------------------
    |
    | Esta chave é usada pelo serviço de criptografia Illuminate e deve ser definida
    | como uma string aleatória de 32 caracteres. Caso contrário, essas strings
    | criptografadas não serão seguras. Faça isso antes de implantar a aplicação!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Driver do Modo de Manutenção
    |--------------------------------------------------------------------------
    |
    | Essas opções de configuração determinam o driver usado para determinar e
    | gerenciar o status de "modo de manutenção" do Laravel. O driver "file" irá
    | permitir que o modo de manutenção seja controlado em várias máquinas.
    |
    | Drivers suportados: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Provedores de Serviços Carregados Automaticamente
    |--------------------------------------------------------------------------
    |
    | Os provedores de serviços listados aqui serão carregados automaticamente
    | quando a sua aplicação for solicitada. Fique à vontade para adicionar
    | os seus próprios serviços a esta matriz para conceder funcionalidades
    | expandidas à sua aplicação.
    |
    */

    'providers' => [

        /*
         * Provedores de Serviços do Framework Laravel...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Provedores de Serviços de Pacotes...
         */

        /*
         * Provedores de Serviços da Aplicação...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Aliases de Classes
    |--------------------------------------------------------------------------
    |
    | Este array de aliases de classe será registrado quando a aplicação
    | for iniciada. No entanto, sinta-se à vontade para registrar quantos
    | você desejar, pois os aliases são carregados de forma "lazy" e não
    | prejudicam o desempenho.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        // 'ClasseExemplo' => App\Exemplo\ClasseExemplo::class,
    ])->toArray(),

];
