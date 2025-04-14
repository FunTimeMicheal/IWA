<?php
namespace IWA\Application\Database;

use DateTime;
use IWA\Application\Lib\Queue;

class DataLogger
{
    private $invalid_temperature = [];
    private $weatherByStation = [];
    private $TemperatureAVG = [];
    private $correctieStation = [];
    private $TemperatureQueue = [];
    private $DewPointQueue = [];
    private $AirpressureStationQueue = [];
    private $AirpressureSeaQueue = [];
    private $VisibilityQueue = [];
    private $WindSpeedQueue = [];
    private $PercipitationQueue = [];
    private $SnowDepthQueue = [];
    private $ConditionsQueueu = [];
    private $CloudCoverQueueu = [];
    private $WindDirectionQueue = [];

    

    function processWeatherData($data) {
        if (isset($data['WEATHERDATA']) && is_array($data['WEATHERDATA'])) {
            foreach ($data['WEATHERDATA'] as $meting) {
                $station = $meting['STN'];
                
                $stationTemperatureQueue = $TemperatureQueue[$station] ?? $TemperatureQueue[$station] = new Queue();
                $stationTemperatureQueue->enqueue('TEMP');

                $stationDewPointQueue = $DewPointQueue[$station] ?? $DewPointQueue[$station] = new Queue();
                $stationDewPointQueue->enqueue('DEWP'); 

                $stationAirpressureStationQueue = $AirpressureStationQueue[$station] ?? $AirpressureStationQueue[$station]= new Queue();
                $stationAirpressureStationQueue->enqueue('STP'); 

                $stationAirpressureSeaQueue = $AirpressureSeaQueue[$station] ?? $AirpressureSeaQueue[$station] = new Queue();  
                $stationAirpressureSeaQueue->enqueue('SLP'); 

                $stationVisibilityQueue = $VisibilityQueue[$station] ?? $VisibilityQueue[$station] = new Queue();
                $stationVisibilityQueue->enqueue('VISIB'); 

                $stationWindSpeedQueue = $WindSpeedQueue[$station] ?? $WindSpeedQueue[$station] = new Queue(); 
                $stationWindSpeedQueue->enqueue('WDSP'); 

                $stationPercipitationQueue = $PercipitationQueue[$station]  ?? $PercipitationQueue[$station] = new Queue();
                $stationPercipitationQueue->enqueue('PRCP'); 

                $stationSnowDepthQueue = $SnowDepthQueue[$station] ?? $SnowDepthQueue[$station] = new Queue();
                $stationSnowDepthQueue->enqueue('SNDP'); 

                $stationConditionsQueueu = $ConditionsQueueu[$station] ?? $ConditionsQueueu[$station] = new Queue();  
                $stationConditionsQueueu->enqueue('FRSHTT'); 

                $stationCloudCoverQueueu = $CloudCoverQueueu[$station] ?? $CloudCoverQueueu[$station] = new Queue();
                $stationCloudCoverQueueu->enqueue('CLDC'); 

                $stationWindDirectionQueue = $WindDirectionQueue[$station] ?? $WindDirectionQueue[$station] = new Queue(); 
                $stationWindDirectionQueue->enqueue('WNDDIR'); 
                
                if ($meting['TEMP'] >= $stationTemperatureQueue->AVG() * 1.2 || $meting['TEMP'] <= $stationTemperatureQueue->AVG() * 0.8 || $meting['TEMP'] == NULL) {
                    $invalid_temperature = $meting['TEMP'];
                    $meting['TEMP'] = $this->TemperatureAVG[$station];
                }

                $this->processQueue($meting, 'DEWP', $DewPointQueue[$station]);
                $this->processQueue($meting, 'STP', $AirpressureStationQueue[$station]);
                $this->processQueue($meting, 'SLP', $AirpressureSeaQueue[$station]);
                $this->processQueue($meting, 'VISIB', $VisibilityQueue[$station]);
                $this->processQueue($meting, 'WDSP', $WindSpeedQueue[$station]);
                $this->processQueue($meting, 'PRCP', $PercipitationQueue[$station]);
                $this->processQueue($meting, 'SNDP', $SnowDepthQueue[$station]);
                $this->processQueue($meting, 'FRSHTT', $ConditionsQueueu[$station]);
                $this->processQueue($meting, 'CLDC', $CloudCoverQueueu[$station]);
                $this->processQueue($meting, 'WNDDIR', $WindDirectionQueue[$station]);

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
