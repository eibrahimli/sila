<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="{{ route('admin.loginStore') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="Enter Your Email">
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password">
    </div>

    <div class="form-grou">
        <button class="btn btn-primary" type="submit">Login</button>
    </div>
</form>
    
</body>
</html>