<?php
use Doctrine\ORM\Mapping as ORM;

// example entity for reference, DO NOT USE!
#[ORM\Entity]
#[ORM\Table(name: 'leaves')]
class Leaf {
  #[ORM\Id]
  #[ORM\Column(type:'integer')]
  #[ORM\GeneratedValue]
  private int $id;
  #[ORM\Column(type:'string')]
  private string $type;
  #[ORM\Column(type:'boolean')]
  private bool $alive;
  
  public function __construct(string $type, bool $alive = true) {
    $this->type = $type;
    $this->alive = $alive;
  }

  public function getType(): string {
    return $this->type;
  }

  public function isAlive(): bool {
    return $this->alive;
  }
}
