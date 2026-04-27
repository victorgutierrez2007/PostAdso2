<x-layouts.app :title="__('Editar Categoría')">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-zinc-900 dark:to-zinc-800 p-4 md:p-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.categories.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white">{{ __('Editar Categoría') }}</h1>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ __('Actualizar información de la categoría') }}</p>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md border border-gray-200 dark:border-zinc-700 p-8">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                            {{ __('Nombre de la Categoría') }} <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $category->name) }}"
                            placeholder="{{ __('Ingresa el nombre de la categoría') }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('name') border-red-500 @enderror"
                            required
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                            {{ __('Descripción') }}
                        </label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="5"
                            placeholder="{{ __('Ingresa una descripción detallada') }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('description') border-red-500 @enderror"
                        >{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Field -->
                    <div>
                        <label for="is_active" class="flex items-center gap-3 cursor-pointer">
                            <input 
                                type="checkbox" 
                                id="is_active" 
                                name="is_active" 
                                value="1"
                                {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}
                                class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-zinc-600 dark:bg-zinc-700 cursor-pointer"
                            >
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ __('Activa') }}</span>
                        </label>
                    </div>

                    <!-- Metadata -->
                    <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-200 dark:border-zinc-700">
                        <div>
                            <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-1">{{ __('Creado el') }}</p>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $category->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-1">{{ __('Última actualización') }}</p>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $category->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-4 pt-6 border-t border-gray-200 dark:border-zinc-700">
                        <a 
                            href="{{ route('admin.categories.index') }}" 
                            class="flex-1 px-6 py-2.5 bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold rounded-lg hover:bg-gray-300 dark:hover:bg-zinc-600 transition text-center"
                        >
                            {{ __('Cancelar') }}
                        </a>
                        <button 
                            type="submit" 
                            class="flex-1 px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold rounded-lg hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('Guardar Cambios') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
