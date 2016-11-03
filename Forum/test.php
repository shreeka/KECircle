<?php
// define location of Parse PHP SDK, e.g. location in "Parse" folder
// Defaults to ./Parse/ folder. Add trailing slash
define( 'PARSE_SDK_DIR', 'F:/xampp/htdocs/android_connect/vendor/parse/php-sdk/src/Parse/' );
// include Parse SDK autoloader
require_once( 'vendor/autoload.php' );
// Add the "use" declarations where you'll be using the classes
use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
// Init parse: app_id, rest_key, master_key
ParseClient::initialize('flZa2ZYQqIUHB2bibP9RF9lE637yTIST7MHMA3Ur', 'DzWDlGqH6VLPQLLfAKiixIuAcE0qd0Wn8VCJjps1', 'Y5irzk8IkjNoSVjtiaKkq14YKmgYWDF0iqvqovRI');
// save something to class TestObject
$testObject = ParseObject::create("TestObject");
$testObject->set("foo", "bar");
$testObject->save();
// get the object ID
echo $testObject->getObjectId();
echo '<h1>Users</h1>';
// get the first 10 users from built-in User class
$query = new ParseQuery("_User");
$query->limit(10);
$results = $query->find();
foreach ( $results as $result ) {
  // echo user Usernames
  echo $result->get('username') . '<br/>';
}