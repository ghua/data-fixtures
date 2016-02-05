<?php


namespace Doctrine\Tests\Common\DataFixtures\TestTaggedFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\TaggedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TaggedFixture implements FixtureInterface, TaggedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    }

    public function getTags()
    {
        return array('all');
    }
}
