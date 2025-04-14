<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Login</title>
</head>
<body>
    <main id="login">
        <div>
            <label for="email">Enter your email</label>
            <input type="email" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" />
            <label for="pass">Password (8 characters minimum)</label>
            <input type="password" id="pass" name="password" minlength="8" required />
  
            <a class="button" href="/home">Log In</a>
            <!-- <a href="/home">Back to home</a> -->
        </div>       

    </main>
</body>
</html>
<script src="/js/apicalls.js"></script>