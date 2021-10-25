<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequisicoesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequisicoesTable Test Case
 */
class RequisicoesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RequisicoesTable
     */
    protected $Requisicoes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Requisicoes',
        'app.Urls',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Requisicoes') ? [] : ['className' => RequisicoesTable::class];
        $this->Requisicoes = $this->getTableLocator()->get('Requisicoes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Requisicoes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RequisicoesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\RequisicoesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
