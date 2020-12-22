var path = require('path');

module.exports = {
    entry: './components/app.js',
    output: {
        path: path.resolve(__dirname, '../../../public/front/themes/default/dist'),
        filename: '[name].js'
    },
    module: {
        rules: [{
            test: /\.js$/,
            exclude: /node_modules/,
            use: {
                loader: 'babel-loader',
                options: {
                    presets: ['@babel/preset-react']
                }
            }
        }]
    }
}