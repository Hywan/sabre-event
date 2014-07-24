ChangeLog
=========

3.0.0-alpha1 (????-??-??)
-------------------------

* Added: flow(), which uses generators to turn Promise-based code into regular
  code again.
* Added: Loop object, to create the illusion of an event-loop in PHP.
* Changed: Promise callbacks are now _always_ called asynchronously, even if
  they are already resolved.


2.0.0 (2014-06-21)
------------------

* Added: When calling emit, it's now possible to specify a callback that will be
  triggered after each method handled. This is dubbed the 'continueCallback' and
  can be used to implement strategy patterns.
* Added: Promise object!
* Changed: EventEmitter::listeners now returns just the callbacks for an event,
  and no longer returns the list by reference. The list is now automatically
  sorted by priority.
* Update: Speed improvements.
* Updated: It's now possible to remove all listeners for every event.
* Changed: Now uses psr-4 autoloading.


1.0.1 (2014-06-12)
------------------

* hhvm compatible!
* Fixed: Issue #4. Compatiblitiy for PHP < 5.4.14.


1.0.0 (2013-07-19)
------------------

* Added: removeListener, removeAllListeners
* Added: once, to only listen to an event emitting once.
* Added README.md.


0.0.1-alpha (2013-06-29)
------------------------

* First version!
