<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class UsersController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function usersEdit()
    {
        session_start();
        $users = $this->userRepository->getAllUsers();
        return $this->render("usersEdit", ['users' => $users]);
    }

    public function deleteUser(int $userId)
    {
        $url = "http://$_SERVER[HTTP_HOST]";

        if (!$this->isPost()) {
            header("Location: {$url}/usersEdit");
        }

        session_start();
        if (is_numeric($userId)) {
            $id = (int)$userId;
            $this->userRepository->deleteUser($id);
        }
        header("Location: {$url}/usersEdit");
    }
}
