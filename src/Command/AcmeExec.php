<?php

namespace AloneWebMan\Acme\Command;

use AloneWebMan\Acme\Facade;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AcmeExec extends Command {
    protected static $defaultName        = 'alone:acme';
    protected static $defaultDescription = 'convert acme ssl <info>[name]</info>';

    protected function configure(): void {
        $this->addArgument('key', InputArgument::OPTIONAL, 'key'); //选择key
    }

    public function execute(InputInterface $input, OutputInterface $output): int {
        $key = $input->getArgument('key');
        static::execCommand($key);
        return self::SUCCESS;
    }

    public static function execCommand($key): void {
        $list = config('plugin.alone.acme.app.config', []);
        echo "--------------------------------------------------------\r\n";
        if (count($list) == 0) {
            echo "No config\r\n";
            echo "--------------------------------------------------------\r\n";
            return;
        }
        $show = "Opt key list:\r\n";
        foreach ($list as $k => $v) {
            $show .= "$k:{$v["path"]}\r\n";
        }
        $key = !empty($key) ? $key : (count($list) == 1 ? key($list) : $key);
        if (empty($key) || !isset($list[$key])) {
            echo $show;
        } else {
            $conf = $list[$key];
            $path = $conf['path'] ?? '';
            if (!empty($path) && is_dir($path)) {
                $save = rtrim(rtrim($conf['save'], '/'), '\\') . '/' . trim(trim($key, '/'), '\\');
                Facade::exec($path, $save);
                echo "$save\r\n";
            } else {
                echo "Directory error:{$path}\r\n";
            }
        }
        echo "--------------------------------------------------------\r\n";
    }
}