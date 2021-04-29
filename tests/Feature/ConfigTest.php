<?php

namespace Sfneal\Users\Tests\Feature;

use Sfneal\Users\Tests\TestCase;

class ConfigTest extends TestCase
{
    // todo: add notification test

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = false;

    /** @test */
    public function org_name()
    {
        $expected = 'HPA Design, inc.';
        $output = config('users.org.name');

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function org_address_street()
    {
        $expected = '35 Main Street';
        $output = config('users.org.address.street');

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function org_address_city()
    {
        $expected = 'Milford';
        $output = config('users.org.address.city');

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function org_address_state()
    {
        $expected = 'MA';
        $output = config('users.org.address.state');

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function org_address_zip()
    {
        $expected = '01575';
        $output = config('users.org.address.zip');

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function org_phone()
    {
        $expected = '508-384-8838';
        $output = config('users.org.phone');

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function org_email()
    {
        $expected = 'contact@hpadesign.com';
        $output = config('users.org.email');

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }
}
