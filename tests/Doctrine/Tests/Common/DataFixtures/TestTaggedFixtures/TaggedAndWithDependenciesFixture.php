<?php


namespace Doctrine\Tests\Common\DataFixtures\TestTaggedFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\TaggedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TaggedAndWithDependenciesFixture implements FixtureInterface, TaggedFixtureInterface, DependentFixtureInterface
{
    public function getDependencies()
    {
        return array('Doctrine\Tests\Common\DataFixtures\TestTaggedFixtures\DependentFixture1');
    }

    public function getTags()
    {
        return array('all');
    }

    public function load(ObjectManager $manager)
    {
    }
}
