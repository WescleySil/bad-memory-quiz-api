<?php


use App\Models\User;

it('Should auth user', function () {
    $user = \App\Models\User::factory()->create();
    $data = [
        'email' => $user->email,
        'password' => 'password',
    ];
    $this->postJson(route('login'), $data)
        ->assertOk();
});

test('should fail auth', function () {
    $user = User::factory()->create();
    $this->postJson(route('login'), [
        'email' => $user->email,
        'password' => 'testing',
    ])
        ->assertStatus(422);
});

describe('validation', function () {
    it('should require email', function () {
        $this->postJson(route('login'), [
            'password' => 'teste',
        ])
            ->assertJsonValidationErrors([
                'email' => trans('validation.required', ['attribute' => 'email'])
            ])
            ->assertStatus(422);
    });
    it('should require password', function () {
        $user = User::factory()->create();
        $this->postJson(route('login'), [
            'email' => $user->email,
            'password' => '',
        ])
            ->assertJsonValidationErrors([
                'password' => trans('validation.required', ['attribute' => 'password'])
            ])
            ->assertStatus(422);
    });
});
