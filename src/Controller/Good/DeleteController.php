<?php

namespace App\Controller\Good;

use App\Entity\Good;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class DeleteController extends AbstractController
{
    /**
     * @param ManagerRegistry $doctrine
     * @param Good            $good
     *
     * @return RedirectResponse
     */
    #[Route('delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(ManagerRegistry $doctrine, Good $good): RedirectResponse
    {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($good);
        $entityManager->flush();

        return $this->redirectToRoute('good_list');
    }
}
