<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IngredientsTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IngredientsTypesTable Test Case
 */
class IngredientsTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\IngredientsTypesTable
     */
    public $IngredientsTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ingredients_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('IngredientsTypes') ? [] : ['className' => 'App\Model\Table\IngredientsTypesTable'];
        $this->IngredientsTypes = TableRegistry::get('IngredientsTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->IngredientsTypes);

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
