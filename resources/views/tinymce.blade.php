<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TinyMCE</title>
    <link rel="icon" href="https://manhdandev.com/web/img/favicon.webp" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/js/app.js'])
</head>
<body>
<div class="col-lg-8 mx-auto p-3 py-md-5">
    <header class="d-flex align-items-center pb-3 mb-3 border-bottom">
        <a href="https://manhdandev.com" class="d-flex align-items-center text-dark text-decoration-none" target="_blank">
            <img src="https://manhdandev.com/web/img/logo.webp" width="100px" height="100px">
        </a>
    </header>
    <main>
        <textarea id="content"></textarea>
    </main>
    <footer class="pt-5 my-5 text-muted border-top">
        &copy;Copyright &copy;2023 All rights reserved | This template is made with
        <i class="fa fa-heart-o"></i> by <a href="https://manhdandev.com/" rel="noopener" target="_blank">ManhDanBlogs</a>
    </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
