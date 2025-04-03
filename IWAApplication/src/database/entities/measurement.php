<?php
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'measurements')]
class Measurement {
    #[ORM\Id]
    #[ORM\Column(type:'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Station::class, inversedBy: 'measurements')]
    private Station|null $station;

    #[ORM\Column(type:'datetime')]
    private DateTime $date_time;
    #[ORM\Column(type:'float')]
    private float $temperature;
    #[ORM\Column(type:'float')]
    private float $invalid_temerature;
    #[ORM\Column(type:'float')]
    private float $dewpoint_temperature;
    #[ORM\Column(type:'float')]
    private float $air_pressure_station;
    #[ORM\Column(type:'float')]
    private float $air_pressure_sea_level;
    #[ORM\Column(type:'float')]
    private float $visibility;
    #[ORM\Column(type:'float')]
    private float $wind_speed;
    #[ORM\Column(type:'float')]
    private float $percipation;
    #[ORM\Column(type:'float')]
    private float $snow_depth;
    #[ORM\Column(type:'string')]
    private string $conditions;
    #[ORM\Column(type:'float')]
    private float $cloud_cover;
    #[ORM\Column(type:'integer')]
    private int $wind_direction;
    #[ORM\Column(type:'integer')]
    private int $missing_fields;

    public function __construct(Station $station, DateTime $date_time, float $temperature, float $invalid_temerature, float $dewpoint_temperature, float $air_pressure_station, float $air_pressure_sea_level, float $visibility, float $wind_speed, float $percipation, float $snow_depth, string $conditions, float $cloud_cover, int $wind_direction, int $missing_fields ) {
        $this->station = $station;
        $this->date_time = $date_time;
        $this->temperature = $temperature;
        $this->invalid_temerature = $invalid_temerature;
        $this->dewpoint_temperature = $dewpoint_temperature;
        $this->air_pressure_station = $air_pressure_station;
        $this->air_pressure_sea_level = $air_pressure_sea_level;
        $this->visibility = $visibility;
        $this->wind_speed = $wind_speed;
        $this->percipation = $percipation;
        $this->snow_depth = $snow_depth;
        $this->conditions = $conditions;
        $this->cloud_cover = $cloud_cover;
        $this->wind_direction = $wind_direction;
        $this->missing_fields = $missing_fields;
    }
    public function setStation(Station $station): void
    {
        $this->station= $station;
    }
}