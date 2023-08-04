<?php

namespace Tests\Feature\Services;

use App\Services\AdminService;
use App\Services\Implement\AdminServiceImplement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminServiceTest extends TestCase
{
    public AdminService $adminService;

    public function setUp():void
    {
        parent::setUp();

        $this->adminService = \App::make(AdminServiceImplement::class);

    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_daftar()
    {
        $this->assertfalse($this->adminService->daftar([]));
    }
}
