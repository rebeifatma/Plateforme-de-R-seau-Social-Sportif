<?php
// src/DataFixtures/SportFixtures.php

namespace App\DataFixtures;

use App\Entity\Sport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SportFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Sport 1
        $sport1 = new Sport();
        $sport1->setNomSport('Football');
        $sport1->setImage('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRKj0jZAARXBTB4ecmV5LsoTQt5J7qxfTweUA&usqp=CAU');
        $manager->persist($sport1);

        // Sport 2
        $sport2 = new Sport();
        $sport2->setNomSport('Basketball');
        $sport2->setImage('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSB7Z17L0ZkWkfh3ggi2y7gxuhiBY7o0i-vWQ&usqp=CAU');
        $manager->persist($sport2);

        // Sport 3
        $sport3 = new Sport();
        $sport3->setNomSport('Tennis');
        $sport3->setImage('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHutyjfnu5YthnFIQydbRmoH7gMOqNGgYkBg&usqp=CAU');
        $manager->persist($sport3);



        // Sport 5
        $sport5 = new Sport();
        $sport5->setNomSport('Swimming');
        $sport5->setImage('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCXSW1wLUmb8Eddlc-rwRTVXwe0D3x8ck5mA&usqp=CAU');
        $manager->persist($sport5);

        // Sport 6
        $sport6 = new Sport();
        $sport6->setNomSport('Volleyball');
        $sport6->setImage('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT6vp5EvEngRFkp6aIqWkg4H62f2YTrnJfq9w&usqp=CAU');
        $manager->persist($sport6);

        // Sport 7
        $sport7 = new Sport();
        $sport7->setNomSport('Golf');
        $sport7->setImage('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRt1bfxPpyxNFE_akXwhnyYNZdSMmV1JVV8_Q&usqp=CAU');
        $manager->persist($sport7);

        // Sport 8
        $sport8 = new Sport();
        $sport8->setNomSport('Cycling');
        $sport8->setImage('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQEs1t2C4DnYQfNphGy0aBC-iwbEBwaBCJRFg&usqp');
        $manager->persist($sport8);

        $manager->flush();
    }
}
