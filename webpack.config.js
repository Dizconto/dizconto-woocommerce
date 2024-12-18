const path = require('path');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const glob = require('glob');

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
        path: path.resolve(__dirname, 'build'), // Output directory
    },
};