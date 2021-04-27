<?php
/**
 * Created by PhpStorm
 * User: jamesho
 * Date: 2021/4/27
 */

/**
 *
 */

abstract class Observer
{
    abstract public function update();
}

abstract class Subject
{
    public $list = [];

    public function attach(Observer $observer)
    {
        $this->list[] = $observer;
    }

    public function detach(Observer $observer)
    {
        $key = array_search($observer, $this->list);

        if (false != $key) {
            unset($this->list[$key]);
        }
    }

    public function notify()
    {
        foreach ($this->list as $observer) {
            $observer->update();
        }
    }
}

class ConcreteSubject extends Subject
{
    private $state;

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }
}

class ConcreteObserver extends Observer
{
    /**
     * @var Subject
     */
    private $subject;
    private $name;

    public function __construct(ConcreteSubject $subject, $name)
    {
        $this->subject = $subject;
        $this->name = $name;
    }

    public function update()
    {
        var_dump("观察者{$this->name}的新状态是{$this->subject->getState()}");
    }
}

class ConcreteObserver1 extends Observer
{
    /**
     * @var Subject
     */
    private $subject;
    private $name;

    public function __construct(ConcreteSubject $subject, $name)
    {
        $this->subject = $subject;
        $this->name = $name;
    }

    public function update()
    {
        var_dump("新观察者{$this->name}的新状态是{$this->subject->getState()}");
    }
}

$subject = new ConcreteSubject();
$subject->attach(new ConcreteObserver($subject, 'a'));
$subject->attach($b =new ConcreteObserver1($subject, 'b'));
$subject->attach(new ConcreteObserver($subject, 'c'));

$subject->setState('abc');
$subject->notify();
$subject->detach($b);

$subject->setState('abc1111');
$subject->notify();