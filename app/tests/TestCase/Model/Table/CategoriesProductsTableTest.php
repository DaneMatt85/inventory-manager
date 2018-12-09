<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CategoriesProductsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CategoriesProductsTable Test Case
 */
class CategoriesProductsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CategoriesProductsTable
     */
    public $CategoriesProducts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.categories_products',
        'app.categories',
        'app.products'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CategoriesProducts') ? [] : ['className' => CategoriesProductsTable::class];
        $this->CategoriesProducts = TableRegistry::getTableLocator()->get('CategoriesProducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CategoriesProducts);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
