<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Car.php';

class CarRepository extends Repository
{

    public function getAllCars(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('SELECT * FROM cars');
        $stmt->execute();
        $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($cars as $car) {
            $result[] = new Car(
                $car['brand'],
                $car['model'],
                $car['price'],
                $car['status'],
                $car['image'],
                $car['id']
            );
        }

        return $result;
    }

    public function getAllCarsFromView(): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM v_cars_cities
        ');
        $stmt->execute();

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

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

    public function deleteCar(int $carId)
    {
        $stmt = $this->database->connect()->prepare('CALL delete_car(:carId)');
        $stmt->bindParam(':carId', $carId, PDO::PARAM_INT);
        $stmt->execute();
    }
}
