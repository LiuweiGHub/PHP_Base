<?php
/*¹³×Ó¶¨Òå
¹³×ÓÊÇ±à³ÌÀïÒ»¸ö³£¼û¸ÅÄî£¬·Ç³£µÄÖØÒª¡£ËüÊ¹µÃÏµÍ³±äµÃ·Ç³£ÈÝÒ×ÍØÕ¹£¬£¨¶ø²»ÓÃÀí½âÆäÄÚ²¿µÄÊµÏÖ»úÀí£¬ÕâÑù¿ÉÒÔ¼õÉÙºÜ¶à¹¤×÷Á¿£©¡£

¹³×Ó×÷ÓÃ
¹³×Óº¯Êý¿ÉÒÔ½Ø»ñ²¢´¦ÀíÆäËûÓ¦ÓÃ³ÌÐòµÄÏûÏ¢¡£Ã¿µ±ÌØ¶¨µÄÏûÏ¢·¢³ö£¬ÔÚÃ»ÓÐµ½´ïÄ¿µÄ´°¿ÚÇ°£¬¹³×Ó³ÌÐò¾ÍÏÈ²¶»ñ¸ÃÏûÏ¢£¬Òà¼´¹³×Óº¯ÊýÏÈµÃµ½¿ØÖÆÈ¨¡£ÕâÊ±¹³×Óº¯Êý¼´¿ÉÒÔ¼Ó¹¤´¦Àí£¨¸Ä±ä£©¸ÃÏûÏ¢£¬Ò²¿ÉÒÔ²»×÷´¦Àí¶ø¼ÌÐø´«µÝ¸ÃÏûÏ¢£¬»¹¿ÉÒÔÇ¿ÖÆ½áÊøÏûÏ¢µÄ´«µÝ¡£

¹³×ÓÊµÏÖ
¹³×ÓµÄÍêÕûÊµÏÖÓ¦¸Ã½ÐÊÂ¼þÇý¶¯¡£ÊÂ¼þÇý¶¯·ÖÎªÁ½¸ö½×¶Î£¬µÚÒ»¸ö½×¶ÎÊÇ×¢²áÊÂ¼þ£¬Ä¿µÄÊÇ¸øÎ´À´¿ÉÄÜ·¢ÉúµÄ¡°ÊÂ¼þ¡±ÆðÒ»¸öÃû×Ö£¬¼òµ¥µÄÊµÏÖ·½·¨ÊÇ
ÓÃµ¥ÀýÄ£Ê½²úÉúÒ»¸ö³Ö¾ÃµÄ¶ÔÏó»òÕß×¢²áÒ»¸öÈ«¾Ö±äÁ¿£¬È»ºó½«ÊÂ¼þÃû³Æ£¬ÒÔ¼°¸ÃÊÂ¼þ¶ÔÓ¦µÄÀàÓë·½·¨²åÈëÈ«¾Ö±äÁ¿¼´¿É¡£Ò²¾ÍÊÇ¹ÒÔØÒ»¸ö¹³×Ó¡£
µÚ¶þ¸ö½×¶ÎÊÇ´¥·¢ÊÂ¼þ£¬±¾ÖÊÉÏ¾ÍÊÇÔÚÊÂ¼þµÄÈ«¾Ö±äÁ¿ÖÐ²éÑ¯Òª´¥·¢µÄÊÂ¼þÃû³Æ£¬È»ºóÕÒµ½×¢²áºÃµÄÀàÓë·½·¨£¬ÊµÀý»¯²¢ÔËÐÐ¡£ÕâÑù×Ó¾Í¿ÉÒÔ°Ú
ÍÑ´«Í³·½Ê½ÖÐ³ÌÐò±ØÐë°´Ë³ÐòµÄ¹æÔò£¬½øÒ»²½ÊµÏÖ½â³ýñîºÏµÄÄ¿µÄ¡£*/


//´úÂëÊ¾ÀýÒ»
class ball {
   
    public function down() {
        echo "ball is downing"."\n";
        //×¢²áÊÂ¼þ
        Hook::add("man");
        Hook::add("woman");
    }

    public function execute() {
        Hook::exec(); 
    }

}

//¶¨Òå¹³×Ó
class Hook {
    private $hookList = null;

    public function add($people) {
        $this->hookList[] = new $people();
    }

    //´¥·¢ÊÂ¼þ
    public function exec() {
        foreach($this->hookList as $people) {
            $people->act();
        }
      }
}

//¹³×ÓµÄÊµÏÖ
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
////////Éý¼¶°æ¹³×Ó///////////////////////////////////
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
