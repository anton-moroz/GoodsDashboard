<?php

namespace App\Controller\Auth;

use App\Entity\User;
use App\Form\Auth\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class RegistrationController extends AbstractController
{
    /**
     * @param Request                     $request
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param EntityManagerInterface      $entityManager
     * @param Security                    $security
     *
     * @return Response
     */
    #[Route('register', name: 'register')]
    #[IsGranted(new Expression('not is_authenticated()'))]
    public function handle(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        Security $security
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $form->get('plainPassword')->getData()));

            $entityManager->persist($user);
            $entityManager->flush();

            $security->login($user);

            return $this->redirectToRoute('good_list');
        }

        return $this->render('auth/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
