<?php
namespace IWA\Application\Database\Entities;

use Doctrine\ORM\Mapping as ORM;
use IWA\Application\Lib\Traits\Entity;
use JsonSerializable;

#[ORM\Entity]
#[ORM\Table(name: 'users')]

class User implements JsonSerializable{
    use Entity;

    #[ORM\Id]
    #[ORM\Column(type:'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\ManyToOne(targetEntity: UserRole::class, inversedBy: 'users')]
    private UserRole|null $userrole;

    #[ORM\Column(type:'string')]
    private string $first_name;

    #[ORM\Column(type:'string')]
    private string $last_name;

    #[ORM\Column(type:'string')]
    private string $email;

    #[ORM\Column(type:'integer')]
    private int $employee_code;

    #[ORM\Column(type:'string')]
    private string $password;

    public function __construct(UserRole $userrole, string $first_name, string $last_name, string $email, int $employee_code, string $password) {
        $this->userrole = $userrole;
        $this->first_name  = $first_name;
        $this->last_name = $last_name;
        $this->email  = $email;
        $this->employee_code  = $employee_code;
        $this->password  = $password;
    }

    public function jsonSerialize():mixed {
        $data = get_object_vars($this);
        $data["userrole"] = $data["userrole"]?->getId();
        return $data;
    }
}
