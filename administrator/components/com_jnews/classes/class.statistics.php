<?php
defined('_JEXEC') OR die('Access Denied!');
### © 2006-2016 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link https://joobi.co

/**
 * This class outputs/generates the correct data in a reports and display a graph
 * functions included:
 * headerFilter, getDataSubscribers, displayGraphSubs, getDataMailing, mailingSpecificGraph
 */


class outputReportGraph {

	/**
	 * This public static function loads the required files for the statistics reports
	 */
	public static function initIncludes() {

		//import the open flash chart library into our file
		require_once(JNEWSPATH_ADMIN.'droplist'.DIRECTORY_SEPARATOR.'intervals.php');			//intervals radiolist
		require_once(JNEWSPATH_ADMIN.'droplist'.DIRECTORY_SEPARATOR.'predefined_range.php');	//predefined dropdownlist
		require_once(JNEWSPATH_ADMIN.'droplist'.DIRECTORY_SEPARATOR.'report_type.php');		//report type radio list
		require_once(JNEWSPATH_ADMIN.'droplist'.DIRECTORY_SEPARATOR.'subscribers.php');		//users dropdown list

		$doc = JFactory::getDocument();
		$doc->addStyleSheet( JNEWS_URL_ADMIN . 'cssadmin/jnews.css' );
		$doc->addStyleSheet( JNEWS_URL_INCLUDES.'calendar2/css/calendar.css');
		if( version_compare( JVERSION,'3.0.0','<' ) ) {
			JHTML::_('behavior.modal');
		} else {
			JHtml::_('behavior.modal');
		}

	}


/**
	 * This public static function displays the header in the page, it consists of report filters
	 * @param string $currentInterval
	 */
	public static function headerFilter( $currentInterval ){
		//Predefined fieldset
		$currentRange =  jnews::getVar('rptrange');
		$currentType = jnews::getVar('rpttype');

		if ( empty( $currentInterval ) ) $currentInterval = jnews::getVar('rptinterval');
		if ( empty( $currentRange ) ) $currentRange = 'this-month';
		if ( empty( $currentType ) ) {
			if($GLOBALS[JNEWS.'level'] > 2)$currentType = 'graph';
			else $currentType = 'listing';
		}

		//drop lists used in the header filter
		$filters = new stdClass;
		$filters->interval = intervalReportType::intervalType($currentInterval);
		$filters->predefinedRange = rangeReportType::rangeType($currentRange);
		$filters->reportType = outputReportType::reportType($currentType);
		$filters->subs = subscribersReportType::subscirbersType();

		$mainPath = JNEWS_URL_INCLUDES.'calendar2/';

		//for passing the values in the input of start and end
		$task = jnews::getVar('task','','','WORD');
		$startdate = ( $task!='refresh' ? jnews::getVar('startdate', '0000-00-00' ):'0000-00-00' );
		$enddate = ( $task!='refresh' ? jnews::getVar('enddate', '0000-00-00' ):'0000-00-00' );

	$mainframe = JFactory::getApplication();

	if($mainframe->isAdmin()) $width = '450px';
	else $width = '350px';
	?>

 	<table align="center" valign="top" >
 	<tr> <td>
 		<fieldset id="predef_date" style="width: <?php echo $width; ?>; height: 100px;">
 			<legend><?php echo _JNEWS_GROUP_PREDEFINED_DATE.':'; ?></legend>
 			<table align="center">
  				<tbody>
					<tr><td valign="top"><?php echo _JNEWS_LABEL_SET_INTERVAL.':'; ?></td>
						<td valign="top"> <?php echo $filters->interval; ?>
					 </td></tr>
					<tr>

						<td valign="top"><?php echo _JNEWS_LABEL_DATE_RANGE.':'; ?></td>
						<td valign="top"> <?php echo $filters->predefinedRange; ?>
					</td></tr>

					<tr>
						<td valign="top" style="padding-right:10px;"><?php echo _JNEWS_LABEL_CURRENT_SERVER_TIME.': '; ?></td>
						<td valign="top"><?php echo date( "l, j F Y H:i:s", jnews::getNow( 0, true ) )?></td></tr>
					</tr>

				</tbody>
			</table>

 		</fieldset>
	</td>
	<td>
	<script type="text/javascript" src="<?php echo $mainPath.'js/calendar.js'; ?>" > </script>

		<table align="center">
		<?php 	if($GLOBALS[JNEWS.'level'] > 2){ ?>
					<tr><td valign="top"><?php echo _JNEWS_LABEL_REPORT_TYPE.':'; ?></td>
						<td valign="top"><?php echo $filters->reportType ?>
		 			</td></tr>
		<?php 	}

		if($mainframe->isAdmin()) $width = '350px';
		else $width = '300px';
		?>
			<tr><td colspan="2" valign="top">
				<fieldset id="specific_date"style="width: <?php echo $width; ?>; height: 80px;"><legend><?php echo _JNEWS_GROUP_SPECIFIED_DATE; ?> </legend>
				<table align="center" >
				<tbody>
				<tr><td valign="top"><?php echo _JNEWS_SPECIFIED_DATE_START.':'; ?></td>
					<td valign="top">
						<input id="startdate" name="startdate" value="<?php echo $startdate;?>" type="text">
						<input type="button" class="aca_calendar" value=""
							style ="background:transparent url('<?php echo $mainPath. 'images/dashboard-icon.gif'; ?>') repeat scroll 0 0;"
							onclick="displayCalendar(document.getElementById('startdate'),'yyyy-mm-dd',this,false,
								'<?php echo $mainPath .'images/'; ?>')">
					</td></tr>
				<tr><td valign="top"><?php echo _JNEWS_SPECIFIED_DATE_END .':'; ?> </td>
					<td valign="top">
						<input name="enddate" id="enddate" value="<?php echo $enddate;?>" type="text">
						<input type="button" class="aca_calendar" value=""
							style ="background:transparent url('<?php echo $mainPath. 'images/dashboard-icon.gif'; ?>') repeat scroll 0 0;"
							onclick="displayCalendar(document.getElementById('enddate'),'yyyy-mm-dd',this,false,
								'<?php echo $mainPath .'images/'; ?>')">
					</td></tr>
			</tbody></table>
		</table>
		</td></tr>
  		</tbody>

	</table>
	<input type="hidden" name="option" value="<?php echo JNEWS_OPTION; ?>" />
	<input type="hidden" id ="act" value="statistics">
	<input type="hidden" id ="task" value="">
	<?php
	$mainframe = JFactory::getApplication();
	if(version_compare(JVERSION,'1.6.0','<') || $mainframe->isAdmin()){ ?>
	<script language="javascript" type="text/javascript">
			function submitbutton(pressbutton) {
				var form = document.adminForm;
				if (pressbutton == 'generate') {
					<?php
					if($mainframe->isAdmin()){
					?>
					form.action = 'index.php?option=<?php echo JNEWS_OPTION; ?>&act=statistics&task=generate#';
					<?php }else{//frontend
						$mainLink = JRoute::_( 'index.php?option='.JNEWS_OPTION.'&act=statistics&task=generate&mid=6' );
						?>
					form.action = '<?php echo $mainLink; ?>';
						<?php
					}
					?>
				}else if (pressbutton == 'refresh') {
					<?php
							if($mainframe->isAdmin()){
							?>
							form.action = 'index.php?option=<?php echo JNEWS_OPTION; ?>&act=statistics&task=refresh';
							<?php }else{//frontend
								$mainLink = JRoute::_( 'index.php?option='.JNEWS_OPTION.'&act=statistics&task=refresh&mid=6' );
								?>
							form.action = '<?php echo $mainLink; ?>';
								<?php
							}
							?>

				}else if(pressbutton == 'exportmailing'){
					form.action = 'index.php?option=<?php echo JNEWS_OPTION; ?>&act=statistics&task=exportm';
				}else if(pressbutton == 'exportlist'){
					form.action = 'index.php?option=<?php echo JNEWS_OPTION; ?>&act=statistics&task=exportl';
				}else if(pressbutton == 'exportsubscribers'){
					form.action = 'index.php?option=<?php echo JNEWS_OPTION; ?>&act=statistics&task=exports';
				}
				submitform( pressbutton );
			}
			</script>
		<?php }else{ ?>
		<script language="javascript" type="text/javascript">
			function submitbutton(pressbutton) {
				var form = document.adminForm;
				if (pressbutton == 'generate') {
                                    form.action = 'index.php?option=<?php echo JNEWS_OPTION; ?>&act=statistics&task=generate#';
					//form.action = 'generate#';
				}else if (pressbutton == 'refresh') {
                                    form.action = 'index.php?option=<?php echo JNEWS_OPTION; ?>&act=statistics&task=refresh';
					//form.action = 'refresh';
				}else if(pressbutton == 'exportmailing'){
					form.action = 'exportm';
				}else if(pressbutton == 'exportlist'){
					form.action = 'exportl';
				}else if(pressbutton == 'exportsubscribers'){
					form.action = 'exports';
				}
				submitform( pressbutton );
			}
			</script>
		<?php
		}
	}


