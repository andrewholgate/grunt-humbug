# grunt-humbug

> Grunt plugin for running PHP Humbug mutation tests.

## Getting Started
This plugin requires Grunt `~0.4`

If you haven't used [Grunt](http://gruntjs.com/) before, be sure to check out the [Getting Started](http://gruntjs.com/getting-started) guide, as it explains how to create a [Gruntfile](http://gruntjs.com/sample-gruntfile) as well as install and use Grunt plugins.

1. Install this grunt plugin:

```shell
npm install grunt-humbug --save-dev
```

2. [Install humbug library](https://github.com/padraic/humbug#installation) (preferably with [composer](https://github.com/composer/composer))

```shell
composer install --working-dir=node_modules/grunt-humbug/
```

3. Generate Humbug configuration file `humbug.json.dist` if one does not already exist in the project root.

```shell
node_modules/grunt-humbug/vendor/bin/humbug configure
```

**Note:** The `humbug.json.dist` should be [modified with custom configurations](https://github.com/padraic/humbug#manual-configuration). Humbug also expectes that a `phpunit.xml.dist` or `phpunit.xml` be also present in the same directory.

4. Once the plugin has been installed, it may be enabled inside your Gruntfile with this line of JavaScript:

```js
grunt.loadNpmTasks('grunt-humbug');
```

## The "humbug" task

### Overview
In your project's Gruntfile, add a section named `humbug` to the data object passed into `grunt.initConfig()`.

```js
grunt.initConfig({
  humbug: {
    options: {
      // Task-specific options go here.
      'bin': 'node_modules/grunt-humbug/vendor/bin/humbug'
    },
    your_target: {
      options: {
        // Target-specific file lists and/or options go here.
        interaction: false
      }
    }
  }
});
```

### Options

#### options.bin
Type: `String`
Default: `'vendor/bin/humbug'`

Path to the executable humbug binary.

#### options.incremental
Type: `Boolean`
Default: `false`

Enable incremental mutation testing by relying on cached results.

#### options.adapter
Type: `String`
Default: `phpunit`

Set name of the test adapter to use.

#### options.constraints
Type: `String`
Default: `null`

Options set on adapter to constrain which tests are run. Applies only to the very first test run.

#### options.options
Type: `String`
Default: `null`

Set command line options string to pass to test adapter. Default is dictated dynamically by Humbug.

#### options.file
Type: `Array`
Default: `[]`

Pattern representing file(s) to mutate.

#### options.noProgressBar
Type: `Boolean`
Default: `false`

When set to `true`, removes dynamic output like the progress bar and performance data from output.

#### options.quiet
Type: `Boolean`
Default: `false`

When set to `true`, does not output any message.

#### options.verbose
Type: `Boolean`
Default: `false`

When set to `true`, increases the verbosity of messages.

#### options.ansi
Type: `Boolean`
Default: `true`

When set to `false`, disables ANSI output.

#### options.interaction
Type: `Boolean`
Default: `true`

When set to `false`, will not ask any interactive questions.

#### options.timeout
Type: `Integer`
Default: `10`

Sets a timeout (in seconds) applied for each test run to combat infinite loop mutations.

#### options.force
Type: `Boolean`
Default: `false`

Continue running grunt in the event of failures.

#### options.maxBuffer
Type: `Integer` Default: `200*1024`

Configure the Node JS `maxBuffer` option passed to the [`exec`](http://nodejs.org/api/child_process.html#child_process_child_process_exec_command_options_callback) function.
This can be useful if you need to run a large test suite which outputs lot of logs, otherwise you could encounter a `Fatal error: stdout maxBuffer exceeded.` error. See issue [#29](https://github.com/SaschaGalley/grunt-phpunit/issues/29) for more informations about this.

#### options.callback
Type: `String`
Default: `null`

Custom callback for altering Humbug's output.

### Usage Examples

#### Test CI Options

In this example, the options are set for a common usage when running Humbug for Continuious Integration tests.

```js
grunt.initConfig({
  humbug: {
    options: {
      'bin': 'node_modules/grunt-humbug/vendor/bin/humbug'
    },
    testci: {
      options: {
        interaction: false,
        noProgressBar: false,
        interaction: false,
        force: true
      }
    }
  }
});
```

## Contributing
In lieu of a formal styleguide, take care to maintain the existing coding style. Add unit tests for any new or changed functionality. Lint and test your code using [Grunt](http://gruntjs.com/).

## Release History
- 2015-05-05 v0.1.0 Initial release.
