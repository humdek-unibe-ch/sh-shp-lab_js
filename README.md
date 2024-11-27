# SelfHelp plugin - lab-js

This is a SelfHelpPlugin that is used for [LabJS](https://lab.js.org) integration


# Installation

 - Download the code into the `plugin` folder
 - Checkout the latest version 
 - Execute all `.sql` script in the DB folder in their version order

# Save data to SelfHelp
 - use function `saveDataToSelfHelp` with parameters
  - `triggerType` - string with values `started`, `updated` or `finished`
  - `extra_data` - object, each key of the object is saved in the data, if the value of the key is another object, it is converted to `JSON` string
 - example:
 ```
if (typeof saveDataToSelfHelp === 'function') {
  // Call the function
  saveDataToSelfHelp('updated')
}
 ```

# Useful LabJS code snippets
 - prevent `reload` - add the code in the beginning to initialize an event  listener for reloading
```
window.addEventListener('beforeunload', function(event) {
    event.preventDefault(); // Prevents the default window unload behavior (page reload)
    // Your beforeunload handling code here
});
```  

# Requirements

 - SelfHelp v6.12.1+
