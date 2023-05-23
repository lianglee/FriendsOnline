<div class="ossn-page-contents">
	<strong><?php echo ossn_print('friendsonline');?></strong>
    <?php
		$user 		= ossn_loggedin_user();
		$time  		= time();
		$intervals 	= 10;
		$users = $user->getFriends($user->guid, array(
				'wheres'     => "(u.last_activity > {$time} - {$intervals})",
		));
		if($users){
			$list = array();
			foreach($users as $item){
				//ossn 6.6 bug
				if($item->guid == ossn_loggedin_user()->guid){
						continue;	
				}
				$list[] = $item;
			}
			$count = $user->getFriends($user->guid, array(
				'wheres'     => "(u.last_activity > {$time} - {$intervals})",
				'count' => true,
			));
			echo ossn_plugin_view('output/users', array(
						'users' => $list,												  
			));
			echo ossn_view_pagination($count, 10, array(
						'offset_name' => 'online_users_page',								
			));
		} else {
			echo ossn_print('friendsonline:no');	
		}
	?>	
</div>