/**
	 * This public static function creates the statistics and reports tab views
	 * @param array $filters query list filters
	 * @param string $task action task
	 * @param string $fileNameExport
	 */
	public static function tabReports( $filters, $task, $fileNameExport ) {

		//type of reports: listing, graph or export file
		$type = jnews::getVar('rpttype');
		if( empty( $type ) ){
			if ($GLOBALS[JNEWS.'level'] > 2) $type = 'graph';
			else $type = 'listing';
		}

		if( version_compare( JVERSION,'3.0.0','>=' ) ) echo '<div style="clear:both; margin-top:70px;">';

		$stats_tabs = new MosTabsjNews(0);
		$stats_tabs->startPane( 'acaStatsReports' );
		$stats_tabs->startTab( _JNEWS_REPORTS_MAIL, "acaStatsReports.Mailing");
		outputReportGraph::mailingReports( $filters, $type, $task, $fileNameExport );
		$stats_tabs->endTab();
		$stats_tabs->startTab( _JNEWS_REPORTS_LIST, "acaStatsReports.Lists");
		outputReportGraph::listReports( $filters, $type, $task, $fileNameExport );
		$stats_tabs->endTab();
		$stats_tabs->startTab( _JNEWS_REPORTS_SUBS, "acaStatsReports.Subscriber");
		outputReportGraph::subscribersReports( $filters, $type, $task, $fileNameExport );
		$stats_tabs->endTab();
		$stats_tabs->endPane();

		if( version_compare( JVERSION,'3.0.0','>=' ) ) echo '</div>';

		echo '<div style="clear:both;"></div>';
	}

