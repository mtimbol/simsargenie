let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');

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

mix.js('resources/assets/js/app.js', 'public/js');
mix.sass('resources/assets/sass/app.scss', 'public/css')
mix.sass('resources/assets/sass/public.scss', 'public/css')
mix.sass('resources/assets/sass/vendor.scss', 'public/css')
// mix.js('resources/assets/js/vendor.js', 'public/js')
mix.js('resources/assets/js/alert.js', 'public/js')
// Contact lists
mix.react('resources/assets/js/components/contact/contact-lists.js', 'public/js')
mix.react('resources/assets/js/ImportContacts.js', 'public/js')
	.options({
		processCssUrls: false,
		postCss: [ tailwindcss('./tailwind.js') ]
	});
mix.copy('./node_modules/font-awesome/fonts', 'public/fonts');
mix.version();

