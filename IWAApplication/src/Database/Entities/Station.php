<?php
namespace IWA\Application\Database\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use IWA\Application\Lib\Traits\Entity;
use JsonSerializable;

#[ORM\Entity]
#[ORM\Table(name: 'stations')]
class Station implements JsonSerializable
{
    use Entity;
    
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'float')]
    private float $longitude;

    #[ORM\Column(type: 'float')]
    private float $latitude;

    #[ORM\Column(type: 'float')]
    private float $elevation;

    #[ORM\OneToMany(targetEntity: Measurement::class, mappedBy: 'station')]
    private Collection $measurements;

    #[ORM\ManyToOne(targetEntity: Geolocation::class, inversedBy: 'stations')]
    private Geolocation|null $nearest_location;


    public function __construct(string $name, float $longitude, float $latitude, float $elevation, Geolocation $nearest_location) {
        $this->name = $name;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->elevation = $elevation;
        $this->measurements = new ArrayCollection();
        $this->nearest_location = $nearest_location;
    }
    public function getId(): int {
        return $this->id;
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

    public function jsonSerialize():mixed {
        $data = get_object_vars($this);
        $data["nearest_location"] = $data["nearest_location"]?->getId();
        unset($data["measurements"]);
        return $data;
    }
}