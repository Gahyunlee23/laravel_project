<?php

namespace Tests\Feature\API\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class IndexUserTest extends BaseUserTest
{
    public function testIndex()
    {
        $response = $this->getJson($this->getURI());
        $response->assertSuccessful();
    }
}
