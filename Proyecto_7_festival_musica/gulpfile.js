const { src, dest, watch } = require("gulp");
const sass = require("gulp-sass")(require("sass"));

function compileCSS(callback) {

    src('src/scss/**/*.scss')
        .pipe(sass())
        .pipe(dest("build/css"));

    callback();
}

function dev(callback) {
    watch("src/scss/**/*.scss", compileCSS);

    callback();
}

exports.compileCSS = compileCSS;

exports.dev = dev;