/**
	 * This public static function generates the List Reports Statistics
	 * @param array $filters array of header filters
	 * @param string $type type of reports(listing, graph & export file)
	 * @param string $task
	 * @param string $fileNameExport
	 */
	 public static function listReports( $filters, $type, $task, $fileNameExport ){
		$my = JFactory::getUser();
		if(!empty($my->id)) $ownedlists = jNews_Lists::getOwnedlists($my->id);

		if(version_compare(JVERSION,'1.6.0','>=')){
			$usergid =JAccess::getGroupsByUser($my->id, false);
			$my->gid = $usergid[0];
		}

		$gidAdmins = array(24,25,7,8);

		$mainframe = JFactory::getApplication();

		$dateFormat = $filters['dateFormat'];
		$specialFormat = $filters['specialFormat'];
		$dateFormat4DateNumber = $filters['dateFormat4DateNumber'];
		$specialNo = $filters['specialNo'];
		$startdate = $filters['startdate'];
		$enddate = $filters['enddate'];

		$db = JFactory::getDBO();
		$sql = "SELECT L.id, L.list_name, N.subscribers, N.confirmed, O.unsubs " .
					" FROM `#__jnews_lists` AS L " .
      				" LEFT JOIN ( " .
      				"		SELECT S.list_id, count( S.subscriber_id ) AS subscribers, " .
      				"			SUM( T.confirmed ) AS confirmed" .
      				"		FROM `#__jnews_listssubscribers` AS S " .
      				"		LEFT JOIN `#__jnews_subscribers` AS T ON T.id = S.subscriber_id" .
      				"		WHERE S.subdate BETWEEN " . (int)$startdate . " AND " . (int)$enddate .
      				"		GROUP BY S.list_id " .
      				"   ) AS N ON N.list_id = L.id" .
      				" LEFT JOIN ( " .
      				"		SELECT V.list_id, count( V.subscriber_id ) AS unsubs" .
      				"		FROM `#__jnews_listssubscribers` AS V" .
      				"		WHERE V.unsubdate BETWEEN " . (int)$startdate . " AND " . (int)$enddate .
      				"			AND V.unsubscribe = 1" .
      				"		GROUP BY V.list_id" .
      				"   ) AS O ON O.list_id = L.id" .
      				" WHERE L.published <>2 " .
      				"   AND ( N.list_id is not NULL OR O.list_id is not NULL )";

				if(!$mainframe->isAdmin()){
					if($GLOBALS[JNEWS.'enable_jsub']){
						if(!empty($ownedlists)) $sql .= " AND N.list_id IN (".jnews::implode(',', $ownedlists ).")";
					}
					if( (!in_array($my->gid, $gidAdmins) ) && jnews::checkpermissions($my->gid) ){ //come back here
						if(!empty($ownedlists)) $sql .= " AND N.list_id IN (".jnews::implode(',', $ownedlists ).")";
					}
				}

				$sql .=	" GROUP BY L.id ".
      				" ORDER BY L.id ";

			$db->setQuery( $sql );
			$results = $db->loadObjectList();

		if( !empty($results)) {
			foreach ( $results as $key => $data ) {
				//subscribers waiting for confirmation
				$results[$key]->unconfirmed = $data->subscribers - $data->confirmed;
			}
		}

		$mainPath = JNEWS_PATH_ADMIN_IMAGES2 . '16/';
		?>	<div id="wizard" class=""></div> <?php

		if($GLOBALS[JNEWS.'level'] > 2){
			?>
				<div id="exportbtn" style="float:right;">

	         	<a  href="#" name="exportlist" value="<?php echo _JNEWS_STATS_EXPORT; ?>"
	             	onclick="submitbutton('exportlist')">
	             	<img src="<?php echo $mainPath . 'export_statistics.png'?>"/>
	       		</a>
		    	</div>
				<br/> <br/>

			<?php

			if ( $task == 'exportl' ){								//task
				//Go to a public static function to export the generated file
				outputReportGraph::listExport( $results, $fileNameExport );
			}
			if($type == 'graph'){
				outputReportGraph::listGoogleGraph( $results );
			}
		}

		//By default it will display a listing of reports
		if($type == 'listing'){
				//call the public static function that wil display the reports in listing type
				outputReportGraph::listListing( $results );
		}
	 	return true;

	 }


/**
	 * This public static function is to generate data report of Lists Report
	 * @param array $filters array of header filters
	 * @param string $type type of reports(listing, graph & export file)
	 * @param string $task
	 * @param string $fileNameExport
	 */
	 public static function listListing( $results ){

	 	$columnHeaders = array( '#', _JNEWS_LIST_NAME, _JNEWS_LIST_SUBCRIBERS, _JNEWS_LIST_UNSUBSCRIBERS,_JNEWS_LIST_CONFIRMED, _JNEWS_LIST_UNCONFIRMED, 'ID');
		$colNames = array( 'list_name', 'subscribers','unsubs', 'confirmed', 'unconfirmed', 'id' );

		$styles = array();
		$styles['subscribers'] = $styles['confirmed'] = 'text-align:center;';
		$styles['unconfirmed'] = $styles['id'] = $styles['unsubs'] = 'text-align:center;';

		outputReportGraph::htmlListingOutput( $columnHeaders, $colNames, $results, $styles );

	 }


	 /**
	 * This public static function will generate a Column Chart Graph report of Lists Report
	 * -- No. of Subscriptions per List.
	 * Column chart is generated, it includes the number of subscribers/unsubscribers/confirmed
	 * @param object $results query result
	 */
	 public static function listGoogleGraph( $results ){

	 	$graphCounter = 0;
	 	$count = count($results);
	 	if($count !=0)
	 	{

	 	foreach($results as $keys => $values)
		{

	 	?>

	    <html>
         <head>

          <script type='text/javascript' src='https://www.google.com/jsapi'>
          </script>

          <script type='text/javascript'>
             google.load('visualization', '1', {packages:['corechart']});
             google.setOnLoadCallback(drawChart);

             function drawChart()
             {
               var <?php echo 'data'.$graphCounter; ?> = google.visualization.arrayToDataTable([
                          ['List Name', 'No. of Subscribers' , 'No. of UnSubscribers', 'No. of Confirmed Emails' , 'No. of UnConfirmed Emails'],

	 	                  <?php

          		          $min = 0;
		                  $max = 4;

		                    $title = $values->list_name;
                            $subscribers = (int)$values->subscribers;
                            $unSubscribers = (int)$values->unsubs;
                            $confirmed = (int)$values->confirmed;
                            $unConfirmed =    (int)$values->unconfirmed;

					        echo '[\''.$title.'\','.$subscribers.','.$unSubscribers.','.$confirmed.','.$unConfirmed.' ] ';


					         // int value to determine maximum and minimum subscribers
					         $valueSub = $subscribers;

					         //Minimum, maximum and range
				             if($min > $valueSub) $min = $valueSub;
				             if($max < $valueSub) $max = $valueSub;


                          ?>
                ]);

                var <?php echo 'options'.$graphCounter; ?> = {
                                title: <?php echo '\''.$title.'\''; ?>,

                                vAxis: { title: 'Subscribers',
                                         format: '0',
        	                             viewWindow:{
        	                                          <?php
        	                                          echo 'max:'.$max.', min:'.$min ;
                                                      ?>
                                                     }
                                       }
                              };

               var <?php echo 'chart'.$graphCounter; ?> = new google.visualization.ColumnChart(document.getElementById(<?php echo '\'chart_col_div'.$graphCounter.'\''; ?>));
               <?php echo 'chart'.$graphCounter; ?>.draw(<?php echo 'data'.$graphCounter; ?>, <?php echo 'options'.$graphCounter; ?>);
             }
          </script>

         </head>

        <body>
         <div id=<?php echo '\'chart_col_div'.$graphCounter.'\''; ?> style='width: 80%; height: 400px;'></div>
        </body>
        </html>

	 	<?php

	 	$graphCounter++;
		} // for loop ends

	 	}
	 	else
	 	{
	 		echo '&nbsp;&nbsp;<b>' . _JNEWS_GRAPH_WARN_MESSAGE . '</b><br /><br />';
	 	}

	 } // end function


