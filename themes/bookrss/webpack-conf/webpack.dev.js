const path = require('path')
const webpack = require('webpack')
const webpackCommonConf = require('./webpack.common')
const HtmlWebpackPlugin = require('html-webpack-plugin')
const merge = require('webpack-merge')
const {srcPath, distPath} = require('./paths')

module.exports = merge(webpackCommonConf, {
    mode: 'development',
    module: {
        rules: [
            // 直接引入图片 url
            {
                test: /\.(png|jpg|jpeg|gif)$/,
                use: 'file-loader'
            },
            {
                // 处理 css
                test: /\.css$/,
                // loader 执行顺序： 从后往前，从下到上
                loader: ['style-loader', 'css-loader', 'postcss-loader']
            },
            {
                // 处理 less
                test: /\.less$/,
                loader: ['style-loader', 'css-loader', 'less-loader']
            },
            {
                // 处理 scss
                test: /\.scss$/,
                loader: ['style-loader', 'css-loader', 'sass-loader']
            }
        ]
    },
    plugins: [
        new webpack.DefinePlugin({
            // window.ENV = 'development'
            ENV: JSON.stringify('development')
        }),
        new HtmlWebpackPlugin({
            template: path.join(srcPath, '/webpack-conf/index.html'),
            filename: 'index.html'
        })
    ],
    devServer: {
        port: 8080,
        progress: true, // 打包进度条
        contentBase: path.join(srcPath, '/webpack-conf/'), // 资源目录
        open: true,// 自动打开浏览器
        compress: true, // 启动 gzip 压缩

        // 设置代理
        proxy: {
            // 如 api => http:www.baidu.com/api
            'api': 'http:www.baidu.com/api',

            // 如 api2/xxx => http:www.baidu.com/api2/xxx
            '/api2': {
                changeOrigin: true,
                target: 'http:www.baidu.com',
                pathRewrite: {
                    '/api2': ''
                }
            }
        }
    }
})
