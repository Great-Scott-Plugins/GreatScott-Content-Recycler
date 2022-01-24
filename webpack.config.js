const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

module.exports = {
	...defaultConfig,
	externals: {
		"react": "React",
		"react-dom": "ReactDOM",
	},
	entry: {
		'post-edit': './src/js/post-edit.js',
	},
};
