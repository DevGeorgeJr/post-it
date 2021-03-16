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
