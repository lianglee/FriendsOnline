<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$user       = ossn_loggedin_user();
$time 		= time();
$intervals  = 10;
$users = $user->getFriends($user->guid, array(
				'wheres'     => "(u.last_activity > {$time} - {$intervals})",
));

echo "<div class='text-center'>";	 
if($users){
	foreach($users as $user) {
		//ossn 6.6 bug
		if($user->guid == ossn_loggedin_user()->guid){
				continue;	
		}
	?>
	 <a class="" href="<?php echo ossn_site_url() . 'u/' . $user->username; ?>">
			<img class="user-img" src="<?php echo $user->iconURL()->small;?>">
      </a>
<?php
	}
	$all = ossn_site_url('friendsonline');
	$vall = ossn_print('friendsonline:viewall');
	echo "<a class='d-block' href='{$all}'>{$vall}</a>";
} else {
	echo ossn_print('whoisonline:no');		
}
echo "</div>";
