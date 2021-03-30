## Post-It

### Project Setup

1. Create project
    ```sh
    composer create-project --prefer-dist laravel/laravel project-name
    ```
2. Setup Tailwind CSS 
    [Tailwind Guide](https://tailwindcss.com/docs/guides/laravel)
    ```sh
    npm install tailwindcss
    ```
    * Configure Tailwind with Laravel Mix
    ```sh
    // webpack.mix.js
    mix.js("resources/js/app.js", "public/js")
        .postCss("resources/css/app.css", "public/css", [
            require("tailwindcss"),
    ]);
    ```
    * Include Tailwind in your CSS
    ```sh
    /* ./resources/css/app.css */
    @tailwind base;
    @tailwind components;
    @tailwind utilities;
    ```

### Running Migrations
 ```sh
 php artisan migrate
 ```

### Preventing CSRF Request

Laravel automatically generates a CSRF "token" for each active user session managed by the application

Anytime you define an HTML form in your application, 
you should include a hidden CSRF _token field in the form so that the CSRF protection middleware can validate the request.

```sh
<form method="POST" action="/profile">
    @csrf

    <!-- Equivalent to... -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>
```

### Assigning Middleware To Routes

Middleware provide a convenient mechanism for inspecting and filtering HTTP requests entering your application

### Authenticating A User And "Remembering" Them

If you would like to provide "remember me" functionality in your application, 
you may pass true as the second argument to the attempt method, 
which will keep the user authenticated indefinitely (or until they manually logout). 
Of course, your users table must include the string remember_token column, which will be used to store the "remember me" token.

```sh
if (Auth::attempt(array('email' => $email, 'password' => $password), true))
{
    // The user is being remembered...
}
```

## [Laravel Collections](https://laravel.com/docs/8.x/collections)

The Illuminate\Support\Collection class provides a fluent, convenient wrapper for working with arrays of data.

### [Eloquent: Relationships](https://laravel.com/docs/8.x/eloquent-relationships#one-to-many)

Database tables are often related to one another. 
For example, a blog post may have many comments or an order could be related to the user who placed it. 
Eloquent makes managing and working with these relationships easy, and supports a variety of common relationships:

### One To Many

A one-to-many relationship is used to define relationships where a single model is the parent to one or more child models.

one-to-many relationships are defined by defining a method
```sh
class User extends Authenticatable
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
```


## [Model Factories](https://laravel.com/docs/8.x/database-testing#concept-overview)
Laravel comes with a feature called model factories that are designed to quickly build out "fake" models. 
When testing, you may need to insert a few records into your database before executing your test. 
Instead of manually specifying the value of each column when you create this test data, 
Laravel allows you to define a set of default attributes for each of your Eloquent models using model factories.

```sh
public function definition()
{
    return [
        'body' => $this->faker->sentence(20)
    ];
}   
```

access php artisan tinker and generate record 

```sh
php artisan tinker
    
App\Models\Post::factory()->times(200)->create(['user_id' => 1]);
```

### [Route Model Binding](https://laravel.com/docs/8.x/routing#route-model-binding)

 Laravel route model binding provides a convenient way to automatically inject the model instances directly into your routes.
 ```sh
Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');

<form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
    @csrf
    <button type="submit" class="text-blue-500">Like</button>
</form>

public function store(Post $post, Request $request)
 ```

 ### [Form Method Spoofing](https://laravel.com/docs/8.x/routing#form-method-spoofing)
 ```sh
<form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-blue-500">Unlike</button>
</form>
 ```

### [Laravel Debug Bar](https://github.com/barryvdh/laravel-debugbar)

```sh
composer require barryvdh/laravel-debugbar --dev
```

### [Eager Loading](https://laravel.com/docs/8.x/eloquent-relationships#eager-loading)
Eager loading is a concept in which when retrieving items, 
you get all the needed items together with all (or most) related items at the same time.

```sh
$posts = Post::with(['user', 'likes'])->paginate(20);
```

### [Authorization](https://laravel.com/docs/8.x/authorization)

Laravel also provides a simple way to authorize user actions against a given resource. 
For example, even though a user is authenticated, 
they may not be authorized to update or delete certain Eloquent models or database records managed by your application. 
Laravel's authorization features provide an easy, organized way of managing these types of authorization checks.

```sh
php artisan make:policy PostPolicy

AuthServiceProvider.php
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

PostController.php
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return back();
    }

views posts - index.blade.php
    @can('delete', $post)
        <form action="{{ route('posts.destroy',  $post) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-blue-500">Delete</button>
        </form>
    @endcan
```