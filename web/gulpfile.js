"use strict";

/* 
*
* /web: run "npx gulp"
*
*/

const gulp = require("gulp");
const sass = require("gulp-sass");

sass.compiler = require("node-sass"); //Necessário para funcionar gulp-sass

gulp.task('default', watch);

gulp.task("sass", compilaSass);

function compilaSass() {
  return gulp
    .src("src/assets/styles/scss/**/*.+(scss|sass)")
    .pipe(sass({ outputStyle: "compressed" }).on("error", sass.logError))
    .pipe(gulp.dest("src/assets/styles/css"));
}

function watch() {
  gulp.watch("src/assets/styles/scss/**/*.+(scss|sass)", compilaSass);
}