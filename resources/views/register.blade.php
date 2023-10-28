<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>

<body>
    <form action="/register" method="POST">
        @csrf
        <input type="text" placeholder="Name" name="name">
        <input type="email" placeholder="Email" name="email">
        <input type="password" placeholder="Password" name="password">
        <button>Register</button>
    </form>
</body>

</html>
