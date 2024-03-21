<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<?php
require_once __DIR__ . "/../../../../../../component/style/StyleModel.php";

/**
 * This class is used to prepare all data related to the form style
 * components such that the data can easily be displayed in the view of the
 * component.
 */
class LabJSModel extends StyleModel
{
    /* Private Properties *****************************************************/

    /**
     * If checked the lab can be done once per schedule
     */
    private $once_per_schedule;

    /**
     * If checked the lab can be done only once by an user. The checkbox `once_per_schedule` is ignore if this is checked
     */
    private $once_per_user;

    /**
     * Start time when the lab should be available
     */
    private $start_time;

    /**
     * End time when the lab should be not available anymore
     */
    private $end_time;

    /**
     * Start time converted to date
     */
    private $start_time_calced;

    /**
     * End time converted to date and adjusted if smaller than start time
     */
    private $end_time_calced;

    /* Constructors ***********************************************************/

    /**
     * The constructor fetches all session related fields from the database.
     *
     * @param array $services
     *  An associative array holding the different available services. See the
     *  class definition base page for a list of all services.
     * @param int $id
     *  The section id of the navigation wrapper.
     * @param array $params
     *  The list of get parameters to propagate.
     * @param number $id_page
     *  The id of the parent page
     * @param array $entry_record
     *  An array that contains the entry record information.
     */
    public function __construct($services, $id, $params)
    {
        parent::__construct($services, $id, $params);
        $this->once_per_schedule = $this->get_db_field('once_per_schedule', 0);
        $this->once_per_user = $this->get_db_field('once_per_user', 0);
        $this->start_time = $this->get_db_field('start_time', '00:00');
        $this->end_time = $this->get_db_field('end_time', '00:00');
        $this->calc_times();
    }

    /* Private Methods ********************************************************/

    /* Private Methods *********************************************************/

    private function calc_times()
    {
        $d = new DateTime();
        $now = $d->setTimestamp(strtotime("now"));
        $at_start_time = explode(':', $this->start_time);
        $at_end_time = explode(':', $this->end_time);
        $start_time = $now->setTime($at_start_time[0], $at_start_time[1]);
        $start_time = date('Y-m-d H:i:s', $start_time->getTimestamp());
        $end_time = $now->setTime($at_end_time[0], $at_end_time[1]);
        $end_time = date('Y-m-d H:i:s', $end_time->getTimestamp());
        if (strtotime($start_time) > strtotime($end_time)) {
            // move end time to next day
            $end_time = date('Y-m-d H:i:s', strtotime($end_time . ' +1 day'));
        }
        $this->start_time_calced = $start_time;
        $this->end_time_calced = $end_time;
    }

    /**
     * Get the lab
     * @return object
     * Return the row for the lab
     */
    private function get_raw_lab()
    {
        $sid = $this->get_db_field('lab-js', '');
        return $this->db->query_db_first("SELECT * FROM labjs WHERE id = :id", array(':id' => $sid));
    }

    /**
     * Check if the lab is already done by the user
     * @return boolean
     * true if it is already done, false if not
     */
    private function is_lab_done_by_user()
    {
        $form_name = $this->get_raw_lab()['lab_generated_id'];
        $form_id = $this->user_input->get_form_id($form_name, FORM_EXTERNAL);
        $filter = ' AND trigger_type = "' . actionTriggerTypes_finished . '"'; // the lab should be completed
        $res = $this->user_input->get_data($form_id, $filter, true, FORM_EXTERNAL, $_SESSION['id_user'], true);
        return $res;
    }

    /**
     * Check if the lab is already done by the user for the selected period
     * @return boolean
     * true if it is already done, false if not
     */
    private function is_lab_done_by_user_for_schedule()
    {
        $form_name = $this->get_raw_lab()['lab_generated_id'];
        $form_id = $this->user_input->get_form_id($form_name, FORM_EXTERNAL);
        $filter = ' AND trigger_type = "' . actionTriggerTypes_finished . '"'; // the lab should be completed
        $filter = $filter  . ' AND (entry_date BETWEEN "' . $this->start_time_calced . '" AND "' . $this->end_time_calced . '")'; // the lab should be completed between the time
        $res = $this->user_input->get_data($form_id, $filter, true, FORM_EXTERNAL, $_SESSION['id_user'], true);
        return $res;
    }

    /**
     * Prepare the data for processing.
     *
     * This function prepares the provided data for further processing. It checks each key in the data array
     * and formats it accordingly. If the key is one of 'labjs_response_id', 'trigger_type', or 'labjs_generated_id',
     * it keeps the original value. If the value is an array, it converts it to JSON format and prefixes the key
     * with 'extra_data_'. If the value is not an array, it keeps the original value and prefixes the key with 'extra_data_'.
     * Additionally, it stores the original data in a key '_raw_data' in JSON format under the assumption that the original data
     * contains a key named 'data'.
     *
     * @param array $data The data to prepare.
     * @return array The prepared data.
     */
    private function prepare_data($data)
    {
        $prepared_data = array();
        foreach ($data['metadata'] as $key => $value) {
            if (in_array($key, ['labjs_response_id', 'trigger_type', 'labjs_generated_id'])) {
                $prepared_data[$key] = $value;
            } else {
                if (is_array($value)) {
                    $prepared_data['extra_data_' . $key] = json_encode($value);
                } else {
                    $prepared_data['extra_data_' . $key] = $value;
                }
            }
        }
        $prepared_data['_raw_data'] = json_encode($data['data'] ?? array());
        return $prepared_data;
    }

