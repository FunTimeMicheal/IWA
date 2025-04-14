<?php
namespace IWA\Application\Lib\Traits;

trait Entity {
  public static function fromArray(array $data = []) {
    foreach (get_object_vars($obj = new self) as $property => $default) {
      if (!array_key_exists($property, $data)) continue;
      $obj->{$property} = $data[$property];
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