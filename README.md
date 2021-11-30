<p align="center">
    <h1 align="center">Interview code test project</h1>
    <br>
</p>

I assumed you got your server setting ready. Running environment will be PHP7.4, Nginx or Apache.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      resource/           contains user data
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



Project configuration
---------------------

### Local environment setup

Run the following command to setup project

~~~
git clone https://github.com/ningzhou1980/interview-code-test-SH.git
cd interview-code-test-SH
composer install
~~~

### Entry script

~~~
the entry script located in web/index.php
~~~
