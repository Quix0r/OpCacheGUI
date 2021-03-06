<?php

namespace OpCacheGUITest\Unit\Security\Generator;

use PHPUnit\Framework\TestCase;

use OpCacheGUI\Security\Generator;
use OpCacheGUI\Security\Generator\Mcrypt;
use OpCacheGUI\Security\Generator\UnsupportedAlgorithmException;

class McryptTest extends TestCase
{
    /**
     * @covers OpCacheGUI\Security\Generator\Mcrypt::__construct
     */
    public function testConstructCorrectInterface()
    {
        if (!$this->mcryptEnabled()) {
            $this->markTestSkipped('The Mcrypt extension is not available.');
        }

        $generator = new Mcrypt();

        $this->assertInstanceOf(Generator::class, $generator);
    }

    /**
     * @covers OpCacheGUI\Security\Generator\Mcrypt::__construct
     */
    public function testConstructThrowsUpWhenMcryptIsNotInstalled()
    {
        if ($this->mcryptEnabled()) {
            $this->markTestSkipped('The Mcrypt extension is available.');
        }

        $this->expectException(UnsupportedAlgorithmException::class);

        new Mcrypt();
    }

    /**
     * @covers OpCacheGUI\Security\Generator\Mcrypt::__construct
     * @covers OpCacheGUI\Security\Generator\Mcrypt::generate
     */
    public function testGenerate()
    {
        if (!$this->mcryptEnabled()) {
            $this->markTestSkipped('The Mcrypt extension is not available.');
        }

        $generator = new Mcrypt();

        $this->assertSame(128, strlen($generator->generate(128)));
    }

    /**
     * @covers OpCacheGUI\Security\Generator\Mcrypt::__construct
     * @covers OpCacheGUI\Security\Generator\Mcrypt::generate
     */
    public function testGenerateRandomTheStupidWay()
    {
        if (!$this->mcryptEnabled()) {
            $this->markTestSkipped('The Mcrypt extension is not available.');
        }

        $generator = new Mcrypt();

        $strings = [];
        for ($i = 0; $i < 10; $i++) {
            $strings[] = $generator->generate(56);
        }

        $this->assertSame($strings, array_unique($strings));
    }

    /**
     * Simple method which checks whether these tests should be run
     *
     * @return boolean True when mcrypt is installed on the current system
     */
    private function mcryptEnabled()
    {
        return function_exists('mcrypt_create_iv');
    }
}
