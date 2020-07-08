<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user2 = new User();

        $user->setName('Moustapha');
        $user->setEmail('madououledansoko@gmail.com');
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$T2RmUmJldVhhMTRiTEVlYQ$yyl/n7aLMLjumvaJxoZfxBRbrEJGaf6JUYNG1eMhjz8');
        $user2->setName('Madououle');
        $user2->setEmail('moustapha@gmail.com');
        $user2->setPassword('$argon2id$v=19$m=65536,t=4,p=1$T2RmUmJldVhhMTRiTEVlYQ$yyl/n7aLMLjumvaJxoZfxBRbrEJGaf6JUYNG1eMhjz8');

        $manager->persist($user);
        $manager->persist($user2);

        $manager->flush();
    }
}
