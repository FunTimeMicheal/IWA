<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stations</title>
</head>
<body>
    <button onclick="getStations()"></button>
</body>
</html>
<script type="text/javascript">
    async function getStations() {
        const url = '/api/stations/'

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
</script>