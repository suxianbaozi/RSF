<?php

$config['router']['Web_Index'] = array(
	'^$',
);



$config['router']['Resource'] = array(
	'^\/([a-z]+)\/resource\/([a-z]+)\/(.+)\.(css|js)$',
);