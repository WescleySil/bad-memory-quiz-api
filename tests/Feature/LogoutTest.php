<?php

use \App\Models\User;

it('user authenticated should can logout', function (){
    $user = User::factory()->create();
    $token = $user->createToken('test_e2e')->plainTextToken;
    $this->postJson(route('logout'), [], [
        'Authorization' => "Bearer {$token}"
    ])->assertStatus(204);
});

it('user unauthenticated should cannot logout', function (){
    $this->postJson(route('logout'), [], [])
        ->assertJson([
            'message' => 'Unauthenticated.'
        ])
        ->assertStatus(401);
});
