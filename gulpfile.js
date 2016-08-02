var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss', 'public/style')
		.scripts([ 'jquery-1x/node_modules/jquery/dist/jquery.js',	
				  'bootstrap-sass/assets/javascripts/bootstrap.js'], 'resources/assets/js/dependancies/bundle.js', 'node_modules')
		.scripts(['dependancies/bundle.js', '_main.js']);
});
