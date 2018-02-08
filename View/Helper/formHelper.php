<?php

class formHelper
{
    function displayError($errorMsg)
    {
        if (!empty($errorMsg)) {

            echo '<div style="font-size: 16px;color: #f00">';

            foreach ($errorMsg as $msg) {
                //错误的提示
                echo $this->h($msg) . '</br>';
            }

            echo '</div>';
        }
    }

    function h($str)
    {
        return htmlspecialchars($str);
    }
}