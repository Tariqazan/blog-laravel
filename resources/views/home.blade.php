<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@auth
            Home
        @else
            Login
        @endauth
    </title>
</head>

<body>
    @auth
        <p>Congrats...</p>
        <form action="/create-post" method="POST">
            @csrf
            <input type="text" name="title">
            <textarea name="body" cols="30" rows="10"></textarea>
            <button>Create Post</button>
        </form>
        <ul>
            @foreach ($posts as $post)
                <li>
                    <h1>{{ $post['title'] }} by {{ $post->user->name }}</h1>
                    <p>{{ $post['body'] }}</p>
                    <a href="/edit-post/{{ $post->id }}">Edit</a>
                    <form action="/delete-post/{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <form action="/logout" method="POST">
            @csrf
            <button>Logout</button>
        </form>
    @else
        <form action="/login" method="POST">
            @csrf
            <input type="text" placeholder="Name" name="name">
            <input type="password" placeholder="Password" name="password">
            <button>Login</button>
        </form>
    @endauth
</body>

</html>
