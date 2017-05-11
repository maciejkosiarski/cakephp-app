<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WeeksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WeeksTable Test Case
 */
class WeeksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WeeksTable
     */
    public $Weeks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.weeks',
        'app.days'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Weeks') ? [] : ['className' => 'App\Model\Table\WeeksTable'];
        $this->Weeks = TableRegistry::get('Weeks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Weeks);

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
