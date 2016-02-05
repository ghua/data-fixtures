<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\Tests\Common\DataFixtures;

use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Tests\Common\DataFixtures\TestBrokenFixtures\BrokenFixture;

/**
 * Test fixtures loader.
 *
 * @author Jonathan H. Wage <jonwage@gmail.com>
 */
class LoaderTest extends BaseTest
{
    public function testLoadFromDirectory()
    {
        $loader = new Loader();
        $loader->addFixture($this->getMock('Doctrine\Common\DataFixtures\FixtureInterface'), array(), array(), 'Mock1');
        $loader->addFixture($this->getMock('Doctrine\Common\DataFixtures\FixtureInterface', array(), array(), 'Mock2'));
        $loader->addFixture($this->getMock('Doctrine\Common\DataFixtures\SharedFixtureInterface', array(), array(), 'Mock3'));

        $this->assertCount(3, $loader->getFixtures());

        $loader->loadFromDirectory(__DIR__.'/TestFixtures');
        $this->assertCount(7, $loader->getFixtures());
        $this->assertTrue($loader->isTransient('TestFixtures\NotAFixture'));
        $this->assertFalse($loader->isTransient('TestFixtures\MyFixture1'));
    }

    public function testLoadFromFile()
    {
        $loader = new Loader();
        $loader->addFixture($this->getMock('Doctrine\Common\DataFixtures\FixtureInterface'), array(), array(), 'Mock1');
        $loader->addFixture($this->getMock('Doctrine\Common\DataFixtures\FixtureInterface', array(), array(), 'Mock2'));
        $loader->addFixture($this->getMock('Doctrine\Common\DataFixtures\SharedFixtureInterface', array(), array(), 'Mock3'));

        $this->assertCount(3, $loader->getFixtures());

        $loader->loadFromFile(__DIR__.'/TestFixtures/MyFixture1.php');
        $this->assertCount(4, $loader->getFixtures());
        $loader->loadFromFile(__DIR__.'/TestFixtures/NotAFixture.php');
        $this->assertCount(4, $loader->getFixtures());
        $loader->loadFromFile(__DIR__.'/TestFixtures/MyFixture2.php');
        $this->assertCount(5, $loader->getFixtures());
        $this->assertTrue($loader->isTransient('TestFixtures\NotAFixture'));
        $this->assertFalse($loader->isTransient('TestFixtures\MyFixture1'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Class "Doctrine\Tests\Common\DataFixtures\TestBrokenFixtures\BrokenFixture" can't implement "OrderedFixtureInterface" and "DependentFixtureInterface" at the same time.
     */
    public function testAddFixtureInvalidArgumentException()
    {
        $loader = new Loader();
        $loader->addFixture(new BrokenFixture());
    }

    public function testLoadOnlyTaggedFixtures()
    {
        $namespace = 'Doctrine\Tests\Common\DataFixtures\TestTaggedFixtures\\';

        $loader = new Loader();
        $loader->setSelectedTags(array('all'));
        $loader->loadFromDirectory(__DIR__.'/TestTaggedFixtures');

        $fixtures = $loader->getFixtures();

        $this->assertCount(6, $fixtures);
        $this->assertInstanceOf($namespace.'TaggedAndOrderedFixture1', $fixtures[0]);
        $this->assertInstanceOf($namespace.'TaggedAndOrderedFixture2', $fixtures[1]);
        $this->assertInstanceOf($namespace.'TaggedFixture', $fixtures[2]);
        $this->assertInstanceOf($namespace.'DependentFixture2', $fixtures[3]);
        $this->assertInstanceOf($namespace.'DependentFixture1', $fixtures[4]);
        $this->assertInstanceOf($namespace.'TaggedAndWithDependenciesFixture', $fixtures[5]);
    }

}
