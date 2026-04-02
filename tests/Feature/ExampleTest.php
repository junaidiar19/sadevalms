<?php

test('root redirects to login', function () {
    $this->get('/')->assertRedirect('/login');
});

test('login page returns successful response', function () {
    $this->get('/login')->assertStatus(200);
});
