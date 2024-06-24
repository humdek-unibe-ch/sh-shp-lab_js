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
     * @param object $services
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
    public function __construct($services, $id, $params, $id_page, $entry_record)
    {
        parent::__construct($services, $id, $params, $id_page, $entry_record);
        $this->once_per_schedule = $this->get_db_field('once_per_schedule', 0);
        $this->once_per_user = $this->get_db_field('once_per_user', 0);
        $this->start_time = $this->get_db_field('start_time', '00:00');
        $this->end_time = $this->get_db_field('end_time', '00:00');
    }

    /* Private Methods ********************************************************/

    /* Private Methods *********************************************************/

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
     * Prepare the data for processing.
     *
     * This function prepares the provided data for further processing. It checks each key in the data array
     * and formats it accordingly. If the key is one of 'labjs_response_id', 'trigger_type', or 'labjs_generated_id',
     * it keeps the original value. If the value is an array, it converts it to JSON format and prefixes the key
     * with 'extra_data_'. If the value is not an array, it keeps the original value and prefixes the key with 'extra_data_'.
     * Additionally, it stores the original data in a key '_raw_data' in JSON format under the assumption that the original data
     * contains a key named 'data'.
     *
     * @param object $data The data to prepare.
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
     * @return object | false
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
        $lab['name'] = 'lab-js';
        $data_config = $this->get_db_field('data_config');
        $lab['content'] = $lab['config'];
        $lab['section_name'] = $this->section_name;
        $lab['content'] = $this->calc_dynamic_values($lab, $data_config, $user_name, $user_code);
        $lab['config'] = $lab['content'];
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
                   return $this->user_input->save_data(transactionBy_by_user, $data['labjs_generated_id'], $data);
                } else {
                    return $this->user_input->save_data(transactionBy_by_user, $data['labjs_generated_id'], $data, array(
                        "labjs_response_id" => $data['labjs_response_id']
                    ));
                }
            }
        }
        return false;
    }

}
?>
