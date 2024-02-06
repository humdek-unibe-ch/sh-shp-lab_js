<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<?php
require_once __DIR__ . "/../../../../../../component/style/StyleView.php";

/**
 * The view class of the formUserInput style component.
 */
class LabJSView extends StyleView
{
    /* Private Properties *****************************************************/

    /**
     * The lab id
     */
    private $sid;

    /**
     * The lab info
     */
    private $lab;

    /**
     * Markdown text that is shown if the lab is done and it can be filled only once per schedule.
     */
    private $label_lab_done;

    /**
     * Markdown text that is shown if the lab is not active right now.
     */
    private $label_lab_not_active;

    /**
     * If true the lab is restarted on refresh
     */
    private $restart_on_refresh;

    /**
     * If it is set it redirects to this link after the lab is completed
     */
    private $redirect_at_end;

    /**
     * If set and the value is higher than 0, it will auto save the lab on interval based on the entered value.
     */
    private $auto_save_interval;

    /**
     * Selected lab theme
     */
    private $lab_js_theme;

    /**
     * If true the lab can be saved as a PDF
     */
    private $save_pdf;

    /**
     * If enabled, parameters can be passed via the url. Example: `?code=test&par1=2&par2=2`
     */
    private $url_params;

    /**
     * When a non-zero value is set for this field, it serves as a `Lab Timeout` or `Lab Expiry Time`
     */
    private $timeout;

    /* Constructors ***********************************************************/

    /**
     * The constructor.
     *
     * @param object $model
     *  The model instance of a base style component.
     * @param object $controller
     *  The controller instance of the component.
     */
    public function __construct($model, $controller)
    {
        parent::__construct($model, $controller);
        $this->sid = $this->model->get_db_field('lab-js', '');
        if ($this->sid > 0) {
            $this->lab = $this->model->get_lab();
        }
        $this->label_lab_done = $this->model->get_db_field('label_lab_done', '');
        $this->label_lab_not_active = $this->model->get_db_field('label_lab_not_active', '');
        $this->restart_on_refresh = $this->model->get_db_field('restart_on_refresh', '');
        $this->redirect_at_end = $this->model->get_db_field('redirect_at_end', '');
        $this->auto_save_interval = $this->model->get_db_field('auto_save_interval', 0);
        $this->timeout = $this->model->get_db_field('timeout', 0);
        $this->url_params = $this->model->get_db_field('url_params', '');
        $this->save_pdf = $this->model->get_db_field('save_pdf');
        $this->lab_js_theme = $this->model->get_db_field('lab-js-theme');
    }


    /* Public Methods *********************************************************/

    /**
     * Render the style view.
     */
    public function output_content()
    {
        require __DIR__ . "/tpl_labJS.php";
        return true;
        if ($this->model->is_lab_active()) {
            if ($this->model->is_lab_done()) {
                if ($this->label_lab_done != '') {
                    $alert = new BaseStyleComponent("alert", array(
                        "type" => "danger",
                        "is_dismissable" => false,
                        "children" => array(new BaseStyleComponent("markdown", array(
                            "text_md" => $this->label_lab_done,
                        )))
                    ));
                    $alert->output_content();
                }
            } else {
                $redirect_at_end = preg_replace('/^\/+/', '', $this->redirect_at_end); // remove the first /
                $redirect_at_end = preg_replace('/^#+/', '', $this->redirect_at_end); // remove the first #
                $redirect_at_end = $this->model->get_link_url(str_replace("/", "", $redirect_at_end));
                $lab_fields = array(
                    "restart_on_refresh" => boolval($this->restart_on_refresh),
                    "redirect_at_end" => $redirect_at_end,
                    "auto_save_interval" => $this->auto_save_interval,
                    "timeout" => $this->timeout,
                    "lab_js_theme" => $this->lab_js_theme,
                    "save_pdf" => $this->save_pdf,
                    "lab_generated_id" => isset($this->lab['lab_generated_id']) ? $this->lab['lab_generated_id'] : null
                );
                if ($this->url_params) {
                    $url_components = parse_url($this->model->get_services()->get_router()->get_url('#self')); // get the requested url
                    $extra_labjs_params = isset($url_components['query']) ? $url_components['query'] : ''; // check if the url contains url parameters (the same format as Qualtrics)
                    $extra_params_arr = array();
                    parse_str($extra_labjs_params, $extra_params_arr);
                    $lab_fields['extra_params'] = $extra_params_arr;
                }
                $lab_fields = json_encode($lab_fields);
                require __DIR__ . "/tpl_labJS.php";
            }
        } else {
            if ($this->label_lab_not_active != '') {
                $alert = new BaseStyleComponent("alert", array(
                    "type" => "danger",
                    "is_dismissable" => false,
                    "children" => array(new BaseStyleComponent("markdown", array(
                        "text_md" => $this->label_lab_not_active,
                    )))
                ));
                $alert->output_content();
            }
        }
    }

    public function output_content_mobile()
    {
        $style = parent::output_content_mobile();
        $redirect_at_end = preg_replace('/^\/+/', '', $this->redirect_at_end); // remove the first /
        $redirect_at_end = preg_replace('/^#+/', '', $this->redirect_at_end); // remove the first #
        $redirect_at_end = $this->model->get_link_url(str_replace("/", "", $redirect_at_end));
        $style['redirect_at_end']['content'] = str_replace(BASE_PATH, "", $redirect_at_end);
        $style['lab_json'] = $this->lab['content'] ? json_decode($this->lab['content']) : [];
        $style['alert'] = '';
        $style['show_lab'] = true;
        $style['lab_generated_id'] = $this->lab['lab_generated_id'];
        if ($this->model->is_lab_active()) {
            if ($this->model->is_lab_done()) {
                $style['alert'] = $this->label_lab_done;
                $style['show_lab'] = false;
            }
        } else {
            $style['alert'] = $this->label_lab_not_active;
            $style['show_lab'] = false;
        }
        return $style;
    }

    /**
     * Get js include files required for this component. This overrides the
     * parent implementation.
     *
     * @return array
     *  An array of js include files the component requires.
     */
    public function get_js_includes($local = array())
    {
        if (empty($local)) {
            $local = array(
                __DIR__ . "/js/1_lodash.min.js",
                // __DIR__ . "/js/1_serializejs.min.js",
                __DIR__ . "/js/1_lab.js",
                // __DIR__ . "/js/lab.dev.js",
                // __DIR__ . "/js/2_lab.fallback.js",
                __DIR__ . "/js/3_labJS.js"
            );
        }
        return parent::get_js_includes($local);
    }

    /**
     * Get css include files required for this component. This overrides the
     * parent implementation.
     *
     * @return array
     *  An array of css include files the component requires.
     */
    public function get_css_includes($local = array())
    {
        if (empty($local)) {
            if (DEBUG) {
                $local = array(
                    __DIR__ . "/css/lab.css"
                );
            } else {
                $local = array(__DIR__ . "/../../../../../lab-js/css/ext/lab-js.min.css?v=" . rtrim(shell_exec("git describe --tags")));
            }
        }
        return parent::get_css_includes($local);
    }
}
?>
