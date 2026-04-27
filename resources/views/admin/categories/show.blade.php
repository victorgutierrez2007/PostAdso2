<x-layouts.app :title="__('Ver Categoría')">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-zinc-900 dark:to-zinc-800 p-4 md:p-8">
        <div class="max-w-4xl mx-auto" x-data="{ showDeleteModal: false }"
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.categories.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white">{{ $category->name }}</h1>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">Ver detalles de la categoría</p>
                    </div>
                </div>
            </div>

            <!-- Details Card -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md border border-gray-200 dark:border-zinc-700 p-8">
                        <!-- Category Name -->
                        <div class="mb-8 pb-8 border-b border-gray-200 dark:border-zinc-700">
                            <h2 class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Nombre de la Categoría</h2>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $category->name }}</p>
                        </div>

                        <!-- Description -->
                        <div class="mb-8 pb-8 border-b border-gray-200 dark:border-zinc-700">
                            <h2 class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Descripción</h2>
                            <div class="prose prose-sm dark:prose-invert max-w-none">
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">
                                    {{ $category->description ?? '—' }}
                                </p>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-8">
                            <h2 class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-3">Estado</h2>
                            @if($category->is_active ?? true)
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                    Activo
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-gray-100 text-gray-800 dark:bg-zinc-700 dark:text-gray-400">
                                    <span class="w-2 h-2 rounded-full bg-gray-500"></span>
                                    Inactivo
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Info Card -->
                    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md border border-gray-200 dark:border-zinc-700 p-6 mb-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Información</h3>
                        
                        <div class="space-y-4 text-sm">
                            <div class="flex justify-between items-start">
                                <span class="text-gray-600 dark:text-gray-400">Creado</span>
                                <span class="text-gray-900 dark:text-white font-medium">{{ $category->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between items-start pt-4 border-t border-gray-200 dark:border-zinc-700">
                                <span class="text-gray-600 dark:text-gray-400">Actualizado</span>
                                <span class="text-gray-900 dark:text-white font-medium">{{ $category->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions Card -->
                    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md border border-gray-200 dark:border-zinc-700 p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Acciones</h3>
                        
                        <div class="space-y-3">
                            <a 
                                href="{{ route('admin.categories.edit', $category) }}" 
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
                                href="{{ route('admin.categories.index') }}" 
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
                        Esta acción no se puede deshacer. Se eliminará permanentemente "{{ $category->name }}" y todos sus datos asociados.
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
        </div>
    </div>
</x-layouts.app>
