<head><meta http-equiv='Content-Type' content='text/html; charset=windows-1251'></head>
<body>
<h3>Результаты запуска:</h3>
<hr/>

<form action='testRunner.php' method='post'>
<table width='100%' style='font-family:tahoma,arial;font-size:14px'>

<?php
foreach($this->results as $result)
{
    $suiteName = $result['suiteName'];
    $result    = $result['result'];
    
    $color = null;
    
    if(($result->failureCount() === 0)
                && ($result->errorCount() === 0))
    {
        $color = 'rgb(100,255,100)';
    }
    else 
    {
        $color = 'rgb(255,100,100)';
    }?>

    <tr style='background:rgb(238,246,255);'>
    
        <td width='50%'>
            <div style='margin-top:10px; margin-bottom:10px;'>
                <input id='<?php echo $suiteName;?>' type='checkbox' name='suite_<?php echo $suiteName;?>' checked value='<?php echo $suiteName;?>'></input>
                <label for='<?php echo $suiteName;?>'><?php echo $suiteName;?></label>
            </div>
        </td>
 
        <td width='50%' style='background: <?php echo $color ?>;'>
            Tests: <b><?php echo $result->count() ?></b>
            Failures: <b><?php echo $result->failureCount() ?></b>
            Errors: <b><?php echo $result->errorCount() ?></b>
            Time: <b><?php echo $result->time() ?></b>
        </td>
    </tr>            

    <?php
    if($result->errorCount() != 0)
    {
        foreach($result->errors() as $error)
        {
            $failedTest = $error->failedTest();
            $exception  = $error->thrownException();?>
            
            <tr>
                <td>
                </td>
                <td style='background:rgb(255,200,200);'>
                    <b>Test name: </b> <?php echo $failedTest->getName() ?> <br />
                    <b>Message: </b><?php echo $exception->getMessage();?> <br />
                    <b>File: </b><?php echo "{$exception->getFile()}:{$exception->getLine()}";?> <br />
                    <b>Stack trace: </b><br /><?php echo str_replace('#', '<br/>', trim($exception->getTraceAsString(), '#'));?>
                </td>
            </tr>
        <?php
        }?>
        
    <?php
    }?>
        
    <?php
    if($result->failureCount() != 0)
    {
        foreach($result->failures() as $failure)
        {
            $failedTest = $failure->failedTest();
            $exception = $failure->thrownException();
            
            if($exception instanceof PHPUnit_Framework_ExpectationFailedException)
            {
                $exceptionMessage = $exception->getDescription();
            }           
            elseif($exception instanceof PHPUnit_Framework_AssertionFailedError)
            {
                $exceptionMessage = $exception->toString();
            }?>
            
            <tr>
                <td>
                </td>
                
                <td style='background:rgb(255,230,230);'>
                    <b>Test name:</b><?php echo $failedTest->getName() ?><br />
                    <b>Message:</b><?php echo $exceptionMessage ?><br />
                    <b>Stack trace: </b><br /><?php echo str_replace('#', '<br/>', trim($exception->getTraceAsString(), '#'));?>
                </td>
            </tr>
        <?php
        }?>
        
    <?php
    }?>
        
<?php
}?>

</table>
        
<hr/>

<input type='submit' value='Запустить еще раз'></input>
<input type='hidden' name='action' value='run'></input>

</form>
        
<hr/>

<a href='testRunner.php'>Назад к списку наборов</a>
</body>
        