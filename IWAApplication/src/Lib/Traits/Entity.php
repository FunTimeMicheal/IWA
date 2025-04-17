<?php
namespace IWA\Application\Lib\Traits;

trait Entity {
  public static function fromArray(array $data = []) {
    $reflector = new \ReflectionClass(static::class);
    $obj = $reflector->newInstanceWithoutConstructor();

    foreach ($reflector->getProperties() as $property) {
        $name = $property->getName();
        if (!array_key_exists($name, $data)) continue;

        $property->setAccessible(true);
        $property->setValue($obj, $data[$name]);
    }

    return $obj;
}


   public function patch(array $data = []) {
    foreach (get_object_vars($this) as $property => $default) {
      if (!array_key_exists($property, $data)) continue;
      $this->{$property} = $data[$property];
    }
   }
 }