<?php
namespace App\DataFixtures;

use App\Entity\AppUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture {
    
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager) {
        $user = new AppUser();
        $password = $this->encoder->encodePassword($user, 'cubias');
        $user
            ->setPassword($password)
            ->setUsername('cubias')
            ->setCreatedAt(new \DateTime())
            ->setStatus(1);
        
        $manager->persist($user);
        $manager->flush();        
    }
}