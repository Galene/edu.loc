<?php // no direct access
defined('_JEXEC') or die('Restricted access');

$baseurl=JURI::root().'modules/mod_jdialog/';
$line=$params->get('information_display_rows');

//if you need to change size of messagebox,customize here!
$msgboxwidth=$params->get('dialog_width');//need (yes button width + margin + no button width)
$msgboxheight=$params->get('dialog_height',"210");
$informations_height=$line*14+20;
$informations_text_height=$line*14;
$cols=ceil($msgboxwidth*0.8/16);

if ($params->get('informations')!="") {
    $msgboxheight=$msgboxheight+$informations_height;
}
?>

<script type="text/javascript">
    var cbdwall_bgcolor="<?php echo $params->get('wall_bgcolor');?>";
    var cbdwall_opacity="<?php echo $params->get('wall_opacity');?>";
    var cbdmsg_color="<?php echo $params->get('msg_color');?>";
    var cbdmsg_opacity="<?php echo $params->get('msg_opacity');?>";
    var cbdyesno_color="<?php echo $params->get('yesno_color');?>";
    var bdokact="<?php echo $params->get('okact');?>";
    var bdokurl="<?php echo $params->get('okurl');?>";
    var bdtriger="<?php echo $params->get('triger');?>";
    var cookiename="<?php echo $params->get('cookiename');?>";
    var limitdays="<?php echo $params->get('limitdays');?>";
    var bdnoauth="<?php if($user->id==0){ echo 'true';} else {echo 'false';} ?>";
    var bdwinw="<?php echo $msgboxwidth;?>";
    var bdwinh="<?php echo $msgboxheight;?>";
    var agreecheck="<?php echo $params->get('agreecheck');?>";
    var disagreewarn="<?php echo $params->get('disagreewarn');?>";
    <?php
    //edit layout to match your needs
    $layout='
    <div id="title">
    <div id="titletxt">%s</div>
    </div>
    <div id="msg">
    <div id="msg1">%s</div>

    </div>

    <div id="informations">
    %s
    </div>

    <div id="check">
    %s
    </div>

    <div id="btns">
    <div id="btnyes"><a id="a_yes" href="javascript:blogdialogok()">%s</a></div>
    <div id="btnno"><a id="a_no" href="%s">%s</a></div>
    </div>
    <div id="cpr">
    <div id="cprtxt">
    </div>
    </div>
    ';

    if($params->get('informations')!=""){
        $textarea='<textarea rows="'.$line.'" cols="'.$cols.'">'.$params->get('informations').'</textarea>';
        $textarea=str_replace("\n",'\n',$textarea);
    }
    else{
        $textarea="";
    }

    if($params->get('agreecheck')=="yes"){
        $check='<input type="checkbox" id="input_agreecheck" name="input_agreecheck" value="agree" />&nbsp;'.$params->get('checktext');
        $check=str_replace("\n",'\n',$check);
    }
    else{
        $check="";
    }

    $layout=str_replace("\n","",$layout);
    $msg=str_replace("\n","<br />",$params->get('msg1'));

    $layout=sprintf($layout,$params->get('title'),$msg,
    $textarea,$check,
    $params->get('yes'),$params->get('ngurl'),$params->get('no'));
    ?>

    var cmsgstr='<?php echo $layout;?>';
</script>

<?php if ($params->get('moduledisp')=="yes") { ?>
    <!--  module display part -->
    <a href="javascript:bdfncPopupStart()" title="popup"><img border="0" src="<?php echo $baseurl;?>img/btnpopup.jpg" /></a>
    <a href="javascript:bdfncDelCookie()" title="reset"><img border="0" src="<?php echo $baseurl;?>img/btnreset.jpg" /></a>
    <a target="_blank" href="http://joomla.bamboo-waves.com" title="joomla! web extension"><img border="0" src="<?php echo $baseurl;?>img/logobw.jpg" /></a>
<?php } ?>
