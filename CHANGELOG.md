# v1.1.10
### Bugfix
 - properly save the data only once

# v1.1.9
### Bugfix
 - use a global variable to know if the data was saved

# v1.1.8
### Bugfix
  - on `saveData` do not exit but add a flag to know that the data was saved

# v1.1.7
 - on `saveData` accept the data and exit;

# v1.1.6
 - on data save do not load the whole view. Just save the data.

# v1.1.5
 - do not load LabJS in CMS
 - properly save the data without duplication

# v1.1.4
### Bugfix
 - load first LabJs field before the experiment

# v1.1.3
### Bugfix
 - properly check if the LabJS is object

# v1.1.2 - Requires SelfHelp v7.0.0+
### New Features
 - make it compatible with the `user_input` refactoring
 - set `displayName` to the dataTable related to the LabJS survey

# v1.1.1
### Bugfix
 - fix the db version script

# v1.1.0
### New Features
 - add field `debug` to style `labJS`

### Bugfix
 - properly propagate `entry_record` to style `labJS`

# v1.0.3
### Bugfix
 - adjust the `css` to be as similar to the original

# v1.0.2
### Bugfix
 - add function `slugify`;

# v1.0.1
### Bugfix

- properly loads `csp` rules for`js`files when in CMS mode

# v1.0.0
### New Features

 - The LabJS related styles and components
 - Lab JS Style
