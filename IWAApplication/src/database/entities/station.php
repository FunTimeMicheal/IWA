<?php
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'stations')]
class Station
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $stationID;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'float')]
    private string $longitude;

    #[ORM\Column(type: 'float')]
    private string $latitude;

    #[ORM\Column(type: 'float')]
    private string $elevation;

    public function __construct(string $name, float $longitude, float $latitude, float $elevation) {
        $this->name = $name;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->elevation = $elevation;
    }

    public function getName() {
        return $this->name;
    }

    public function getLongitude() {
        return $this->longitude;
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function getElevation() {
        return $this->elevation;
    }
}