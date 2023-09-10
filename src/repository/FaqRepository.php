<?php

require_once 'Repository.php';

class FaqRepository extends Repository
{
    public function getAllFaqs(): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM v_faqs
        ');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
