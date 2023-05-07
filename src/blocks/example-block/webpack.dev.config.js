const defaultConfig = require("@wordpress/scripts/config/webpack.config");
const { DefinePlugin } = require("webpack");

module.exports = {
	...defaultConfig,
	mode: "development",
	devtool: "inline-source-map",
	devServer: {
		contentBase: "./build",
		port: 9000,
		writeToDisk: true,
		hot: true,
		headers: {
			"Access-Control-Allow-Origin": "*",
		},
	},
	plugins: [
		...defaultConfig.plugins,
		new DefinePlugin({
			"process.env.NODE_ENV": JSON.stringify("development"),
		}),
	],
};
