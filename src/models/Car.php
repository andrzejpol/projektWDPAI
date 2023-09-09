<?php

class Car
{
    private $id;
    private $carBrand;
    private $carModel;
    private $carPrice;
    private $carStatus;
    private $carImage;

    public function __construct(string $carBrand, string $carModel, int $carPrice, string $carStatus, string $carImage, int $id = 0)
    {
        $this->id = $id;
        $this->carBrand = $carBrand;
        $this->carModel = $carModel;
        $this->carPrice = $carPrice;
        $this->carStatus = $carStatus;
        $this->carImage = $carImage;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        return $this->id = $id;
    }

    public function getCarBrand(): string
    {
        return $this->carBrand;
    }

    public function setCarBrand(string $carBrand)
    {
        return $this->carBrand = $carBrand;
    }

    public function getCarModel(): string
    {
        return $this->carModel;
    }

    public function setCarModel(string $carModel)
    {
        return $this->carModel = $carModel;
    }

    public function getCarPrice(): int
    {
        return $this->carPrice;
    }

    public function setCarPrice(int $carPrice)
    {
        return $this->carPrice = $carPrice;
    }

    public function getCarStatus(): string
    {
        return $this->carStatus;
    }

    public function setCarStatus(string $carStatus)
    {
        return $this->carStatus = $carStatus;
    }

    public function getCarImage(): string
    {
        return $this->carImage;
    }

    public function setCarImage(string $carImage)
    {
        return $this->carImage = $carImage;
    }
}
