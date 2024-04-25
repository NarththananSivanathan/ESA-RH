<?php

namespace App\Tests\Entity;

use App\Entity\Adresse;
use App\Entity\Recruteur;
use App\Entity\Entreprise;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RecruteurTest extends KernelTestCase
{
    public function testValidationError()
    {
        self::bootKernel();

        $adresse = (new Adresse())
            ->setNumero('1')
            ->setAdresse('rue de la paix')
            ->setCodePostal('75000')
            ->setVille('Paris')
            ->setPays('France');

        $entreprise = (new Entreprise())
            ->setNom('ESA-RH')
            ->setSiret('123456')
            ->setCodeNaf('1234')
            ->setTelephone('0123456789')
            ->setDescription('Bonjoiur je suis test ESA-RH');

        $recruteur = (new Recruteur())
            ->setCivilite('Monsieur')
            ->setNom('Arthur')
            ->setPrenom('Lucas')
            ->setEmail('arthur@test.com')
            ->setPassword('c')
            ->setPost('Directeur')
            ->setAdresse($adresse)
            ->setEntreprise($entreprise);


        $validator = self::getContainer()->get('validator');
        $this->assertCount(1, $validator->validate($recruteur));
    }

    public function testValidationIsValid()
    {
        self::bootKernel();

        $adresse = (new Adresse())
            ->setNumero('1')
            ->setAdresse('rue de la paix')
            ->setCodePostal('75000')
            ->setVille('Paris')
            ->setPays('France');

        $entreprise = (new Entreprise())
            ->setNom('ESA-RH')
            ->setSiret('123456')
            ->setCodeNaf('1234')
            ->setTelephone('0123456789')
            ->setDescription('Bonjoiur je suis test ESA-RH');

        $recruteur = (new Recruteur())
            ->setCivilite('Monsieur')
            ->setNom('Arthur')
            ->setPrenom('Lucas')
            ->setEmail('arthur@test.com')
            ->setPassword('cL99e-h+3e9~PF')
            ->setPost('Directeur')
            ->setAdresse($adresse)
            ->setEntreprise($entreprise);


        $validator = self::getContainer()->get('validator');
        $this->assertCount(0, $validator->validate($recruteur));
    }
}
