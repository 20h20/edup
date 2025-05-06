module.exports = function (grunt) {
  require("time-grunt")(grunt);
  require("jit-grunt")(grunt);

  grunt.initConfig({
    site_url: "http://localhost:8888/EdUp/",
    theme_name: "edup",

    /* Do not edit below */

    path_src: "src/",
    path_theme: "",
    path_dist: "library/",

    pkg: grunt.file.readJSON("package.json"),

    /* Sass */

    sass: {
      options: {
        sourceMap: false,
        outputStyle: "nested" // nested, compressed
      },
      dist: {
        files: {
          "<%= path_dist %>css/style.css": "<%= path_src %>scss/style.scss",
        }
      }
    },

    /* Css minification */

    postcss: {
      options: {
        map: false, // inline sourcemaps
        processors: [
          require("autoprefixer")({ browsers: "last 3 versions" }), // add vendor prefixes
          require("cssnano")() // minify the result
        ]
      },
      dist: {
        src: "<%= path_dist %>css/*.css"
      }
    },

    /* Icons font */

    webfont: {
      icons: {
        src: "<%= path_src %>icons/*.svg",
        dest: "<%= path_dist %>iconfont",
        destCss: "<%= path_src %>scss/partials/",
        options: {
          stylesheet: "scss",
          relativeFontPath: "../iconfont",
          template: "<%= path_src %>scss/partials/_icons-template.scss",
          types: "eot,woff,ttf,svg",
          htmlDemo: false,
          optimize: false,
          engine: "node",
          autoHint: false
        }
      }
    },

    /* Javascript Inclusions */

    include_file: {
      default_options: {
        cwd: "<%= path_src %>js/",
        src: ["scripts.js"],
        dest: "<%= path_dist %>js/"
      }
    },

    /* Javascripts Concat */

    concat: {
      options: {
        separator: ";"
      },
      dist: {
        src: ["<%= path_src %>js/**/*.js"],
        dest: "<%= path_dist %>js/scripts.js"
      }
    },

    /* Javascript Uglify */

    uglify: {
      app: {
        files: {
          "<%= path_dist %>js/scripts.js": ["<%= path_dist %>js/scripts.js"]
        }
      }
    },

    /* Browser Sync */

    browserSync: {
      bsFiles: {
        src: [
          "<%= path_dist %>css/*.css",
          "<%= path_dist %>js/*.js",
          "<%= path_theme %>**/*.php"
        ]
      },
      options: {
        proxy: "<%= site_url %>",
        watchTask: true
      }
    },

    /* --------- Default Watch -------- */

    watch: {
      options: {
        spawn: false
      },
      iconfont: {
        files: "<%= path_src %>icons/*.svg",
        tasks: ["webfont"]
      },
      css: {
        files: "<%= path_src %>scss/**/*.scss",
        tasks: ["sass", "postcss"]
      },
      js: {
        files: "<%= path_src %>js/**/*.js",
        tasks: ["include_file", "uglify"]
      }
    }
  });

  grunt.loadNpmTasks("grunt-contrib-watch");
  grunt.loadNpmTasks("grunt-browser-sync");

  grunt.registerTask("default", [
    "webfont",
    "sass",
    "postcss",
    "include_file",
    "uglify",
    "browserSync",
    "watch"
  ]);
  grunt.registerTask("build", [
    "webfont",
    "sass",
    "postcss",
    "include_file",
    "uglify"
  ]);
};
