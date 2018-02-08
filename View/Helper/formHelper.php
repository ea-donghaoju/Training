<?php

class formHelper
{
    function displayError($errorMsg)
    {
        if (!empty($errorMsg)) {
            foreach ($errorMsg as $msg) {
                //错误的提示
                echo htmlspecialchars($msg) . '</br>';
            }
        }
    }
}