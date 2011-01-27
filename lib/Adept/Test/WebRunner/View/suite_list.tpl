<head><meta http-equiv='Content-Type' content='text/html; charset=windows-1251'></head>

<body>
        
<h3>Доступные наборы тестов:</h3>
<hr/>
        
<form action='testRunner.php' method='post'>
        
<table width='100%' style='font-family:tahoma,arial;font-size:14px'>

<?php
foreach($this->suites as $suite)
{?>
    <tr style='background:rgb(238,246,255)'>
        <td width='50%'>
            <div style='margin-top:10px; margin-bottom:10px;'>
                <input id='<?php echo $suite->getName();?>' type='checkbox' name='suite_<?php echo $suite->getName();?>' checked value='<?php echo $suite->getName();?>'></input>
                <label for='<?php echo $suite->getName();?>'><?php echo $suite->getName();?></label>
            </div>
        </td>
    
        <td>
            Tests: <b><?php echo $suite->count() ?></b>
        </td>
    </tr>
    
<?php
}?>

</table>

<input type='submit' value='Запустить'></input>
<input type='hidden' name='action' value='run'></input>
</form>

</body>
