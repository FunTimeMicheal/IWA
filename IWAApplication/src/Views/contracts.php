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

    <main id="contracts">
        <div class="header">
            <input type="text" placeholder="Search Contracts..">
            <a href="" class="button">Search</a>
        </div>

        <table>
            <tbody id="tablebody">
                <tr>
                    <th>Contract ID</th>
                    <th>Company name</th>
                </tr>
                 <tr>
                 </tr>
            </tbody>
        </table>
    </main>

</body>
</html>
<script src="/js/apicalls.js"></script>
<script>
    //TODO: Moet uitgewerkt worden aangezien dit nog een skelet van een functie is, ook in de innerhtml
    async function getContractData() {
    try {
        const response = await fetch('/api/contracts/');
        if(!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json().catch(() => {});
        console.log(json)

        for (const item of json) {
            const dataElement = Object.assign(document.createElement('tr'), {
                innerHTML: /* html */`
                    <td>${item.id}</td>
              `,
            });
    
            const parent = document.getElementById("tablebody");
            parent.appendChild(dataElement);
        }
    } catch (error) {
        console.error(error);
    }
}

window.onload = function() {
    getContractData()
}
</script>