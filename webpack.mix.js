const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

require('laravel-mix-webp');

mix
    // Обрабатываем JS
    .js(
        'resources/assets/js/main.js',
        'public/assets/js'
    )
    // Преобразовываем SASS в CSS
    .sass(
        'resources/assets/scss/main.scss', // Путь относительно каталога с webpack.mix.js
        'public/assets/css/' // Путь относительно каталога с webpack.mix.js
    )    
    // Включаем версионность
    .version();

