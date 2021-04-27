<?php

namespace Sfneal\Users\Tests\Feature\Queries;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Sfneal\Models\Model;
use Sfneal\Testing\Utils\Interfaces\RequestCreator;
use Sfneal\Testing\Utils\Traits\CreateRequest;
use Sfneal\Users\Tests\TestCase;

class QueriesTestCase extends TestCase implements RequestCreator
{
    use CreateRequest;

    /**
     * @var Model
     */
    public $modelClass;

    /**
     * @var Collection
     */
    public $models;

    /**
     * @var int
     */
    public $count = 1000;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // Retrieve the People model from an Address model
        if (isset($this->modelClass)) {
            $this->models = $this->modelClass::query()->limit($this->count)->get();
        }
    }

    /**
     * Execute Query test assertions.
     *
     * @param Collection $records
     * @param Builder $builder
     * @param string $queryBuilder
     */
    protected function executeAssertions(Collection $records, Builder $builder, string $queryBuilder)
    {
        // todo: create sfneal/mock-models CollectionBuilderAssertions?
        $this->assertInstanceOf($queryBuilder, $builder);
        $this->assertEquals($records->count(), $builder->count());
        $this->assertEquals($records, $builder->get());
    }
}
