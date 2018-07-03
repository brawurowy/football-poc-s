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
use App\Entity\League;

/**
 * KernelTestCase is the base class for tests needing a Kernel.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class LeagueTest extends BaseUnitTest
{
    public function testSerialization()
    {
        $league = new League();
        $league->setName = 'Test';
        $serializedJson = $league->serialize();
        $this->assertJson($serializedJson);

        $unserialized = new League();
        $unserialized->unserialize($serializedJson);

        $this->assertInstanceOf(League::class, $unserialized);
    }
}