<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture {
    
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager) {
        $user = new User();
        $password = $this->encoder->encodePassword($user, 'cubias');
        $user
            ->setPassword($password)
            ->setUsername('cubias')
            ->setCreatedAt(new \DateTime())
            ->setStatus(1)
            ->setRole('ROLE_ADMIN');
        
        $manager->persist($user);
        $manager->flush();        
    }
}