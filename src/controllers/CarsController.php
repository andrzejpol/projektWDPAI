<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Car.php';
require_once __DIR__ . '/../repository/CarRepository.php';

class CarsController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];
    private $carRepository;

    public function __construct()
    {
        parent::__construct();
        $this->carRepository = new CarRepository();
    }

    public function addCar()
    {
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['file']['name']
            );

            session_start();
            $car = new Car($_POST['carBrand'], $_POST['carModel'], $_POST['carPrice'], $_POST['carStatus'], $_FILES['file']['name']);

            $this->carRepository->addCar($car);

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/carsEdit");
        }
        return $this->render("carsEdit", ['messages' => $this->messages]);
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = "File is too large.";
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = "File type is not supported.";
            return false;
        }

        return true;
    }
}
