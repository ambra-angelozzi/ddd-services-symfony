<?php

namespace ApiBundle\GenericCommand;

use BestInvestmentsLtd\ProjectManagement\Event\CommandInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class Command extends GenericEvent implements CommandInterface {

    public function getName(): string
    {
        return $this->subject;
    }

    public function getPayload(): array
    {
        return $this->arguments;
    }
}