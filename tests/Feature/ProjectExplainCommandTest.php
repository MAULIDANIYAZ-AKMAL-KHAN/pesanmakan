<?php

it('explains the project from the artisan command', function () {
    $this->artisan('project:explain')
        ->assertOk()
        ->expectsOutputToContain('Project Overview')
        ->expectsOutputToContain('routes/web.php')
        ->expectsOutputToContain('OrderController')
        ->expectsOutputToContain('FoodController')
        ->expectsOutputToContain('app/Models');
});
