<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DaytimesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DaytimesTable Test Case
 */
class DaytimesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DaytimesTable
     */
    public $Daytimes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.daytimes',
        'app.days',
        'app.weeks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Daytimes') ? [] : ['className' => 'App\Model\Table\DaytimesTable'];
        $this->Daytimes = TableRegistry::get('Daytimes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Daytimes);

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
