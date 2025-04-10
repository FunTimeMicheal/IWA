<?php
namespace IWA\Application\Database\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]

class User {
    #[ORM\Id]
    #[ORM\Column(type:'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\ManyToOne(targetEntity: UserRole::class, inversedBy: 'users')]
    private UserRole|null $userrole;

    #[ORM\Column(type:'string')]
    private string $name;

    #[ORM\Column(type:'string')]
    private string $first_name;

    #[ORM\Column(type:'string')]
    private string $initials;

    #[ORM\Column(type:'string')]
    private string $prefix;

    #[ORM\Column(type:'string')]
    private string $email;

    #[ORM\Column(type:'integer')]
    private int $employee_code;

    #[ORM\Column(type:'string')]
    private string $password;

    public function __construct(string $name, string $first_name, string $initials, string $prefix, string $email, int $employee_code, string $password) {
        $this->name  = $name;
        $this->first_name  = $first_name;
        $this->initials  = $initials;
        $this->prefix  = $prefix;
        $this->email  = $email;
        $this->employee_code  = $employee_code;
        $this->password  = $password;

    }

}
