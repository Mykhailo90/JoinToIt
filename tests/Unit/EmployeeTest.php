<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
   function it_has_a_company()
   {
        $employee = create('App\Employee');

        $this->assertInstanceOf('App\Company', $employee->company);
   }
}
