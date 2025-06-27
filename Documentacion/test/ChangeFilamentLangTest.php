<?php

use Tests\TestCase;

uses(TestCase::class);

test('Cambiar idioma en Filament redirige y actualiza locale', function () {
    $response = $this->get('/admin/change-locale/fr');
    $response->assertRedirect();
    expect(session()->get('locale'))->toBe('fr');
    $response = $this->get('/admin/');
    expect(session()->get('locale'))->toBe('fr');
    $response = $this->get('/');
    expect(session()->get('locale'))->toBe('fr');
});

test('Cambiar idioma actualiza la sesión y devuelve traducciones', function () {
    $response = $this->get('/set_lang?locale=en');

    $response->assertStatus(200)
        ->assertJsonStructure(['translation', 'title']);

    expect(session()->get('locale'))->toBe('en');
});
