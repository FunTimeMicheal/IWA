<?php
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'countries')]

class Country {
  #[ORM\Id]
  #[ORM\Column(type:'integer')]
  #[ORM\GeneratedValue]
  private int $id;

  #[ORM\Column(type:'string')]
  private string $name;

  #[ORM\OneToMany(targetEntity: Company::class, mappedBy: 'country')]
  private Collection $companies;

  #[ORM\OneToMany(targetEntity: NearestLocation::class, mappedBy: 'country')]
  private Collection $nearest_locations;
  
  public function __construct(string $name) {
    $this->name = $name;
    $this->nearest_locations = new ArrayCollection();
    $this->companies = new ArrayCollection();
  }

  public function getID(): int {
    return $this->id;
  }

  public function getName(): string {
    return $this->name;
  }
}

