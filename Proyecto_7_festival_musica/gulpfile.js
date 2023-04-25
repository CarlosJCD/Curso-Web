const { src, dest, watch, parallel } = require("gulp");
//CSS
const sass = require("gulp-sass")(require("sass"));
const plumber = require("gulp-plumber");
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const postcss = require('gulp-postcss');

//Imagenes
const webp = require("gulp-webp");
const imagemin = require("gulp-imagemin");
const cache = require("gulp-cache");
const avif = require('gulp-avif');

function compilarSCSS(callback) {

    src('src/scss/**/*.scss')
        .pipe(plumber())
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
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

function exportarJavaScript(callback) {
    src('src/js/**/*.js').pipe(dest("build/js"));

    callback();
}

function dev(callback) {
    watch("src/scss/**/*.scss", compilarSCSS);
    watch("src/js/**/*.js", exportarJavaScript);

    callback();
}

exports.compilarProyecto = parallel(convertirAAvif, reducirTamañoImagenes, convertirAWebp, exportarJavaScript, compilarSCSS);

exports.dev = parallel(dev);