    /* Public Methods *********************************************************/

    /**
     * Get the lab and apply all dynamic variables
     * @return object
     * Return the info for the lab
     */
    public function get_lab()
    {
        $lab = $this->get_raw_lab();
        if (!$lab) {
            return false;
        }
        $user_name = $this->db->fetch_user_name();
        $user_code = $this->db->get_user_code();
        $lab['content'] = isset($lab['published']) ? $lab['published'] : '';
        $lab['name'] = 'lab-js';
        $data_config = $this->get_db_field('data_config');
        $lab['content'] = $this->calc_dynamic_values($lab, $data_config, $user_name, $user_code);
        return $lab;
    }

    /**
     * Save lab js data as external table
     * @param object $data
     * Object with the data that should be saved
     */
    public function save_lab($data)
    {
        $data = $this->prepare_data($data);
        $lab = $this->get_raw_lab();
        if (isset($lab['labjs_generated_id']) && isset($data['labjs_generated_id']) && $data['labjs_generated_id'] == $lab['labjs_generated_id']) {
            if (isset($data['trigger_type'])) {
                if ($data['trigger_type'] == actionTriggerTypes_started) {
                    $this->user_input->save_external_data(transactionBy_by_user, $data['labjs_generated_id'], $data);
                } else {
                    $this->user_input->save_external_data(transactionBy_by_user, $data['labjs_generated_id'], $data, array(
                        "response_id" => $data['response_id']
                    ));
                }
            }
        }
        return false;
    }

    /**
     * Check if the lab is active
     * @retval boolean
     * true if it is active, false if it is not active
     */
    public function is_lab_active()
    {
        if ($this->start_time == $this->end_time) {
            // lab is always active
            return true;
        } else {
            if (strtotime($this->start_time_calced) <= strtotime("now") && strtotime("now") <= strtotime($this->end_time_calced)) {
                // the lab is active
                return true;
            } else {
                // lab is not active right now
                return false;
            }
        }
    }

    /**
     * Check if the lab is done; if once_per_schedule is not enabled it will return always false
     * @return boolean
     * true if it is active, false if it is not active
     */
    public function is_lab_done()
    {
        if ($this->once_per_user) {
            // the lab can be filled only once per user
            return $this->is_lab_done_by_user();
        } else if ($this->once_per_schedule) {
            // the lab can be filled once per schedule
            return $this->is_lab_done_by_user_for_schedule();
        } else {
            // lab can be filled as many times per schedule
            return false;
        }
    }

    /**
     * Saves uploaded files to the server.
     *
     * This function takes care of saving uploaded files to the server while organizing them
     * into appropriate directories based on lab, response, user code, and question name.
     *
     * @return mixed If all files are successfully saved, it returns an empty array. If there are any errors,
     *               it returns an associative array where keys are file names and values are the paths
     *               where the files were supposed to be saved but couldn't due to errors. If there are no errors
     *               and no files to be saved, it returns `null`.
     */
    public function save_uploaded_files()
    {
        $lab = $this->get_raw_lab();
        $lab_id = $lab['lab_generated_id'];
        $user_code = isset($_SESSION['user_code']) ? $_SESSION['user_code'] : 'no_code';
        $return_files = array();

        foreach ($_FILES as $index => $file) {
            $question_name = $_POST['question_name'];
            $response_id = $_POST['response_id'];
            $rel_path = SURVEYJS_UPLOAD_FOLDER . '/' . $lab_id . '/' . $response_id . '/' . $user_code . '/' . $question_name;
            $new_directory = __DIR__ . '/../../../../' . $rel_path;
            $new_file_name = '[' . $lab_id . '][' . $response_id . '][' . $user_code . '][' . $question_name . ']' . $file['name'];
            $new_file_name_full_path = $new_directory . '/' . $new_file_name;
            $new_file_name_full_path = str_replace(array("\r", "\n"), '', $new_file_name_full_path);
            $new_directory = str_replace(array("\r", "\n"), '', $new_directory);
            $rel_path = str_replace(array("\r", "\n"), '', $rel_path);
            $new_file_name = str_replace(array("\r", "\n"), '', $new_file_name);


            // Create the directory if it doesn't exist
            if (!is_dir($new_directory)) {
                if (!mkdir($new_directory, 0755, true)) {
                    // Handle the error (e.g., log or display an error message)
                    return false;
                }
            }

            if (!move_uploaded_file($file['tmp_name'], $new_file_name_full_path)) {
                return false;
            } else {
                $return_files[$file['name']] = '?file_path=' . $rel_path . '/' . $new_file_name;
            }
        }
        return $return_files;
    }
}
?>
