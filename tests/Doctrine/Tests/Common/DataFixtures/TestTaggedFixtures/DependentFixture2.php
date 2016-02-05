<?php


namespace Doctrine\Tests\Common\DataFixtures\TestTaggedFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DependentFixture2 implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
    }
}
