<?php

namespace App\Controller\Auth;

use App\Form\Auth\LoginFormType;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @param Request             $request
     * @param AuthenticationUtils $authenticationUtils
     *
     * @return array|RedirectResponse
     */
    #[IsGranted(new Expression('not is_authenticated()'))]
    #[Route('login', name: 'login')]
    #[Template('auth/login.html.twig')]
    public function handle(Request $request, AuthenticationUtils $authenticationUtils): array|RedirectResponse
    {
        $form = $this->createForm(LoginFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('home');
        }

        return [
            'loginForm' => $form->createView(),
            'error'     => $authenticationUtils->getLastAuthenticationError(),
        ];
    }
}
