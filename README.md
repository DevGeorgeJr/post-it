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

Anytime you define an HTML form in your application, you should include a hidden CSRF _token field in the form so that the CSRF protection middleware can validate the request.

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

If you would like to provide "remember me" functionality in your application, you may pass true as the second argument to the attempt method, which will keep the user authenticated indefinitely (or until they manually logout). Of course, your users table must include the string remember_token column, which will be used to store the "remember me" token.

```sh
if (Auth::attempt(array('email' => $email, 'password' => $password), true))
{
    // The user is being remembered...
}
```

### [Laravel Collections](https://laravel.com/docs/8.x/collections)

The Illuminate\Support\Collection class provides a fluent, convenient wrapper for working with arrays of data.

### Eloquent: Relationships

Database tables are often related to one another. For example, a blog post may have many comments or an order could be related to the user who placed it. Eloquent makes managing and working with these relationships easy, and supports a variety of common relationships:

## One To Many

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