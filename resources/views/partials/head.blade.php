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
