const path = require('path')
const {srcPath, distPath} = require('./paths')

module.exports = {
    entry: path.join(srcPath, '/webpack-conf/index.js'),
    module: {
        rules: [
            {
                // 处理 ES6 等
                test: /\.js$/,
                loader: ['babel-loader'],
                include: path.join(srcPath, '/js/'),
                exclude:/node_modules/
            },
            {
                // 处理 vue
                test: /\.vue/,
                loader: ['vue-loader']
            },
        ]
    },
    plugins: [

    ]
}
