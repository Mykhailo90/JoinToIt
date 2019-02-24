<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInCRMTest extends TestCase
{
    use DatabaseMigrations;

    protected $company;
    protected $employee;

    public function setUp()
    {
        parent::setUp();

        $this->company = create('App\Company');
        $this->employee = make('App\Employee');
    }

    /**
    * @test
    */
   public function a_authentificated_user_may_participate_in_crm_companies()
   {
       $this->signIn(create('App\User'));

      $this->post('/admin/companies', $this->company->toArray());

      $this->get($this->company->path())
                                ->assertSee($this->company->name);
   }

    /**
     * @test
     */
    public function a_authentificated_user_may_participate_in_crm_employees()
    {
        $this->signIn(create('App\User'));

        $this->post('/admin/employees', $this->employee->toArray());

        $this->get('/admin/employees')
            ->assertSee($this->employee->first_name);
    }


    /**
     * @test
     */
    public function an_authentificated_user_may_not_add_companies()
    {
       $this->withExceptionHandling()
           ->post('/admin/companies', $this->company->toArray())
           ->assertRedirect('/login');
    }

}
