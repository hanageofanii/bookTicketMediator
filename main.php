<?php

// Mediator interface
interface Mediator {
    public function bookTicket($film, $theater);
}

// Concrete Mediator class
class TicketBookingMediator implements Mediator {
    private $theaters = [];

    public function addTheater($theater) {
        $this->theaters[] = $theater;
    }

    public function bookTicket($film, $theater) {
        foreach ($this->theaters as $t) {
            if ($t->getName() === $theater) {
                $t->sendRequest($film);
            }
        }
    }
}

// Colleague interface
interface Colleague {
    public function sendRequest($film);
}

// Concrete Colleague class
class Theater implements Colleague {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function sendRequest($film) {
        echo "Request received at {$this->name} for film: $film\n";
    }
}

// Usage
$mediator = new TicketBookingMediator();

$theater1 = new Theater("Cinema 1");
$theater2 = new Theater("Cinema 2");

$mediator->addTheater($theater1);
$mediator->addTheater($theater2);

$mediator->bookTicket("Avengers", "Cinema 1");
$mediator->bookTicket("Spiderman", "Cinema 2");

?>
