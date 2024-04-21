<?php

namespace Game;

class Snake
{
    private array $body;
    private string $direction;
    private int $score;

    public int $lenght = 3;
    public array $position;

    public function __construct()
    {
        $this->body = [[10, 10], [10, 11], [10, 12]];
        $this->direction = 'right';
        $this->score = 0;
        $this->position = [10, 10];
        $this->lenght = $this->getLenght();
    }

    public static function main(): Snake
    {
        return new self;
    }

    public function initSnake(): void
    {
        // Place the initial snake on the board
        foreach ($this->body as $segment) {
            list($x, $y) = $segment;
            $this->body[] = [$x, $y];
        }
    }
    public function getLenght(): int
    {
        return count($this->body);
    }

    /*
    public function getNewHead($direction): array
    {
        // Get the new head position based on the current direction
        switch ($direction) {
            case 'up':
                $newHead = [$this->body[0][0], $this->body[0][1] - 1];
                break;
            case 'down':
                $newHead = [$this->body[0][0], $this->body[0][1] + 1];
                break;
            case 'left':
                $newHead = [$this->body[0][0] - 1, $this->body[0][1]];
                break;
            case 'right':
                $newHead = [$this->body[0][0] + 1, $this->body[0][1]];
                break;
        }

        return $newHead;
    }
    */

    public function getPosition(): array
    {
        return $this->body[0];
    }

    public function move($direction, $width, $height, &$board): bool
    {
        // Move the snake in the given direction
        $newHead = $this->getNewHead($direction);

        // Check if the new head is out of bounds or collides with the snake's body
        if ($this->hasCollided($width, $height, $board)) {
            return false;
        }

        // Move the snake's body
        array_shift($this->body);
        $this->body[] = $newHead;

        // Update the snake'

        $this->direction = $direction;

        return true;
    }

    public function hasEaten($food): bool
    {
        // Check if the snake has eaten the food
        $head = $this->body[0];
        list($foodX, $foodY) = $food;

        return $head[0] === $foodX && $head[1] === $foodY;
    }

    public function hasCollided($width, $height, &$board): bool
    {
        // Check for collisions with the board edges or the snake's own body
        $head = $this->body[0];
        $x = $head[0];
        $y = $head[1];

        // Check if the snake has hit the board edges
        if ($x < 0 || $x >= $width || $y < 0 || $y >= $height) {
            return true;
        }

        // Check if the snake has hit its own body
        if ($board[$y][$x] === '#') {
            return true;
        }

        return false;
    }

    private function getNewHead($direction): array
    {
        // Get the new head position based on the given direction
        $head = $this->body[0];
        $x = $head[0];
        $y = $head[1];

        switch ($direction) {
            case 'up':
                $x--;
                break;
            case 'down':
                $x++;
                break;
            case 'left':
                $y--;
                break;
            case 'right':
                $y++;
                break;
        }

        return [$x, $y];
    }
}
