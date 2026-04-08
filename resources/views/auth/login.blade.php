<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Login</h2>

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form method="POST" action="/login">
    @csrf

    <input name="email" placeholder="Email" class="form-control mb-2">
    <input name="password" type="password" placeholder="Password" class="form-control mb-2">

    <button class="btn btn-primary">Login</button>
</form>

<p class="mt-2">
    Belum punya akun? <a href="/register">Register</a>
</p>

</body>
</html>