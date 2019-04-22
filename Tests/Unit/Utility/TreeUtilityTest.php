<?php
declare(strict_types=1);

namespace Filoucrackeur\StorageFrameworkManager\Tests\Utility;

use Filoucrackeur\StorageFrameworkManager\Utility\TreeUtility;
use Nimut\TestingFramework\TestCase\UnitTestCase;

class TreeUtilityTest extends UnitTestCase
{
    /**
     * @var array
     */
    protected $array;

    /**
     * @test
     */
    public function array_is_convert_to_ul_li(): void
    {
        $convert = TreeUtility::fromArray($this->array);
        $this->assertContains('<ul', $convert);
        $this->assertContains('<li>sub_key = <code>value</code></li>', $convert);
        $this->assertContains('</ul>', $convert);
    }

    /**
     * @test
     */
    public function value_password_is_replace_by_stars(): void
    {
        $convert = TreeUtility::fromArray($this->array);
        $this->assertContains('********', $convert);
    }

    protected function setUp()
    {

        $this->array = [
            'key' => [
                'sub_key' => 'value',
                'password' => '********'
            ]
        ];
    }

    protected function tearDown()
    {
        unset($this->array);
    }
}
