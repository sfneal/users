<?php

namespace Sfneal\Users\Tests\Unit;

use Sfneal\Users\Services\OrganizationService;
use Sfneal\Users\Tests\TestCase;

class OrganizationServiceTest extends TestCase
{
    // todo: add 'full' method test and test scenarios with null config values

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
        $output = OrganizationService::name();

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function org_address_street()
    {
        $expected = '35 Main Street';
        $output = OrganizationService::address()->street();

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function org_address_city()
    {
        $expected = 'Milford';
        $output = OrganizationService::address()->city();

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function org_address_state()
    {
        $expected = 'MA';
        $output = OrganizationService::address()->state();

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function org_address_zip()
    {
        $expected = '01575';
        $output = OrganizationService::address()->zip();

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function org_phone()
    {
        $expected = '508-384-8838';
        $output = OrganizationService::phone();

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function org_email()
    {
        $expected = 'contact@hpadesign.com';
        $output = OrganizationService::email();

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function org_phone_href()
    {
        $expected = 'tel:+5083848838';
        $output = OrganizationService::phone(true);

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function org_email_href()
    {
        $expected = 'mailto:contact@hpadesign.com';
        $output = OrganizationService::email(true);

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }
}
