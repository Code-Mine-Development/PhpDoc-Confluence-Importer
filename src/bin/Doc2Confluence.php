<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 10.02.16
 * Time: 10:20
 */
require __DIR__.'/../../vendor/autoload.php';

$app = new \Symfony\Component\Console\Application('Doc2Confluence', '0.1-dev');
$app->add(new \CodeMine\Commands\PhpDocCommand());
$app->run();