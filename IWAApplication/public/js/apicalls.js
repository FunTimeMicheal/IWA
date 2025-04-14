async function getData(url) {
    try {
        const response = await fetch(url);
        if(!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json().catch(() => {});
        console.log(json)

        for (const item of json) {
            const dataElement = Object.assign(document.createElement('div'), {
                className: 'region',
                innerHTML: /* html *//* html */`
                <h2>Groningen</h2>
                <div class="stations">
                    <h4 class="station">0</h4>
                    <h4 class="station error">1</h4>
                    <h4 class="station warning">2</h4>
                </div>
              `,
            });
    
            const parent = document.getElementById("stations");
            parent.appendChild(dataElement);
        }
        

    } catch (error) {
        console.error(error);
    }
}

async function postData(url) {
    try {
        const response = await fetch(url, {
            method: "POST"
        });
        if(!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json().catch(() => {});
        console.log(json)

    } catch (error) {
        console.error(error);
    }
}

async function patchData(url) {
    try {
        const response = await fetch(url, {
            method: "PATCH"
        });
        
        if(!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json().catch(() => {});
        console.log(json)

    } catch (error) {
        console.error(error);
    }
}
async function deleteData(url) {
    try {
        const response = await fetch(url, {
            method: "DELETE"
        });

        if(!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json().catch(() => {});
        console.log(json)

    } catch (error) {
        console.error(error);
    }
}