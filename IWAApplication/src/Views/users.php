<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Users</title>
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
            <input type="text" placeholder="Search Users..">
            <a href="" class="button">Search Users..</a>
            <a id="addButton" href="#" class="button">Add</a>
        </div>

        <table>
            <tbody id="tablebody">
                <tr>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Employee Code</th>
                    <th>Role ID</th>
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
        var passString = Math.random().toString(36).slice(-8);
        const form = Object.assign(document.createElement('form'), {
            id: "modal-form",
            action: "api/users/",
            method: "POST",
            innerHTML: /* html */`

            <label for="first_name">First name:</label>
            <input type="text" id="first_name" name="first_name"><br>

            <label for="last_name">Last name:</label>
            <input type="text" id="last_name" name="last_name"><br>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email"><br>

            <label for="employee_code">Employee code:</label>
            <input type="text" id="employee_code" name="employee_code"><br>

            <label for="userrole">Role id:</label>
            <input type="text" id="userrole" name="userrole"><br>

            <input type="hidden" id="password" name="password" value="${passString}">

            <input class="button" type="submit" value="Add">
              `,
        });
        modalContent.appendChild(form);
    }

    async function getUserData() {
    try {
        const response = await fetch('/api/users/');
        if(!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json().catch(() => {});
        console.log(json)

        for (const item in json) {
            const dataElement = Object.assign(document.createElement('tr'), {
                innerHTML: /* html */`
                    <td>${json[item].first_name} ${json[item].last_name}</td>
                    <td>${json[item].email}</td>
                    <td>${json[item].employee_code}</td>
                    <td>${json[item].userrole}</td>
              `,
            });

            dataElement.onclick = () => {
                modal.style.display = "block";

                const form = Object.assign(document.createElement('form'), {
                id: "modal-form-patch",
                innerHTML: /* html */`

                <input type="hidden" id="id" name="id" value="${json[item].id}"><br>

                <label for="first_name">First name:</label>
                <input type="text" id="first_name" name="first_name" value="${json[item].first_name}"><br>

                <label for="last_name">Last name:</label>
                <input type="text" id="last_name" name="last_name" value="${json[item].last_name}"><br>

                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="${json[item].email}"><br>

                <label for="employee_code">Employee code:</label>
                <input type="text" id="employee_code" name="employee_code" value="${json[item].employee_code}"><br>

                <label for="userrole">Role id:</label>
                <input type="number" id="userrole" name="userrole" value="${json[item].userrole}"><br>

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

        fetch(`api/users/${jsonData.id}`, {
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
    getUserData()
}
</script>