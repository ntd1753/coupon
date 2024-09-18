<html>
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" id="fm-main-block">
            <iframe id="fm" src="{{ url('/file-manager/fm-button') }}" class="w-full h-full"></iframe>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set iframe height
        document.getElementById('fm').style.height = (window.innerHeight - 50) + 'px';
        document.getElementById('fm').style.width = (window.innerWidth - 50) + 'px';

        // Handle messages from the file manager
        window.addEventListener('message', function(event) {
            if (event.origin !== window.location.origin) {
                return;
            }

            const data = event.data;
            if (data.type === 'file:selected') {
                window.opener.fmSetLink(data.url);
                window.close();
            }
        });
    });
</script>
</body>
</html>
