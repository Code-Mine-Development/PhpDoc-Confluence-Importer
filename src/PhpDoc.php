<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 10.02.16
 * Time: 12:37
 */

namespace CodeMine;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PhpDoc extends Command
{
    protected function configure()
    {
        $this->setName('phpdoc')
            ->setDescription('<info>Create documentation</info>')
            ->addArgument('dupa', NULL, 'dupa description',InputArgument::REQUIRED)
            >setDefinition(
            new InputDefinition(
                [
                    new InputOption('someOption', 's', NULL, 'Some option doing nothing'),
                    new InputOption('Option', 'o', NULL, 'Some option doing nothing'),
                    new InputOption('some', 'f', NULL, 'Some option doing nothing')
                ]
            )
        )
            ->setHelp('balalalalallalala alaalbalbalbal labalbl lb bla bla blablabla babab')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }
}
