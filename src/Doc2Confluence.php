<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 10.02.16
 * Time: 10:16
 */

namespace CodeMine;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Doc2Confluence extends Command
{
    protected function configure()
    {
//        $this->setName('hello')->setDescription('Sey Hello');

        $this->setName('doSomething')->setDescription('do what you want');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('hello world');
//        parent::execute($input, $output);
    }
}