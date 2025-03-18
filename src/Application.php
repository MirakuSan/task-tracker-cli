<?php

namespace App;

class Application
{
    public function run(): void
    {
        $command = $this->getCommand();
        $arguments = $this->getArguments();

        // TODO: Implement command routing
        echo "Command: " . $command . PHP_EOL;
        echo "Arguments: " . implode(', ', $arguments) . PHP_EOL;
    }

    private function getCommand(): string
    {
        return $_SERVER['argv'][1] ?? 'list';
    }

    private function getArguments(): array
    {
        return array_slice($_SERVER['argv'], 2);
    }
} 
