<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExtrusorasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExtrusorasTable Test Case
 */
class ExtrusorasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ExtrusorasTable
     */
    public $Extrusoras;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Extrusoras',
        'app.Bobinasdeextrusions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Extrusoras') ? [] : ['className' => ExtrusorasTable::class];
        $this->Extrusoras = TableRegistry::getTableLocator()->get('Extrusoras', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Extrusoras);

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
