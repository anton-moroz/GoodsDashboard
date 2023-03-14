<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class RedirectController extends AbstractController
{
    /**
     * @return RedirectResponse
     */
    #[Route('/', name: 'home')]
    public function home(): RedirectResponse
    {
        return $this->redirectToRoute('good_list');
    }
}
