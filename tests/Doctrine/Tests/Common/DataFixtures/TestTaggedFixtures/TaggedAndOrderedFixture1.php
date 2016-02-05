<?php


namespace Doctrine\Tests\Common\DataFixtures\TestTaggedFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\TaggedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TaggedAndOrderedFixture1 implements FixtureInterface, OrderedFixtureInterface, TaggedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    }

    public function getOrder()
    {
        return 0;
    }

    public function getTags()
    {
        return array('all');
    }
}
