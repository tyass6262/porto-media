<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Register</h2>

<form method="POST" action="/register">
    @csrf

    <input name="name" placeholder="Nama" class="form-control mb-2">
    <input name="email" placeholder="Email" class="form-control mb-2">
    <input name="password" type="password" placeholder="Password" class="form-control mb-2">

    <button class="btn btn-success">Register</button>
</form>

<p class="mt-2">
    Sudah punya akun? <a href="/login">Login</a>
</p>

</body>
</html>