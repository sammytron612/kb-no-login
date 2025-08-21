<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
    .editor-container {
        width: 100%;
        min-height: 400px;
    }

    .tox-tinymce {
        width: 100% !important;
        max-width: 100% !important;
        transition: none !important;
    }

    .tox-editor-container,
    .tox-edit-area,
    .tox-edit-area iframe {
        width: 100% !important;
        max-width: 100% !important;
        transition: none !important;
    }

    /* Force immediate reflow on layout changes */
    .tox-tinymce-aux {
        display: none !important;
    }

    @media (max-width: 768px) {
        .tox-toolbar {
            flex-wrap: wrap !important;
        }

        .tox-toolbar__primary {
            flex-wrap: wrap !important;
        }
    }

    /* Add observer class for layout changes */
    .layout-observer {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 1px;
        pointer-events: none;
        z-index: -1;
    }
</style>

<script>
// Global TinyMCE resize handler
window.handleTinyMCEResize = function() {
    if (typeof tinymce !== 'undefined') {
        const editor = tinymce.get('editor');
        if (editor) {
            requestAnimationFrame(() => {
                try {
                    // Force container width update
                    const container = editor.getContainer();
                    if (container) {
                        container.style.width = '100%';
                        container.style.maxWidth = '100%';
                    }

                    // Force editor repaint
                    editor.execCommand('mceRepaint');

                    // Trigger resize event on editor
                    if (editor.fire) {
                        editor.fire('ResizeEditor');
                    }
                } catch (e) {
                    console.warn('TinyMCE resize failed:', e);
                }
            });
        }
    }
};

// Enhanced resize observer for layout changes
window.createTinyMCEObserver = function() {
    if (!window.ResizeObserver) return;

    const observer = new ResizeObserver(entries => {
        let shouldResize = false;

        for (let entry of entries) {
            const { width } = entry.contentRect;
            if (width > 0) {
                shouldResize = true;
                break;
            }
        }

        if (shouldResize) {
            setTimeout(window.handleTinyMCEResize, 100);
        }
    });

    return observer;
};
</script>

@fluxAppearance
