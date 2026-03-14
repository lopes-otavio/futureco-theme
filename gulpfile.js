const gulp = require("gulp");
const cssimport = require("gulp-cssimport");
const cleanCSS = require("gulp-clean-css");
const rename = require("gulp-rename");

// Task para processar e minificar o CSS
gulp.task("styles", function () {
	return gulp
		.src("assets/css/main.css")
		.pipe(cssimport()) // Lê os @imports dentro do main.css e junta tudo
		.pipe(cleanCSS({ compatibility: "ie8" })) // Minifica
		.pipe(rename("main.min.css")) // Renomeia para main.min.css
		.pipe(gulp.dest("dist/")); // Salva na pasta dist/
});

// Task para observar mudanças nos arquivos CSS e rodar a task 'styles' automaticamente
gulp.task("watch", function () {
	gulp.watch("assets/css/**/*.css", gulp.series("styles"));
});

// Build padrão (roda usando `gulp` ou `npx gulp build`)
gulp.task("build", gulp.series("styles"));

// Exportação padrão (roda apenas `gulp`)
gulp.task("default", gulp.series("build", "watch"));
