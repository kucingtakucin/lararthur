<?php
function validation_feedback($field, $message)
{
    $field = ucwords($field);
    return "
        <div class=\"invalid-feedback text-danger\">$field $message</div>
        <div class=\"valid-feedback text-success\">Looks good</div>
    ";
}

function validation_tooltip($field, $message)
{
    $field = ucwords($field);
    return "
        <div class=\"invalid-tooltip\">$field $message</div>
        <div class=\"valid-tooltip\">Looks good</div>
    ";
}
