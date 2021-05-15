import del from 'del';
import { src, dest, watch, series, parallel } from 'gulp';
import yargs from 'yargs';
import sass from 'gulp-sass';
import cleanCss from 'gulp-clean-css';
import gulpif from 'gulp-if';
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'autoprefixer';
import imagemin from 'gulp-imagemin';
import webp from 'gulp-webp';
import webpack from 'webpack-stream';
import info from './package.json';
import named from 'vinyl-named';
import browserSync from 'browser-sync';
import replace from 'gulp-replace';
import bump from 'gulp-bump';
import Fiber from 'fibers';

require('dotenv').config()

const env = process.env.NODE_ENV;
const proxy = process.env.PROXY_SERVER || 'localhost:8888';
const PRODUCTION = yargs.argv.prod;
const PATCH = yargs.argv.patch;
const MINOR = yargs.argv.minor;
const MAJOR = yargs.argv.major;

sass.compiler = require('sass');

export const styles = () => {
    return src('src/scss/index.scss')
        .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
        .pipe(sass({outputStyle: 'expanded', fiber: Fiber}).on('error', sass.logError))
        .pipe(postcss([ autoprefixer() ]))
        .pipe(gulpif(PRODUCTION, cleanCss({compatibility:'ie8'})))
        .pipe(gulpif(!PRODUCTION, sourcemaps.write('./')))
        .pipe(dest('dist/css'))
        .pipe(server.stream());
}

export const images = () => {
    return src('src/img/**/*.{jpg,jpeg,png,svg,gif}')
    .pipe(gulpif(PRODUCTION, imagemin()))
    .pipe(webp())
    .pipe(dest('dist/img'));
}

export const copy = () => {
    return src(['src/**/*','!src/{img,js,scss}','!src/{img,js,scss}/**/*'])
        .pipe(dest('dist'));
}

export const scripts = () => {
    return src(['src/js/index.js', 'src/js/vendor/*'])
      .pipe(named())
      .pipe(webpack({
        module: {
          rules: [
            {
              test: /\.js$/,
              use: {
                loader: 'babel-loader',
                options: {
                  presets: []
              }
            }
          }
        ]
      },
      mode: PRODUCTION ? 'production' : 'development',
      devtool: !PRODUCTION ? 'source-map' : false,
      output: {
        filename: '[name].js'
      },
      externals: {
        jquery: 'jQuery'
      },
    }))
    .pipe(dest('dist/js'));
}

export const clean = () => del(['dist']);

const server = browserSync.create();
export const serve = done => {
  server.init({
    proxy: proxy
  });
  done();
};

export const reload = done => {
  server.reload();
  done();
};

export const bumpVersion = () => {
  return src(['package.json', 'package-lock.json'])
  .pipe(gulpif(PATCH, bump({type:'patch'})))
  .pipe(gulpif(MINOR, bump({type:'minor'})))
  .pipe(gulpif(MAJOR, bump({type:'major'})))
  .pipe(dest('./'));
}

export const updateVersion = () => {
  return src(['style.css'])
  .pipe( replace( /Version: (\d+\.)(\d+\.)(\d+)/, function(match) {
    console.log('Old ' + match + '\nNew Version ' + info.version);
    return 'Version: ' + info.version
  }) )
  .pipe(dest('./'));
}

export const compress = () => {
return src([
    "**/*",
    "!node_modules{,/**}",
    "!bundled{,/**}",
    "!src{,/**}", 
    "!.babelrc",
    "!.gitignore",
    "!gulpfile.babel.js",
    "!package.json",
    "!package-lock.json",
  ])
  .pipe(dest('./bundled'));
};
  
export const watchForChanges = () => {
    watch('src/scss/**/*.scss', styles);
    watch('src/img/**/*.{jpg,jpeg,png,svg,gif}', series(images, reload));
    watch(['src/**/*','!src/{img,js,scss}','!src/{img,js,scss}/**/*'], series(copy, reload));
    watch('src/js/**/*.js', series(scripts, reload));
    watch("**/*.php", reload);
}
    
export const dev = gulpif(env == 'development', series(clean, parallel(styles, images, copy, scripts), serve, watchForChanges));
export const update = series(bumpVersion);
export const build = gulpif(env != undefined, series(clean, updateVersion, parallel(styles, images, copy, scripts), compress));
export default dev;