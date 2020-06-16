<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BobinasdecortesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BobinasdecortesTable Test Case
 */
class BobinasdecortesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BobinasdecortesTable
     */
    public $Bobinasdecortes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Bobinasdecortes',
        'app.Empleados',
        'app.Impresoras',
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
        $config = TableRegistry::getTableLocator()->exists('Bobinasdecortes') ? [] : ['className' => BobinasdecortesTable::class];
        $this->Bobinasdecortes = TableRegistry::getTableLocator()->get('Bobinasdecortes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bobinasdecortes);

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
