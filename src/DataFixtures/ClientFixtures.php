<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Users;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class UserFixtures extends Fixture
{
    private $faker;
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->faker=Factory::create("fr_FR");
        $this->passwordHasher= $passwordHasher;
 }

    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<10;$i++){
            $client = new Client();
            $client->setNom($this->faker->lastName())
            ->setPrenom($this->faker->firstName())
            ->setRue($this->faker->rue())
            ->setVille($this->faker->ville())
            ->setCodePostal($this->faker->codepostal())
            ->setSecteur($this->faker->secteur());
            $this->addReference('client'.$i, $client);
            $manager->persist($client);
        }
        $manager->flush();
    }
}