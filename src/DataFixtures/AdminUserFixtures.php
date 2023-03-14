<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Enum\AdminUsersEnum;
use App\Enum\RolesEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminUserFixtures extends Fixture
{
    /**
     * @param ContainerBagInterface       $params
     * @param UserPasswordHasherInterface $userPasswordHasher
     */
    public function __construct(
        private readonly ContainerBagInterface $params,
        private readonly UserPasswordHasherInterface $userPasswordHasher
    ) {
    }

    /**
     * @param ObjectManager $manager
     *
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function load(ObjectManager $manager): void
    {
        if ($this->params->get('kernel.environment') === 'prod') {
            return;
        }

        foreach (AdminUsersEnum::cases() as $admin) {
            $user = new User();
            $user->setUsername($admin->name);
            $user->setRoles([RolesEnum::ROLE_ADMIN->name]);
            $user->setPassword($this->userPasswordHasher->hashPassword($user, $admin->value));

            if (!$manager->getRepository(User::class)->findOneBy(['username' => $admin->name])) {
                $manager->persist($user);
            }
        }

        $manager->flush();
    }
}
