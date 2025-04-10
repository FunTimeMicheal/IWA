<?php

echo "Datalogger gestart...\n";
while(true)
{
    if ($buffer) {
        
        $segments = explode(";", trim($buffer));
        $parsedData = [];
        
        foreach ($segments as $segment) {
            list($key, $value) = explode(":", $segment);
            $parsedData[trim($key)] = trim($value);
        }
        
        file_put_contents($dataFile, json_encode($parsedData, JSON_PRETTY_PRINT));
        
        echo "Data opgeslagen: " . json_encode($parsedData) . "\n";
        
        $temperature = $parsedData['TEMP'] ?? null;
        $windSpeed = $parsedData['WIND'] ?? null;
        $humidity = $parsedData['HUM'] ?? null;
        
        echo "Data opgeslagen in Database.\n";
    }
    
    sleep(1); 
}

?>
