<?php

namespace App\Security;
namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class AppAuthenticator extends AbstractLoginFormAuthenticator
{
    /**
     * @param RouterInterface $router
     * @param UserRepository  $userRepository
     */
    public function __construct(private RouterInterface $router, private UserRepository $userRepository)
    {
    }

    /**
     * @param Request $request
     *
     * @return Passport
     */
    public function authenticate(Request $request): Passport
    {
        $loginForm = $request->get('login_form');

        return new Passport(
            new UserBadge($loginForm['username'], function (string $userIdentifier) {
                return $this->userRepository->findOneBy(['username' => $userIdentifier]);
            }),
            new PasswordCredentials($loginForm['plainPassword'])
        );
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    protected function getLoginUrl(Request $request): string
    {
        return $this->router->generate('auth_login');
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $firewallName
     *
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(
        Request $request,
        TokenInterface $token,
        string $firewallName
    ): RedirectResponse {
        return new RedirectResponse($this->router->generate('home'));
    }
}
