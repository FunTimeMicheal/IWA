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

<main id="contracts">
    <div id="header" class="header">
        <input type="text" placeholder="Search Regions..">
        <a href="" class="button">Search</a>
    </div>

    <table>
        <tbody id="tablebody">
            <tr>
                <th>Station Name</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Elevation</th>
                <th>Nearest location</th>
            </tr>
            <tr>
                

            </tr>
        </tbody>

        <div id="infoModal" class="modal">
            <div id="infoModal-content" class="modal-content">
                <span class="close">&times;</span>
            </div>
        </div>
    </table>
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

    //TODO: Zorg ervoor dat dit op basis van region en bijbehorende stations gebeurt in plaats van alleen de stations
    async function getStationData() {
    try {
        const response = await fetch('/api/stations/');
        if(!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json().catch(() => {});
        console.log(json)

        for (const item in json) {
            const dataElement = Object.assign(document.createElement('tr'), {
                className: 'region',
                innerHTML: /* html */`
                <td>${json[item].name}</td>
                <td>${json[item].longitude}</td>
                <td>${json[item].latitude}</td>
                <td>${json[item].elevation}</td>
                <td>${json[item].nearest_location}</td>
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

                <label for="longitude">Longtitude:</label>
                <input type="number" id="longitude" name="longitude" value="${json[item].longitude}"><br>

                <label for="latitude">Latitude:</label>
                <input type="number" id="latitude" name="latitude" value="${json[item].latitude}"><br>
                
                <label for="elevation">Elevation:</label>
                <input type="number" id="elevation" name="elevation" value="${json[item].elevation}"><br>

                <label for="nearest_location">Nearest location:</label>
                <input type="number" id="nearest_location" name="nearest_location" value="${json[item].nearest_location}"><br>

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
        console.log(jsonData);

        fetch(`api/stations/${jsonData.id}`, {
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
    getStationData()
}
</script>