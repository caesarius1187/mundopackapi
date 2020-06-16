<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmpleadosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmpleadosTable Test Case
 */
class EmpleadosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EmpleadosTable
     */
    public $Empleados;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Empleados',
        'app.Bobinasdecortes',
        'app.Bobinasdeextrusions',
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
        $config = TableRegistry::getTableLocator()->exists('Empleados') ? [] : ['className' => EmpleadosTable::class];
        $this->Empleados = TableRegistry::getTableLocator()->get('Empleados', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Empleados);

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
}
