<?php


namespace Sfneal\Users\Tests\Feature;


use Sfneal\Testing\Utils\Traits\ModelAttributeAssertions;
use Sfneal\Users\Models\Role;
use Sfneal\Users\Tests\TestCase;

class MigrationsTest extends TestCase
{
    use ModelAttributeAssertions;

    /** @test */
    public function role_table_is_accessible()
    {
        $data = [
            'type' => 'user',
            'name' => 'Employee',
            'description' => "Here's an example description",
            'order' => 4,
        ];

        // Create the `TrackAction`
        $createdModel = Role::query()->create($data);

        // Retrieve the `TrackAction`
        $foundModel = Role::query()->find($createdModel->getKey());

        // Assert model has expected values
        $this->assertSame($foundModel, $createdModel);
        $this->modelAttributeAssertions($data, $foundModel);
    }
}
