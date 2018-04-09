<?php

function unset_quest()
{
    unset(
        $_SESSION['test_to_run'],
        $_SESSION['wrong_a'],
        $_SESSION['correct_a'],
        $_SESSION['questions'],
        $_SESSION['result'],
        $_SESSION['last_answer'],
        $_SESSION['hints'],
        $_SESSION['has_hints'],
        $_SESSION['last_answer_q']
    );
}

function validate_captcha($key_to_verify)
{
    $data = ['secret' => SECRET, 'response' => $key_to_verify];
    $curl = curl_init('https://www.google.com/recaptcha/api/siteverify');
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