/**
	 * public static function that will export a file based on the generated reports
	 * @param array $results array of results from query
	 * @param string $fileNameExport
	 */
	 public static function listExport( $results, $fileNameExport ){
	 	//Inializing all the variables needed
		$headers = '';
		$data = '';
		$ctr = 0;

		$headers = _JNEWS_LIST_NAME. "," ._JNEWS_LIST_SUBCRIBERS . "," ._JNEWS_LIST_CONFIRMED.  ",". _JNEWS_LIST_UNCONFIRMED;
		if(!empty($results)){
			foreach($results as $key => $datas){
				$data .= '"' .$datas->list_name . '"';
				$data .= "," . $datas->subscribers ;
				$data .= "," .  $datas->confirmed ;
				$data .= "," . $datas->unconfirmed ;
				$data .= "\n";
			}

			$csvFormat = $headers. "\n" . $data;
			$fileNameTemp = _JNEWS_REPORTS_LIST . $fileNameExport;
			$fileName = str_replace(' ', '_', $fileNameTemp);
			outputReportGraph::exportHeader($csvFormat, $fileName);		//Call the public static function to export the csv file
 		}else{
			echo jnews::printM('warning',_JNEWS_EXPORT_WARN_MESSAGE);
			return;
		}

		return true;
	 }


/**
	 * This public static function gets the data that needs to be generated
	 * Report for the No. of Subcriptions on a certain Date
	 * @param array $filters array of header filters
	 * @param string $type type of reports(listing, graph & export file)
	 * @param string $task
	 * @param string $fileNameExport
	 */
	 public static function subscribersReports( $filters, $type, $task, $fileNameExport ) {

		$dateFormat = $filters['dateFormat'];
		$specialFormat = $filters['specialFormat'];
		$dateFormat4DateNumber = $filters['dateFormat4DateNumber'];
		$specialNo = $filters['specialNo'];
		$startdate = $filters['startdate'];
		$enddate = $filters['enddate'];

		$db = JFactory::getDBO();
		$sql = "SELECT FROM_UNIXTIME(subscribe_date $specialFormat) AS s_date," .
					"		$dateFormat4DateNumber subscribe_date $specialNo AS DateNumber, " .
					"		COUNT(id) AS `s_id`" .
					" FROM `#__jnews_subscribers`" .
					" WHERE confirmed = 1" .
					" 	AND `subscribe_date`BETWEEN " . (int)$startdate . " AND " . (int)$enddate .
					" GROUP BY `DateNumber` " .
					" ORDER BY `subscribe_date`";
		$db->setQuery( $sql );
		$results = $db->loadObjectList();

		$mainPath = JNEWS_PATH_ADMIN_IMAGES2 . '16/';
		?>	<div id="wizard" class=""></div> <?php

		if($GLOBALS[JNEWS.'level'] > 2){
			?>
		       	<div id="exportbtn" style="float:right;">
		         	<a  href="#" name="exportsubscribers" value="<?php echo _JNEWS_STATS_EXPORT; ?>"
		             	onclick="submitbutton('exportsubscribers')">
		             	<img src="<?php echo $mainPath .'export_statistics.png'?>"/>
		       		</a>
		       	</div>
				<br/> <br/>

			<?php

			if( $task == 'exports'){
				//Go to a public static function to export the generated file
				outputReportGraph::subscribersExport( $results, $fileNameExport );
			}
			if($type == 'graph'){
				//temporarily redirect to the graph page
				outputReportGraph::subscribersGoogleGraph( $results );
			}
		}

		if($type == 'listing'){
			//call the public static function that wil display the reports in listing type
			outputReportGraph::subscribersList( $results );
		}

	}


/**
	 * This public static function is to generate data report of Subscribers Report
	 * @param object $results query results
	 */
	 public static function subscribersList( $results ){

	 	$columnHeaders = array( '#', _JNEWS_LIST_SUB_DATE,_JNEWS_LIST_SUBCRIBERS);
		$colNames = array( 's_date', 's_id' );

		$styles = array();
		$styles['s_date'] = $styles['s_id'] = 'text-align:center;';

		outputReportGraph::htmlListingOutput( $columnHeaders, $colNames, $results, $styles );

	 }

