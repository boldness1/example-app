<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_update_post()
    {
        $this->json('PUT', 'api/post/1',
        [
            'content' => 'testUpdate'
        ])->seeJsonEquals([
                 'updated' => true
             ]);;
 
    }
}
