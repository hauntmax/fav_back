<?php

namespace App\Entities;

abstract class AbstractEntity
{
    public array $attributes = [];
    public function __construct(?array $attributes = [])
    {
        foreach ($attributes as $attribute => $value) {
            $this->{$attribute} = $value;
        }
    }

    public function __get($name)
    {
        return $this->attributes[$name];
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function __isset($name)
    {
        return array_key_exists($name, $this->attributes);
    }

    public function toArray(): array
    {
        return $this->attributes;
    }

    public static function fromArray(array $array): AbstractEntity
    {
        foreach ((new static())->fields() as $field) {
            if (!isset($array[$field])) {
                $array[$field] = null;
            }
        }
        return new static($array);
    }

    abstract public function fields(): array;
}
