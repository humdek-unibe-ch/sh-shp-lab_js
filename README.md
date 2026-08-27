# SelfHelp plugin - lab-js

This is a SelfHelpPlugin that is used for [LabJS](https://lab.js.org) integration


# Installation

 - Download the code into the `plugin` folder
 - Checkout the latest version 
 - Execute all `.sql` script in the DB folder in their version order

# Save data to SelfHelp
 - use function `saveDataToSelfHelp` with parameters
  - `trigger_type` - string with values `started`, `updated` or `finished`
  - `extra_data` - object, each key of the object is saved in the data, if the value of the key is another object, it is converted to `JSON` string
 - example:
 ```
if (typeof saveDataToSelfHelp === 'function') {
  // Call the function
  saveDataToSelfHelp('updated')
}
 ```

# Style fields

 - `redirect_at_end` - where to send the participant once the experiment saves with
   status `finished`. Accepts a page keyword (`my-page`) or a template containing
   `{{name}}` placeholders (`my-page/{{extra_param_code}}`). Placeholders are filled
   from the data being saved; a missing value resolves to an empty string.
 - `url_params` - when enabled, the URL parameters of the requested page are handed to
   the experiment and each is saved with its data as `extra_param_<name>`. Both route
   parameters and the query string are read; a query parameter wins on a name clash.
 - `update_based_on` - names the column that identifies a response row. Empty (the
   default) keys rows on the generated `labjs_response_id`, one row per run. Set to a
   column name and the experiment updates the row already holding that value, so
   several components sharing a `labjs_generated_id` build one row together. A key
   matching no row falls back to the default rather than inserting.
 - `warning_on_reload` - when enabled, the browser asks the participant to confirm
   before a reload or a close interrupts the experiment, since a refresh restarts it
   from the beginning. The wording is the browser's own and cannot be set, and the
   prompt only appears once the page has been interacted with. The warning is dropped
   as soon as the experiment saves as `finished`, so `redirect_at_end` still navigates
   without prompting. Off by default.


# Requirements

 - SelfHelp v6.12.1+
