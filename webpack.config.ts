import * as path from "path";
import * as webpack from "webpack";
import * as MiniCssExtractPlugin from "mini-css-extract-plugin";

const config: webpack.Configuration = {
    mode: 'development',
    entry: './src/index.ts',
    module: {
        rules: [
            {
                test: /\.tsx?$/,
                use: 'ts-loader',
                exclude: /node_modules/,
            },
            {
                test: /\.s[ac]ss$/i,
                use: [
                    MiniCssExtractPlugin.loader, // Creates `style` nodes from JS strings
                    "css-loader", // Translates CSS into CommonJS
                    "sass-loader", // Compiles Sass to CSS
                ]
            }
        ],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "styles.css"
        })
    ],
    resolve: {
        extensions: ['.tsx', '.ts', '.js'],
    },
    output: {
        filename: 'bundle.js',
        path: path.resolve(__dirname, 'dist'),
    }
};

export default config;