<?php
namespace IWA\Application\Database\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'companies')]

class Company {
    #[ORM\Id]
    #[ORM\Column(type:'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Geolocation::class, inversedBy: 'companies')]
    private Geolocation|null $location = null;

    //subscriptions

    #[ORM\OneToMany(targetEntity: Relation::class, mappedBy: 'company')]
    private Collection $relations;

    #[ORM\Column(type:'string')]
    private string $name;

    #[ORM\Column(type:'string')]
    private string $street;

    #[ORM\Column(type:'integer')]
    private int $number;

    #[ORM\Column(type:'string')]
    private string $nummer_additional;

    #[ORM\Column(type:'string')]
    private string $zip_code;

    #[ORM\Column(type:'string')]
    private string $email;

    public function __construct(string $name, string $city, string $street, int $number, string $nummer_additional, string $zip_code, string $email) {
        $this->name  = $name;
        $this->city  = $city;
        $this->street  = $street;
        $this->number  = $number;
        $this->nummer_additional  = $nummer_additional;
        $this->zip_code  = $zip_code;
        $this->email  = $email;
        $this->relations = new ArrayCollection();
    }
}
