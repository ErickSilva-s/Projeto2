<div class="flex">

    <!-- Importando a biblioteca Input Mask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <!-- Adicionando o código JavaScript -->
    <script>
        $(document).ready(function() {
            $('#phone').mask('(00) 0 0000-0000');
        });
    </script>


    <div class="w-1/2 bg-green-800 flex justify-center items-center">

        <img src="{{ asset('fazenda.png') }}" alt="imagem da fazenda">
    </div>
    <div class="w-1/2 p-8 bg-amber-50">


        <x-guest-layout>


            <h1 class="text-center font-semibold text-orange-600 font-sans" style="font-size:50px;">
                Cadastre-se
            </h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nome')" />
                    <x-text-input id="name" class="block mt-1 w-full border-orange-600" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address  -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full border-orange-600" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Phone -->
                <div class="mt-4">
                    <x-input-label for="phone" :value="__('Telefone')" />
                    <x-text-input id="phone" class="block mt-1 w-full border-orange-600" type="text" name="phone" :value="old('phone')" />
                </div>

                <!-- Type user -->
                <div class="mt-4">
                    <x-input-label for="type">{{ __('Tipo de usuário') }}</x-input-label>
                    <select name="type" id="type" required class="block w-full rounded-md border-orange-600 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value=""> -- Selecione -- </option>
                        <option value="cliente">Cliente</option>
                        <option value="vendedor">Vendedor</option>
                        <option value="entregador">Entregador</option>
                    </select>
                </div>







                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Senha')" />

                    <x-text-input id="password" class="block mt-1 w-full border-orange-600" type="password" name="password" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confimar Senha')" />


                    <x-text-input id="password_confirmation" class="block mt-1 w-full border-orange-600" type="password" name="password_confirmation" required autocomplete="new-password" />

                    <br>



                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <br>


                <x-primary-button class="ml-3 bg-orange-600 hover:bg-green-800 text-md w-full flex justify-center items-center">
                    {{ __('Cadastrar-se') }}
                </x-primary-button>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-md text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Já tem uma conta? Entrar') }}
                    </a>
                </div>

    </div>

    </form>
    </x-guest-layout>

</div>
</div>
