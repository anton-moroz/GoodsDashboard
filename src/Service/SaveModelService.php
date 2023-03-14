<?php

namespace App\Service;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\FormInterface;

class SaveModelService
{
    /**
     * @param FormInterface   $form
     * @param ManagerRegistry $doctrine
     *
     * @return bool
     */
    public static function save(FormInterface $form, ManagerRegistry $doctrine): bool
    {
        $data          = $form->getData();
        $entityManager = $doctrine->getManager();
        $entityManager->persist($data);
        $entityManager->flush();

        return true;
    }
}
