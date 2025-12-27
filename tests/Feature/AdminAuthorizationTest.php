<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guests cannot access admin dashboard', function () {
    $response = $this->get('/admin/dashboard');

    $response->assertRedirect('/login');
});

test('regular users cannot access admin dashboard', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $response = $this->actingAs($user)->get('/admin/dashboard');

    $response->assertForbidden();
});

test('admin users can access admin dashboard', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $response = $this->actingAs($admin)->get('/admin/dashboard');

    $response->assertOk();
});

test('regular users cannot access admin quizzes page', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $response = $this->actingAs($user)->get('/admin/quizzes');

    $response->assertForbidden();
});

test('admin users can access admin quizzes page', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $response = $this->actingAs($admin)->get('/admin/quizzes');

    $response->assertOk();
});

test('regular users cannot access admin questions page', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $response = $this->actingAs($user)->get('/admin/questions');

    $response->assertForbidden();
});

test('admin users can access admin questions page', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $response = $this->actingAs($admin)->get('/admin/questions');

    $response->assertOk();
});

test('regular users cannot access admin categories page', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $response = $this->actingAs($user)->get('/admin/categories');

    $response->assertForbidden();
});

test('admin users can access admin categories page', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $response = $this->actingAs($admin)->get('/admin/categories');

    $response->assertOk();
});

test('user is_admin defaults to false', function () {
    $user = User::factory()->create();

    expect($user->is_admin)->toBeFalse();
});

test('user isAdmin method returns correct value', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $user = User::factory()->create(['is_admin' => false]);

    expect($admin->isAdmin())->toBeTrue();
    expect($user->isAdmin())->toBeFalse();
});
