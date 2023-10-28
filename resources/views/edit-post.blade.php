<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post Details</title>
</head>

<body>
    <form action="" method="POST">
        @csrf
        <input type="text" name="title" value="{{ $post['title'] }}">
        <textarea name="body" cols="30" rows="10">{{ $post['body'] }}</textarea>
        <button>Save Changes</button>
    </form>
    <form action="/delete-post/{{ $post->id }}" method="POST">
        @csrf
        @method('DELETE')
        <button>Delete</button>
    </form>
    </li>
</body>

</html>
