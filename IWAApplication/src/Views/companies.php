<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Companies</title>
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
            <input type="text" placeholder="Search Companies..">
            <a href="" class="button">Search</a>
        </div>

        <table>
            <tbody id="tablebody">
                <tr>
                    <th>Comany ID</th>
                    <th>Company Name</th>
                </tr>
                 <tr>
                    <td>1</td>
                    <td>Boing</td>
                 </tr>
            </tbody>
        </table>
    </main>

</body>
</html>
<script src="/js/apicalls.js"></script>
<script>
    async function getCompanyData() {
    try {
        const response = await fetch('/api/companies/');
        if(!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json().catch(() => {});
        console.log(json)

        for (const item in json) {
            const dataElement = Object.assign(document.createElement('tr'), {
                innerHTML: /* html */`
                    <td>${item.id}</td>
                    <td>${item.name}</td>
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
    getCompanyData()
}
</script>