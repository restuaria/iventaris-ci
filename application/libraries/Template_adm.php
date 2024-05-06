<?php

class Template_adm
{

    var $template_data_adm = array();

    function set($name, $value)
    {
        $this->template_data_adm[$name] = $value;
    }

    function load($template_adm = '', $view = '', $view_data = array(), $return = FALSE)
    {
        $this->CI = &get_instance();
        $this->set('tem_adm', $this->CI->load->view($view, $view_data, TRUE));
        return $this->CI->load->view($template_adm, $this->template_data_adm, $return);
    }
}
