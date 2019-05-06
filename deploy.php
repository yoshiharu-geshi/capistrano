<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'capistrano');

// Project repository
// set('repository', 'git@github.com:yoshiharu-geshi/capistrano.git');
set('repository', 'https://github.com/yoshiharu-geshi/capistrano.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
set('shared_files', []);
set('shared_dirs', []);

// Writable dirs by web server
set('writable_dirs', []);

// Hosts
host('YourWindowsFirstHostName')
    ->hostname('1.1.1.1')
    ->stage('windows')
    ->roles('first_app')
    ->user('git')
    ->port('22')
    ->set('deploy_path', 'C:\Apps\application');

host('YourWindowsHostName')
    ->hostname('1.1.1.2')
    ->stage('windows')
    ->roles('apps')
    ->user('git')
    ->port('22')
    ->set('deploy_path', 'C:\Apps\application');

host('YourLinuxFirstHostName')
    ->hostname('1.1.1.3')
    ->stage('linux')
    ->roles('first_app')
    ->user('git')
    ->port('22')
    ->set('deploy_path', '/apps/application');

host('YourLinuxHostName')
    ->hostname('1.1.1.4')
    ->stage('linux')
    ->roles('apps')
    ->user('git')
    ->port('22')
    ->set('deploy_path', '/Apps/application');

    // New Task
desc('Update code');
task('deploy:deploy_code', function () {
    $repository = trim(get('repository'));
    $branch = get('branch');
    $stage = get('stage');
    $recursive = '--recursive'; // include subproject
    $quiet = '-q';              // quiet
    $delimiter = '/';           // path delimiter
    $command_delimiter = '&&';  // command delimiter
    $options = [
        'tty' => get('git_tty', false),
    ];
    if ('windows' === $stage) {
        $delimiter = "\\";
        $command_delimiter = ";";
    }
    $application_path = "{{deploy_path}}$delimiter{{application}}";

/*
    $at = '';
    if (!empty($branch)) {
        $at = "-b $branch";
    }

    // If option `tag` is set
    if (input()->hasOption('tag')) {
        $tag = input()->getOption('tag');
        if (!empty($tag)) {
            $at = "-b $tag";
        }
    }

    // If option `tag` is not set and option `revision` is set
    if (empty($tag) && input()->hasOption('revision')) {
        $revision = input()->getOption('revision');
        if (!empty($revision)) {
            $depth = '';
        }
    }
*/
    if ('windows' === $stage) {
        $dir = run("Test-Path $application_path", $options);
    } else {
        $dir = run("if [ -d $application_path ]; then echo 'True'; fi");
    }
    if ($dir == "True") {
        run("git clone $recursive $quiet $repository $application_path 2>&1", $options);
    } else {
        run("cd $application_path $command_delimiter git pull $quiet 2>&1", $options);
    }
});

// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:deploy_code',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
// after('deploy:failed', 'deploy:unlock');