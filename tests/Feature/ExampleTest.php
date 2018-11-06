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

        $response = $this->get('/dashboard');
        $response->assertStatus(200);

        $response = $this->get('/news');
        $response->assertStatus(302);

        $response = $this->get('/news/all');
        $response->assertStatus(200);

        $response = $this->get('/news/slug/lorem-ipsum');
        $response->assertStatus(200);
        $response->assertSee('WTF is Lorem Ipsum?');

        $response = $this->get('/blog');
        $response->assertStatus(302);

        $response = $this->get('/blog/all');
        $response->assertStatus(200);

        $response = $this->get('/blog/slug/lorem-ipsum');
        $response->assertStatus(200);
        $response->assertSee('WTF is Lorem Ipsum?');
    }
}
