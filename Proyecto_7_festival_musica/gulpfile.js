const { src, dest, watch, parallel } = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const plumber = require("gulp-plumber");
const webp = require("gulp-webp");
const imagemin = require("gulp-imagemin");
const cache = require("gulp-cache");
const avif = require('gulp-avif');

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

function convertirAAvif(callback) {
    const opciones = {
        quality: 50
    }
    src("src/img/**/*.{png,jpg}")
        .pipe(avif(opciones))
        .pipe(dest('build/img'));
    callback();
}

function reducirTamañoImagenes(callback) {
    const opciones = {
        optimizationlevel: 3
    }
    src('src/img/**/*.{png,jpg}')
        .pipe(cache(imagemin(opciones)))
        .pipe(dest('build/img'));

    callback();
}

function dev(callback) {
    watch("src/scss/**/*.scss", compileCSS);

    callback();
}

exports.compileCSS = compileCSS;

exports.reducirTamañoImagenes = reducirTamañoImagenes;

exports.convertirAWebp = convertirAWebp;

exports.convertirAAvif = convertirAAvif;

exports.dev = parallel(convertirAAvif, reducirTamañoImagenes, convertirAWebp, dev);