/**
	 * This public static function will generate a goodgle graph report of Subscribers Report
	 * --No. of Subscriptions on a certain date
	 * Google Line chart is generated,
	 * @param object $results query result
	 */
	 public static function subscribersGoogleGraph( $results )
	 {

	 	$count = count($results);
	 	if($count != 0)
	 	{

	 	?>

	    <html>
         <head>

          <script type='text/javascript' src='https://www.google.com/jsapi'>
          </script>

          <script type='text/javascript'>
             google.load('visualization', '1', {packages:['corechart']});
             google.setOnLoadCallback(drawChart);

             function drawChart()
             {
               var data = google.visualization.arrayToDataTable([
                          ['Date', 'No. of Subscriptions'],

	 	                  <?php


                          $counter = 1;
          		          $min = 0;
		                  $max = 4;

		                  foreach($results as $keys => $values)
				          {
				          	 // need to not append a comma for last row
					         if ($counter == $count)
					         {
					           echo '[\''.$values->s_date.'\','.$values->s_id.' ] ';
					         }
					         else
					         {
					           echo '[\''.$values->s_date.'\','.$values->s_id.' ] ,';
					         }

					         // int value to determine maximum and minimum subscribers
					         $valueSub =(int)$values->s_id;

					         //Minimum, maximum and range
				             if($min > $valueSub) $min = $valueSub;
				             if($max < $valueSub) $max = $valueSub;

					         $counter++;
				          }
                          ?>
                ]);

                var options = {
                                title: 'Subscribers Report',
                                hAxis: { title: 'Period'} ,
                                vAxis: { title: 'Subscribers',
                                         format: '0',
        	                             viewWindow:{
        	                                          <?php
        	                                          echo 'max:'.$max.', min:'.$min ;
                                                      ?>
                                                     }
                                       }
                              };

               var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
               chart.draw(data, options);
             }
          </script>

         </head>

        <body>
         <div id='chart_div' style='width: 80%; height: 400px;'></div>
        </body>
        </html>

	 	<?php
	 	}
	 	else
	 	{
	 		echo '&nbsp;&nbsp;<b>' . _JNEWS_GRAPH_WARN_MESSAGE . '</b><br /><br />';
	 	}


	 } // end function 	subscribersGoogleGraph()



	/**
	 * public static function to generate an export file
	 */
	 public static function subscribersExport($results, $fileNameExport){
	 	//Inializing all the variables needed
		$headers = '';
		$data = '';
		$ctr = 0;
		$csvFormat = '';

		$headers = _JNEWS_LIST_SUB_DATE .","._JNEWS_LIST_SUBCRIBERS;
		if(!empty($results)){
			foreach($results as $key => $datas){
				$data .= '"' . $datas->s_date  . '" ' ;
				$data .= "," . $datas->s_id  . '' ;
				$data .= "\r\n";
			}

			$csvFormat = $headers."\r\n" . $data;
			$fileNameTemp = _JNEWS_REPORTS_SUBS . $fileNameExport;
			$fileName = str_replace(' ', '_', $fileNameTemp);
			outputReportGraph::exportHeader($csvFormat, $fileName);
 		}else{
			echo jnews::printM('warning',_JNEWS_EXPORT_WARN_MESSAGE);
			return;
		}

//			return true;
	 }


	/**
	 * This public static function generates the view of the mailing statistics
	 * and reports lists and graphs.
	 * @param array $filters array of header filters
	 * @param string $type type of reports(listing, graph & export file)
	 * @param string $task
	 * @param string $fileNameExport
	 */
	public static function mailingReports( $filters, $type, $task, $fileNameExport ){
		$my = JFactory::getUser();
		if(!empty($my->id)) $ownedlists = jNews_Lists::getOwnedlists($my->id);

		if(version_compare(JVERSION,'1.6.0','>=')){
			$usergid =JAccess::getGroupsByUser($my->id, false);
			$my->gid = $usergid[0];
		}

		$gidAdmins = array(24,25,7,8);

		$dateFormat = $filters['dateFormat'];
		$specialFormat = $filters['specialFormat'];
		$dateFormat4DateNumber = $filters['dateFormat4DateNumber'];
		$specialNo = $filters['specialNo'];
		$startdate = $filters['startdate'];
		$enddate = $filters['enddate'];

		$mainframe = JFactory::getApplication();

		$db = JFactory::getDBO();

		$sql = "SELECT FROM_UNIXTIME(N.sentdate $specialFormat) AS s_date," .
				"	$dateFormat4DateNumber N.sentdate $specialNo AS DateNumber, " .
				"	M.subject, N.html_sent, N.text_sent, N.html_read as html_views, " .
				"	N.pending, N.failed, N.bounces, N.sent, " .
				"	N.mailing_id as id" .
				" FROM #__jnews_mailings AS M" .
				" LEFT JOIN #__jnews_stats_global AS N ON N.mailing_id = M.id";

		if(!$mainframe->isAdmin()){
			if($GLOBALS[JNEWS.'enable_jsub']) $sql .= " LEFT JOIN #__jnews_listmailings AS O ON O.mailing_id = M.id";
			if( (!in_array($my->gid, $gidAdmins) ) && jnews::checkpermissions($my->gid) ){ //come back here
				if(!empty($ownedlists))$sql .= " LEFT JOIN #__jnews_listmailings AS O ON O.mailing_id = M.id";
			}
		}

		$sql .=" WHERE N.sentdate BETWEEN " . (int)$startdate . " AND " . (int)$enddate;

		if(!$mainframe->isAdmin() && !jnews::checkPermissions('admin')){
			if($GLOBALS[JNEWS.'enable_jsub'] && !empty($ownedlists) ) $sql .=" AND O.list_id IN (".implode($ownedlists,',').")";
			if( (!in_array($my->gid, $gidAdmins) ) && jnews::checkpermissions($my->gid) ) $sql .=" AND O.list_id IN (".implode($ownedlists,',').")";
		}

		$sql .=" GROUP BY M.id, DateNumber ORDER BY DateNumber ";

		$db->setQuery( $sql );
		$results = $db->loadObjectList();

		$mainPath = JNEWS_PATH_ADMIN_IMAGES2 . '16/';

		?>	<div id="wizard" class=""></div> <?php

		if($GLOBALS[JNEWS.'level'] > 2){
			?>
			       	<div id="exportbtn" style="float:right;">
			         	<a  href="#" name="exportmailing" value="<?php echo _JNEWS_STATS_EXPORT; ?>"
			             		onclick="submitbutton('exportmailing')" >
			             	<img src="<?php echo $mainPath . 'export_statistics.png'?>"/>
			       		</a>
			    	</div>
					<br/> <br/>
			<?php

			if ( $task == 'exportm' ){
				//Go to a public static function to export the generated file
				outputReportGraph::mailingExport( $results, $fileNameExport );
			}
			if($type == 'graph'){
					//tallying totals
			        $totalData = array();
			        $totalData['subject'] = '';
			        $totalData['html_sent'] = 0;
			        $totalData['text_sent'] = 0;
			        $totalData['html_views'] = 0;
			        $totalData['pending'] = 0;
//			        $totalData['failed'] = 0;
//			        $totalData['bounces'] = 0;
			        $totalData['sent'] = 0;
			        $totalData['mailings'] = 0;

			        if(!empty($results)){
				        foreach( $results as $row ){
				            $totalData['html_sent'] += $row->html_sent;
				            $totalData['text_sent'] += $row->text_sent;
				            $totalData['html_views'] += $row->html_views;
				            $totalData['pending'] += $row->pending;
//			           		$totalData['failed'] += $row->failed;
//				        	$totalData['bounces'] += $row->bounces;
				           	$totalData['sent'] += $row->sent;
//			           	 	$totalData['sent'] += $row->html_sent + $row->text_sent; //fixed
				            $totalData['mailings'] ++;
				        }//end4each
			        }

			        // Fix by Amod Begins
					//outputReportGraph::mailingGraph( $totalData );
					outputReportGraph::mailingGraph( $results );
			        // Fix by Amod Ends

			}
		}

		if($type == 'listing') {
			//call the public static function that wil display the reports in listing type
			outputReportGraph::mailingList( $results, str_replace( "'", "", $startdate ), str_replace( "'", "", $enddate ) );
		}

		return true;
	}


	/**
	 * This public static function displays the mailing report listing
	 * @param object $results query results
	 */
	public static function mailingList( $results, $startDate=0, $endDate=0 ) {
		$mainframe = JFactory::getApplication();

		$columnHeaders = array( '#', _JNEWS_LIST_SUB, _JNEWS_MAILING_SENT_HTML,
				_JNEWS_MAILING_SENT_TEXT, _JNEWS_VIEWS_FROM_HTML,
				_JNEWS_MAILING_PENDING, _JNEWS_MAILING_SENT, 'ID' );

		$colNames = array( 'subject', 'html_sent', 'text_sent', 'html_views','pending', 'sent', 'id' );

		$styles = array();
		$styles[ 'html_sent' ] = $styles[ 'text_sent' ] = $styles[ 'sent' ] = 'text-align:center;';
		$styles[ 'html_views' ] = $styles[ 'pending' ] = 'text-align:center;';
		$styles[ 'id' ] = 'text-align:center;';

		$links = array();
		$links['subject'] = jNews_Tools::completeLink( 'option='.JNEWS_OPTION.'&act=statistics&task=graph', true, false, true );//changed the second parameter from false to true

		outputReportGraph::htmlListingOutput( $columnHeaders, $colNames, $results, $styles, $links, $startDate, $endDate );

	}


	/**
	 * This public static function will generate a graph report of Mailing Report
	 * Two Pie charts are generated,
	 * @referenced files: open flash chart 2 library
	 *
	 * @param object $results query result
	 */
	 public static function mailingSpecificGraph( $results ,$queryfilters ) {
		if ( empty($results) ) {
			echo '&nbsp;&nbsp;<b>' . _JNEWS_GRAPH_WARN_MESSAGE . '</b><br /><br />';
			return true;
		}

		?>
		<div style="font-size:20px; font-weight:bold; color:#0B55C4;">
			<?php echo _JNEWS_MAILING_SUBJECT_HEADER . ': ' . $results['subject']; ?>
		</div>
		<br />
		<?php

		//remove the wizard text in the pop-up page of mailing report
		$doc = JFactory::getDocument();
		$doc->addStyleDeclaration('div#acawizard{display:none}');
		//Tabs
		$stats_tabs = new MosTabsjNews(0);
		$stats_tabs->startPane( 'acaMailingReports' );


		//Graph of each Mailing
		$stats_tabs->startTab( _JNEWS_MAIL_GRAPH, "acaMailingReports.graph" );
        outputReportGraph::mailingGooglePieChart($results);

	$stats_tabs->endTab();
	//Detailed info of each Mailing (read/unread/text)
	$stats_tabs->startTab( _JNEWS_MAIL_DETAILS, "acaMailingReports.details");

	?>
		<br />
		<table class="<?php echo jnews::myTheme(); ?>">
			<thead>
				<th ><?php echo _JNEWS_MAIL_DETAILS_READ; ?></th>
				<th ><?php echo _JNEWS_MAIL_DETAILS_UNREAD; ?></th>
				<th ><?php echo _JNEWS_MAIL_DETAILS_TEXT; ?></th>
			</thead>
			<tr>
				<?php
					$mailingId = $results['id'];
					$startDate  = $queryfilters['startdate'];
					$endDate = $queryfilters['enddate'];

					$db = JFactory::getDBO();

					$sql = "SELECT B.`email` " .	//COUNT(A.subscriber_id) AS s_format "
							"FROM `#__jnews_stats_details` AS A " .
							"LEFT JOIN `#__jnews_subscribers` AS B ON B.`id` = A.`subscriber_id` ".
							"WHERE A.`mailing_id`=" . (int)$mailingId .
							" AND A.sentdate BETWEEN " . (int)$startDate . " AND " . (int)$endDate;

					//html read
					$query = $sql . " AND A.`html` = 1 AND A.`read` = 1 LIMIT 10000";
					$db->setQuery( $query );
					$loadResultArray = $db->loadObjectList();
					$resultHTMLRead = jnews::convertObjectList2Array( $loadResultArray );

					//html unread
					$query = $sql . " AND A.`html` = 1 AND A.`read` = 0 LIMIT 10000";
					$db->setQuery( $query );
					$loadResultArray = $db->loadObjectList();
					$resultHTMLUnread = jnews::convertObjectList2Array( $loadResultArray );

					//text only
					$query = $sql . " AND A.`html` = 0 LIMIT 10000";
					$db->setQuery( $query );
					$loadResultArray = $db->loadObjectList();
					$resultsText = jnews::convertObjectList2Array( $loadResultArray );

				?>
				<td valign="top"><?php
						foreach($resultHTMLRead as $data){
							if(!empty($data)) echo $data . "<br />";
						}
				 ?></td>
				<td valign="top"><?php
						foreach($resultHTMLUnread as $data){
							if(!empty($data)) echo $data . "<br />";
						}

				 ?></td>
				<td valign="top"><?php
						foreach($resultsText as $data){
							if(!empty($data)) echo $data . "<br />";
						}
				 ?></td>
			</tr>
		</table>
	<?php
	$stats_tabs->endTab();
	$stats_tabs->endPane();

	}


