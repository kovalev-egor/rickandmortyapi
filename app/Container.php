<?php

namespace App;

use Exception;
use ReflectionClass;

class Container {
    private array $services = [];

    public function bind(string $interface, string $implementation): void {
        $this->services[$interface] = $implementation;
    }

    public function resolve(string $classOrInterface): object {
        if (isset($this->services[$classOrInterface])) {
            return $this->resolve($this->services[$classOrInterface]);
        }

        $reflection = new ReflectionClass($classOrInterface);

        if ($reflection->isInterface()) {
            throw new Exception("$classOrInterface is not bound to any implementation.");
        }

        $constructor = $reflection->getConstructor();
        if ($constructor === null) {
            return new $classOrInterface;
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];
        foreach ($parameters as $parameter) {
            $dependencyClass = $parameter->getType()?->getName();
            $dependencies[] = $this->resolve($dependencyClass);
        }

        return $reflection->newInstanceArgs($dependencies);
    }
}