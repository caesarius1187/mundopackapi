<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CortadorasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CortadorasTable Test Case
 */
class CortadorasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CortadorasTable
     */
    public $Cortadoras;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Cortadoras',
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
        $config = TableRegistry::getTableLocator()->exists('Cortadoras') ? [] : ['className' => CortadorasTable::class];
        $this->Cortadoras = TableRegistry::getTableLocator()->get('Cortadoras', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cortadoras);

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
