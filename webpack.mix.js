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

mix.js('resources/js/app.js', 'public/js')
	.stylus('resources/stylus/app.styl', 'public/css', {
	    use: [
	        require('rupture')(),
	        require('nib')()
	    ]
	})
	.browserSync('h1-studio.ru')
	.copy('node_modules/font-awesome/fonts', 'public/fonts');
