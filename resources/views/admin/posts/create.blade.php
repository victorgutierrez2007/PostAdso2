{{-- resources/views/admin/posts/create.blade.php --}}
<x-layouts.app :title="__('Crear Post')">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-zinc-900 dark:to-zinc-800 p-4 md:p-8">
        <div class="max-w-4xl mx-auto">

            {{-- Header --}}
            <div class="mb-8">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.posts.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white">{{ __('Crear Post') }}</h1>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ __('Agregar un nuevo artículo al blog') }}</p>
                    </div>
                </div>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
                    <p class="text-sm font-semibold text-red-700 dark:text-red-400 mb-1">Por favor corrige los siguientes errores:</p>
                    <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400 space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md border border-gray-200 dark:border-zinc-700 p-8">
                <form action="{{ route('admin.posts.store') }}" method="POST" class="space-y-6" id="post-form">
                    @csrf

                    {{-- Título --}}
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                            {{ __('Título') }} <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="{{ __('Escribe el título del post') }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('title') border-red-500 @enderror"
                            required
                        >
                        @error('title') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>

                    {{-- Slug --}}
                    <div>
                        <label for="slug" class="block text-sm font-semibold text-gray-900 dark:text-white mb-1">
                            {{ __('Slug') }}
                        </label>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Se genera automáticamente desde el título. Puedes personalizarlo.</p>
                        <input
                            type="text"
                            id="slug"
                            name="slug"
                            value="{{ old('slug') }}"
                            placeholder="mi-articulo-de-ejemplo"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition font-mono text-sm @error('slug') border-red-500 @enderror"
                        >
                        @error('slug') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>

                    {{-- Extracto --}}
                    <div>
                        <label for="excerpt" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                            {{ __('Extracto') }}
                        </label>
                        <textarea
                            id="excerpt"
                            name="excerpt"
                            rows="3"
                            placeholder="{{ __('Resumen breve del artículo (opcional)') }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('excerpt') border-red-500 @enderror"
                        >{{ old('excerpt') }}</textarea>
                        @error('excerpt') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>

                    {{-- Contenido --}}
                    <div>
                        <label for="content-editor" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                            {{ __('Contenido') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="rounded-lg overflow-hidden border border-gray-300 dark:border-zinc-600 notranslate" translate="no" wire:ignore>
                            <div id="editor-container" style="min-height: 400px;">
                                {!! old('content') !!}
                            </div>
                        </div>
                        <input type="hidden" name="content" id="content-input" value="{{ old('content') }}">
                        @error('content') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>

                    {{-- image_path --}}
                    <div>
                        <label for="image_path" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                            {{ __('URL de Imagen') }} <span class="text-xs font-normal text-gray-500">(image_path)</span>
                        </label>
                        <input
                            type="text"
                            id="image_path"
                            name="image_path"
                            value="{{ old('image_path') }}"
                            placeholder="https://ejemplo.com/imagen.jpg"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('image_path') border-red-500 @enderror"
                        >
                        @error('image_path') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>

                    {{-- category_id + published_at --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                                {{ __('Categoría') }} <span class="text-red-500">*</span>
                                <span class="text-xs font-normal text-gray-500">(category_id)</span>
                            </label>
                            <select
                                id="category_id"
                                name="category_id"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('category_id') border-red-500 @enderror"
                                required
                            >
                                <option value="">-- Seleccionar categoría --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }} (ID: {{ $category->id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="published_at" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                                {{ __('Fecha de publicación') }} <span class="text-xs font-normal text-gray-500">(published_at)</span>
                            </label>
                            <input
                                type="datetime-local"
                                id="published_at"
                                name="published_at"
                                value="{{ old('published_at') }}"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('published_at') border-red-500 @enderror"
                            >
                            @error('published_at') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- is_published --}}
                    <div>
                        <label for="is_published" class="flex items-center gap-3 cursor-pointer">
                            <input type="hidden" name="is_published" value="0">
                            <input
                                type="checkbox"
                                id="is_published"
                                name="is_published"
                                value="1"
                                {{ old('is_published') ? 'checked' : '' }}
                                class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-zinc-600 dark:bg-zinc-700 cursor-pointer"
                            >
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                {{ __('Publicar ahora') }}
                                <span class="text-xs font-normal text-gray-500">(is_published)</span>
                            </span>
                        </label>
                    </div>

                    {{-- Acciones --}}
                    <div class="flex gap-4 pt-6 border-t border-gray-200 dark:border-zinc-700">
                        <a
                            href="{{ route('admin.posts.index') }}"
                            class="flex-1 px-6 py-2.5 bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold rounded-lg hover:bg-gray-300 dark:hover:bg-zinc-600 transition text-center"
                        >
                            {{ __('Cancelar') }}
                        </a>
                        <button
                            type="submit"
                            class="flex-1 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            {{ __('Crear Post') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function initPostForm() {
            const titleInput = document.getElementById('title');
            const slugInput  = document.getElementById('slug');
            let slugModified = false;

            if (titleInput && slugInput) {
                titleInput.addEventListener('input', function () {
                    if (!slugModified) {
                        slugInput.value = this.value
                            .toLowerCase()
                            .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                            .replace(/[^a-z0-9\s-]/g, '')
                            .trim()
                            .replace(/\s+/g, '-');
                    }
                });
                slugInput.addEventListener('input', function () {
                    slugModified = true;
                });
            }

            // Inicializar Quill
            const editorContainer = document.getElementById('editor-container');
            if (editorContainer && !editorContainer.classList.contains('ql-container')) {
                const quill = new Quill('#editor-container', {
                    theme: 'snow',
                    placeholder: 'Escribe el contenido aquí...',
                    modules: {
                        toolbar: [
                            [{ 'header': [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            [{ 'script': 'sub'}, { 'script': 'super' }],
                            ['link', 'image', 'video'],
                            ['clean']
                        ]
                    }
                });

                // Sincronizar el contenido de Quill con el input hidden
                const postForm = document.getElementById('post-form');
                const contentInput = document.getElementById('content-input');

                if (postForm && contentInput) {
                    // Actualizar en cada cambio
                    quill.on('text-change', function() {
                        const html = quill.root.innerHTML;
                        // Si el editor está vacío (solo tiene un párrafo vacío), enviamos vacío
                        contentInput.value = (html === '<p><br></p>') ? '' : html;
                    });

                    // Asegurar sincronización al enviar
                    postForm.addEventListener('submit', function() {
                        const html = quill.root.innerHTML;
                        contentInput.value = (html === '<p><br></p>') ? '' : html;
                    });
                }
            }
        }

        // Ejecutar en carga inicial y en navegaciones de Livewire
        document.addEventListener('livewire:navigated', initPostForm);
        document.addEventListener('DOMContentLoaded', initPostForm);
    </script>
</x-layouts.app>