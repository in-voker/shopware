<?php
/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace Shopware\Tests\Unit\Bundle\SitemapBundle;

use PHPUnit\Framework\TestCase;
use Shopware\Bundle\SitemapBundle\Service\SitemapNameGenerator;

class SitemapNameGeneratorTest extends TestCase
{
    /**
     * @var SitemapNameGenerator
     */
    private $generator;

    protected function setUp()
    {
        parent::setUp();
        $this->generator = new SitemapNameGenerator(__DIR__);
    }

    public function testPathGeneration()
    {
        $name = __DIR__ . '/sitemap-shop-1-1.xml.gz';
        $this->assertSame($name, $this->generator->getSitemapFilename(1));
        touch(__DIR__ . '/sitemap-shop-1-1.xml.gz');

        $this->assertSame(__DIR__ . '/sitemap-shop-1-2.xml.gz', $this->generator->getSitemapFilename(1));

        unlink($name);
    }

    public function testGlobGeneration()
    {
        $this->assertSame('sitemap-shop-1-*.xml.gz', $this->generator->getSitemapFilenameGlob(1));
    }
}
