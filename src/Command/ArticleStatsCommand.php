<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ArticleStatsCommand extends Command
{
    protected static $defaultName = 'article:stats';

    protected function configure()
    {
        $this
            ->setDescription('Return some articles stats')
            ->addArgument('slug', InputArgument::REQUIRED, 'The article\'s slug')
            ->addOption('format', null, InputOption::VALUE_REQUIRED, 'Output stats in json', 'text')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $slug = $input->getArgument('slug');

        $data = [
            'slug' => $slug,
            'hearts' => rand(6, 100)
        ];

        switch ($input->getOption('format')) {
            case 'text':
                $io->listing($data);
                break;
            case 'json':
                $io->write(json_encode($data));
                break;
            default:
                throw new \Exception('What kind of crazy format is that?');
        }

        $io->success('find your stats above');
    }
}
