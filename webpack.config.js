const path = require('path');
const { VueLoaderPlugin } = require('vue-loader');
const HtmlWebpackPlugin = require('html-webpack-plugin');

module.exports = {
  mode: 'production', // Modo de compilação: 'production' ou 'development'
  entry: './public/assets/js/main.js', // Arquivo de entrada principal
  output: {
    path: path.resolve(__dirname, 'dist'), // Diretório de saída
    filename: 'bundle.js', // Nome do arquivo de saída
  },
  devServer: {
    static: path.resolve(__dirname, 'dist'), // Diretório estático para o servidor de desenvolvimento
    compress: true, // Habilita compressão gzip
    port: 8080, // Porta onde o servidor será executado
    hot: true, // Habilita Hot Module Replacement
  },
  module: {
    rules: [
      {
        test: /\.vue$/, // Processa arquivos .vue
        loader: 'vue-loader',
      },
      {
        test: /\.js$/, // Processa arquivos .js
        exclude: /node_modules/, // Exclui a pasta node_modules
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'], // Preset do Babel para compatibilidade com versões antigas do JavaScript
          },
        },
      },
      {
        test: /\.css$/, // Processa arquivos .css
        use: ['vue-style-loader', 'css-loader'],
      },
    ],
  },
  plugins: [
    new VueLoaderPlugin(), // Plugin para processar arquivos .vue
    new HtmlWebpackPlugin({
      template: path.resolve(__dirname, 'public/index.php'), // Template HTML
    }),
  ],
  resolve: {
    alias: {
      vue$: 'vue/dist/vue.runtime.esm-browser.js', // Alias para a versão runtime do Vue
    },
    extensions: ['.js', '.vue'], // Extensões resolvidas automaticamente
  },
};
