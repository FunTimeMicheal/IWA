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
            <a id="addButton" href="#" class="button">Add</a>
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
    var addButton = document.getElementById("addButton");

    closer.onclick = function() {
        closeModal()
    }

    addButton.onclick = function() {
        modal.style.display = "block";

        const form = Object.assign(document.createElement('form'), {
            id: "modal-form",
            action: "api/companies/",
            method: "POST",
            innerHTML: /* html */`

            <label for="name">Name:</label>
            <input type="text" id="name" name="name"><br>

            <label for="street">Street name:</label>
            <input type="text" id="street" name="street"><br>

            <label for="number">House number:</label>
            <input type="text" id="number" name="number"><br>

            <label for="nummer_additional">Number additional:</label>
            <input type="text" id="nummer_additional" name="nummer_additional"><br>

            <label for="zip_code">Zip Code:</label>
            <input type="text" id="zip_code" name="zip_code"><br>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email"><br>

            <label for="location">Location ID:</label>
            <input type="text" id="location" name="location"><br>

            <input class="button" type="submit" value="Add">
              `,
        });
        modalContent.appendChild(form);
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
                id: "modal-form-patch",
                innerHTML: /* html */`

                <input type="hidden" id="id" name="id" value="${json[item].id}"><br>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="${json[item].name}"><br>

                <label for="street">Street name:</label>
                <input type="text" id="street" name="street" value="${json[item].street}"><br>

                <label for="number">House number:</label>
                <input type="text" id="number" name="number" value="${json[item].number}"><br>

                <label for="nummer_additional">Number additional:</label>
                <input type="text" id="nummer_additional" name="nummer_additional" value="${json[item].nummer_additional}"><br>

                <label for="zip_code">Zip Code:</label>
                <input type="text" id="zip_code" name="zip_code" value="${json[item].zip_code}"><br>

                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="${json[item].email}"><br>

                <label for="location">Location ID:</label>
                <input type="text" id="location" name="location" value="${json[item].location}"><br>

                <input class="button" type="submit" value="Submit changes">
              `,
            });
                modalContent.appendChild(form);
                listenForPatch()
            };
    
            const parent = document.getElementById("tablebody");
            parent.appendChild(dataElement);
        }
    } catch (error) {
        console.error(error);
    }
}

function listenForPatch() {
    document.getElementById("modal-form-patch").addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        const jsonData = Object.fromEntries(formData.entries());

        fetch(`api/companies/${jsonData.id}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(jsonData),
        })
        .then(response => response.json())
        .then(() => {
            window.location.reload();
        })
    });
}

function closeModal() {
    var modalForm = document.getElementById("modal-form");
    if (!modalForm) {
        var modalForm = document.getElementById("modal-form-patch");
    }
    modalContent.removeChild(modalForm);
    modal.style.display = "none";
}
 
window.onload = function() {
    getCompanyData()
}
</script>