/**
	 * public static function that will generate a general graph for mailing
	 * It will display a results in percentage base on the no. of mailings generated on a certain date
	 *
	 * @param array $resultsGeneral values of the graph
	 */
	 public static function mailingGraph( $resultsGeneral ){
		if (empty($resultsGeneral)){
			echo '&nbsp;&nbsp;<b>' . _JNEWS_GRAPH_WARN_MESSAGE . '</b><br /><br />';
			return true;
		}

		outputReportGraph::mailingGooglePieChart( $resultsGeneral );
	 	return true;

	 }



// Code change by Amod Begins
/**
	 * public static function to generate google graph pie charts for the mailing reports
     *
	 * @param array $results data needed for graph values
	 */
	 public static function mailingGooglePieChart( $results ) {
	 	
	 	if ( !empty($results['id']) ) {
	 		$obj = new stdClass;
	 		foreach( $results as $p => $v ) $obj->$p = $v;
	 		$results = array( $obj );
	 	}//endif
	 

        $count = count($results);
	 	$counter = 1;

	 	if($count == 0)
	 	{
	 		echo '&nbsp;&nbsp;<b>' . _JNEWS_GRAPH_WARN_MESSAGE . '</b><br /><br />';
	 		return;
	 	}

	 	?>

        <html>
         <head>
           <!--  Fix by Amod Begins -->
           <!-- Changing address from http to secured https -->
           <script type="text/javascript" src="https://www.google.com/jsapi"></script>
           <script type="text/javascript">
             // Surprisingly google has changed the javascript lib path to https which I have done above
             // Secondly with https the visulization package controls has version 1.0 and not 1.1 for some reason unkown
             // Have done this with trial and error and it seems to work
             //google.load('visualization', '1.1', {packages: ['controls']});
             google.load('visualization', '1.0', {packages: ['controls']});
             </script>
           <!--  Fix by Amod Ends-->
           <script type="text/javascript">
            function drawVisualization()
            {
               // Prepare the data
               var data = google.visualization.arrayToDataTable([
                   ['Status', 'Subject', 'Value'],

                   <?php

                    $subjectLable = _JNEWS_LIST_SUB;
                   foreach($results as $row)
                   {
                      $htmlSent =  $row->html_sent;
          	          $htmlSentLable = _JNEWS_MAILING_SENT_HTML;
          	          $textSent =  $row->text_sent;
          	          $textSentLable = _JNEWS_MAILING_SENT_TEXT;
          	          $pending =  $row->pending;
          	          $pendingLable = _JNEWS_MAILING_PENDING;
          	          $subject =  $row->subject;


          	          echo ' [ \''.$htmlSentLable.'\' , \''.$subject.' \' , '.$htmlSent.'] ,';
          	          echo ' [ \''.$textSentLable.'\' , \''.$subject.' \' , '.$textSent.'] ,';

          	          if($count == $counter )
          	          {
          	            echo ' [ \''.$pendingLable.'\' , \''.$subject.' \' , '.$pending.'] ';
          	          }
          	          else
          	          {
          	            echo ' [ \''.$pendingLable.'\' , \''.$subject.' \' , '.$pending.'] ,';
          	          }
          	          $counter++;
                    }

                    ?>

            ]);

            // Define a category picker control for the Gender column
            var categoryPicker = new google.visualization.ControlWrapper({
               'controlType': 'CategoryFilter',
               'containerId': 'control2',
               'options':
                   {
        	         'filterColumnLabel': 'Subject',
                     'ui': {
                              'labelStacking': 'vertical',
                              'label' : <?php echo '\''.$subjectLable.'\''; ?> ,
                              'allowTyping': false,
                              'allowNone' : false,
                              'allowMultiple': false
                           }
                    }
            });

            // Define a Pie chart
            var pie = new google.visualization.ChartWrapper({
               'chartType': 'PieChart',
               'containerId': 'chart1',
               'options':
                    {
                      'width': 400,
                      'height': 400,
                      'legend': 'none',
                      'title': 'Percentage wise distribution of Emails per Subject',
                      'chartArea': {'left': 15, 'top': 15, 'right': 0, 'bottom': 0},
                      'pieSliceText': 'label'
                     },

               // Instruct the piechart to use colums 0 (Name) and 3 (Donuts Eaten)
               // from the 'data' DataTable.
               'view': {'columns': [0, 2]}
            });

        // Create a dashboard
        new google.visualization.Dashboard(document.getElementById('dashboard')).
            // Establish bindings, declaring the both the slider and the category
            // picker will drive both charts.
            bind([categoryPicker], [pie]).
            // Draw the entire dashboard.
            draw(data);
      }


      google.setOnLoadCallback(drawVisualization);
    </script>
  </head>
  <body style="font-family: Arial;border: 0 none;">
    <div id="dashboard">
      <table>
        <tr style='vertical-align: top'>
          <td style='width: 300px; font-size: 0.9em;'>
            <div id="control1"></div>
            <div id="control2"></div>
            <div id="control3"></div>
          </td>
          <td style='width: 600px'>
            <div style="float: left;" id="chart1"></div>
            <div style="float: left;" id="chart2"></div>
            <div style="float: left;" id="chart3"></div>
          </td>
        </tr>
      </table>
    </div>
  </body>
</html>
​	 	<?php

	 }
