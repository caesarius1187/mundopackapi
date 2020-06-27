<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrdenotsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrdenotsTable Test Case
 */
class OrdenotsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrdenotsTable
     */
    public $Ordenots;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Ordenots',
        'app.Extrusoras',
        'app.Impresoras',
        'app.Cortadoras',
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
        $config = TableRegistry::getTableLocator()->exists('Ordenots') ? [] : ['className' => OrdenotsTable::class];
        $this->Ordenots = TableRegistry::getTableLocator()->get('Ordenots', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ordenots);

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
