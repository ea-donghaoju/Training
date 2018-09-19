<?php

class formHelper
{
    // input str
    function h($str)
    {
        return htmlspecialchars($str);
    }

    // input error array
    function displayError($errorMsgArray)
    {
        if (!empty($errorMsgArray) ) {
            echo '<div style="font-size: 16px;color: #f00">';
                    foreach ($errorMsgArray as $errorMsg) {
                        //错误的提示
                        echo $this->h($errorMsg) . '</br>';
                    }
            echo '</div>';
        }
    }
