const { src, dest, watch, parallel } = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const plumber = require("gulp-plumber");
const webp = require("gulp-webp")

function compileCSS(callback) {

    src('src/scss/**/*.scss')
        .pipe(plumber())
        .pipe(sass())
        .pipe(dest("build/css"));

    callback();
}

function convertirAWebp(callback) {
    const opciones = {
        quality: 50
    }
    src("src/img/**/*.{png,jpg}")
        .pipe(webp(opciones))
        .pipe(dest('build/img'));
    callback();
}

function dev(callback) {
    watch("src/scss/**/*.scss", compileCSS);

    callback();
}

exports.compileCSS = compileCSS;

exports.convertirAWebp = convertirAWebp;

exports.dev = parallel(convertirAWebp, dev);