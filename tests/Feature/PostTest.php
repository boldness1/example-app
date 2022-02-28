<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_post()
    {
          $this->json('PUT', 'api/post/1', [ 'content' => 'testUpdate'])
                ->seeJson([
                 'type'  => 'user_posts_update',
                 'updated' => true
             ]);;
    }
}
