<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Blog');
        $response->assertSee('Login');
        $response->assertSee('Register');

        $response = $this->get('/news');
        $response->assertStatus(302);

        $response = $this->get('/news/all');
        $response->assertStatus(200);

        $response = $this->get('/blog');
        $response->assertStatus(302);

        $response = $this->get('/blog/1/show_blog');
        $response->assertStatus(200);
        $response->assertSee('WTF is Lorem Ipsum?');
    }
}
