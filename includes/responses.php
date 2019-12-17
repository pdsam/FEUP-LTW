<?php 

function prepareResponse() {
    return array(
        'result' => 'error',
        'type' => '0',
        'message' => ''
    );
}

function reply($response) {
    echo json_encode($response);
    die;
}

?>