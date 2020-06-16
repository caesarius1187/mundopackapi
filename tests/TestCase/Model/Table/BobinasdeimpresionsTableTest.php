<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BobinasdeimpresionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BobinasdeimpresionsTable Test Case
 */
class BobinasdeimpresionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BobinasdeimpresionsTable
     */
    public $Bobinasdeimpresions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Bobinasdeimpresions',
        'app.Empleados',
        'app.Cortadoras',
        'app.Bobinasdeextrusions',
        'app.Bobinascorteorigen',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Bobinasdeimpresions') ? [] : ['className' => BobinasdeimpresionsTable::class];
        $this->Bobinasdeimpresions = TableRegistry::getTableLocator()->get('Bobinasdeimpresions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bobinasdeimpresions);

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
