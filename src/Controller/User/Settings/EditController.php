<?php

namespace App\Controller\User\Settings;

use App\Form\User\SettingsFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class EditController extends AbstractController
{
    /**
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param EntityManagerInterface      $entityManager
     * @param Request                     $request
     *
     * @return Response
     */
    #[Route('update', name: 'edit')]
    #[Template('user/settings/edit.html.twig')]
    public function handle(
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        Request $request,
    ): Response {
        $form = $this->createForm(SettingsFormType::class, $this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $user->setUsername($form->get('username')->getData());
            $password = $form->get('plainPassword')->getData();

            if ($password) {
                $user->setPassword($userPasswordHasher->hashPassword($user, $password));
            }

            $entityManager->persist($user);
            $entityManager->flush();
        }

        return $this->render('user/settings/edit.html.twig', [
            'userSettingsEditForm' => $form,
        ]);
    }
}
