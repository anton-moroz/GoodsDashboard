<?php

namespace App\Controller\Good;

use App\Repository\GoodRepository;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @param GoodRepository $repository
     *
     * @return array
     */
    #[Route('list', name: 'list', methods: ['GET'])]
    #[Template('good/list.html.twig')]
    public function handle(GoodRepository $repository): array
    {
        return ['goods' => $repository->findAll()];
    }
}
