const path = require('path')
const webpack = require('webpack')
const {CleanWebpackPlugin} = require('clean-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const TerserJSPlugin = require('terser-webpack-plugin')
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin')
const webpackCommonConf = require('./webpack.common')
const merge = require('webpack-merge')
const {srcPath, distPath} = require('./paths')

module.exports = merge(webpackCommonConf, {
    mode: 'production',
    output: {
        filename: 'bundel.js', // 打包代码时，加上 hash 戳
        path: path.join(distPath,'dist'),
        //publicPath:'http://cdn.baidu.com' // 修改所有静态文件 url 为 cdn
    },
    module: {
        rules: [
            {
                // 小图片转 base64
                test: /\.(png|jpg|jpeg|gif)$/,
                use: {
                    loader: 'url-loader',
                    options: {
                        limit: 5 * 1024, // 小于5k
                        outputPath: '/imgs',
                        // publicPath: 'http://cdn.abc.com'
                    }
                },
            },
            {
                // 处理 css
                test: /\.css$/,
                // loader 执行顺序： 从后往前，从下到上
                loader: [MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader']
            },
            {
                // 处理 less
                test: /\.less$/,
                loader: [MiniCssExtractPlugin.loader, 'css-loader', 'less-loader','postcss-loader']
            },
            {
                // 处理 scss
                test: /\.scss$/,
                loader: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader','postcss-loader']
            }
        ]
    },
    plugins: [
        new CleanWebpackPlugin(), // 默认清空 output.path 文件
        new webpack.DefinePlugin({
            ENV: JSON.stringify('production')
        }),
        new MiniCssExtractPlugin({ // 抽离css
            filename:'style.css'
        })
    ],
    optimization:{
        minimizer:[  // 压缩 css
            new TerserJSPlugin({}),
            new OptimizeCSSAssetsPlugin({})
        ]
    }
})
