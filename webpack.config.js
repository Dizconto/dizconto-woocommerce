const path = require( 'path' );
const glob = require('glob');
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const WooCommerceDependencyExtractionWebpackPlugin = require( '@woocommerce/dependency-extraction-webpack-plugin' );

module.exports = {
    ...defaultConfig,
    entry: glob.sync('./src/**/*.js').reduce((entries, file) => {
        const name = path.basename(file, path.extname(file));
        entries[name] = file;
        return entries;
    }, {}),
    output: {
        ...defaultConfig.output,
        filename: '[name].js', // Output file names match the source file names
        path: path.resolve(__dirname, 'build'),
    },
    resolve: {
        ...defaultConfig.resolve,
        extensions: ['.js', '.jsx'], // Add .jsx extension
    },
    plugins: [
        ...defaultConfig.plugins.filter(
            ( plugin ) =>
                plugin.constructor.name !== 'DependencyExtractionWebpackPlugin'
        ),
        new WooCommerceDependencyExtractionWebpackPlugin(),
    ],
};