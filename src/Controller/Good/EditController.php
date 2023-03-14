<?php

namespace App\Controller\Good;

use App\Entity\Good;
use App\Form\Good\GoodType;
use App\Service\SaveModelService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditController extends AbstractController
{
    /**
     * @param ManagerRegistry $doctrine
     * @param Request         $request
     * @param Good            $good
     *
     * @return RedirectResponse|Response
     */
    #[Route('edit/{id}', name: 'edit', methods: ['GET', 'POST'])]
    #[Template('good/edit.html.twig')]
    public function edit(ManagerRegistry $doctrine, Request $request, Good $good): RedirectResponse|Response
    {
        $form = $this->createForm(GoodType::class, $good);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            SaveModelService::save($form, $doctrine);
        }

        return $this->render('good/edit.html.twig', [
            'goodEditForm' => $form,
        ]);
    }
}
