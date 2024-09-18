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
   <form method="POST" action="{{route('post.add')}}">
       @csrf
       <main>
           <textarea id="content" name="content"></textarea>
       </main>
       <button>submit</button>
   </form>


</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
