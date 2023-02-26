<?php
			$eventID = $plink['eventID'];
			$eventstr = !empty($admtext[$eventID]) ? $admtext[$eventID] : "";
			if($eventID && !$eventstr) {
				$query = "SELECT display, eventdate, eventplace, info FROM $events_table, $eventtypes_table WHERE eventID = \"{$plink['eventID']}\" AND $events_table.eventtypeID = $eventtypes_table.eventtypeID";
				$custevents = tng_query($query);
				$custevent = tng_fetch_assoc( $custevents );
				$displayval = isset($custevent['display']) ? getEventDisplay( $custevent['display'] ) : "";
				$info = "";
				if( !empty($custevent['eventdate']) )
					$info = displayDate($custevent['eventdate']);
				elseif( !empty($custevent['eventplace']) )
					$info = truncateIt($custevent['eventplace'],20);
				elseif( !empty($custevent['info']) )
					$info = truncateIt($custevent['info'],20);
				$eventstr = "$displayval: $info";
			}
?>