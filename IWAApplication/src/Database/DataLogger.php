<?php
$json = file_get_contents('weatherdata.json'); 
$data = json_decode($json, true);

$weatherByStation = [];
$TemperatureAVG = []; 

$correctieStation = [
$TemperatureQueue = [];
$DewPointQueue = [];
$AirpressureStationQueue= [];
$AirpressureSeaQueue = [];
$VisibilityQueue = [];
$WindSpeedQueue = [];
$PercipitationQueue= [];
$SnowDepthQueue = [];
$ConditionsQueueu = [];
$CloudCoverQueueu =[];
$WindDirectionQueue= [];
];

if (isset($data['WEATHERDATA']) && is_array($data['WEATHERDATA'])) {
    foreach ($data['WEATHERDATA'] as $meting) {
        $station = $meting['STN'];

        if (!isset($correctieStation[$station])) {
            $TemperatureQueue[$station] = [];
            $DewPointQueue[$station] = [];
            $AirpressureStationQueue[$station] = [];
            $AirpressureSeaQueue[$station] = [];
            $VisibilityQueue[$station] = [];
            $WindSpeedQueue[$station] = [];
            $PercipitationQueue[$station]= [];
            $SnowDepthQueue[$station] = [];
            $ConditionsQueueu[$station] = [];
            $CloudCoverQueueu[$station] =[];
            $WindDirectionQueue[$station] = [];
        }

        $TemperatureQueue[$station][] = $meting['TEMP'];
        $DewPointQueue[$station][] = $meting['DEWP'];
        $AirpressureStationQueue[$station][] = $meting['STP'];
        $AirpressureSeaQueue[$station][] = $meting['SLP'];
        $VisibilityQueue[$station][] = $meting['VISIB'];
        $WindSpeedQueue[$station][] = $meting['WDSP'];
        $PercipitationQueue[$station][] = $meting['PRCP'];
        $SnowDepthQueue[$station][] = $meting['SNDP'];
        $ConditionsQueueu[$station][] = $meting['FRSHTT'];
        $CloudCoverQueueu[$station][] = $meting['CLDC'];
        $WindDirectionQueue[$station][] = $meting['WNDDIR'];

        if (count($TemperatureQueue[$station]) > 30) {
            array_shift($TemperatureQueue[$station]);
        }
        if (count($DewPointQueue[$station]) > 30) {
            array_shift($DewPointQueue[$station]);
        }
        if (count( $AirpressureStationQueue[$station]) > 30) {
            array_shift( $AirpressureStationQueue[$station]);
        }
        if (count($AirpressureSeaQueue[$station]) > 30) {
            array_shift($AirpressureSeaQueue[$station]);
        }
        if (count($VisibilityQueue[$station]) > 30) {
            array_shift($VisibilityQueue[$station]);
        }
        if (count($WindSpeedQueue[$station]) > 30) {
            array_shift($WindSpeedQueue[$station]);
        }
        if (count($PercipitationQueue[$station]) > 30) {
            array_shift($PercipitationQueue[$station]);
        }
        if (count( $SnowDepthQueue[$station]) > 30) {
            array_shift( $SnowDepthQueue[$station]);
        }
        if (count($ConditionsQueueu[$station]) > 30) {
            array_shift($ConditionsQueueu[$station]);
        }
        if (count($CloudCoverQueueu[$station]) > 30) {
            array_shift($CloudCoverQueueu[$station]);
        }
        if (count( $WindDirectionQueue[$station]) > 30) {
            array_shift( $WindDirectionQueue[$station]);
        }

        $TempAVG = array_sum($TemperatureQueue[$station]) / count($TemperatureQueue[$station]);
        $TemperatureAVG[$station] = $TempAVG;
        if ($meting['TEMP'] >= $TemperatureAVG[$station] * 1.2 || $meting['TEMP'] <= $TemperatureAVG[$station] * 0.8 || $meting['TEMP'] == 0) {
            $invalid_temperature = $meting['TEMP'];
            $meting['TEMP'] = $TemperatureAVG[$station]; 
        } 

        if ($meting['DEWP'] = 0)
        {
            $meting['DEWP'] = array_sum($DewPointQueue[$station]) / count($DewPointQueue[$station]);
        }
        if ($meting['STP'] = 0)
        {
            $meting['STP'] = array_sum($AirpressureStationQueue[$station]) / count($AirpressureStationQueue[$station]);
        }
        if ($meting['SLP'] = 0)
        {
            $meting['SLP'] = array_sum($AirpressureSeaQueue[$station]) / count($AirpressureSeaQueue[$station]);
        }
        if ($meting['VISIB'] = 0)
        {
            $meting['VISIB'] = array_sum($VisibilityQueue[$station]) / count($VisibilityQueue[$station]);
        }
        if ($meting['WDSP'] = 0)
        {
            $meting['WDSP'] = array_sum($WindSpeedQueue[$station]) / count($WindSpeedQueue[$station]);
        }
        if ($meting['PRCP'] = 0)
        {
            $meting['PRCP'] = array_sum($PercipitationQueue[$station]) / count($PercipitationQueue[$station]);
        }
        if ($meting['SNDP'] = 0)
        {
            $meting['SNDP'] = array_sum($SnowDepthQueue[$station]) / count($SnowDepthQueue[$station]);
        }
        if ($meting['FRSHTT'] = 0)
        {
            $meting['FRSHTT'] = array_sum($ConditionsQueueu[$station]) / count($ConditionsQueueu[$station]);
        }
        if ($meting['CLDC'] = 0)
        {
            $meting['CLDC'] = array_sum($CloudCoverQueueu[$station]) / count($CloudCoverQueueu[$station]);
        }
        if ($meting['WNDDIR'] = 0)
        {
            $meting['WNDDIR'] = array_sum($WindDirectionQueue[$station]) / count($WindDirectionQueue[$station]);
        }

        $weatherByStation[$station][] = [
            'date_time' => new DateTime($meting['DATE'] . ' ' . $meting['TIME']),
            'temperature' => $meting['TEMP'],
            'invalid_temperature' => $invalid_temperature,
            'dewpoint_temperature' => $meting['DEWP'],
            'air_pressure_station' => $meting['STP'],
            'air_pressure_sea_level' => $meting['SLP'],
            'visibility' => $meting['VISIB'],
            'wind_speed' => $meting['WDSP'],
            'percipation' => $meting['PRCP'],
            'snow_depth' => $meting['SNDP'],
            'conditions' => $meting['FRSHTT'],
            'cloud_cover' => $meting['CLDC'],
            'wind_direction' => $meting['WNDDIR'],
        ];
    }
}

?>
