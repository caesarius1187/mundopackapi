<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrdenesdepedidosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrdenesdepedidosTable Test Case
 */
class OrdenesdepedidosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrdenesdepedidosTable
     */
    public $Ordenesdepedidos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Ordenesdepedidos',
        'app.Ordenesdetrabajos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Ordenesdepedidos') ? [] : ['className' => OrdenesdepedidosTable::class];
        $this->Ordenesdepedidos = TableRegistry::getTableLocator()->get('Ordenesdepedidos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ordenesdepedidos);

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
