<?php
/**
 * Pour générer des données factices et aléatoires avec la dépendance "Faker"
 * 
 */
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Members;

class LoadData extends Fixture
{

    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 15; $i++){
           
            $faker = \Faker\Factory::create();

            $member = new Members();
            $member->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setPseudo($faker->suffix)
                ->setMail($faker->email)
                ->setPw($faker->ean13);
                
            //$em = $this->getDoctrine()->getManager();
            $manager->persist($member);

        }

        $manager->flush();

        




    }



}