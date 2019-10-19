<?php


// https://stackoverflow.com/questions/6167279/converting-a-simplexml-object-to-an-array
function xml2array ( $xmlObject, $out = array () )
{
    foreach ( (array) $xmlObject as $index => $node )
        $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;

    return $out;
}

function wrapperAndSlashes($text, $wrapperSymbol='"')
{
    return $wrapperSymbol . addslashes($text) . $wrapperSymbol;
}

function KeyValueToString(array $pairKeyValue, string $glue='=') 
{
    $out = [];

    array_walk(
        $pairKeyValue,
        function ($item, $key) use ($glue, &$out) {
            return $out[] = $key . ' '. $glue . ' ' . $item;
        }
    );
    return $out;
}

function arrayUtf8Encoder(array $items) 
{
    return array_map(
        function ($item) {
            return utf8_encode($item);
        },
        $items
    );
}

function arrayUtf8Decoder(array $items)
{
    return array_map(
        function ($item) {
            return utf8_decode($item);
        },
        $items
    );
}
