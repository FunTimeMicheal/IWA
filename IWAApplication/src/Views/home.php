<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Contracts</title>
</head>
<body>
    <header>
        <img src="assets/logo.png" height="32" width="38" alt="IWA logo">
        <nav>
            <a href="/home">Home</a>
            <a href="/contracts">Contracts</a>
            <a href="/data">Data</a>
            <a href="/stations">Stations</a>
            <a href="/companies">Companies</a>
            <a href="/roles">Roles</a>
            <a href="/users">Users</a>
        </nav>
        <a href="#login">Log Out</a>
    </header>

    <main id="landing">
        <!-- voorbeeld cards -->
        <div class="card">
            <h1>Data</h1>
            <h4>Start</h4>
            <input type="datetime-local">
            <h4>End</h4>
            <input type="datetime-local">
            <a class="button" href="#data">Get Data</a>
        </div>
        <div class="card">
            <h1>Stations</h1>
            <h3>Outages:</h3>
            <div class="outages">
                <div class="station">
                    <div class="header">
                        <h3 class="tag warning">WARN</h3>
                        <h2><a href="#station-warning">Station #127 (Groningen)</a></h2>
                    </div>
                    <p>Incorrect Data (5 minutes ago)</p>
                </div>
                <div class="station">
                    <div class="header">
                        <h3 class="tag error">ERR</h3>
                        <h2><a href="#station-warning">Station #3346 (New York)</a></h2>
                    </div>
                    <p>Connection Lost (since 3 hours ago)</p>
                </div>
            </div>
            <a class="button" href="#stations">See All Stations</a>
        </div>
    </main>
</body>