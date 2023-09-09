<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Car.php';

class CarRepository extends Repository
{
    public function addCar(Car $car)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO cars (brand, model, price, status, image)
            VALUES (?,?,?,?,?)
        ');

        $stmt->execute([
            $car->getCarBrand(),
            $car->getCarModel(),
            $car->getCarPrice(),
            $car->getCarStatus(),
            $car->getCarImage(),
        ]);
    }
}
