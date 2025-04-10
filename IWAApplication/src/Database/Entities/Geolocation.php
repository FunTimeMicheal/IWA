<?php
namespace IWA\Application\Database\Entities;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'geolocation')]
class Geolocation {
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

    #[ORM\Column(type: 'string')]
    private string $latitude;

    #[ORM\Column(type: 'string')]
    private string $longitude;

    public function __construct(string $name, string $type, Geolocation $parent, $longitude, float $latitude) {
        $this->name = $name;
        $this->type = $type;
        $this->parent = $parent;
        $this->children = new ArrayCollection();
        $this->stations = new ArrayCollection();
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getName(): string {
        return $this->name;
    }
}