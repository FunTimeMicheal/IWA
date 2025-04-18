<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Roles</title>
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
            <input type="text" placeholder="Search Roles..">
            <a href="" class="button">Search roles...</a>
            <a id="addButton" href="#" class="button">Add</a>
        </div>

        <table>
            <tbody id="tablebody">
                <tr>
                    <th>Role Name</th>
                    <th>Role Description</th>
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
            action: "api/roles/",
            method: "POST",
            innerHTML: /* html */`

            <label for="role">Name:</label>
            <input type="text" id="role" name="role"><br>

            <label for="description">Description:</label>
            <input type="text" id="description" name="description"><br>
            <input class="button" type="submit" value="Add">
              `,
        });
        modalContent.appendChild(form);
    }

    async function getRoleData() {
    try {
        const response = await fetch('/api/roles/');
        if(!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json().catch(() => {});
        console.log(json)

        for (const item in json) {
            const dataElement = Object.assign(document.createElement('tr'), {
                innerHTML: /* html */`
                    <td>${json[item].role}</td>
                    <td>${json[item].description}</td>
              `,
            });

            dataElement.onclick = () => {
                modal.style.display = "block";

                const form = Object.assign(document.createElement('form'), {
                id: "modal-form-patch",
                innerHTML: /* html */`

                <input type="hidden" id="id" name="id" value="${json[item].id}"><br>

                <label for="role">Name:</label>
                <input type="text" id="role" name="role" value="${json[item].role}"><br>

                <label for="description">Description:</label>
                <input type="text" id="description" name="description" value="${json[item].description}"><br>

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

        fetch(`api/roles/${jsonData.id}`, {
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
    getRoleData()
}
</script>