<?php


namespace Doctrine\Common\DataFixtures;

/**
 * Tagged Fixture interface needs to be implemented
 * by fixtures, which needs to have a specific set of tags
 * when being loaded by directory scan for example
 *
 * @author Semyon Velichko <semyon@velichko.net>
 */
interface TaggedFixtureInterface
{

    /**
     * Get the set of tags for this fixture
     *
     * @return array
     */
    public function getTags();

}
