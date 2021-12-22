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

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);

const SVGSpritemapPlugin = require('svg-spritemap-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
// const ImageminPlugin = require('imagemin-webpack-plugin').default;

require('laravel-mix-webp');
// require('laravel-mix-polyfill');

mix
    // Обрабатываем JS
    .js(
        'resources/assets/js/main.js',
        'public/assets/js'
    )
    .js(
        'resources/assets/js/jquery.js',
        'public/assets/js'
    )
    // Преобразовываем SASS в CSS
    .sass(
        'resources/assets/scss/main.scss', // Путь относительно каталога с webpack.mix.js
        'public/assets/css/' // Путь относительно каталога с webpack.mix.js
    )    
    // Включаем версионность
    .version();

