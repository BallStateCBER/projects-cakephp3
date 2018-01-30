<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GraphicsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GraphicsTable Test Case
 */
class GraphicsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GraphicsTable
     */
    public $Graphics;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.graphics',
        'app.releases'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Graphics') ? [] : ['className' => GraphicsTable::class];
        $this->Graphics = TableRegistry::get('Graphics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Graphics);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
