<?php


namespace Doctrine\Tests\Common\DataFixtures\TestTaggedFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DependentFixture1 implements FixtureInterface, DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    }

    public function getDependencies()
    {
        return array('Doctrine\Tests\Common\DataFixtures\TestTaggedFixtures\DependentFixture2');
    }
}
