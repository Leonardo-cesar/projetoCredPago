<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UrlsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UrlsTable Test Case
 */
class UrlsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UrlsTable
     */
    protected $Urls;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Urls',
        'app.Usuarios',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Urls') ? [] : ['className' => UrlsTable::class];
        $this->Urls = $this->getTableLocator()->get('Urls', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Urls);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UrlsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\UrlsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
