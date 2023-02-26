<script type="text/javascript" src="<?php echo $cms['tngpath']; ?>js/selectutils.js"></script>
<script type="text/javascript" src="<?php echo $cms['tngpath']; ?>js/datevalidation.js"></script>
<script type="text/javascript">
var tnglitbox;
var preferEuro = <?php echo ($tngconfig['preferEuro'] ? $tngconfig['preferEuro'] : "false"); ?>;
var preferDateFormat = '<?php (isset($preferDateFormat) ? $preferDateFormat : ""); ?>';
var tree = "<?php echo (isset($tree) ? $tree : ""); ?>";
var entereventtype = "<?php echo $admtext['entereventtype']; ?>";
var entereventinfo = "<?php echo $admtext['entereventinfo']; ?>";
var confdeleteevent = "<?php echo $admtext['confdeleteevent']; ?>";

var enternote = "<?php echo $admtext['enternote']; ?>";
var confdeletenote = "<?php echo $admtext['confdeletenote']; ?>";

var selectsource = "<?php echo $admtext['selectsource']; ?>";
var confdeletecite = "<?php echo $admtext['confdeletecite']; ?>";

var enterpassoc = "<?php echo $admtext['enterpassoc']; ?>";
var enterrela = "<?php echo $admtext['enterrela']; ?>";
var confdeleteassoc = "<?php echo $admtext['confdeleteassoc']; ?>";

var editmsg = "<?php echo $admtext['edit']; ?>";
var delmsg = "<?php echo $admtext['text_delete']; ?>";
var notemsg = "<?php echo $admtext['notes']; ?>";
var citemsg = "<?php echo $admtext['sources']; ?>";
</script>