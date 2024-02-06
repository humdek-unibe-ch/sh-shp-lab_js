<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<div class="selfHelp-lab-js-holder <?php echo $this->css; ?>" data-lab-js='<?php echo isset($this->lab['content']) ?  htmlspecialchars($this->lab['content'], ENT_QUOTES, 'UTF-8') : ""; ?>' data-lab-js-fields='<?php echo isset($lab_fields) ? $lab_fields : "" ?>'>
    <div class="selfHelp-lab-js" data-labjs-section="main">
        <main class="content-vertical-center content-horizontal-center">
            <div>
                <h2>Loading Experiment</h2>
                <p>The experiment is loading and should start in a few seconds</p>
            </div>
        </main>
    </div>
</div>