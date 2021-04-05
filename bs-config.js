module.exports = {
	proxy: `localhost:8888/php_glob/htdocs`,
	files: [
		`./htdocs/**/*.*`,
	],
	cwd: `./htdocs/`
};
