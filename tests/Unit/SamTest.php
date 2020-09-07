<?php

namespace Tests\Unit;

use Tests\TestCase;

class SamTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $credential = [
            'email' => 'test3@gmail.com',
            'password' => '12341234'
        ];
        $this->post('login', $credential)->assertRedirect('/home');

        $response = $this->get('/recordadd');
        $response->assertStatus(200);

        $newRecord = [
            'date' => '16/06/2020',
            'other_type' => 'sleeps',
            'minutes' => 10
        ];
        $this->post('/sleeps',$newRecord);
    }
}
