<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<?php
require_once __DIR__ . "/../../../../component/BaseHooks.php";
require_once __DIR__ . "/../../../../component/style/BaseStyleComponent.php";

/**
 * The class to define the hooks for the plugin.
 */
class LabJSHooks extends BaseHooks
{
    /* Constructors ***********************************************************/

    /**
     * The constructor creates an instance of the hooks.
     * @param object $services
     *  The service handler instance which holds all services
     * @param object $params
     *  Various params
     */
    public function __construct($services, $params = array())
    {
        parent::__construct($services, $params);
    }

    /* Private Methods *********************************************************/

    /**
     * Output select LabJS field
     * @param string $value
     * Value of the field
     * @param string $name
     * The name of the fields
     * @param int $disabled 0 or 1
     * If the field is in edit mode or view mode (disabled)
     * @return object
     * Return instance of BaseStyleComponent -> select style
     */
    private function outputSelectLabJSField($value, $name, $disabled)
    {
        return new BaseStyleComponent("select", array(
            "value" => $value,
            "name" => $name,
            "max" => 10,
            "live_search" => 1,
            "is_required" => 1,
            "disabled" => $disabled,
            "items" => $this->db->fetch_table_as_select_values('labjs', 'id', array('labjs_generated_id', 'name'))
        ));
    }

    /**
     * Return a BaseStyleComponent object
     * @param object $args
     * Params passed to the method
     * @param int $disabled 0 or 1
     * If the field is in edit mode or view mode (disabled)
     * @return object
     * Return a BaseStyleComponent object
     */
    private function returnSelectLabJSField($args, $disabled)
    {
        $field = $this->get_param_by_name($args, 'field');
        $res = $this->execute_private_method($args);
        if ($field['name'] == 'lab-js') {
            $field_name_prefix = "fields[" . $field['name'] . "][" . $field['id_language'] . "]" . "[" . $field['id_gender'] . "]";
            $selectField = $this->outputSelectLabJSField($field['content'], $field_name_prefix . "[content]", $disabled);
            if ($selectField && $res) {
                $children = $res->get_view()->get_children();
                $children[] = $selectField;
                $res->get_view()->set_children($children);
            }
        }
        return $res;
    }

    /**
     * Check if the page contains a lab js
     * @param string $page_keyword
     * The keyword of the page
     * @return boolean
     * Return true if the page contains lab js or false
     */
    private function page_has_lab_js($page_keyword, $id_page = null)
    {
        if ($id_page == null) {
            $id_page = $this->db->fetch_page_id_by_keyword($page_keyword);
        }
        $sql = "CALL get_all_sections_in_page(:id_page)";
        $res = $this->db->query_db($sql, array(":id_page" => $id_page));
        if (!$res) {
            return false;
        } else {
            foreach ($res as $key => $value) {
                if (isset($value['style_name'])) {
                    if ($value['style_name'] == LABJS_STYLE) {
                        // the page has labJS
                        return true;
                    }
                } else {
                    return false;
                }
            }
        }
        return false;
    }

    /* Public Methods *********************************************************/

    /**
     * Return a BaseStyleComponent object
     * @param object $args
     * Params passed to the method
     * @return object
     * Return a BaseStyleComponent object
     */
    public function outputFieldLabJSEdit($args)
    {
        return $this->returnSelectLabJSField($args, 0);
    }

    /**
     * Return a BaseStyleComponent object
     * @param object $args
     * Params passed to the method
     * @return object
     * Return a BaseStyleComponent object
     */
    public function outputFieldLabJSView($args)
    {
        return $this->returnSelectLabJSField($args, 1);
    }

    /**
     * Set csp rules for LabJS     
     * @return string
     * Return csp_rules
     */
    public function setCspRules($args)
    {
        $res = $this->execute_private_method($args);
        $resArr = explode(';', strval($res));
        foreach ($resArr as $key => $value) {
            if (strpos($value, 'script-src') !== false) {
                if ($this->router->route && in_array($this->router->route['name'], array(PAGE_LAB_JS_MODE))) {
                    // enable only for 2 pages
                    $value = str_replace("'unsafe-inline'", "'unsafe-inline' 'unsafe-eval'", $value);
                } else if ($this->router->route && $this->page_has_lab_js($this->router->route['name'])) {
                    $value = str_replace("'unsafe-inline'", "'unsafe-inline' 'unsafe-eval'", $value);
                } else if (
                    $this->router->route && in_array($this->router->route['name'], array("cmsSelect", "cmsUpdate")) &&
                    isset($this->router->route['params']['pid'])
                ) {
                    $value = str_replace("'unsafe-inline'", "'unsafe-inline' 'unsafe-eval'", $value);
                }
                $resArr[$key] = $value;
            } else if (strpos($value, 'font-src') !== false) {
                $value = str_replace("'self'", "'self' https://fonts.gstatic.com", $value);
                $resArr[$key] = $value;
            }
        }
        return implode(";", $resArr);
    }

    /**
     * Set csp rules for LabJS     
     * @return string
     * Return csp_rules
     */
    public function get_sensible_pages($args)
    {
        $res = $this->execute_private_method($args);
        $res[] = PAGE_LAB_JS_MODE;
        return $res;
    }

    /**
     * Get the plugin version
     */
    public function get_plugin_db_version($plugin_name = 'lab-js')
    {
        return parent::get_plugin_db_version($plugin_name);
    }


    public function add_transaction($args)
    {   
        if(isset($args['verbal_log']) && isset($args['verbal_log']['form_data']) && isset($args['verbal_log']['form_data']['form_fields'])&& isset($args['verbal_log']['form_data']['form_fields']['_raw_data']))
        {
            unset($args['verbal_log']['form_data']['form_fields']['_raw_data']);
        }      
        return $this->execute_private_method($args);
    }
}
?>
