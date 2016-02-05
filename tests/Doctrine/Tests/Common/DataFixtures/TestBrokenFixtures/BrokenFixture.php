<?php

namespace Doctrine\Tests\Common\DataFixtures\TestBrokenFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BrokenFixture implements FixtureInterface, OrderedFixtureInterface, DependentFixtureInterface
{

    public function getDependencies()
    {
        return;
    }

    public function load(ObjectManager $manager)
    {
        return;
    }

    public function getOrder()
    {
        return;
    }

}
