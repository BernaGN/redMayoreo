<?php

function active($path) {
    return request()->is($path)  ? 'active' : '';
}

function open($path) {
    return request()->is($path)  ? 'menu-open' : '';
}

function selectedIcon($path, $color = 'primary') {
    return request()->is($path) ? 'text-'.$color.' fas' : 'far';
}
