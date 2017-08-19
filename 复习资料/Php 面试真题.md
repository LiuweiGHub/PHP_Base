# Php 面试真题

###1、echo()、print()、print_r()的区别？

- echo是php语句，语句没有返回值，print、pringt_r是函数名，具有返回值


- echo()是语法结构，输出一个或多个字符串
- print()只能打印简单数据类型的值（int、string）
- pring_r()可以打印复合数据类型（数组、对象）

###2、如何实现字符串反转？

```Php
$str = '1223456';
echo(strrev($str));
```

### 3、实现中文字符串截取无乱码？

```Php
//mbstring库 全称是Multi-Byte String 即各种语言都有自己的编码，他们的字节数是不一样的，目前PHP内部的编码只支持ISO-8859-*, EUC-JP, UTF-8
//其他的编码的语言是没办法在php程序上正确显示的。
//解决的方法就是通过php的mbstring函数库来解决
function getSubstr($str,$start,$len){
    if(mb_strlen($string,'utf-8')>$len){
        $str = mb_substr($string,$start,'urf-8');
      	return $str.'...';
    }else{
        return $string;
    }
}
```



### 4、用PHP写出显示客户端IP和服务端IP

- $_SERVER['REMOTE_ADDR']
- $_SERVER['SERVER_ADDR']

## 5、对于大流量的网站，可以采用哪些方法解决访问量的问题？

- 确认服务器硬件是否能够支持当前的流量
- 数据库读写分离
- 优化数据表
- 禁止外部盗链
- 控制大文件的下载
- 使用不同的主机分流主要流量

## 6、冒泡排序

```Php
function bubbleSort($arr){
    $count = count($arr);
  for($i=0;$i<$count;$i++){
      for($j=0;$j<$count-$i-1;$j++){
          if($j>$j+1){
              $tmp = $j+1;
              $j+1 = $j;
              $j = $tmp;
          }
      }
  }
}

$arr = [2,3,4,1,6,5];
bubbleSort($arr);
```



## rem、应用缓存、socket

- rem是移动端的一种适配方案，它是基于根元素的font-size的计算方式

- 怎么去做页面上的适配？

  > 检测屏幕的区间，然后设置html的fontsize，【html的font-size的默认大小是16px】，改变当前页面盒子的大小，font-size就跟着改变

rem适配方案可以同时实现宽度与高度的适配，而百分比适配方案只能实现宽度适配。

## 应用缓存

本地存储：session