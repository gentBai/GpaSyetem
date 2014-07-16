<?php
return array(
//url规则
'URL_ROUTE_RULES' => array(
    'login'     =>      './Index/login',
    'logout'    =>      './Index/logout',
    'record/:c_id'    =>      './updateClass/record',
    'signup/:c_id'    =>      './updateClass/signup',
    'edit/:c_id'    =>      './updateClass/edit',
    'doSignup'    =>      './updateClass/doSignup',
    'doEdit'    =>      './updateClass/doEdit',
    'judgeEdit/:c_id'    =>      './Index/judgeEdit',
    'editResult'    =>      './Index/editResult',
),
);