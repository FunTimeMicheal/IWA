<?php
namespace IWA\Application\Database\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use IWA\Application\Lib\Traits\Entity;

#[ORM\Entity]
#[ORM\Table(name: 'geolocation')]
class Geolocation {
    use Entity;
    
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string')]
    private string $type;

    #[ORM\ManyToOne(targetEntity: Geolocation::class, inversedBy: 'children')]
    private Geolocation|null $parent;

    #[ORM\OneToMany(targetEntity: Geolocation::class, mappedBy: 'parent')]
    private Collection $children;

    #[ORM\OneToMany(targetEntity: Station::class, mappedBy: 'nearest_location')]
    private Collection $stations;

    #[ORM\OneToMany(targetEntity: Company::class, mappedBy: 'location')]
    private Collection $companies;

    #[ORM\Column(type: 'float')]
    private float $latitude;

    #[ORM\Column(type: 'float')]
    private float $longitude;

    public function __construct(string $name, string $type, Geolocation $parent, $longitude, float $latitude) {
        $this->name = $name;
        $this->type = $type;
        $this->parent = $parent;
        $this->children = new ArrayCollection();
        $this->stations = new ArrayCollection();
        $this->companies = new ArrayCollection();
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getId(): int {
        return $this->id;
    }
}