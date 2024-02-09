<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<?php
require_once __DIR__ . "/../../../../../component/BaseModel.php";
/**
 * This class is used to prepare all data related to the cmsPreference component such
 * that the data can easily be displayed in the view of the component.
 */
class ModuleLabJSModel extends BaseModel
{

    /* Constructors ***********************************************************/

    /**
     * The constructor.
     *
     * @param array $services
     *  An associative array holding the differnt available services. See the
     *  class definition BasePage for a list of all services.
     */
    public function __construct($services)
    {
        parent::__construct($services);
    }

    /**
     * Insert a new LabJS.     
     * @return int
     *  The id of the new lab or false if the process failed.
     */
    public function insert_new_lab()
    {
        try {
            $this->db->begin_transaction();
            $labjs_gen_id = "LJS_" . substr(uniqid(), -15);
            $lid = $this->db->insert(LABJS_TABLE_LABJS, array(
                "labjs_generated_id" => $labjs_gen_id,
                "name" => $labjs_gen_id
            ));
            $this->transaction->add_transaction(
                transactionTypes_insert,
                transactionBy_by_user,
                $_SESSION['id_user'],
                LABJS_TABLE_LABJS,
                $lid
            );
            $this->db->commit();
            return $lid;
        } catch (Exception $e) {
            $this->db->rollback();
            return false;
        }
    }

    /**
     * Update a LabJS.   
     * @param int $lid
     * Lab id,
     * @param object $labJson
     * Lab json data
     * @return int
     *  The id of the new lab or false if the process failed.
     */
    public function update_labjs($lid, $labJson)
    {
        try {
            $this->db->begin_transaction();
            $this->db->update_by_ids(LABJS_TABLE_LABJS, array("config" => $labJson, "name" => $_POST['name']), array('id' => $lid));
            $this->transaction->add_transaction(
                transactionTypes_update,
                transactionBy_by_user,
                $_SESSION['id_user'],
                LABJS_TABLE_LABJS,
                $lid
            );
            $this->db->commit();
            return $lid;
        } catch (Exception $e) {
            $this->db->rollback();
            return false;
        }
    }

    /**
     * Get lab
     * @param int $lid
     * lab id
     * @param return object
     * Return the lab row
     */
    public function get_labjs($lid)
    {
        $sql = "SELECT *
                FROM labjs
                WHERE id = :id";
        return $this->db->query_db_first($sql, array(':id' => $lid));
    }

    /**
     * Get all labs
     * @return array
     * Return all labs as rows
     */
    public function get_labs()
    {
        return $this->db->select_table("labjs");
    }

    /**
     * Delete lab
     * @param int $lid
     * The lab id
     * @return bool
     * Return the success result of the operation
     */
    public function delete_lab($lid)
    {
        return $this->db->remove_by_ids("labjs", array("id" => $lid));
    }

    /**
     * Publish lab
     * @param int $lid
     * The lab id
     * @return bool
     * Return the success result of the operation
     */
    public function publish_lab($lid)
    {
        $sql = 'UPDATE labs
                SET published = config, published_at = NOW()
                WHERE id =:sid;';
        $res = $this->db->execute_update_db($sql, array(":sid" => $lid));
        if ($res) {
            // add new version of the lab
            $lab = $this->get_labjs($lid);

            $res = $res &&  $this->db->insert(SURVEYJS_TABLE_SURVEYS_VERSIONS, array(
                "id_users" => $_SESSION['id_user'],
                "id_labs" => $lid,
                "config" => $lab['published'],
                "published" => 1
            ));
        }
        return $res;
    }
}
