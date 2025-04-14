<?php
namespace IWA\Application\Database\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relations')]

class Relation {
  #[ORM\Id]
  #[ORM\Column(type:'integer')]
  #[ORM\GeneratedValue]
  private int $id;

  #[ORM\ManyToOne(targetEntity: Company::class, inversedBy: 'relations')]
  private Company|null $company;

  #[ORM\Column(type:'string')]
  private string $name;

  #[ORM\Column(type:'string')]
    private string $first_name;

    #[ORM\Column(type:'string')]
    private string $initials;

    #[ORM\Column(type:'string')]
    private string $prefix;

    #[ORM\Column(type:'string')]
    private string $function;

    #[ORM\Column(type:'string')]
    private string $title;

    #[ORM\Column(type:'string')]
    private string $email;

    #[ORM\Column(type:'string')]
    private string $phone;
  
  public function __construct(string $name, string $first_name, string $initials, string $prefix, string $function, string $title, string $email, string $phone) {
    $this->name = $name;
    $this->first_name = $first_name;
    $this->initials = $initials;
    $this->prefix = $prefix;
    $this->function = $function;
    $this->title = $title;
    $this->email = $email;
    $this->phone = $phone;

  }

  public function setCompany(Company $company) {
    $this->company = $company;
  }
}