// Code change by AMod ends

/**
	 * public static function to generate two pie charts for the mailing reports
	 * It was extracted because there are two graph in mailing for each mailing and general mailing which is the total
	 *
	 * @param array $results data needed for graph values
	 */
	 public static function mailingPieChart( $results ){
			$data = array();

			//First Pie, Pie Chart for HTML/TEXT format
			$valuesFormat = array();
			$pieHtmlValues = new pie_value((int)$results['html_sent'], _JNEWS_GRAPH_LBL_HTML);
			$pieTextValues = new pie_value((int)$results['text_sent'], _JNEWS_GRAPH_LBL_TEXT);
			$valuesFormat[] = $pieHtmlValues;
			$valuesFormat[] = $pieTextValues;

			if(empty($results['html_sent']) && empty($results['text_sent']) ){
				$data['pie1'] = 'empty';
			}else{
				$css = '{font-size:15px;font-weight:bold;color:#0B55C4;}';
				$title = new title(_JNEWS_GRAPH_TITLE_FORMAT);	//Name of the newsletter
				$title->set_style($css);

				$pieMailing = new pie();
				$pieMailing->set_alpha(0.6);
				$pieMailing->set_start_angle( 35 );
				$pieMailing->add_animation( new pie_fade() );
				$pieMailing->set_tooltip( '#val#<br>#percent# of 100%' );
				$pieMailing->set_colours( array('#156cbd','#368d03','#f7941d','#ed145a','#92278f',
											'#156cbd','#182972','#3e5d2b','#db4b19','#9d0039','#440e62') );
				$pieMailing->set_values($valuesFormat);

				$chartPie = new open_flash_chart();
				$chartPie->set_title($title);
				$chartPie->add_element($pieMailing);
				$chartPie->set_bg_colour('#FFFFFF');

				$data['pie1'] = $chartPie->toPrettyString();

			}

			//Second chart, Pie chart for the status of mailing process
			$valuesProcess = array();
			//$pieFailedlValues = new pie_value((int)$results['failed'], _JNEWS_MAILING_FAILED);
            //$pieBounceValues = new pie_value((int)$results['bounces'], _JNEWS_MAILING_BOUNCES);
			$piePendingValues = new pie_value((int)$results['pending'], _JNEWS_MAILING_PENDING);
			$pieSentValues = new pie_value((int)$results['sent'], _JNEWS_MAILING_SENT);
           //$valuesProcess[] = $pieFailedlValues;
           //$valuesProcess[] = $pieBounceValues;
			$valuesProcess[] = $piePendingValues;
			$valuesProcess[] = $pieSentValues;

            //if(!empty($results['failed']) && !empty($results['pending']) && !empty($results['bounces'])){
			if(!empty($results['sent']) || !empty($results['pending'])){

				$css = '{font-size:15px;font-weight:bold;color:#0B55C4;}';
				$title = new title(_JNEWS_GRAPH_PIE_TITLE_MAIL);		//Name of the newsletter
				$title->set_style($css);

				$pieMailing = new pie();
				$pieMailing->set_alpha(0.6);
				$pieMailing->set_start_angle( 35 );
				$pieMailing->add_animation( new pie_fade() );
				$pieMailing->set_tooltip( '#val#<br>#percent# of 100%' );
				$pieMailing->set_colours( array('#156cbd','#368d03','#f7941d','#ed145a','#92278f',
											'#156cbd','#182972','#3e5d2b','#db4b19','#9d0039','#440e62') );
				$pieMailing->set_values($valuesProcess);

				$chartPie = new open_flash_chart();
				$chartPie->set_title($title);
				$chartPie->add_element($pieMailing);
				$chartPie->set_bg_colour('#FFFFFF');

				$data['pie2'] = $chartPie->toPrettyString();
			}else{
				$data['pie2'] = 'empty';
			}

	 	return $data;

	 }


