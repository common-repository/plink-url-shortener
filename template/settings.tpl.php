<br />
    <a target="_blank" href="http://plink.ir" title="<?php echo __('Plink' , 'plink') ?>">plink.ir</a> |     <a target="_blank" href="http://plink.ir/advertise" title="<?php echo __('Advertise with us' , 'plink') ?>"><?php echo __('Advertise' , 'plink') ?></a>  | <a target="_blank" href="http://plink.ir/developer" title="<?php echo __('Developer API' , 'plink') ?>"><?php echo __('Developer API &amp; Extensions' , 'plink') ?></a> | <a target="_blank" href="http://plink.ir/abuse" title="<?php echo __('Report a link' , 'plink') ?>"><?php echo __('Report a link' , 'plink') ?></a>  
<br />
<br />
<br />
<h2><?php _e('Usage & Shortcodes','plink') ?>:</h2>
<li>
<p>
<?php _e('To display the Short link of current page use the following shortcode on post, page or sidebar widget','plink')?>:
</p>
<p>
<strong>[plink-url]</strong>
</p>
</li>
<li>
<p>
<?php _e('To quickly shorten any External URL within post use the following short code','plink')?>:
</p>
<p><?php _e('Example: Using','plink') ?> <a target="_blank" href="https://www.google.com/webhp?hl=en&tab=ww#hl=en&q=plink.ir" ><font color="blue">https://www.google.com/webhp?hl=en&tab=ww#hl=en&q=plink.ir</font></a> <?php _e('as extrnal link, then use following code','plink') ?></p>
</li>
<p><pre>[plink-url u="<font color="blue">https://www.google.com/webhp?hl=en&tab=ww#hl=en&q=plink.ir</font>"]</p></pre>

<form method="post" id="plink_shorturl_settings" style="margin-top:2em;margin-left:1em;">

<table class="form-table">


		<tr valign="top">
        <th scope="row"><?php echo __('Enter Api key' , 'plink') ?></th>
        <td><input type="text" name="new_Api_key" value="<?php echo get_option('new_Api_key');?>" /> <a href="http://plink.ir/user/register" target="_blank"><?php echo __('Get API Key?' , 'plink') ?></a></td>
        </tr>
        
  <tr valign="top">
    <th scope="row">
        <label for="Display" style="font-weight:bold;"><?php echo __('Display Short URL' , 'plink') ?></label>
    </th>
  </tr>
  <tr>
    <td>
        <input type="radio" name="Display" value="Y" <?php echo $opt['Display'] == 'Y' ? 'checked="checked"' : '' ?> /> <?php echo __('Yes' , 'plink') ?>
        <input type="radio" name="Display" value="N" <?php echo $opt['Display'] == 'N' ? 'checked="checked"' : '' ?> /> <?php echo __('No' , 'plink') ?>
    </td>
  <tr>

  <tr valign="top">
    <th scope="row">
        <label for="TwitterLink" style="font-weight:bold;"><?php echo __('Display Social Icons' , 'plink') ?></label>
    </th>
  </tr>
  <tr>
    <td>
        <input type="radio" name="TwitterLink" value="Y" <?php echo $opt['TwitterLink'] == 'Y' ? 'checked="checked"' : '' ?> /> <?php echo __('Yes' , 'plink') ?>
        <input type="radio" name="TwitterLink" value="N" <?php echo $opt['TwitterLink'] == 'N' ? 'checked="checked"' : '' ?> /> <?php echo __('No' , 'plink') ?>
    </td>
  <tr>
  
  <tr valign="top">
    <th scope="row">
        <label for="Domain" style="font-weight:bold;"><?php echo __('Domain' , 'plink') ?></label>
    </th>
  </tr>
  <tr>
    <td>
        <select name="Domain">
        <option value="eeb.me" <?php echo $opt['Domain'] == 'plink.ir' ? 'selected' : ''  ?>>plink.ir</option>
        </select>
    </td>
  <tr>
  
  


  <tr valign="top">
    <th scope="row">
        <input type="submit" class="button-primary" name="save" value="<?php echo __('Save' , 'plink') ?>" />
    </th>
    <td>

    </td>
  <tr>


</table>


</form>
<br />
    <a target="_blank" href="http://plink.ir" title="<?php echo __('Plink' , 'plink') ?>">plink.ir</a> |     <a target="_blank" href="http://plink.ir/advertise" title="<?php echo __('Advertise with us' , 'plink') ?>"><?php echo __('Advertise' , 'plink') ?></a>  | <a target="_blank" href="http://plink.ir/developer" title="<?php echo __('Developer API' , 'plink') ?>"><?php echo __('Developer API &amp; Extensions' , 'plink') ?></a> | <a target="_blank" href="http://plink.ir/abuse" title="<?php echo __('Report a link' , 'plink') ?>"><?php echo __('Report a link' , 'plink') ?></a>  