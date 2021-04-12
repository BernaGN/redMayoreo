<?php

function active($path) {
    return request()->is($path)  ? 'active' : '';
}

function open($path) {
    return request()->is($path)  ? 'menu-open' : '';
}
