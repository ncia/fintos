<?php
// Simulate PHP's automatic decoding of POST data
$input = "%40"; // What PHP would receive if JS did encodeURIComponent("@") and it was NOT double encoded
echo "Test 1 (Single): " . (preg_match("/[^\.0-9a-z_@-]+/i", $input) ? "Fail" : "Pass") . " (Value: $input)\n";

$input2 = urldecode("%2540"); // What PHP would receive if JS did encodeURIComponent("@") AND jQuery double-encoded it
echo "Test 2 (Double): " . (preg_match("/[^\.0-9a-z_@-]+/i", $input2) ? "Fail" : "Pass") . " (Value: $input2)\n";
?>
