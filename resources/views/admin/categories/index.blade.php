<x-layouts.app :title="__('Categorías')">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-zinc-900 dark:to-zinc-800 p-4 md:p-8">
        <div class="max-w-7xl mx-auto">
            <!-- Success Message -->
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-800 text-green-800 dark:text-green-400 rounded-lg flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Categorías') }}</h1>
                        <p class="text-gray-600 dark:text-gray-400">{{ __('Administra tus categorías de productos') }}</p>
                    </div>
                    <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        {{ __('Crear Categoría') }}
                    </a>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md p-6 border border-gray-200 dark:border-zinc-700 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">{{ __('Total de Categorías') }}</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $categories->count() }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md p-6 border border-gray-200 dark:border-zinc-700 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">{{ __('Última Actualización') }}</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                                @if($categories->max('updated_at'))
                                    {{ $categories->max('updated_at')->format('d/m/y') }}
                                @else
                                    -
                                @endif
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
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">{{ __('Estado') }}</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $categories->count() > 0 ? '✓' : '○' }}</p>
                        </div>
                        <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories Table/List -->
            @if($categories->isEmpty())
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md p-12 border border-gray-200 dark:border-zinc-700 text-center">
                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('No se encontraron categorías') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">{{ __('Comienza creando tu primera categoría') }}</p>
                    <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        {{ __('Crear Primera Categoría') }}
                    </a>
                </div>
            @else
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md border border-gray-200 dark:border-zinc-700 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-zinc-900 border-b border-gray-200 dark:border-zinc-700">
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Nombre') }}</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Descripción') }}</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Creado') }}</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900 dark:text-gray-100">{{ __('Acciones') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                                @foreach($categories as $category)
                                    <tr x-data="{ showDeleteModal: false, deleteCategory: '{{ $category->id }}', deleteName: '{{ $category->name }}' }" class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center gap-2">
                                                <span class="w-2.5 h-2.5 bg-blue-500 rounded-full"></span>
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $category->name }}</span>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-gray-600 dark:text-gray-400 text-sm">{{ Str::limit($category->description ?? '-', 50) }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ $category->created_at->format('d/m/Y') }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('admin.categories.show', $category) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-sm bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-900/50 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                    {{ __('Ver') }}
                                                </a>
                                                <a href="{{ route('admin.categories.edit', $category) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-sm bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 rounded-lg hover:bg-indigo-200 dark:hover:bg-indigo-900/50 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    {{ __('Editar') }}
                                                </a>
                                                <button @click="showDeleteModal = true" class="inline-flex items-center gap-1 px-3 py-1.5 text-sm bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    {{ __('Eliminar') }}
                                                </button>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div x-show="showDeleteModal" @keydown.escape="showDeleteModal = false" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4" style="display: none;">
                                                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-2xl max-w-sm w-full border border-gray-200 dark:border-zinc-700 p-6 animate-in fade-in" @click.stop>
                                                    <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 dark:bg-red-900/30 rounded-full mb-4">
                                                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4v2M6.343 3.665A9 9 0 0116.743 2.016m4.243 4.243A9 9 0 018.656 20.335m12.486-12.486A9 9 0 008.656 20.335"/>
                                                        </svg>
                                                    </div>

                                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white text-center mb-2">
                                                        ¿Eliminar categoría?
                                                    </h3>
                                                    <p class="text-gray-600 dark:text-gray-400 text-center mb-6 text-sm">
                                                        Esta acción no se puede deshacer. Se eliminará permanentemente "<span x-text="deleteName"></span>" y todos sus datos asociados.
                                                    </p>

                                                    <div class="flex gap-3">
                                                        <button 
                                                            @click="showDeleteModal = false"
                                                            class="flex-1 px-4 py-2.5 bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold rounded-lg hover:bg-gray-300 dark:hover:bg-zinc-600 transition"
                                                        >
                                                            Cancelar
                                                        </button>
                                                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="flex-1">
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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
