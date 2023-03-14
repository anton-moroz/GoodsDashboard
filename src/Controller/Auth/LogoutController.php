<?php

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController extends AbstractController
{
    /**
     * @return void
     */
    #[Route('logout', name: 'logout', methods: ['GET'])]
    public function handle(): void
    {
    }
}
