<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<div class="mb-3">
    <table id="labs-js" class="table table-sm table-hover">
        <thead>
            <tr>
                <th scope="col">Lab ID</th>
                <th scope="col">Generated Lab ID</th>
                <th scope="col">Lab Name</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
            </tr>
        </thead>
        <tbody>
            <?php $this->output_labs_rows(); ?>
        </tbody>
    </table>
</div>
