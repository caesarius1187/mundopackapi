<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BobinascorteorigensTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BobinascorteorigensTable Test Case
 */
class BobinascorteorigensTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BobinascorteorigensTable
     */
    public $Bobinascorteorigens;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Bobinascorteorigens',
        'app.Bobinasdeimpresions',
        'app.Bobinasdecortes',
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
        $config = TableRegistry::getTableLocator()->exists('Bobinascorteorigens') ? [] : ['className' => BobinascorteorigensTable::class];
        $this->Bobinascorteorigens = TableRegistry::getTableLocator()->get('Bobinascorteorigens', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bobinascorteorigens);

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
