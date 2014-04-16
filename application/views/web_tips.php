
<?php
if($isOk){
?>
<script type="text/javascript">
alert('Success!');
top.location = "<?=$next_url?>";
</script>
<?php
}else{
    ?>
<script type="text/javascript">
alert('Failed!');
top.location = "<?=$next_url?>";
</script>

<?php

}
?>