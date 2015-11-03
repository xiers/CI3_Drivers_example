# CI3_Drivers_example

http://www.codeigniter.com/user_guide/general/creating_drivers.html
http://codeigniter.org.cn/user_guide/general/creating_libraries.html

CI的手册中关于创建驱动器的部分甚是简短，中文版还在文章末尾提供了三个案例链接网站
但是，链接里的例子只适合CI2.x，类似于https://github.com/oliverhr/CI2_Drivers_example/

已经不适合CI3.X ，其主要原因是 CI/system/libraries/Driver.php里，
CI_Driver_Library里的public function load_driver的改动。

驱动器类是一种特殊的类库，并不是继承关系。更像是 master-sub 主次级类。

驱动器类的目录结构必须是如下，并严格注意大小写。
/application/libraries/Driver_name
		Driver_name.php
		drivers/
			Driver_name_subclass_1.php
			Driver_name_subclass_2.php
			Driver_name_subclass_3.php

CI3于CI2使用驱动器类的差异在于配置。


CI3.X驱动的配置有两种办法：
1. 使用CI的配置文件，并严格遵从格式；
	/application/config/driverName.php 文件中确定配置
如 /application/config/dtest.php $config['modules'] = array('first','second'); 数组列出次级类的名称；
在Driver_name.php的构造函数中获取配置，如
	$this->CI = & get_instance();
        $this->CI->config->load('dtst', TRUE);
        $this->valid_drivers = $this->CI->config->item('modules', 'dtest');

2.在主级类即Driver_name.php的构造函数中使用$this->valid_drivers = array('sub_class_name');
如：$this->valid_drivers = array('first'，'second');

注意:
不管是使用哪种配置方式，不需要再加Driver_前缀；
推荐使用第一种。
另可以在控制器中使用print_r($this->dtest->valid_drivers)调试打印所有已经注册的次级类。

如果要在配置文件中加主级驱动名作为前缀，
则需要将/system/libraries/Driver.php 中CI_Driver_Library里的public function load_driver
 in_array($child, $this->valid_drivers)  change to in_array($child_name, $this->valid_drivers) 但是这已经改动了Driver的原意，不推荐。

