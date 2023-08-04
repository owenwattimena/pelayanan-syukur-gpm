<?php

namespace Tests\Feature\Repositories;

use App\Repositories\AdminRepository;
use App\Repositories\Implement\AdminRepoImplement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminRepositoryTest extends TestCase
{
    protected AdminRepository $adminRepo;

    public function setUp():void
    {
        parent::setUp();

        $this->adminRepo = \App::make(AdminRepoImplement::class);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_daftar()
    {
        $this->assertNull($this->adminRepo->daftar([]));
    }
}
