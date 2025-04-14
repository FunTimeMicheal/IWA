<?php
namespace IWA\Application\Database;

use IWA\Application\Lib\Queue;

class DataLogger
{
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

    

    function processWeatherData($data) {
        if (isset($data['WEATHERDATA']) && is_array($data['WEATHERDATA'])) {
            foreach ($data['WEATHERDATA'] as $meting) {
                $station = $meting['STN'];
                
                $stationTemperatureQueue = $TemperatureQueue[$station] ?? $TemperatureQueue[$station] = new Queue();
                $stationTemperatureQueue->enqueue();

                $stationDewPointQueue = $DewPointQueue[$station] ?? $DewPointQueue[$station] = new Queue();
                $stationDewPointQueue->enqueue(); 

                $stationAirpressureStationQueue = $AirpressureStationQueue[$station] ?? $AirpressureStationQueue[$station]= new Queue();
                $stationAirpressureStationQueue->enqueue(); 

                $stationAirpressureSeaQueue = $AirpressureSeaQueue[$station] ?? $AirpressureSeaQueue[$station] = new Queue();  
                $stationAirpressureSeaQueue->enqueue(); 

                $stationVisibilityQueue = $VisibilityQueue[$station] ?? $VisibilityQueue[$station] = new Queue();
                $stationVisibilityQueue->enqueue(); 

                $stationWindSpeedQueue = $WindSpeedQueue[$station] ?? $WindSpeedQueue[$station] = new Queue(); 
                $stationWindSpeedQueue->enqueue(); 

                $stationPercipitationQueue = $PercipitationQueue[$station]  ?? $PercipitationQueue[$station] = new Queue();
                $stationPercipitationQueue->enqueue(); 

                $stationSnowDepthQueue = $SnowDepthQueue[$station] ?? $SnowDepthQueue[$station] = new Queue();
                $stationSnowDepthQueue->enqueue(); 

                $stationConditionsQueueu = $ConditionsQueueu[$station] ?? $ConditionsQueueu[$station] = new Queue();  
                $stationConditionsQueueu->enqueue(); 

                $stationCloudCoverQueueu = $CloudCoverQueueu[$station] ?? $CloudCoverQueueu[$station] = new Queue();
                $stationCloudCoverQueueu->enqueue(); 

                $stationWindDirectionQueue = $WindDirectionQueue[$station] ?? $WindDirectionQueue[$station] = new Queue(); 
                $stationWindDirectionQueue->enqueue(); 
                
                if ($meting['TEMP'] >= stationTemperatureQueue->AVG() * 1.2 || $meting['TEMP'] <= stationTemperatureQueue->AVG() * 0.8 || $meting['TEMP'] == NULL) {
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

    function processQueue(&$meting, $param, &$queue) {
        if ($meting[$param] === NULL) {
            if (count($queue) > 0) {
                $meting[$param] = array_sum($queue) / count($queue);
            } else {
                $meting[$param] = 0;
            }
        }
        else ;
    }
}
?>
