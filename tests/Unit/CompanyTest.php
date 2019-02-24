<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use DatabaseMigrations;

    protected $company;

    public function setUp()
    {
        parent::setUp();

        $this->company = create('App\Company');
    }

    /**
     * @test
     */
    public function a_company_has_employees()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->company->employees);
    }

//
    /**
     * @test
     */
    public function a_company_can_add_employees()
    {
        $this->company->addEmployee([
            'first_name' => 'Foobar',
            'last_name' => 'LastName',
        ]);

        $this->assertCount(1, $this->company->employees);
    }

    /**
     * @test
     */
    public function a_company_can_make_a_string_path()
    {

        $this->assertEquals(
            "/admin/companies/{$this->company->id}",
            $this->company->path()
        );
    }
}
