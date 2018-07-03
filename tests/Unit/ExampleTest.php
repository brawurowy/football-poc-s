<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Unit\Test;

/**
 * KernelTestCase is the base class for tests needing a Kernel.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class ExampleTest extends BaseUnitTest
{
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testExampleTwo()
    {
        $this->assertFalse(false);
    }
}