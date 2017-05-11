<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DishesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DishesTable Test Case
 */
class DishesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DishesTable
     */
    public $Dishes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dishes',
        'app.components',
        'app.ingredients',
        'app.days',
        'app.weeks',
        'app.daytimes',
        'app.meals',
        'app.meals_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Dishes') ? [] : ['className' => 'App\Model\Table\DishesTable'];
        $this->Dishes = TableRegistry::get('Dishes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Dishes);

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