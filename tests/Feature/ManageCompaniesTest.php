<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ManageThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected $company;
    protected $employee;

    public function setUp()
    {
        parent::setUp();

        $this->company = create('App\Company');
        $this->employee = create('App\Employee');
    }

    /**
     * @test
     */
    public function an_authenticated_user_can_create_new_employee()
    {
        $this->signIn();

        $response = $this->post('/admin/employees', $this->employee->toArray());
        $this->get($response->headers->get('Location'))
            ->assertSee($this->employee->first_name)
            ->assertSee($this->employee->last_name);
    }

    /**
     * @test
     */
    public function an_authenticated_user_can_be_deleted_company_and_employee()
    {
        $this->signIn();

        $this->json('GET', '/admin/companies/'. $this->company->id .'/delete');
        $this->json('GET', '/admin/employees/'. $this->employee->id .'/delete');

        $this->assertDatabaseMissing('companies', ['id' => $this->company->id]);
        $this->assertDatabaseMissing('employees', ['id' => $this->employee->id]);
    }

    /**
     * @test
     */
    public function guests_may_not_create_company()
    {
        $this->withExceptionHandling();

            $this->get('admin/companies/create')
            ->assertRedirect('/login');

        $this->post('admin/companies')
            ->assertRedirect('/login');
    }

}
