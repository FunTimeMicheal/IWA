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
            <a href="" class="button">Add</a>
        </div>

        <table>
            <tbody id="tablebody">
                <tr>
                    <th>Company ID</th>
                    <th>Company Name</th>
                </tr>
            </tbody>
        </table>

        <div id="infoModal" class="modal">
            <div id="infoModal-content" class="modal-content">
                <span class="close">&times;</span>
            </div>
        </div>
    </main>

</body>
</html>
<script src="/js/apicalls.js"></script>
<script>

    var modal = document.getElementById("infoModal");
    var closer = document.getElementsByClassName("close")[0];
    var modalContent = document.getElementById("infoModal-content");
    var modalForm = null;

    closer.onclick = function() {
        var modalForm = document.getElementById("modal-form");
        console.log(modalForm);
        modalContent.removeChild(modalForm);
        modal.style.display = "none";
    }
    
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
                class: 'data-item', 
                innerHTML: /* html */`
                    <td>${json[item].id}</td>
                    <td>${json[item].name}</td>
              `,
            });
            dataElement.onclick = () => {
                modal.style.display = "block";

                const form = Object.assign(document.createElement('form'), {
                id: "modal-form",
                innerHTML: /* html */`
                <label for="location">Location ID:</label>
                <input type="text" id="location" name="location" value="${json[item].location}"><br>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="${json[item].name}"><br>

                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="${json[item].email}"><br>

                <label for="number">Huisnummer:</label>
                <input type="text" id="number" name="number" value="${json[item].number}"><br>

                <label for="additional">Toevoeging:</label>
                <input type="text" id="additional" name="additional" value="${json[item].number_additional}"><br>

                <label for="street">Straatnaam:</label>
                <input type="text" id="street" name="street" value="${json[item].street}"><br>

                <label for="zip_code">Postcode:</label>
                <input type="text" id="zip_code" name="zip_code" value="${json[item].zip_code}"><br>

                <input class="button" type="submit" value="Submit changes">
                <input class="button" type="button" value= "Delete">
              `,
            });
                modalContent.appendChild(form);
            };
    
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
