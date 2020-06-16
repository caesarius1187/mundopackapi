<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ImpresorasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ImpresorasTable Test Case
 */
class ImpresorasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ImpresorasTable
     */
    public $Impresoras;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Impresoras',
        'app.Bobinasdecortes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Impresoras') ? [] : ['className' => ImpresorasTable::class];
        $this->Impresoras = TableRegistry::getTableLocator()->get('Impresoras', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Impresoras);

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
