<?php
/**
 * Created by PhpStorm
 * User: jamesho
 * Date: 2021/4/28
 */


/**
 * Interface Strategy
 *
 * 策略模式
 * 定义一系列模式相同的家族算法封装起来，之间可以相互替换
 *
 * 优点：单元测试简单化，每个算法都有自己类。
 *
 */
interface Strategy {
    public function algorithm();
}

class StrategyOne implements Strategy {

    public function algorithm()
    {
        echo 'algorithm one echo' . PHP_EOL;
    }
}

class StrategyTwo implements Strategy {

    public function algorithm()
    {
        echo 'algorithm two echo' . PHP_EOL;
    }
}

class StrategyThree implements Strategy {

    public function algorithm()
    {
        echo 'algorithm three echo' . PHP_EOL;
    }
}

/**
 * Class Context
 *
 * 简单的依赖注入
 */
class Context {
    /**
     * @var Strategy
     */
    private $strategy;

    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function algorithm()
    {
        $this->strategy->algorithm();
    }
}

$cxt = new Context(new StrategyOne());
$cxt->algorithm();

/**
 * Class ContextFactory
 *
 * 结合工厂模式，后续可加入反射的模式
 */
class ContextFactory {
    /**
     * @var Strategy
     */
    private $strategy;

    public function __construct($type)
    {
        switch ($type) {
            case 'one':
                $this->strategy = new StrategyOne();
                break;
            case 'two':
                $this->strategy = new StrategyTwo();
                break;
            default:
                $this->strategy = new StrategyThree();
                break;
        }
    }

    public function algorithm() {
        $this->strategy->algorithm();
    }
}

$ctx = new ContextFactory('three');
$ctx->algorithm();