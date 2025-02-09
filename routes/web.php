<?php

use App\Events\AdminActivityLogged;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('user', function () {
//     $user = User::create([
//         'name'          => 'John Doe',
//         'email'         => 'john@example.com',
//         'password'      => Hash::make('password'),
//     ]);

//     AdminActivityLogged::dispatch(
//         $user->id,
//         'User Created', 'User ' . $user->name . ' created',
//         null
//     );
// });

// Route::get('blog', function () {
//     $user = User::latest()->get()->first();

//     $blog = Blog::create([
//         'title'         => 'Hello World',
//         'content'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl nec ultricies lacinia, nunc nisl aliquam nunc, vitae aliquam nisl nunc vitae nisl. Sed euismod, nisl nec ultricies lacinia, nunc nisl aliquam nunc, vitae aliquam nisl nunc vitae nisl.',
//         'slug'          => 'hello-world',
//         'user_id'       => $user->id,
//     ]);

//     AdminActivityLogged::dispatch(
//         $blog->user_id,
//         'Post Created',
//         'Post ' . $user->title . ' created',
//     );
// });


Route::get('user/create', function () {
    Event::dispatch('event.user.create', ['name' => 'james', 'email' => 'james@gmail.com'], true);
    return '<h1>success</h1>';
});
Route::get('user/update', function () {
    Event::dispatch('event.user.update', ['name' => 'james', 'email' => 'james@gmail.com'], true);
    return '<h1>success</h1>';
});
Route::get('user/delete', function () {
    Event::dispatch('event.user.delete', ['name' => 'james', 'email' => 'james@gmail.com'], true);
    return '<h1>success</h1>';
});

ROute::get('blog/create', function () {
    Event::dispatch('event.blog.create', ['name' => 'james','email' => 'james@gmail.com'], true);
    return '<h1>success</h1>';
});
ROute::get('blog/update', function () {
    Event::dispatch('event.blog.update', ['name' => 'james','email' => 'james@gmail.com'], true);
    return '<h1>success</h1>';
});
ROute::get('blog/delete', function () {
    Event::dispatch('event.blog.delete', ['name' => 'james','email' => 'james@gmail.com'], true);
    return '<h1>success</h1>';
});
