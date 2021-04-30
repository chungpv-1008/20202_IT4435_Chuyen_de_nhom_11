const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.styles('resources/css/style.css', 'public/css/style.css')

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')

mix.styles('resources/css/register.css', 'public/css/register.css')
    .js('resources/js/register.js', 'public/js')

mix.js('resources/js/list_user.js', 'public/js')

mix.js('resources/js/list_job.js', 'public/js')

mix.styles('resources/css/edit_company.css', 'public/css/edit_company.css')

mix.styles('resources/css/edit_user.css','public/css/edit_user.css')

mix.js('resources/js/filter_job.js', 'public/js')
    .js('resources/js/suitable_job.js', 'public/js')

mix.styles('resources/css/user.css', 'public/css/user.css')

mix.js('resources/js/job_history.js', 'public/js')

mix.js('resources/js/home.js', 'public/js')
