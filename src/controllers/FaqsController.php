<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/FaqRepository.php';

class FaqsController extends AppController
{

    private $faqRepository;

    public function __construct()
    {
        parent::__construct();
        $this->faqRepository = new FaqRepository();
    }

    public function getallfaqs()
    {
        session_start();
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : "";

        if ($contentType === "application/json") {
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode($this->faqRepository->getAllFaqs());
        }
    }
}
