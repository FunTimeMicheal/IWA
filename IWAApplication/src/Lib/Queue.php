<?php
namespace IWA\Application\Lib;

class Queue {
    private $queue = [];
    private $head = 0;

    public function __construct() {
        $this->queue = array_fill(0, 30, NULL);
    }

    public function enqueue($item) {
        $this->queue[$head] = $item;
        $head = ($head + 1) % 30;
    }

    public function AVG() {
        return array_sum($queue) / count($queue);
    }
}

// // Voorbeeld van gebruik
// $queue = new Queue();
// $queue->enqueue(10, 0, 1);
// $queue->enqueue(20, 1, 1);
// $queue->enqueue(30, 2, 1);

// // Bereken het gemiddelde voor station 1
// $avg = $queue->AVG($queue->queue, 1);
// echo "Gemiddelde waarde voor station 1: " . $avg;
?>
