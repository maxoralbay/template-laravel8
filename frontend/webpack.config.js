const path = require('path');
const { VueLoaderPlugin } = require('vue-loader')
const HtmlWebpackPlugin = require('html-webpack-plugin');
const webpack = require('webpack')
const resourcesDir = 'src/assets/js';

module.exports = {
    mode: 'development',
    entry: './src/assets/js/app.js',
    devServer: {
        hot: true,
        headers: {"Access-Control-Allow-Origin": "*"},
        host: 'localhost',
        port: 3000,
        historyApiFallback: true
    },
    devtool: 'source-map',
    output: {
        filename: 'main.js',
        path: path.resolve(__dirname, 'dist'),
        publicPath: '/'
    },
    plugins: [
        new webpack.DefinePlugin({
            __VUE_OPTIONS_API__: true,
            __VUE_PROD_DEVTOOLS__: false,
        }),
        new HtmlWebpackPlugin({ template: './src/index.html' }),
        new VueLoaderPlugin()
    ],
    module: {
        rules: [
            {
                test: /\.m?js$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            },
            {
                test: /\.css$/i,
                use: ["style-loader", "css-loader"],
            },
            {
                test: /\.s[ac]ss$/i,
                use: [
                  // Creates `style` nodes from JS strings
                  "style-loader",
                  // Translates CSS into CommonJS
                  "css-loader",
                  // Compiles Sass to CSS
                  "sass-loader",
                ],
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {   
                test: /\.txt$/, 
                use: 'raw-loader' 
            },
            {
                test: /\.(png|svg|jpg|jpeg|gif|ico)$/i,
                loader: 'file-loader',
                options: {
                  name: '[path][name].[ext]',
                },
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/i,
                type: 'asset/resource',
            },
        ]
    },
    resolve: {
        alias: {
            MainDir: path.resolve(__dirname, resourcesDir),
            Components:  path.resolve(__dirname, resourcesDir + '/components'),
            Pages: path.resolve(__dirname, resourcesDir + '/pages'),
            Providers: path.resolve(__dirname, resourcesDir + '/providers'),
            Helpers: path.resolve(__dirname, resourcesDir + '/helpers'),
            Routes: path.resolve(__dirname, resourcesDir + '/routes'),
            Services: path.resolve(__dirname, resourcesDir + '/services'),
            Store: path.resolve(__dirname, resourcesDir + '/store'),
            Middleware: path.resolve(__dirname, resourcesDir + '/middleware'),
            Mixins: path.resolve(__dirname, resourcesDir + '/mixins'),

            Images: path.resolve(__dirname, 'src/assets/images'),
        }
    }
};