const { src, dest, series, parallel, watch } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const terser = require('gulp-terser');
const concat = require('gulp-concat');
const clean = require('gulp-clean');
const sourcemaps = require('gulp-sourcemaps');
const gulpif = require('gulp-if');
const svgmin = require('gulp-svgmin');

const paths = {
    dev: {
        js: 'dev/js/**/*.js',
        img: 'dev/img/**/*',
        icons: 'dev/icons/**/*',
        scss: 'dev/scss/**/*.scss',
        fonts: 'dev/fonts/**/*'
    },
    assets: {
        root: 'assets',
        js: 'assets/js',
        img: 'assets/img',
        icons: 'assets/icons',
        css: 'assets/css',
        fonts: 'assets/fonts'
    }
};

let production = process.env.NODE_ENV === 'production';

function cleanDist() {
    return src(paths.assets.root, { read: false, allowEmpty: true })
        .pipe(clean());
}

function js() {
    return src(paths.dev.js)
        .pipe(dest(paths.assets.js));
}

function img() {
    return src(paths.dev.img)
        .pipe(dest(paths.assets.img));
}

function icons() {
    return src(paths.dev.icons)
        .pipe(svgmin())
        .pipe(dest(paths.assets.icons));
}

function fonts() {
    return src(paths.dev.fonts)
        .pipe(dest(paths.assets.fonts));
}

function scss() {
    return src(paths.dev.scss)
        .pipe(sourcemaps.init())
        .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
        .pipe(concat('theme.min.css'))
        .pipe(sourcemaps.write())
        .pipe(dest(paths.assets.css));
}

exports.default = series(parallel(js, img, icons, fonts, scss));

function buildJs() {
    return src(paths.dev.js)
        .pipe(sourcemaps.init())
        .pipe(terser())
        .pipe(concat('theme.min.js'))
        .pipe(gulpif(!production, sourcemaps.write('.')))
        .pipe(dest(paths.assets.js));
}

function buildCss() {
    return src(paths.dev.scss)
        .pipe(sourcemaps.init())
        .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
        .pipe(concat('theme.min.css'))
        .pipe(gulpif(!production, sourcemaps.write('.')))
        .pipe(dest(paths.assets.css));
}

function cleanAndBuild(cb) {
    return series(cleanDist, parallel(img, icons, fonts), buildJs, buildCss)(cb);
}

exports.build = series(cleanAndBuild);
exports.cleanStart = series(cleanDist, exports.default);

// Gulp 4 watch
exports.watch = function () {
    watch(paths.dev.js, series(buildJs));
    watch(paths.dev.img, series(img));
    watch(paths.dev.icons, series(icons));
    watch(paths.dev.fonts, series(fonts));
    watch(paths.dev.scss, series(buildCss));
};
