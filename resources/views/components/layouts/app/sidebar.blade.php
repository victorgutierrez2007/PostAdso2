<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <script>
            (function() {
                const theme = localStorage.getItem('theme') || 'system';
                const isDarkMode = theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
                if (isDarkMode) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            })();
        </script>
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

           @php
    $menu = [
        [
            'heading' => 'Platform',
            'items' => [
                ['icon' => 'home', 'label' => 'Dashboard', 'route' => 'dashboard'],
                ['icon' => 'chart-pie', 'label' => 'Statistics', 'route' => 'dashboard'],
                ['icon' => 'information-circle', 'label' => 'Information', 'route' => 'dashboard'],
            ],
        ],
        [
            'heading' => 'Administration',
            'items' => [
                ['icon' => 'funnel', 'label' => 'Categories', 'route' => 'admin.categories.index'],
                ['icon' => 'users', 'label' => 'User', 'route' => 'dashboard'],
                ['icon' => 'shield-check', 'label' => 'Roles', 'route' => 'dashboard'],
                ['icon' => 'key', 'label' => 'Permissions', 'route' => 'dashboard'],
            ],
        ],
        [
            'heading' => 'Content',
            'items' => [
                // 'file-text' cambiado por 'document-text'
                ['icon' => 'document-text', 'label' => 'Posts', 'route' => 'admin.posts.index'],
                ['icon' => 'tag', 'label' => 'Tags', 'route' => 'dashboard'],
            ],
        ],
    ];
@endphp

            <flux:navlist variant="outline">
                @foreach($menu as $group)
                    <flux:navlist.group heading="{{ __($group['heading']) }}" class="grid">
                        @foreach ($group['items'] as $item)
                            <flux:navlist.item
                                icon="{{ $item['icon'] }}"
                                :href="route($item['route'])"
                                :current="request()->routeIs($item['route'])"
                                wire:navigate
                            >
                                {{ __($item['label']) }}
                            </flux:navlist.item>
                        @endforeach
                    </flux:navlist.group>
                @endforeach
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                    {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                    {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist>

            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                    data-test="sidebar-menu-button"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <div class="px-3 py-2">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">{{ __('Theme') }}</p>
                        <div class="flex gap-1.5" x-data="{ theme: localStorage.getItem('theme') || 'system' }">
                            <button @click="theme = 'light'; document.documentElement.classList.remove('dark'); localStorage.setItem('theme', 'light')" :class="theme === 'light' ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-gray-300'" class="flex-1 px-2 py-1.5 rounded text-xs font-medium transition hover:opacity-90">
                                <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 24 24"><path d="M12 18a6 6 0 100-12 6 6 0 000 12zM12 2v4m0 12v4m10-10h-4M4 12H0M19.07 4.93l-2.83 2.83M7.76 16.24l-2.83 2.83M19.07 19.07l-2.83-2.83M7.76 7.76L4.93 4.93"/></svg>
                            </button>
                            <button @click="theme = 'dark'; document.documentElement.classList.add('dark'); localStorage.setItem('theme', 'dark')" :class="theme === 'dark' ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-gray-300'" class="flex-1 px-2 py-1.5 rounded text-xs font-medium transition hover:opacity-90">
                                <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                            </button>
                            <button @click="theme = 'system'; localStorage.setItem('theme', 'system'); const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches; isDark ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')" :class="theme === 'system' ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-gray-300'" class="flex-1 px-2 py-1.5 rounded text-xs font-medium transition hover:opacity-90">
                                <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 24 24"><path d="M20 3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14l4 4V5c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-4H6V9h12v2z"/></svg>
                            </button>
                        </div>
                    </div>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full" data-test="logout-button">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>
                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>
                    <flux:menu.separator />
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                    <flux:menu.separator />
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>