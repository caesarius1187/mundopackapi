<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrdenesdetrabajosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrdenesdetrabajosTable Test Case
 */
class OrdenesdetrabajosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrdenesdetrabajosTable
     */
    public $Ordenesdetrabajos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Ordenesdetrabajos',
        'app.Ordenesdepedidos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Ordenesdetrabajos') ? [] : ['className' => OrdenesdetrabajosTable::class];
        $this->Ordenesdetrabajos = TableRegistry::getTableLocator()->get('Ordenesdetrabajos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ordenesdetrabajos);

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
