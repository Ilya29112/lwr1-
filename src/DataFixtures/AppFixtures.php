<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Order;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setEmail("user{$i}@example.com");
            $user->setIsActive(true);
            $manager->persist($user);

            for ($j = 1; $j <= rand(1, 5); $j++) {
                $order = new Order();
                $order->setUser($user);
                $order->setAmount(rand(100, 10000));
                $order->setStatus('paid');
                $order->setCreatedAt(new \DateTimeImmutable('2024-' . rand(1, 12) . '-' . rand(1, 28)));
                $manager->persist($order);
            }
        }

        $manager->flush();
    }
}
