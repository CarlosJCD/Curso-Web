const { src, dest, watch } = require("gulp");
const sass = require("gulp-sass")(require("sass"));

function compileCSS(callback) {

    src('src/scss/app.scss')
        .pipe(sass())
        .pipe(dest("build/css"));

    callback();
}

function dev(callback) {
    watch("src/scss/app.scss", compileCSS);

    callback();
}

exports.compileCSS = compileCSS;

exports.dev = dev;