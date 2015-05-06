/*
 * grunt-humbug
 * https://github.com/andrewholgate/grunt-humbug
 *
 * Copyright (c) 2015 Andrew Holgate
 * Licensed under the MIT license.
 */

'use strict';

module.exports = function(grunt) {

  // Please see the Grunt documentation for more information regarding task
  // creation: http://gruntjs.com/creating-tasks

  var path = require('path'),
      exec = require('child_process').exec,
      config = null,
      cmd = null,
      done = null;

  grunt.registerMultiTask('humbug', 'Grunt plugin for running PHP Humbug.', function() {
    // Merge task-specific and/or target-specific options with these defaults.
    var options = this.options({
      bin: 'node_modules/grunt-humbug/vendor/bin/humbug',
      default: {
        incremental: false,
        adapter: 'phpunit',
        constraints: null,
        options: null,
        file: [],
        timeout: 10,
        noProgressBar: false,
        quiet: false,
        verbose: false,
        ansi: true,
        interaction: true,
        maxBuffer: 200*1024,
        force: false
      }
    });

    // Merge default and user configs.
    config = this.options(options.default);
    cmd = path.normalize(options.bin);

    // Verify humbug has the configuration file it needs.
    if (!grunt.file.exists(path.normalize('humbug.json')) && !grunt.file.exists(path.normalize('humbug.json.dist'))) {
      grunt.fail.warn('Humbug expects the file humbug.json or humbug.json.dist to be in the root directory.\n' +
        'To generate a new humbug.json.dist file execute: ' + cmd + ' configure\n');
    }

    if (grunt.util.kindOf(config.file) === 'array') {
      config.file.forEach(function(fileName) {
        cmd += ' --file=' + fileName;
      });
    }

    if (config.adapter) {
      cmd += ' --adapter=' + config.adapter;
    }

    if (config.constraints) {
      cmd += ' --constraints=' + config.constraints;
    }

    if (config.options) {
      cmd += ' --options=' + config.options;
    }

    if (config.timeout) {
      cmd += ' --timeout=' + config.timeout;
    }

    if (config.noProgressBar) {
      cmd += ' --no-progress-bar';
    }

    if (config.quiet) {
      cmd += ' --quiet';
    }

    if (config.verbose) {
      cmd += ' --verbose';
    }

    if (!config.ansi) {
      cmd += ' --no-ansi';
    }

    if (!config.interaction) {
      cmd += ' --no-interaction';
    }

    if (config.incremental) {
      cmd += ' --incremental';
    }

    grunt.log.writeln('Starting humbug..');
    grunt.verbose.writeln('Execute: ' + cmd);

    done = this.async();

    exec(cmd, {maxBuffer: options.maxBuffer}, function(error, stdout, stderr) {
        /*jshint -W030 */
        typeof options.callback === 'function' && options.callback.call(this, error, stdout, stderr, done);
        stdout && grunt.log.write(stdout);
        if (!config.force && error) {
          grunt.fail.warn(stderr ? stderr : 'Task humbug:' + cmd + ' failed.');
        } else if (!error) {
          grunt.log.ok('Task humbug:' + cmd + ' passed.');
        }
        done();
      });
  });
};
