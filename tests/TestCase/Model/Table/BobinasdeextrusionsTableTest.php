<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BobinasdeextrusionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BobinasdeextrusionsTable Test Case
 */
class BobinasdeextrusionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BobinasdeextrusionsTable
     */
    public $Bobinasdeextrusions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Bobinasdeextrusions',
        'app.Empleados',
        'app.Extrusoras',
        'app.Bobinascorteorigen',
        'app.Bobinasdeimpresions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Bobinasdeextrusions') ? [] : ['className' => BobinasdeextrusionsTable::class];
        $this->Bobinasdeextrusions = TableRegistry::getTableLocator()->get('Bobinasdeextrusions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bobinasdeextrusions);

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
