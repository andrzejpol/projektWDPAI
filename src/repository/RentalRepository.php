<?php

require_once 'Repository.php';

class RentalRepository extends Repository
{
    public function rentCar(int $user_id, int $car_id, string $start_date, string $end_date, string $status, int $total_cost)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO rentals (user_id, car_id, start_date, end_date, total_cost, status)
            VALUES (?,?,?,?,?,?)
        ');

        $stmt->execute([
            $user_id,
            $car_id,
            $start_date,
            $end_date,
            $total_cost,
            $status
        ]);
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
}
