async function getData(url) {
    try {
        const response = await fetch(url);
        if(!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.text();
        console.log(json)

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

        const json = await response.text();
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

        const json = await response.text();
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

        const json = await response.text();
        console.log(json)

    } catch (error) {
        console.error(error);
    }
}