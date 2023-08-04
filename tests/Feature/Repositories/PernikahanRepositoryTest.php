<?php

namespace Tests\Feature\Repositories;

use App\Repositories\Implement\PernikahanRepoImplement;
use App\Repositories\PernikahanRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PernikahanRepositoryTest extends TestCase
{
    public PernikahanRepository $pernikahanRepo;

    public function setUp():void
    {
        parent::setUp();
        $this->pernikahanRepo = \App::make(PernikahanRepoImplement::class);

    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_getBySektor()
    {
        $this->assertNotEmpty($this->pernikahanRepo->getBySektor(1));
    }
}
