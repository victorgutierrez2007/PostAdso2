<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

<!-- Quill Editor -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<style>
    /* Estilos base para Quill */
    .ql-toolbar.ql-snow {
        border: 1px solid #d1d5db !important;
        border-radius: 0.75rem 0.75rem 0 0 !important;
        background-color: #f9fafb !important;
        padding: 8px 12px !important;
    }

    .ql-container.ql-snow {
        border: 1px solid #d1d5db !important;
        border-radius: 0 0 0.75rem 0.75rem !important;
        background-color: #ffffff !important;
        font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif !important;
        font-size: 1rem !important;
        min-height: 400px;
    }

    .ql-editor {
        min-height: 400px;
        padding: 1.25rem !important;
    }

    /* Modo oscuro */
    .dark .ql-toolbar.ql-snow {
        background-color: #18181b !important;
        border-color: #3f3f46 !important;
    }

    .dark .ql-container.ql-snow {
        background-color: #27272a !important;
        border-color: #3f3f46 !important;
        color: #f4f4f5 !important;
    }

    .dark .ql-snow .ql-stroke {
        stroke: #a1a1aa !important;
    }

    .dark .ql-snow .ql-fill {
        fill: #a1a1aa !important;
    }

    .dark .ql-snow .ql-picker {
        color: #a1a1aa !important;
    }

    .dark .ql-snow .ql-picker-options {
        background-color: #18181b !important;
        border-color: #3f3f46 !important;
    }

    /* Mejoras de diseño */
    .ql-snow .ql-editor pre.ql-syntax {
        background-color: #1f2937 !important;
        color: #f9fafb !important;
        border-radius: 0.5rem !important;
    }

    .dark .ql-snow .ql-editor pre.ql-syntax {
        background-color: #09090b !important;
    }
</style>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
