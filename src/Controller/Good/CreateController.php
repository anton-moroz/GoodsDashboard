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

class CreateController extends AbstractController
{
    /**
     * @param ManagerRegistry $doctrine
     * @param Request         $request
     *
     * @return RedirectResponse|Response
     */
    #[Route('create', name: 'create', methods: ['GET', 'POST'])]
    #[Template('good/create.html.twig')]
    public function handle(ManagerRegistry $doctrine, Request $request): RedirectResponse|Response
    {
        $form = $this->createForm(GoodType::class, new Good());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            SaveModelService::save($form, $doctrine);

            return $this->redirectToRoute('good_edit', ['id' => $form->getData()->getId()]);
        }

        return $this->render('good/create.html.twig', [
            'goodCreateForm' => $form,
        ]);
    }
}
