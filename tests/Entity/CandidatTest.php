<?php

namespace App\Tests\Entity;

use App\Entity\Candidat;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CandidatTest extends KernelTestCase
{
    public function testValidationError()
    {
        self::bootKernel();
        $candidat = (new Candidat())
            ->setCivilite('Monsieur')
            ->setNom('Doe')
            ->setPrenom('John')
            ->setEmail('john@esa.com')
            ->setTelephone('0123456789')
            ->setPassword('coucou');

        $validator = self::getContainer()->get('validator');
        $this->assertCount(1, $validator->validate($candidat));
    }

    public function testValidationSuccess()
    {
        self::bootKernel();
        $candidat = (new Candidat())
            ->setCivilite('Monsieur')
            ->setNom('Doe')
            ->setPrenom('John')
            ->setEmail('john@esa.com')
            ->setTelephone('0123456789')
            ->setPassword("cL99e-h+3e9~PF");
        $validator = self::getContainer()->get('validator');
        $this->assertCount(0, $validator->validate($candidat));
    }

}
