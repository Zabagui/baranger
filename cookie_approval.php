<?php
  global $text;
?>
<div class="cookie-banner" style="display: none">
  <?php echo $text['cookieuse']; ?>
  <p>
    <a href="<?php echo getURL( "data_protection_policy", 0 ); ?>"><?php echo $text['viewpolicy']; ?></a>
  </p>
  <button class="cookie-close"><?php echo $text['understand']; ?></button>
</div>

<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function() {
  if (localStorage.getItem('cookieSeen') != 'shown') {
    $('.cookie-banner').show();
  };
  $('.cookie-close').click(function() {
    localStorage.setItem('cookieSeen','shown')
    $('.cookie-banner').hide();
  })
});
//]]>
</script>
