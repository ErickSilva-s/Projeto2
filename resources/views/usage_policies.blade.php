<x-app-layout>

    <x-slot name="header">
        @if(!(Auth::user()))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block ">
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Entrar</a>
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Cadastre-se</a>
            <a href="{{ url('/product') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Produtos</a>
        </div>
        @endif

 

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">



                    <h1 class="text-3xl text-center font-semibold text-orange-600 font-sans"> Politicas de uso </h1>

                    <div class="text-xl">
                        Esta Política de Uso estabelece as diretrizes e termos de uso para o nosso eCommerce. Ao acessar e utilizar nosso site, você concorda em cumprir e estar vinculado a esta política. Reservamos o direito de atualizar ou modificar esta política a qualquer momento, sem aviso prévio. É responsabilidade do usuário revisar regularmente esta política para estar ciente de quaisquer alterações.
                        <h2 class="text-xl font-bold">1. Uso adequado:</h2>
                        1.1. Ao utilizar nosso eCommerce, você concorda em usar os recursos e serviços fornecidos de forma legal, ética e apropriada.<br>
                        1.2. Você não deve utilizar nosso eCommerce para atividades ilegais, fraudulentas, difamatórias, prejudiciais ou que violem os direitos de terceiros.
                        <h2 class="text-xl font-bold">2. Conta de usuário:</h2>
                        2.1. Alguns recursos do eCommerce podem exigir que você crie uma conta de usuário. É sua responsabilidade fornecer informações precisas e atualizadas ao criar a conta.<br>
                        2.2. Você é responsável pela proteção e confidencialidade de suas informações de login. Qualquer atividade realizada em sua conta será de sua responsabilidade.
                        <h2 class="text-xl font-bold">3. Privacidade:</h2>
                        3.1. Respeitamos a privacidade de nossos usuários. Consulte nossa Política de Privacidade para obter informações detalhadas sobre como coletamos, usamos e protegemos suas informações pessoais.
                        <h2 class="text-xl font-bold">4. Propriedade intelectual:</h2>
                        4.1. Todo o conteúdo, incluindo textos, imagens, logotipos, vídeos e gráficos, presentes em nosso eCommerce são protegidos por direitos autorais e outras leis de propriedade intelectual. Você não pode copiar, reproduzir, modificar ou distribuir qualquer conteúdo sem permissão expressa por escrito.
                        <h2 class="text-xl font-bold">5. Comentários e avaliações:</h2>
                        5.1. Podemos permitir que os usuários comentem, avaliem e façam análises de produtos em nosso eCommerce. No entanto, nos reservamos o direito de moderar, editar ou remover qualquer conteúdo que seja considerado inadequado, ofensivo ou violador de direitos de terceiros.
                        <h2 class="text-xl font-bold">6. Responsabilidade:</h2>
                        6.1. Fornecemos nosso eCommerce "no estado em que se encontra" e não fazemos representações ou garantias de qualquer tipo, expressas ou implícitas, quanto à sua funcionalidade, precisão, confiabilidade ou disponibilidade.<br>
                        6.2. Não nos responsabilizamos por quaisquer danos diretos, indiretos, incidentais, consequenciais ou punitivos resultantes do uso ou da incapacidade de usar nosso eCommerce.
                        Ao utilizar nosso eCommerce, você concorda em cumprir esta Política de Uso. Caso viole qualquer um desses termos, nos reservamos o direito de tomar as medidas adequadas, incluindo a restrição ou encerramento do acesso ao nosso site.  <br><br>

                        Ao utilizar nosso eCommerce, você concorda em cumprir esta Política de Uso. Caso viole qualquer um desses termos, nos reservamos o direito de tomar as medidas adequadas, incluindo a restrição ou encerramento do acesso ao nosso site.
                    </div>



                </div>
            </div>
        </div>
    </div>

</x-app-layout>
