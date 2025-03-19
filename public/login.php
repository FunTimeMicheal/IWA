<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="loginpage.css">
        <script src="/public/loginfunctions.js"></script>
        <title>Login</title>
    </head>
    <body>
        <header>
            <div>
                hi
            </div>
        </header>
        <main>
            <div class="login-container">
                
                <form action="/" class="login-form">
                    <div class="login-title">
                        <h1>Sign in</h1>
                    </div>
                    <div class="login-content">
                        <div>
                            <input type="email" placeholder="E-mail">
                        </div>
                        <div>
                            <input type="password" placeholder="Password" id="login-password">
                        </div>
                        <div class="login-options">
                            <div class="login-show-password">
                                <input id="show-password" type="checkbox" onclick="showPassword()" checked="">
                                <label for="show-password">Show Password</label>
                            </div>
                            <div>
                                <a href="#" class="forgot-passwprd">Forgot password?</a>
                            </div>
                        </div>
                        <div class="login-submit-button">
                             <button type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>




