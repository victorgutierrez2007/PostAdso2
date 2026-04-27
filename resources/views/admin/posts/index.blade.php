{{-- resources/views/admin/posts/index.blade.php --}}
<x-layouts.app :title="__('Posts')">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-zinc-900 dark:to-zinc-800 p-4 md:p-8">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-init="setTimeout(() => show = false, 5000)"
                    class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-800 text-green-800 dark:text-green-400 rounded-lg flex items-center gap-3"
                >
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Header --}}
            <div class="mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Posts') }}</h1>
                        <p class="text-gray-600 dark:text-gray-400">{{ __('Gestiona el contenido de tu blog') }}</p>
                    </div>
                    <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        {{ __('Crear Nuevo Post') }}
                    </a>
                </div>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md p-6 border border-gray-200 dark:border-zinc-700 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">{{ __('Total de Posts') }}</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $posts->total() }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md p-6 border border-gray-200 dark:border-zinc-700 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">{{ __('Publicados') }}</p>
                            <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-2">
                                {{ $publishedCount ?? $posts->getCollection()->where('is_published', true)->count() }}
                            </p>
                        </div>
                        <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-lg">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md p-6 border border-gray-200 dark:border-zinc-700 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">{{ __('Borradores') }}</p>
                            <p class="text-3xl font-bold text-amber-600 dark:text-amber-400 mt-2">
                                {{ $draftCount ?? $posts->getCollection()->where('is_published', false)->count() }}
                            </p>
                        </div>
                        <div class="p-3 bg-amber-100 dark:bg-amber-900/30 rounded-lg">
                            <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @if($posts->isEmpty())
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md p-12 border border-gray-200 dark:border-zinc-700 text-center">
                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('No hay posts aún') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">{{ __('Escribe tu primera historia hoy mismo.') }}</p>
                    <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        {{ __('Crear Primer Post') }}
                    </a>
                </div>
            @else
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md border border-gray-200 dark:border-zinc-700 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-zinc-900 border-b border-gray-200 dark:border-zinc-700">
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Título') }}</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 dark:text-gray-100 hidden lg:table-cell">{{ __('Slug') }}</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 dark:text-gray-100 hidden xl:table-cell">{{ __('Extracto') }}</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900 dark:text-gray-100 hidden lg:table-cell">{{ __('Imagen') }}</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Categoría') }}</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Autor') }}</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Estado') }}</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900 dark:text-gray-100 hidden md:table-cell">{{ __('Publicado el') }}</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Acciones') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                                @foreach($posts as $post)
                                    <tr x-data="{ showDeleteModal: false }" class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">

                                        {{-- Título + fecha creación --}}
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                <span class="inline-flex items-center gap-2">
                                                    <span class="w-2.5 h-2.5 {{ $post->is_published ? 'bg-green-500' : 'bg-amber-400' }} rounded-full flex-shrink-0"></span>
                                                    <span class="font-medium text-gray-900 dark:text-gray-100">{{ Str::limit($post->title, 38) }}</span>
                                                </span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 ml-[18px]">{{ $post->created_at?->format('d/m/Y') }}</span>
                                                {{-- Info extra en mobile --}}
                                                <div class="mt-1.5 space-y-0.5 text-xs text-gray-500 dark:text-gray-400 lg:hidden ml-[18px]">
                                                    <div><span class="font-medium text-gray-700 dark:text-gray-300">Slug:</span> {{ Str::limit($post->slug ?? '-', 30) }}</div>
                                                    <div><span class="font-medium text-gray-700 dark:text-gray-300">Publicado:</span> {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d/m/Y H:i') : '-' }}</div>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Slug --}}
                                        <td class="px-6 py-4 hidden lg:table-cell">
                                            <p class="text-gray-600 dark:text-gray-400 text-sm font-mono">{{ Str::limit($post->slug ?? '-', 28) }}</p>
                                        </td>

                                        {{-- Extracto --}}
                                        <td class="px-6 py-4 hidden xl:table-cell max-w-[180px]">
                                            <p class="text-gray-600 dark:text-gray-400 text-sm">{{ Str::limit($post->excerpt ?? '-', 55) }}</p>
                                        </td>

                                        {{-- Imagen (image_path) --}}
                                        <td class="px-6 py-4 hidden lg:table-cell text-center">
                                            @if($post->image_path)
                                                <img
                                                    src="{{ Str::startsWith($post->image_path, ['http://','https://']) ? $post->image_path : asset($post->image_path) }}"
                                                    alt="{{ $post->title }}"
                                                    class="w-10 h-10 rounded-lg object-cover inline-block border border-gray-200 dark:border-zinc-600"
                                                    loading="lazy"
                                                >
                                            @else
                                                <div class="w-10 h-10 rounded-lg inline-flex items-center justify-center bg-gray-100 dark:bg-zinc-700 border border-gray-200 dark:border-zinc-600 text-gray-400 text-xs">
                                                    N/A
                                                </div>
                                            @endif
                                        </td>

                                        {{-- Categoría (category_id → name) --}}
                                        <td class="px-6 py-4">
                                            <span class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                                                {{ $post->category->name ?? 'Sin categoría' }}
                                            </span>
                                        </td>

                                        {{-- Autor (user_id → name) --}}
                                        <td class="px-6 py-4">
                                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ $post->user->name ?? '-' }}</span>
                                        </td>

                                        {{-- Estado (is_published) --}}
                                        <td class="px-6 py-4 text-center">
                                            @if($post->is_published)
                                                <span class="inline-flex items-center gap-1.5 text-sm font-medium text-green-600 dark:text-green-400">
                                                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                                    {{ __('Publicado') }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 text-sm font-medium text-amber-600 dark:text-amber-400">
                                                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                                                    {{ __('Borrador') }}
                                                </span>
                                            @endif
                                        </td>

                                        {{-- published_at --}}
                                        <td class="px-6 py-4 text-center hidden md:table-cell">
                                            <span class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d/m/Y H:i') : '-' }}
                                            </span>
                                        </td>

                                        {{-- Acciones --}}
                                        <td class="px-6 py-4">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('admin.posts.show', $post) }}"
                                                   class="inline-flex items-center gap-1 px-3 py-1.5 text-sm bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-900/50 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                    {{ __('Ver') }}
                                                </a>
                                                <a href="{{ route('admin.posts.edit', $post) }}"
                                                   class="inline-flex items-center gap-1 px-3 py-1.5 text-sm bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 rounded-lg hover:bg-indigo-200 dark:hover:bg-indigo-900/50 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    {{ __('Editar') }}
                                                </a>
                                                <button @click="showDeleteModal = true"
                                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-sm bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    {{ __('Eliminar') }}
                                                </button>
                                            </div>

                                            {{-- Delete Modal --}}
                                            <div x-show="showDeleteModal" x-transition.opacity @keydown.escape="showDeleteModal = false"
                                                 class="fixed inset-0 bg-black/75 backdrop-blur-sm z-[100] flex items-center justify-center p-4"
                                                 style="display: none;">
                                                <div x-show="showDeleteModal" x-transition.scale.95 @click.stop
                                                     class="bg-white dark:bg-zinc-800 rounded-2xl shadow-2xl max-w-sm w-full border border-gray-200 dark:border-zinc-700 p-8">
                                                    <div class="flex items-center justify-center w-16 h-16 mx-auto bg-red-100 dark:bg-red-900/30 rounded-full mb-6">
                                                        <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </div>
                                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white text-center mb-2">
                                                        ¿Eliminar post?
                                                    </h3>
                                                    <p class="text-gray-600 dark:text-gray-400 text-center mb-8 text-sm">
                                                        Esta acción no se puede deshacer. Se eliminará permanentemente <strong class="text-gray-800 dark:text-gray-200">"{{ Str::limit($post->title, 40) }}"</strong> y todos sus datos asociados.
                                                    </p>
                                                    <div class="flex gap-3">
                                                        <button @click="showDeleteModal = false"
                                                                class="flex-1 px-4 py-2.5 bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold rounded-lg hover:bg-gray-300 dark:hover:bg-zinc-600 transition">
                                                            Cancelar
                                                        </button>
                                                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" class="flex-1">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="w-full px-4 py-2.5 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition">
                                                                Eliminar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 dark:bg-zinc-900/50 border-t border-gray-200 dark:border-zinc-700">
                        {{ $posts->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>