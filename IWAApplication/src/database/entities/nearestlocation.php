<?php
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'nearestlocation')]

class NearestLocation
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id;

    #[ORM\OneToOne(targetEntity: Station::class)]
    private Station|null $station = null;

    #[ORM\ManyToOne(targetEntity: Country::class, inversedBy: 'nearest_locations')]
    private Country|null $country = null;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string')]
    private string $administrative_region1;

    #[ORM\Column(type: 'string')]
    private string $administrative_region2;

    #[ORM\Column(type: 'float')]
    private float $longitude;

    #[ORM\Column(type: 'float')]
    private float $latitude;

    public function __construct(Station $station, Country $country, string $name, string $administrative_region1, string $administrative_region2, float $longitude, float $latitude) {
        $this->station = $station;
        $this->country = $country;
        $this->name = $name;
        $this->administrative_region1 = $administrative_region1;
        $this->administrative_region2 = $administrative_region2;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }
}