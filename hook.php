<?php
/*钩子定义
钩子是编程里一个常见概念，非常的重要。它使得系统变得非常容易拓展，（而不用理解其内部的实现机理，这样可以减少很多工作量）。

钩子作用
钩子函数可以截获并处理其他应用程序的消息。每当特定的消息发出，在没有到达目的窗口前，钩子程序就先捕获该消息，亦即钩子函数先得到控制权。这时钩子函数即可以加工处理（改变）该消息，也可以不作处理而继续传递该消息，还可以强制结束消息的传递。

钩子实现
钩子的完整实现应该叫事件驱动。事件驱动分为两个阶段，第一个阶段是注册事件，目的是给未来可能发生的“事件”起一个名字，简单的实现方法是
用单例模式产生一个持久的对象或者注册一个全局变量，然后将事件名称，以及该事件对应的类与方法插入全局变量即可。也就是挂载一个钩子。
第二个阶段是触发事件，本质上就是在事件的全局变量中查询要触发的事件名称，然后找到注册好的类与方法，实例化并运行。这样子就可以摆
脱传统方式中程序必须按顺序的规则，进一步实现解除耦合的目的。*/
//示例代码
class ball {
   
    public function down() {
        echo "ball is downing"."\n";
        //注册事件
        Hook::add("man");
        Hook::add("woman");
    }

    public function execute() {
        Hook::exec(); 
    }

}

//定义钩子
class Hook {
    private $hookList = null;

    public function add($people) {
        $this->hookList[] = new $people();
    }

    //触发事件
    public function exec() {
        foreach($this->hookList as $people) {
            $people->act();
        }
      }
}

//钩子实现
class man {
    public function act() {
        echo 'i am man'."\n";
    }
}

class woman {
    public function act() {
        echo 'i am woman'."\n";
    }
}

$ball = new Ball();
$ball->down();
$ball->execute();
//////////////////////////////////////////////////////
////////升级版钩子///////////////////////////////////
class HookPlus {
    private $hookList;

    function add($name, $func) {
        $this->hookList[$name][] = $func;
    }

    function exec($name) {
        $value = func_get_args();
        unset($value[0]);
        foreach($this->hookList[$name] as $key => $fun) {
            call_user_func_array($fun, $value);
        }
    }
}

$hook = new HookPlus();
$hook->add('women', function($msg) { echo 'oh my god'.$msg."\n" ; });
$hook->add('men', function($msg) { echo 'oh my god'.$msg."\n" ; } );
$hook->exec('women', 'xxx');
$hook->exec('men', 'xxx');
