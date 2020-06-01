<?php


namespace Framework\Command;

/**
 * Запрашивает комманды
 *
 * Class Invoker
 * @package Framework\Command
 */
class Invoker
{
    private $commands;


    /**
     * Собираем очередь комманд
     *
     * @param Command $command
     */
    function setCommand(Command $command) {
        $commands[] = $command;
    }

    /**
     * Выполняем комманды
     */
    function executeAll() {

        foreach ($this->commands as $command) {
            $command->execute();
        }
    }

    /**
     * Выполнить немедленно
     * @param Command $command
     */
    function executeNowAndReturn(Command $command) {
        return $command->execute();
    }
}