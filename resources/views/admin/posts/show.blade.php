{{-- resources/views/admin/posts/show.blade.php --}}
<x-layouts.app :title="$post->title">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-zinc-900 dark:to-zinc-800 p-4 md:p-8">
        <div class="max-w-4xl mx-auto" x-data="{ showDeleteModal: false }">

            {{-- Header --}}
            <div class="mb-8">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.posts.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white">{{ $post->title }}</h1>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">Ver detalles del post</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Contenido principal --}}
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md border border-gray-200 dark:border-zinc-700 p-8">

                        {{-- Imagen destacada --}}
                        @if($post->image_path)
                            <div class="mb-8 pb-8 border-b border-gray-200 dark:border-zinc-700">
                                <h2 class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-3">Imagen destacada</h2>
                                <img
                                    src="{{ Str::startsWith($post->image_path, ['http://','https://']) ? $post->image_path : asset($post->image_path) }}"
                                    alt="{{ $post->title }}"
                                    class="w-full h-48 object-cover rounded-xl border border-gray-200 dark:border-zinc-600"
                                >
                                <p class="text-xs text-gray-500 dark:text-gray-400 font-mono mt-2 break-all">{{ $post->image_path }}</p>
                            </div>
                        @endif

                        {{-- Título --}}
                        <div class="mb-8 pb-8 border-b border-gray-200 dark:border-zinc-700">
                            <h2 class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Título</h2>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $post->title }}</p>
                        </div>

                        {{-- Slug --}}
                        <div class="mb-8 pb-8 border-b border-gray-200 dark:border-zinc-700">
                            <h2 class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Slug</h2>
                            <code class="text-sm px-3 py-1.5 bg-gray-100 dark:bg-zinc-700 text-gray-700 dark:text-gray-300 rounded-lg font-mono">{{ $post->slug ?? '-' }}</code>
                        </div>

                        {{-- Extracto --}}
                        <div class="mb-8 pb-8 border-b border-gray-200 dark:border-zinc-700">
                            <h2 class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Extracto</h2>
                            @if($post->excerpt)
                                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-400 rounded-r-lg">
                                    <p class="text-gray-700 dark:text-gray-300 italic text-sm">{{ $post->excerpt }}</p>
                                </div>
                            @else
                                <p class="text-gray-500 dark:text-gray-400">—</p>
                            @endif
                        </div>

                        {{-- Contenido --}}
                        <div class="mb-8">
                            <h2 class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-3">Contenido</h2>
                            <div class="prose prose-sm dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $post->content }}</div>
                        </div>

                        {{-- Estado --}}
                        <div>
                            <h2 class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-3">Estado</h2>
                            @if($post->is_published)
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                    Publicado
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
                                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                                    Borrador
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1">

                    {{-- Info Card --}}
                    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md border border-gray-200 dark:border-zinc-700 p-6 mb-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Información</h3>

                        <div class="space-y-4 text-sm">
                            <div class="flex justify-between items-start">
                                <span class="text-gray-600 dark:text-gray-400">ID</span>
                                <span class="text-gray-900 dark:text-white font-medium">{{ $post->id }}</span>
                            </div>
                            <div class="flex justify-between items-start pt-3 border-t border-gray-200 dark:border-zinc-700">
                                <span class="text-gray-600 dark:text-gray-400">Categoría</span>
                                <span class="text-blue-600 dark:text-blue-400 font-medium">{{ $post->category->name ?? 'Sin categoría' }}</span>
                            </div>
                            <div class="flex justify-between items-start pt-3 border-t border-gray-200 dark:border-zinc-700">
                                <span class="text-gray-600 dark:text-gray-400">Autor</span>
                                <span class="text-gray-900 dark:text-white font-medium">{{ $post->user->name ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between items-start pt-3 border-t border-gray-200 dark:border-zinc-700">
                                <span class="text-gray-600 dark:text-gray-400">Publicado el</span>
                                <span class="text-gray-900 dark:text-white font-medium text-right">
                                    {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d/m/Y H:i') : '-' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-start pt-3 border-t border-gray-200 dark:border-zinc-700">
                                <span class="text-gray-600 dark:text-gray-400">Creado</span>
                                <span class="text-gray-900 dark:text-white font-medium">{{ $post->created_at?->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between items-start pt-3 border-t border-gray-200 dark:border-zinc-700">
                                <span class="text-gray-600 dark:text-gray-400">Actualizado</span>
                                <span class="text-gray-900 dark:text-white font-medium">{{ $post->updated_at?->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Actions Card --}}
                    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md border border-gray-200 dark:border-zinc-700 p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Acciones</h3>

                        <div class="space-y-3">
                            <a
                                href="{{ route('admin.posts.edit', $post) }}"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold rounded-lg hover:shadow-lg transform hover:scale-105 transition-all duration-200"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                {{ __('Editar') }}
                            </a>

                            <button
                                @click="showDeleteModal = true"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 font-semibold rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 transition"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                {{ __('Eliminar') }}
                            </button>

                            <a
                                href="{{ route('admin.posts.index') }}"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold rounded-lg hover:bg-gray-300 dark:hover:bg-zinc-600 transition"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                {{ __('Volver') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Delete Modal --}}
            <div x-show="showDeleteModal" @keydown.escape="showDeleteModal = false"
                 class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4"
                 style="display: none;">
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-2xl max-w-sm w-full border border-gray-200 dark:border-zinc-700 p-6" @click.stop>
                    <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 dark:bg-red-900/30 rounded-full mb-4">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white text-center mb-2">
                        ¿Eliminar post?
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 text-center mb-6 text-sm">
                        Esta acción no se puede deshacer. Se eliminará permanentemente "{{ $post->title }}" y todos sus datos asociados.
                    </p>
                    <div class="flex gap-3">
                        <button
                            @click="showDeleteModal = false"
                            class="flex-1 px-4 py-2.5 bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold rounded-lg hover:bg-gray-300 dark:hover:bg-zinc-600 transition"
                        >
                            Cancelar
                        </button>
                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="w-full px-4 py-2.5 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition"
                            >
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>