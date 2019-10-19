<?php


// https://stackoverflow.com/questions/6167279/converting-a-simplexml-object-to-an-array
function xml2array ( $xmlObject, $out = array () )
{
    foreach ( (array) $xmlObject as $index => $node )
        $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;

    return $out;
}
