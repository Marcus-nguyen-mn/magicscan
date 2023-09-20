import gulp from 'gulp';
import yargs from 'yargs';
import dartSass from 'sass';
import gulpSass from 'gulp-sass';
import cleanCss from 'gulp-clean-css';
import gulpif from 'gulp-if';
import sourcemaps from 'gulp-sourcemaps';
import webpack from 'webpack-stream';
import uglify from 'gulp-uglify';
import browserSync from 'browser-sync';

const server = browserSync.create();

const sass = gulpSass(dartSass);

const PRODUCTION = yargs.argv.prod;

const paths = {
    styles: {
        src: ['src/assets/scss/bundle.scss'],
        dest: 'dist/assets/css'
    },
    scripts: {
        src: ['src/assets/js/bundle.js'],
        dest: 'dist/assets/js'
    }
}

export const serve = (done)=>{
    server.init({
        proxy: "http://magicscan.co"
    });
    done();
}

export const reload = (done)=>{
    server.reload();
    done();
}

export const styles = ()=>{
    return gulp.src(paths.styles.src)
        .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCss({compatibility: 'ie8'}))
        .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
        .pipe(gulp.dest(paths.styles.dest));
}

export const watch = () =>{
    gulp.watch('src/assets/scss/**/*.scss', gulp.series(styles, reload));
    gulp.watch('src/assets/js/**/*.js', gulp.series(scripts, reload));
    gulp.watch('**/*.php', reload);
}

export const scripts = () => {
    return gulp.src(paths.scripts.src)
        .pipe(webpack({
            module: {
                rules: [
                    {
                        test: /\.m?js$/,
                        exclude: /node_modules/,
                        use: {
                          loader: 'babel-loader',
                          options: {
                            presets: [
                              ['@babel/preset-env', { targets: "defaults" }]
                            ]
                          }
                        }
                      }
                ]
            },
            output: {
                filename: 'bundle.js'
            },
            devtool: !PRODUCTION ? 'inline-source-map': false,
            mode: 'development'
        }))
        .pipe(uglify())
        .pipe(gulp.dest(paths.scripts.dest));
}

export const dev = gulp.series(gulp.parallel(styles, scripts), serve, watch);
export const build = gulp.series(gulp.parallel(styles, scripts));

export default dev;