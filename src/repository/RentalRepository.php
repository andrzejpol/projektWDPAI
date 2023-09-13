<?php

require_once 'Repository.php';

class RentalRepository extends Repository
{
    public function rentCar(int $user_id, int $car_id, string $start_date, string $end_date, string $status, int $total_cost)
    {
        $stmt = $this->database->connect()->prepare('
            CALL rentcar(:userId, :carId, :start_date, :end_date, :total_cost, :status)
        ');

        $stmt->bindParam(':userId', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':carId', $car_id, PDO::PARAM_INT);
        $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
        $stmt->bindParam(':total_cost', $total_cost, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getUserActiveRentals(int $user_id)
    {
        $stmt = $this->database->connect()->prepare('
        SELECT * from v_cars_rentals WHERE v_cars_rentals.user_id = :user_id
        ');
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public function cancelRent(int $car_id, int $user_id)
    {
        $stmt = $this->database->connect()->prepare('
        CALL cancelrent( :car_id, :user_id )
        ');
        $stmt->bindParam(':car_id', $car_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
