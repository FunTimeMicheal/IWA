<?php
namespace IWA\Application\Database\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use IWA\Application\Lib\Traits\Entity;

#[ORM\Entity]
#[ORM\Table(name: 'userroles')]

class UserRole {
    use Entity;
    
    #[ORM\Id]
    #[ORM\Column(type:'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'userrole')]
    private Collection $users;

    #[ORM\Column(type:'string')]
    private string $role;

    #[ORM\Column(type:'string')]
    private string $description;

    public function __construct(string $role, string $description) {
        $this->role  = $role;
        $this->description  = $description;
        $this->users = new ArrayCollection();
    }

}
