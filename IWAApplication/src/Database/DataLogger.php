<?php

function processWeatherData($data) {
    $invalid_temperature = null;
    $weatherByStation = [];
    $TemperatureAVG = [];
    $correctieStation = [];
    $TemperatureQueue = [];
    $DewPointQueue = [];
    $AirpressureStationQueue = [];
    $AirpressureSeaQueue = [];
    $VisibilityQueue = [];
    $WindSpeedQueue = [];
    $PercipitationQueue = [];
    $SnowDepthQueue = [];
    $ConditionsQueueu = [];
    $CloudCoverQueueu = [];
    $WindDirectionQueue = [];

    function processQueue(&$meting, $param, &$queue) {
        if ($meting[$param] === NULL) {
            if (count($queue) > 0) {
                $meting[$param] = array_sum($queue) / count($queue);
            } else {
                $meting[$param] = 0;
            }
        }
    }

    if (isset($data['WEATHERDATA']) && is_array($data['WEATHERDATA'])) {
        foreach ($data['WEATHERDATA'] as $meting) {
            $station = $meting['STN'];

            if (count($TemperatureQueue[$station]) > 30) {
                array_shift($TemperatureQueue[$station]);
            }
            if (count($DewPointQueue[$station]) > 30) {
                array_shift($DewPointQueue[$station]);
            }
            if (count($AirpressureStationQueue[$station]) > 30) {
                array_shift($AirpressureStationQueue[$station]);
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
            if (count($SnowDepthQueue[$station]) > 30) {
                array_shift($SnowDepthQueue[$station]);
            }
            if (count($ConditionsQueueu[$station]) > 30) {
                array_shift($ConditionsQueueu[$station]);
            }
            if (count($CloudCoverQueueu[$station]) > 30) {
                array_shift($CloudCoverQueueu[$station]);
            }
            if (count($WindDirectionQueue[$station]) > 30) {
                array_shift($WindDirectionQueue[$station]);
            }

            $TempAVG = array_sum($TemperatureQueue[$station]) / count($TemperatureQueue[$station]);
            $TemperatureAVG[$station] = $TempAVG;

            if ($meting['TEMP'] >= $TemperatureAVG[$station] * 1.2 || $meting['TEMP'] <= $TemperatureAVG[$station] * 0.8 || $meting['TEMP'] == NULL) {
                $invalid_temperature = $meting['TEMP'];
                $meting['TEMP'] = $TemperatureAVG[$station];
            }

            processQueue($meting, 'DEWP', $DewPointQueue[$station]);
            processQueue($meting, 'STP', $AirpressureStationQueue[$station]);
            processQueue($meting, 'SLP', $AirpressureSeaQueue[$station]);
            processQueue($meting, 'VISIB', $VisibilityQueue[$station]);
            processQueue($meting, 'WDSP', $WindSpeedQueue[$station]);
            processQueue($meting, 'PRCP', $PercipitationQueue[$station]);
            processQueue($meting, 'SNDP', $SnowDepthQueue[$station]);
            processQueue($meting, 'FRSHTT', $ConditionsQueueu[$station]);
            processQueue($meting, 'CLDC', $CloudCoverQueueu[$station]);
            processQueue($meting, 'WNDDIR', $WindDirectionQueue[$station]);

            if (!isset($correctieStation[$station])) {
                $TemperatureQueue[$station] = [];
                $DewPointQueue[$station] = [];
                $AirpressureStationQueue[$station] = [];
                $AirpressureSeaQueue[$station] = [];
                $VisibilityQueue[$station] = [];
                $WindSpeedQueue[$station] = [];
                $PercipitationQueue[$station] = [];
                $SnowDepthQueue[$station] = [];
                $ConditionsQueueu[$station] = [];
                $CloudCoverQueueu[$station] = [];
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

    return $weatherByStation;
}

?>
