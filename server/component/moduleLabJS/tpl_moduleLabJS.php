<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-auto">
            <?php $this->output_side_buttons(); ?>            
        </div>
        <div class="col">    
            <?php $this->output_alert(); ?>        
            <div class="jumbotron">
                <h1>Labjs</h1>
                <p>This page shows all created labs. If you click on a labjs you can select it.
                </p>                 
            </div>
            <?php $this->output_page_content(); ?>   
        </div>
    </div>
</div>
