<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Stations</title>
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

<main id="stations">
    <div class="header">
        <input type="text" placeholder="Search Regions..">
        <a href="" class="button">Search</a>
    </div>
    <!-- For each region with it's own name, the below should be seen as an example -->
    <div class="region">
        <h2>Groningen</h2>
        <div class="stations">
            <h4 class="station">0</h4>
            <h4 class="station error">1</h4>
            <h4 class="station warning">2</h4>
        </div>
    </div>
</main>

</body>
</html>
<script src="/js/apicalls.js"></script> 