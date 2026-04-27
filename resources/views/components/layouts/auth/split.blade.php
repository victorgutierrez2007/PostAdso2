<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    <style>
        /* Estilos para el contenedor del fondo */
        .bg-image-section {
            position: relative;
            flex-grow: 1;
            padding: 2.5rem;
            color: white;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        /* Imagen de fondo con overlay oscuro degradado */
        .bg-image-section::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 100%),
                url('{{ asset('images/laravel.jpeg') }}');
            background-size: cover;
            background-position: center;
            /* Aplica escala de grises por defecto y ajuste de brillo */
            filter: grayscale(100%) brightness(0.8);
            z-index: 1;
            transition: filter 0.3s ease;
        }

        /* Asegura que el contenido esté por encima del fondo */
        .bg-image-section > * {
            position: relative;
            z-index: 2;
        }

        /* Al pasar el cursor sobre la sección, se quita el gris y vuelve el color normal */
        .bg-image-section:hover::before {
            filter: grayscale(0%) brightness(1);
        }
    </style>
</head>
<body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
    <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
        <div class="bg-muted relative hidden h-full flex-col p-10 text-white lg:flex dark:border-e dark:border-neutral-800 bg-image-section">
            <a href="{{ route('home') }}" class="relative z-20 flex items-center text-lg font-medium" wire:navigate>
                <span class="flex h-10 w-10 items-center justify-center rounded-md">
                    <x-app-logo-icon class="me-2 h-7 fill-current text-white" />
                </span>
                {{ config('app.name', 'Laravel') }}
            </a>

            @php
                [$message, $author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
            @endphp

            <div class="relative z-20 mt-auto">
                <blockquote class="space-y-2">
                    <flux:heading size="lg">&ldquo;{{ trim($message) }}&rdquo;</flux:heading>
                    <footer><flux:heading>{{ trim($author) }}</flux:heading></footer>
                </blockquote>
            </div>
        </div>
        <div class="w-full lg:p-8">
            <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden" wire:navigate>
                    <span class="flex h-9 w-9 items-center justify-center rounded-md">
                        <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                    </span>

                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>
                {{ $slot }}
            </div>
        </div>
    </div>
    @fluxScripts
</body>
</html>
