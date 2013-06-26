--TEST--
Test PHP bug #63207
--FILE--
<?php
$im = new Imagick();
$im->newImage(100, 100, 'none');

$privious_memory = null;
for ($i = 0; $i < 500; $i++) {
    $color = sprintf('#%06X', mt_rand(0, 0xffffff));
	if (is_null($privious_memory)) {
		$privious_memory = memory_get_usage();
	} elseif ($privious_memory < memory_get_usage()) {
		printf("previous memory: %d, current memory: %d\n", $privious_memory, memory_get_usage());
		break;
	}
    $im->borderImage($color, 2, 2); 
}
echo "END";
?>
--EXPECT--
END
