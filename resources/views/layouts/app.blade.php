<!DOCTYPE html>
<html>
<head>
    <title>Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <a href="/projects" class="navbar-brand">Portfolio</a>

    <div>
        <a href="/projects" class="btn btn-light btn-sm">Project</a>
        <a href="/categories" class="btn btn-light btn-sm">Category</a>
        <a href="/logout" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>