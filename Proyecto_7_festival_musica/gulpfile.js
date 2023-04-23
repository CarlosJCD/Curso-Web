const { src, dest } = require("gulp");
const sass = require("gulp-sass")(require("sass"));

function compileCSS(callback) {

    src('src/scss/app.scss')
        .pipe(sass())
        .pipe(dest("build/css"));

    callback();
}

exports.compileCSS = compileCSS;