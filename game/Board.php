<?php

namespace Game;

class Board
{
    private ?int $width;
    private ?int $height;
    private array $board;
    private Snake $snake;
    private array|null|string $food;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->board = [];
        $this->snake = Snake::main();
        $this->food = null;
        $this->initBoard();
    }

    private function initBoard(): void
    {
        // Initialize the game board
        for ($y = 0; $y < $this->height; $y++) {
            $row = str_repeat(' ', $this->width);
            $this->board[] = $row;
        }

        // Place the initial food on the board
        do {
            $foodX = rand(0, $this->width - 1);
            $foodY = rand(0, $this->height - 1);
        } while ($this->board[$foodY][$foodX] !== ' ');
        $this->food = [$foodX, $foodY];
        $this->board[$foodY][$foodX] = '*';

        // Place the initial snake on the board
        $this->snake->initSnake();
    }

    public function displayBoard(): void
    {
        // Display the game board
        foreach ($this->board as $row) {
            echo $row . PHP_EOL;
        }
    }

    public function moveSnake($direction): bool
    {
        // Move the snake based on the given direction
        if (!$this->snake->move($direction, $this->width, $this->height, $this->board)) {
            // Game over
            return false;
        }

        // Check if the snake has eaten the food
        if ($this->snake->hasEaten($this->food)) {
            $this->placeFood();
        }

        // Check for collisions with the board edges or the snake's own body
        if ($this->snake->hasCollided($this->width, $this->height, $this->board)) {
            // Game over
            return false;
        }

        return true;
    }
    /**
     * Places the food on a random empty space on the board
     */
    private function placeFood(): void
    {
        // Place the food on a random empty space on the board
        do {
            $foodX = rand(0, $this->width - 1);
            $foodY = rand(0, $this->height - 1);
        }
        // Keep trying until an empty space is found
        while ($this->board[$foodY][$foodX] !== ' ');
        // Place the food on the board
        $this->food = [$foodX, $foodY];
        $this->board[$foodY][$foodX] = '*';
    }
}
