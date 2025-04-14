<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Data</title>
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

    <main id="data">
        <nav>
            <h4>Start</h4>
            <input type="datetime-local">
            <h4>End</h4>
            <input type="datetime-local">
            <a class="button" href="">Get Data</a>
        </nav>
        <!-- the below should be seen as an example, needs to be made dynamic -->
        <div>
            <div class="header">
                <div class="info">
                    <h1>Data Result</h1>
                    <ul>
                        <li>
                            Number of elements: 128
                        </li>
                        <li>
                            Average temperature: 42°C
                        </li>
                    </ul>
                </div>
                <input type="button" value="Download as CSV">
                
            </div>
            <table>
                <tbody>
                    <tr>
                        <th>Temperature</th>
                        <th>Other</th>
                    </tr>
                    <tr>
                        <td>69.16964171103331</td>
                        <td>12.660522708994833</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</body>