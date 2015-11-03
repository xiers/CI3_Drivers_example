<?php
class Dtest extends CI_Driver_Library{
    public $valid_drivers;
    public $CI;
    /*
     * CI3.X驱动的配置问题
     * 两种办法：1. 使用CI的配置文件，并严格遵从格式；
     *  /app/config/driverName.php 文件中确定配置
     *  /app/config/dtest.php $config['modules'] = array('first','second'); 列出次级类的名城；
     * 2.在主级类即Driver.php的构造函数中使用$this->valid_drivers = array('first','second');
     * 注意不管是哪种配置，不需要再加Driver_前缀；推荐使用第一种。
     * print_r($this->dtst->valid_drivers); 可以调试打印所有已经注册的次级类。
     * 如果要在配置文件中加主级驱动名作为前缀，则需要将/system/libraries/Driver.php line110
     * in_array($child, $this->valid_drivers)  change to in_array($child_name, $this->valid_drivers) 但是这已经改动了Driver的原意。
     */
    public function __construct()
    {
        $this->CI = & get_instance();
        //$this->valid_drivers = array('first','second');
        $this->CI->config->load('dtest', TRUE);
        $this->valid_drivers = $this->CI->config->item('modules', 'dtest');
    }
    public function get_info()
    {
        echo "master driver";
    }

}
?>
