@if(Auth::user())
<nav x-data="{ open: false }" class="bg-green-800 border-b border-gray-100 fixed top-0 left-0 right-0">
    <!-- Primary Navigation Menu -->
    <div class="max-w-8xl mx-auto px-4 mt-4 flex justify-between items-center">
        <div class="flex items-center">
            <!-- Logo -->
                <a href="{{ url('product') }}">
                    <img src="{{ asset('logo2.png') }}" alt="imagem do logotipo" style="width:170px;">
                    <h1 class="text-2xl font-bold text-white text-right">Feira Na Mão</h1>
            </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:my-14 sm:ml-10 sm:flex">
                @if(!(Auth::user() ->type=='entregador'))
                <x-nav-link :href="route('product.index')" :active="request()->routeIs('product.index')" class="text-white text-xl hover:text-orange-400">
                    {{ __('Produtos') }}
                </x-nav-link>
                @endif

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white text-xl hover:text-orange-400">
                        {{ __('Endereços') }}
                    </x-nav-link>

                    @if(Auth::user() ->type=='administrador')
                    <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')" class="text-white text-xl hover:text-orange-400">
                        {{ __('Usuários') }}
                    </x-nav-link>
                    @endif

                    <x-nav-link :href="url('/usage_policies')" class=" text-white text-xl hover:text-orange-400">
                        {{ __('Politicas de uso') }}
                    </x-nav-link>

                    @if(Auth::user()->type == 'administrador')
                    <x-nav-link :href="url('reviews')" class="text-white text-xl hover:text-orange-400">
                        {{ __('Avaliações') }}
                    </x-nav-link>
                    @endif

                    @if(Auth::user()->type == 'entregador')
                    <x-nav-link :href="route('deliveries.index')" class="text-white text-xl hover:text-orange-400">
                        {{ __('Entregador') }}
                    </x-nav-link>
                    @endif

                    @if(!(Auth::user() ->type=='entregador'))
                    <x-nav-link :href="route('questions.index')" class="text-white text-xl hover:text-orange-400">
                        {{ __('Ajuda?') }}
                    </x-nav-link>
                    @endif
                </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @if(Auth::user() ->type=='cliente')
                
                <a href="/cart" class="mr-4">
  <img src="{{ asset('meu_carrinho2.png') }}" class="h-6 w-6 color-white ">
</a>
                @endif

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class=" text-white inline-flex items-center px-3 py-2 border border-transparent text-md leading-4 font-medium rounded-md text-black bg-orange-400 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">

                            <div>{{ Auth::user()->name }} ({{ Auth::user()->type }})</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Conta') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Sair') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
</div>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
@endif