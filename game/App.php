<?php

namespace Game;

class App
{
    private $board;

    public function __construct($width, $height)
    {
        $this->board = new Board($width, $height);
    }

    public function displayBoard()
    {
        $this->board->displayBoard();
    }

    public function playGame()
    {
        $this->displayBoard();

        while (true) {
            // Get the user's input
            $input = trim(fgets(STDIN));

            // Move the snake based on the user's input
            if (!$this->board->moveSnake($input)) {
                // Game over
                echo "Game over!" . PHP_EOL;
                break;
            }

            // Display the updated game board
            $this->displayBoard();

            // Sleep for a short time to simulate game speed
            usleep(100000);
        }
    }
}