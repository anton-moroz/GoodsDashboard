<?php

namespace App\DataFixtures;

use App\Entity\Currency;
use App\Enum\CurrencyEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CurrencyFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        foreach (CurrencyEnum::cases() as $seedCurrency) {
            $currency = new Currency();
            $currency->setCode($seedCurrency->name);
            $currency->setName($seedCurrency->value);

            if (!$manager->getRepository(Currency::class)->findOneBy(['code' => $seedCurrency->name])) {
                $manager->persist($currency);
            }
        }

        $manager->flush();
    }
}