/**
	 * Export the generated file in csv format
	 * @param $result - (array) data to be exported
	 * 		  $fileNameExport - (string) temporary name of the file to be exported
	 */
	 public static function mailingExport( $results, $fileNameExport ){
	 	//Inializing all the variables needed
		$headers = '';
		$data = '';
		$ctr = 0;

		$headers .= _JNEWS_LIST_SUB . ",". _JNEWS_MAILING_SENT_HTML. ","._JNEWS_MAILING_SENT_TEXT. ",". _JNEWS_VIEWS_FROM_HTML. ",".
               _JNEWS_MAILING_FAILED. ",". _JNEWS_MAILING_PENDING. ",". _JNEWS_MAILING_BOUNCES. ","._JNEWS_MAILING_SENT. ",". 'ID';

		if ( !empty( $results ) ){
			foreach( $results as $key => $datas ){
				$data .= '"' .$datas->subject. '"' ;
				$data .= "," . $datas->html_sent ;
				$data .= " ," . $datas->text_sent ;
				$data .= " ," . $datas->html_views ;
				$data .= " ," . $datas->pending ;
//				$data .= " ," . $datas->failed ;
//				$data .= " ," . $datas->bounces ;
				$data .= " ," . $datas->sent ;
				$data .= " ," . $datas->id ;
				$data .= "\r\n";
			}

			$csvFormat = $headers. "\r\n" . $data;
			$fileNameTemp = _JNEWS_REPORTS_MAIL . $fileNameExport;
			$fileName = str_replace(' ', '_', $fileNameTemp);
			outputReportGraph::exportHeader($csvFormat, $fileName);		//Call the public static function to export the csv file
 		} else {
			echo jnews::printM('warning',_JNEWS_EXPORT_WARN_MESSAGE);
			return;
		}

	 }

	/**
	 * This public static function creates the listing view of the stats and reports.
	 *
	 * @param array $columnHeaders column headers of the listing table
	 * @param array $colNames column names of the results rows
	 * @param object $results query results
	 * @param array $styles styles for the column data
	 * @param array $links links for the column data
	 * @param array $popupCol name of the popup column index
	 *
	 */
	public static function htmlListingOutput( $columnHeaders, $colNames, $results=null, $styles=null, $links=null, $startDate=0, $endDate=0 ) {

		//no table to make
		if ( empty( $columnHeaders ) ) return true;
		$table = '<table class="' . jnews::myTheme() . '"> <tbody><thead>';

		$tableHeader = '<tr>';
		foreach ( $columnHeaders as $colHeader ) {
			$tableHeader .= '<th class="title" style="text-align: center;">';
			$tableHeader .= $colHeader;
			$tableHeader .= '</th>';

		}//end4each
		$tableHeader .= '</tr></thead>';

		$tableRows = '';
		if ( !empty( $results ) ){

			$rownum = 1;
			foreach( $results as $rowdata ){

				$i = ($rownum + 2) % 2;
				$trclass = 'class="row'.$i.'"';
				$tableRows .= '<tr '.$trclass.'>';
				$tableRows .= "<td style=\"width:30px;text-align: center;\"> $rownum </td>";
				$colnum = 0;

				foreach( $colNames as $colname ) {
					if ( isset( $styles[$colname] ) ) $tableRows .= '<td '.outputReportGraph::addStyle($styles[$colname]).'> ';
					else $tableRows .= "<td>" ;

					$coldata = ( !empty($rowdata->$colname )? $rowdata->$colname:0 );

					if ( isset( $links[$colname] ) ) {
						$coldata = outputReportGraph::addPopupLink( $links[$colname], $rowdata, $colNames, $coldata, $startDate, $endDate ) ;
					}

					$tableRows .=  "$coldata</td>";
					$colnum++;
				}

				$tableRows .= "</tr>";
				$rownum++;
			}
		}

		$table .= $tableHeader . $tableRows;
		$table .= '</tbody></table>';

		echo $table;

	}


	/**
	 * This public static function is to add styles into the table element
	 * @param string $style
	 * @return string html
	 */
	public static function addStyle( $style ) {
		$html = '';
		if ( !empty( $style ) ){
			$html = "style=\"$style\"";
		}

		return $html;
	}


/**
	 * This public static function generates the popup html code for the column
	 * data element.
	 * @param string $link link destionation
	 * @param object $rowdata row results data
	 * @param array $colNames
	 * @param string $coldata
	 * @return string html
	 */
	public static function addPopupLink( $link, $rowdata, $colNames, $coldata, $startDate=0, $endDate=0 ) {

		if ( empty($rowdata) ) return;

		foreach( $colNames as $name ) $link .= '&'.$name.'='.urlencode($rowdata->$name);

		if ( !empty($startDate) ) $link .= '&startdate='.$startDate;
		if ( !empty($endDate) ) $link .= '&enddate='.$endDate;

		$rel = 'rel="{handler: \'iframe\',size: {x: 700, y: 450}}" ';

		$html = '<a href="'.$link.'" class="modal" '.$rel.'>'.$coldata .'</a>';

		return $html;

	}


	/**
	 * public static function to export the csv file
	 * @param: $csvFormat - (string) file to be exported in csv format
	 * 			$fileName - (string) name of the name consisting of name of reports and the date range
	 * @return - true;
	 */
	public static function exportHeader( $csvFormat, $fileName ){
		header('Content-type: application/octet-stream');
		header('Content-disposition:  attachment; filename="' . $fileName . '.csv"');
		header('Pragma: no-cache');
		header('Expires: 0');
		ob_end_clean();
		print $csvFormat;
		exit;
	}

}