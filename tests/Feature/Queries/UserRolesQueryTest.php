<?php

namespace Sfneal\Users\Tests\Feature\Queries;

use Illuminate\Database\Eloquent\Collection;
use Sfneal\Users\Models\Role;
use Sfneal\Users\Queries\UserRolesQuery;
use Sfneal\Users\Tests\TestCase;

class UserRolesQueryTest extends TestCase
{
    /** @test */
    public function query_result_is_correct()
    {
        $expected = Role::query()->whereTypeUser()->get();
        $result = (new UserRolesQuery())->execute();

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertSame($expected->count(), $result->count());
        $this->assertCount(4, $result);
        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function query_can_be_cached()
    {
        $query = new UserRolesQuery();

        $this->assertIsString($query->cacheKey());
        $this->assertFalse($query->isCached());

        $nonCached = $query->execute();
        $cached = $query->fetch();

        $this->assertInstanceOf(Collection::class, $nonCached);
        $this->assertInstanceOf(Collection::class, $cached);
        $this->assertSame($nonCached->count(), $cached->count());
        $this->assertCount(4, $cached);
        $this->assertEquals($nonCached, $cached);
        $this->assertTrue($query->isCached());
    }

    /** @test */
    public function query_cache_can_be_invalidated()
    {
        $query = new UserRolesQuery();
        $query->fetch();

        $this->assertTrue($query->isCached());

        $invalidations = $query->invalidateCache();
        $this->assertFalse($query->isCached());
        $this->assertIsArray($invalidations);
        $this->assertArrayHasKey($query->cacheKey(), $invalidations);
    }
}
