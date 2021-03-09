<?php

function head($text, $num = 3)
{
    echo '<h' . $num . '>' . $text . '</h' . $num . '>';
}

function arr($arr)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

function hr() { echo '<br><hr><br>'; }