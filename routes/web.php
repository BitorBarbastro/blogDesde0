<?php

use Illuminate\Support\Facades\Route;
use Mailgun\Mailgun;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



# Include the Autoloader (see "Libraries" for install instructions)

Route::get('/enviar-correo', function () {
    # Include the Autoloader (see "Libraries" for install instructions)
    require_once base_path('vendor/autoload.php');

    # Instantiate the client using the create method
    $mgClient = Mailgun::create('5e3f36f5-1cdfb09d', 'https://api.mailgun.net');
    $domain = 'sandbox8c6d2bd550f946279cd72a9e91bb0114.mailgun.org';
    $params = [
        'from' => 'Excited User <servidor@sandbox8c6d2bd550f946279cd72a9e91bb0114>',
        'to' => 'bbarbastrovicien@iesmordefuentes.com',
        'subject' => 'Hello',
        'text' => 'Testing some Mailgun awesomeness!',
    ];

    # Make the call to the client
    $mgClient->messages()->send($domain, $params);

    return 'Correo enviado correctamente';
});