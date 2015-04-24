<?php

$output = shell_exec("git fetch --all; git reset --hard origin/master;");

?>

<pre>
<?=$output?>
</pre>