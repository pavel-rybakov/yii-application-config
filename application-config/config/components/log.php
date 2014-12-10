<?php

return array(
    'class'=>'CLogRouter',
    'routes'=>array(
        array(
            'class'=>'CProfileLogRoute',
            'levels'=>'info,error,warning,',
        ),
    ),
);