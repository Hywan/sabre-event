<?php

namespace Sabre\Event;

use SplQueue;
use SplDoublyLinkedList;

/**
 * A simple implementation of an 'event loop'.
 *
 * The main thing this event loop does is ensuring that all deferred callbacks
 * are called.
 *
 * The event loop is global and a singleton. It exists once per process.
 *
 * What does the event loop do?
 *
 * It's primary purpose is to provide a central place for deferred functions to
 * be called. In a javascript world, this would be very similar to calling a
 * function with setTimeout on 0 seconds, or process.nextTick in node.
 *
 * @copyright Copyright (C) 2007-2014 fruux GmbH. All rights reserved.
 * @author Evert Pot (http://evertpot.com/)
 * @license http://sabre.io/license/ Modified BSD License
 */
final class Loop {

    protected static $instance;

    /**
     * Returns the event loop instance.
     *
     * @return Loop
     */
    static function get() {

        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;

    }

    /**
     * Schedules a method to be called upon the next iteration of the loop.
     *
     * @param callable $event
     * @return void
     */
    function nextTick(callable $event) {

        $this->queue->enqueue($event);

    }

    /**
     * Starts the event loop.
     *
     * Returns false if the loop is already running. A loop may run multiple
     * times in a given php script.
     *
     * @return void
     */
    function start() {

        if ($this->started) {
            return false;
        }
        $this->started = true;

        while(!$this->queue->isEmpty()) {

            $callback = $this->queue->dequeue();
            $callback();

        }
        $this->started = false;

        return true;

    }

    /**
     * Tracks whether the loop has started or not. This is to ensure that the
     * loop does not get started twice.
     *
     * @var bool
     */
    protected $started = false;

    /**
     * List of pending callbacks.
     *
     * @var SplQueue
     */
    protected $queue;

    /**
     * Creates the instance of the loop.
     */
    function __construct() {

        register_shutdown_function([$this, 'start']);
        $this->queue = new SplQueue();
        $this->queue->setIteratorMode(SplDoublyLinkedList::IT_MODE_DELETE);

    }

}
