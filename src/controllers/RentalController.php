<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/RentalRepository.php';

class RentalController extends AppController
{

    private $rentalRepository;

    public function rentals()
    {
        session_start();
        $id = $_SESSION['userId'];
        $rentals = $this->rentalRepository->getUserActiveRentals($id);
        $this->render('myRentals', ['rentals' => $rentals]);
    }

    public function __construct()
    {
        parent::__construct();
        $this->rentalRepository = new RentalRepository();
    }

    public function rentcar()
    {
        session_start();
        $id = $_SESSION['userId'];
        $contentType  = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : "";

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-Type: application/json');
            http_response_code(200);
            $this->rentalRepository->rentCar($id, $decoded['car_id'], $decoded['start_date'], $decoded['end_date'], $decoded['status'], $decoded['total_cost']);
        }
    }

    public function cancelrent(int $carid)
    {
        $url = "http://$_SERVER[HTTP_HOST]";

        if (!$this->isPost()) {
            header("Location: {$url}/rentals");
        }

        session_start();
        $id = $_SESSION['userId'];
        if (is_numeric($carid)) {
            $carId = (int)$carid;
            $this->rentalRepository->cancelRent($carId, $id);
        }
        header("Location: {$url}/rentals");
    }
}
