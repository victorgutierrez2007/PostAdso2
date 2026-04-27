<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|outfit:300,400,500,600,700,800" rel="stylesheet" />

<style>
    :root {
        --brand-primary: #3b82f6;
        --brand-secondary: #6366f1;
        --glass-bg: rgba(255, 255, 255, 0.7);
        --glass-border: rgba(255, 255, 255, 0.3);
    }

    .dark:root {
        --glass-bg: rgba(24, 24, 27, 0.7);
        --glass-border: rgba(39, 39, 42, 0.5);
    }

    body {
        font-family: 'Outfit', 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
        -webkit-font-smoothing: antialiased;
        scroll-behavior: smooth;
    }

    /* Glassmorphism effects */
    .glass {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
    }

    /* Modern scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    ::-webkit-scrollbar-track {
        background: transparent;
    }
    ::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 20px;
    }
    .dark ::-webkit-scrollbar-thumb {
        background: #3f3f46;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in {
        animation: fadeIn 0.4s ease-out forwards;
    }

    /* Hover scales */
    .hover-scale {
        transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .hover-scale:hover {
        transform: scale(1.02);
    }

    /* Specific Quill Overrides for Beauty */
    .ql-toolbar.ql-snow {
        border: none !important;
        border-bottom: 1px solid #e5e7eb !important;
        background: #fcfcfd !important;
        padding: 12px !important;
    }
    .dark .ql-toolbar.ql-snow {
        background: #18181b !important;
        border-bottom: 1px solid #27272a !important;
    }
</style>

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
