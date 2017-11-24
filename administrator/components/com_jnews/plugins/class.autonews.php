<?php
defined('_JEXEC') OR die('Access Denied!');
### © 2006-2016 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link https://joobi.co
class jNews_Autonews {

	function editmailing() {

		$show['sender_info'] = true;
		$show['published'] = false;
		$show['pub_date'] = false;
		$show['hide'] = true;
		$show['issuenb'] = false;
		$show['delay'] = false;
		$show['htmlcontent'] = true;
		$show['textcontent'] = true;
		$show['attachement'] = true;
		$show['images'] = true;
		$show['sitecontent'] = true;
		return $show;

	}


	function editlist() {
		$show['sender_info'] = true;
		$show['hide'] = true;
		$show['auto_option'] = false;
		$show['htmlmailing'] = true;
		$show['auto_subscribe'] = true;
		$show['email_unsubcribe'] = true;
		$show['unsusbcribe'] = true;
		return $show;

	}


	function showMailings() {
		$show['id'] = true;
		$show['dropdown'] = true;
		$show['select'] = true;
		$show['issue'] = true;
		$show['sentdate'] = true;
		$show['delay'] = false;
		$show['status'] = true;
		return $show;
	}


	function getQueue() {
		$query =  ' AND `mailing_id` > 0 ';
		$query .= ' AND `issue_nb` > 0 ';
		$query .= ' AND `type`= 7  ';
		$query .= ' AND `published` > 0';
		$query .=  ' AND `mailing_id` IN (' .
					'	SELECT M.`id` FROM #__jnews_mailings AS M WHERE M.`published` > 0 '.
				') ';
		return $query;
	}


	 function getActive() {
		$config['listype7'] = '1';
		$config['listname7'] = '_JNEWS_AUTONEWS';
		$config['listnames7'] = '_JNEWS_MENU_AUTONEWS';
		$config['listshow7'] = '1';
		$config['listlogo7'] = 'smartnewsletter.png';
		$config['classes7'] ='autonews';
		return $config;
	}


	/**
	 * This function is used to get the computed last date process same time the next date to process the next SmartNewsletter
	 * @param $delayMin int in terms seconds the mininum delay specified in the smartnewsletter
	 * @param $currentDate int in terms seconds the current date at which we want to create a new newsletter
	 * @return $computedDate object the computed date with corresponding properties
	 */
	public static function computeSmartDate( $delayMin, $currentDate, $myTime ) {

		if( empty($currentDate) || empty($delayMin) ) return;

		$computedDate = new stdClass;

		$delay = 0;
		$monthlay = 0;
		$seconds = 0;

		switch ($delayMin ) {
			case '1':	// daily
			case '2':
				$delay = 1;
				break;
			case '3':	// every other day
			case '4':
				$delay = 2;
				break;
			case '5':	// weekly
				$delay = 7;
				break;
			case '6':	// bi -weekly
				$delay = 14;
				break;
			case '7':	//monthly
				$monthlay = 1;
				break;
			case '8':	// quaterly
				$monthlay = 3;
				break;
			case '9':	// yearly
				$monthlay = 12;
				break;
			default :	// 1800 every 30 minutes, 3600 every hours , 43200 every 12 hours
				$seconds = $delayMin;
				break;
		}

		$tm = $currentDate;

		$lastDate = @mktime( date("H", $tm), date("i", $tm), date("s", $tm), date("m", $tm)-$monthlay, date("d", $tm)-$delay , date("Y", $tm) );
		$lastDate = $lastDate - $seconds;
		$computedDate->lastDate = $lastDate;

		$computedDate->next_date = @mktime( date("H", $myTime), date("i", $myTime), date("s", $myTime), date("m", $myTime) + $monthlay, date("d", $myTime) + $delay, date("Y", $myTime) );
		$computedDate->next_date = $computedDate->next_date + $seconds;

		return $computedDate;

	}


	/**
	 * This function is used to get the computed last date process same time the next date to process the next SmartNewsletter
	 * @param $delayMin int in terms seconds the mininum delay specified in the smartnewsletter
	 * @param $currentDate int in terms seconds the current date at which we want to create a new newsletter
	 * @return $computedDate object the computed date with corresponding properties
	 */
	public static function AddDelay( $currentDate, $delayMin, $addORsubstract='+' ) {

		if( empty($currentDate) ) return 0;
		if( empty($delayMin) ) return $currentDate;

		$delay = 0;
		$monthlay = 0;
		$seconds = 0;

		switch ($delayMin ) {
			case '1':	// daily
			case '2':
				$delay = 1;
				break;
			case '3':	// every othe rday
			case '4':
				$delay = 2;
				break;
			case '5':	// weekly
				$delay = 7;
				break;
			case '6':	// bi -weekly
				$delay = 14;
				break;
			case '7':	//monthly
				$monthlay = 1;
				break;
			case '8':	// quaterly
				$monthlay = 3;
				break;
			case '9':	// yearly
				$monthlay = 12;
				break;
			default :	// 1800 every 30 minutes, 3600 every hours , 43200 every 12 hours
				$seconds = $delayMin;
				break;
		}

		if ( $addORsubstract == '-' ) {
			$monthlay = $monthlay * -1;
			$delay = $delay * -1;
			$seconds = $seconds * -1;
		}

		$newDate = @mktime( date("H", $currentDate), date("i", $currentDate), date("s", $currentDate), date("m", $currentDate) + $monthlay, date("d", $currentDate) + $delay , date("Y", $currentDate) );
		$newDate = $newDate + $seconds;
		return $newDate;

	}

/**
 *
 * Create a new smart newsletter if there is new articles retreived
 */
	 public static function createSmartNewsletters() {
		if (!jNews_Auto::good()) return '';
		$HTML = '';

		//check if we have a smart-newsletter to create
		$db = JFactory::getDBO();
		$query = 'SELECT * FROM `#__jnews_queue` WHERE `type`=7';
		$db->setQuery($query);
		$allSNA = $db->loadObjectList();
		if ( empty($allSNA) ) return '';
//		$jNewsTime = jnews::getNow();
		$time = time();

		$nextDates = array();

		$useCurrentTimeAsRef = true;

		foreach( $allSNA as $oneSN ) {

			//create a newsletter out of the smart-newsletter
			$query = 'SELECT * FROM `#__jnews_mailings` WHERE `id`=' . (int)$oneSN->mailing_id;
			$query .= ' AND `next_date` < ' .$time;
			$query .= ' AND `start_date` <= ' . $time;
			$query .= ' LIMIT 1';

			$db->setQuery($query);
			$mailing = $db->loadObject();

			//this happen if the mailing_id in the queue is not the same as the mailing id
			if( empty($mailing) ) {
//				$HTML .= 'There is no SmartNewsletter to generate yet for the ID ' . $oneSN->mailing_id .'<br>A SmartNewsletter will be generated after this date: '.date('Y-m-d H:i:s', jnews::getNow( 0, true, $oneSN->delay ) ).'<br/>';
//				$HTML .=  'The current time is: ' .date( 'Y-m-d H:i:s', jnews::getNow( 0, true, $time ) ) .'<br/><br/>';
				$HTML .= JText::sprintf( _JNEWS_AUTONEWS_NO_SMARTNEWS_GENERATE_IDS, $oneSN->mailing_id );
				$HTML .= '<br/>';
				$HTML .= JText::sprintf( _JNEWS_AUTONEWS_NO_SMARTNEWS_GENERATE_DATE, date('Y-m-d H:i:s', jnews::getNow( 0, true, $oneSN->delay ) ) );
				$HTML .= '<br/>';
				$HTML .= JText::sprintf( _JNEWS_AUTONEWS_NO_SMARTNEWS_GENERATE_TIME, date( 'Y-m-d H:i:s', jnews::getNow( 0, true, $time ) ) );
				$HTML .= '<br/><br/>';
				continue;
			}

			if ( $oneSN->delay < $time ) {

				if ( $useCurrentTimeAsRef ) $timeReference = $time;
				else $timeReference = $oneSN->delay;

				$articleStart = $mailing->start_date;
				$articleEnd = $mailing->next_date;

				//if delay is less than 1 daywe do differently than the others
				if ( $mailing->delay_min > 10 ) {
									if ( $mailing->delay_min > 10 ) {
					if ( $articleEnd < $time ) $articleEnd = $time;
				}

				}

				$nextProcessingQueue = jNews_Autonews::AddDelay( $articleEnd, $mailing->delay_min, '+' );
				$nextArticleStart = $articleEnd;
				$nextArticleEnd = $nextProcessingQueue;

				//update main SM with next_date for mailing
				$query = 'UPDATE `#__jnews_mailings` SET';
				$query .= ' `next_date` = '. (int)$nextArticleEnd;
				$query .= ' ,`start_date` =' . $db->escape($nextArticleStart);
				$query .= ' WHERE `id` = '. (int)$mailing->id;
				$db->setQuery($query);
				$db->query();

				//update the queue with for main SM with new next date ... delay for queue
				$query = 'UPDATE `#__jnews_queue` SET';
				$query .= ' `delay` = '. (int)$nextProcessingQueue;
				$query .= ' WHERE `mailing_id` = '. (int)$mailing->id;
				$db->setQuery($query);
				$db->query();

				if(empty($mailing)) return '';

				$newmailing = jNews_Autonews::loadSmartContent( $mailing, $articleStart, $articleEnd );	// $computedDate->lastDate, $delay );

				jNews_Autonews::insertSmartMailing( $newmailing, $articleEnd ) ;

			}

		}

		return $HTML;
	}



    /**
	 * $mailing - orig sn
	 * @param $lastDate - computed last date from time now
	 *@param $delay - frequency of the sn
	 */
	public static function loadSmartContent( $mailing, $startDate, $endDate ) {

		$mainframe = JFactory::getApplication();

		$originalMailingID = $mailing->id;

		//we check if the tag for the flexicontent is in the smartnewsletter
        //and if there is we call the plugin of jomsocial which is also integrated with flexicontent
        $pos = strpos($mailing->htmlcontent, '[SMARTFLEXI]');

        if($pos !== false)
        {

        	$mailing = jNews_Mailing::getOneMailingSmart( $originalMailingID, 0 );
        	if(!empty($mailing)) $mailing->originalId = $originalMailingID;
        	$mailing->delay = $originalMailingID;	// we use the delay column to store the mailing ID of the smart-newsletter
//		    $mailing->issue_nb = $currentList+1;
		    $mailing->published = 1;
		    $mailing->send_date = time();
                    $mailing->id = 0;
                    $newmailing = $mailing;
        }
        //we check if the [SMART NEWSLETTER] tag is in the the body of the mailing

        $pos2 = strpos( $mailing->htmlcontent, '[SMARTK2]' );
        if($pos2 !== false)
        {
              $newmailing = jNews_Autonews::smartNewsLetterOrK2('[SMARTK2]',$pos2, $startDate, $endDate, $mailing, $mainframe, $originalMailingID);
        }
        else
        {
             $pos = strpos( $mailing->htmlcontent, '[SMARTNEWSLETTER]' );
             $newmailing = jNews_Autonews::smartNewsLetterOrK2('[SMARTNEWSLETTER]',$pos, $startDate, $endDate, $mailing, $mainframe, $originalMailingID);
        }


        return $newmailing;


//          if ( $pos !== false )
//        {
//
//			$newmailing = new stdClass;
//
//			$startTime = jNews_Autonews::getDBDate( $startDate );
//			$endTime = jNews_Autonews::getDBDate( $endDate );
//
//			$smartNews = '';
//
//			//created or modified or publish_up
//			if ( empty($mailing->smart_date) ) $mailing->smart_date = 0;
//			$mailing->smart_date = (int)$mailing->smart_date;
//			switch( $mailing->smart_date ) {
//				case 1:
//					$DateReference = 'modified';
//					break;
//				case 2:
//					$DateReference = 'publish_up';
//					break;
//				default:
//				case 0:
//					$DateReference = 'created';
//					break;
//
//			}
////			$DateReference = ( !empty($mailing->smart_date) ) ? 'modified' : 'created';
//
//			$query = 'SELECT `id` FROM `#__content`';
//			$query .= ' WHERE ';
//			$query .= '( `'.$DateReference.'`>\''. $db->escape($startTime) .'\' AND `'.$DateReference.'`<=\''. $db->escape($endTime) .'\' AND (';
//			$query .= '`publish_up`<=\''. $db->escape($endTime) .'\' AND (`publish_down`>=\''. $db->escape($endTime) .'\' OR `publish_down`=\'0000-00-00 00:00:00\') )';
//
////			$query .= ' OR ( `publish_up`>\''.$startTime.'\' AND (`publish_down`>=\''.$endTime.'\' ) )';
//
//			$query .= ')';
//			$query .= ' AND `state` = 1';
//
//			$conditions = array();
//			$catIDs = trim( $mailing->cat_id );
//			if ( !empty($catIDs) && $catIDs !='0:0' )
//                        {
//				$allCategories = explode(',', $catIDs );
//
//				foreach($allCategories as $oneCat){
//			        $secat = explode(':',$oneCat);
//
//			        if( version_compare(JVERSION,'1.6.0','<') ){ 
//
//			        	//entire section
//			        	if(empty($secat[1])) {
//				            $conditions[] = '`sectionid`='.intval($secat[0]);
//				        } else {
//				        	$conditions[] = '`sectionid`='.intval($secat[0]).' AND `catid`='.intval($secat[1]);
//				        }
//
//			        } else {
//			        	if(!empty($secat[1])) {
//				            $conditions[] = '`catid`='.intval($secat[1]);
//				        }
//
//			        }
//
//				}
//
//				if( !empty($conditions) ) $query .= ' AND ((' . implode(') OR (',$conditions). '))';
//			}
//
//			$ordering[0] = ' ORDER BY `created` DESC ';
//			$ordering[1] = ' ORDER BY `title` ASC ';
//			$ordering[2] = ' ORDER BY `ordering` ASC ';
//
//		    $query .= $ordering[$mailing->notify_id];
//		    $db->setQuery($query);
//		    $newsLists = $db->loadObjectList();
//
//		    if ( empty($newsLists) ) {
//
//				$mailing->htmlcontent = str_replace('[SMARTNEWSLETTER]', _JNEWS_AUTONEWS_NO_ARTICLE , $mailing->htmlcontent );
//		    	return $mailing;
//		    }
//
//			//traces for admin
//		    if ( $mainframe->isAdmin() ) {
//		    	$nbArticles = count($newsLists);
//		    	$message = JText::sprintf( _JNEWS_AUTONEWS_SMARTNEWS_PROCESS, $mailing->subject, $nbArticles, date( 'Y-m-d H:i:s', jnews::getNow( 0, true, $startDate ) ), date( 'Y-m-d H:i:s', jnews::getNow( 0, true, $endDate ) ) );
//
//		    	if($nbArticles > 0){
//		    		jnews::printM('ok' , $message);
//		    	}else{
//		    		jnews::printM('blue' , $message);
//		    	}
//			}
//
//		    foreach( $newsLists as $newsList ) {
//				// we use the column delay max to define if we want introduction, full article or anything else
//				// we use the column smart_date to define whhich date to take created or modified
//		    	$smartNews .= '{contentitem:'.$newsList->id.'|'.$mailing->delay_max.'|'.$mailing->smart_date.'}';
//				$smartNews .= '<br /><br />';
//		    }
//
//	        $mailing = jNews_Mailing::getOneMailingSmart( $originalMailingID, 0 );
//
//			if(!empty($mailing)){
//
//		    	$mailing->originalId = $originalMailingID;
//
//		    	//to get the issue number
//		        $query = "SELECT COUNT(*) FROM #__jnews_mailings";
//				$query .= " WHERE `published` != -1 AND `mailing_type`=7 AND delay=" . (int)$originalMailingID;
//				$db->setQuery($query);
//				$currentList = $db->loadResult();
//
//		        $mailing->delay = $originalMailingID;	// we use the delay column to store the mailing ID of the smart-newsletter
//		        $mailing->issue_nb = $currentList+1;
//		        $mailing->published = 1;
//		        $mailing->send_date = time();
//				$mailing->id = 0;
//
//				//replace the smartnewsletter with the {content} tag
//		        $mailing->htmlcontent = str_replace('[SMARTNEWSLETTER]', $smartNews , $mailing->htmlcontent );
//
//		        if ( !empty($mailing->textonly) ){
//		            $mailing->textonly = str_replace('[SMARTNEWSLETTER]', $smartNews , $mailing->textonly);
//		            $mailing->textonly = str_replace(array('<br>', '<br/>', '<br />', '<br >','<BR >', '<BR>', '<BR/>', '<BR />', '</p>', '</P>', '<p />', '<p/>', '<P />', '<P/>'), "\n", $mailing->textonly);
//		        }
//
//			 	$newmailing = $mailing;
//
//			}
//            }
//            else
//            {
//
//			// no SMART NEWSLETTER tag required
//			 $mailing = jNews_Mailing::getOneMailingSmart( $originalMailingID, 0 );
//			if ( !empty($mailing) ) {
//
//		    	$mailing->originalId = $originalMailingID;
//
//		    	//to get the issue number
//		        $query = "SELECT COUNT(*) FROM #__jnews_mailings";
//				$query .= " WHERE `published` != -1 AND `mailing_type`=7 AND delay=" . (int)$originalMailingID;
//				$db->setQuery($query);
//				$currentList = $db->loadResult();
//
//		        $mailing->delay = $originalMailingID;	// we use the delay column to store the mailing ID of the smart-newsletter
//		        $mailing->issue_nb = $currentList+1;
//		        $mailing->published = 1;
//		        $mailing->send_date = time();
//				$mailing->id = 0;
//
//			}
//
//			$newmailing = $mailing;
//
//            }



	}

        public static function smartNewsLetterOrK2($smartnewsletter_or_smartk2, $pos, $startDate, $endDate, $mailing, $mainframe, $originalMailingID)
        {
            $db = JFactory::getDBO();
            if ( $pos !== false )
            {
                     $newmailing = new stdClass;

                    $startTime = jNews_Autonews::getDBDate( $startDate );
                    $endTime = jNews_Autonews::getDBDate( $endDate );

                    $smartNews = '';

                    //created or modified or publish_up
                    if ( empty($mailing->smart_date) ) $mailing->smart_date = 0;
                    $mailing->smart_date = (int)$mailing->smart_date;
                    switch( $mailing->smart_date )
                    {
                            case 1:
                                    $DateReference = 'modified';
                                    break;
                            case 2:
                                    $DateReference = 'publish_up';
                                    break;
                            default:
                            case 0:
                                    $DateReference = 'created';
                                    break;

                    }
                    $where_search_db = ($smartnewsletter_or_smartk2 == '[SMARTNEWSLETTER]') ? '#__content' : '#__k2_items';
                    $state_or_published = ($smartnewsletter_or_smartk2 == '[SMARTNEWSLETTER]') ? 'state' : 'published';
//			$DateReference = ( !empty($mailing->smart_date) ) ? 'modified' : 'created';

                    $query = 'SELECT `id` FROM `'.$where_search_db.'` ';
                    $query .= ' WHERE ';
                    $query .= '( `'.$DateReference.'`>\''. $db->escape($startTime) .'\' AND `'.$DateReference.'`<=\''. $db->escape($endTime) .'\' AND (';
                    $query .= '`publish_up`<=\''. $db->escape($endTime) .'\' AND (`publish_down`>=\''. $db->escape($endTime) .'\' OR `publish_down`=\'0000-00-00 00:00:00\') )';

                    $query .= ')';
                    $query .= ' AND `'.$state_or_published.'` = 1';


                    $conditions = array();
                    $catIDs = trim( $mailing->cat_id );
                    if ( ! empty($catIDs) && $catIDs !='0:0' )
                    {
                            $allCategories = explode(',', $catIDs );

                            foreach($allCategories as $oneCat)
                            {
                                $secat = explode(':',$oneCat);

                                if( version_compare(JVERSION,'1.6.0','<') )
                                { 
                                        //entire section
                                        if(empty($secat[1])) {
                                            $conditions[] = '`sectionid`='.intval($secat[0]);
                                        } else {
                                                $conditions[] = '`sectionid`='.intval($secat[0]).' AND `catid`='.intval($secat[1]);
                                        }

                                }
                                else
                                {
                                        if(!empty($secat[1])) {
                                            $conditions[] = '`catid`='.intval($secat[1]);
                                        }

                                }

                            }

                            if( !empty($conditions) )
                                $query .= ' AND ((' . implode(') OR (',$conditions). '))';
                    }

                    $ordering[0] = ' ORDER BY `created` DESC ';
                    $ordering[1] = ' ORDER BY `title` ASC ';
                    $ordering[2] = ' ORDER BY `ordering` ASC ';

		    $query .= $ordering[$mailing->notify_id];
		    $db->setQuery($query);
		    $newsLists = $db->loadObjectList();
		    if ( empty($newsLists) )
                    {
                            $mailing->htmlcontent = str_replace($smartnewsletter_or_smartk2, _JNEWS_AUTONEWS_NO_ARTICLE , $mailing->htmlcontent );
                            $mailing->notfindarticle = true;
                            return $mailing;

		    }

			//traces for admin
		    if ( $mainframe->isAdmin())
                    {
		    	$nbArticles = count($newsLists);
		    	$message = JText::sprintf( _JNEWS_AUTONEWS_SMARTNEWS_PROCESS, $mailing->subject, $nbArticles, date( 'Y-m-d H:i:s', jnews::getNow( 0, true, $startDate ) ), date( 'Y-m-d H:i:s', jnews::getNow( 0, true, $endDate ) ) );

		    	if($nbArticles > 0){
		    		jnews::printM('ok' , $message);
		    	}else{
		    		jnews::printM('blue' , $message);
		    	}
                    }

		    foreach( $newsLists as $newsList )
                    {
                             $contentitem_or_k2item = ($smartnewsletter_or_smartk2 == '[SMARTNEWSLETTER]') ? '{contentitem:' : '{k2item:';
				// we use the column delay max to define if we want introduction, full article or anything else
				// we use the column smart_date to define whhich date to take created or modified
                            $smartNews .= $contentitem_or_k2item.$newsList->id.'|'.$mailing->delay_max.'|'.$mailing->smart_date.'}';
                            $smartNews .= '<br /><br />';
		    }

                    if( ! isset($mailing->originalId) OR $smartnewsletter_or_smartk2 == '[SMARTNEWSLETTER]')
                    {
                           $mailing = jNews_Mailing::getOneMailingSmart( $originalMailingID, 0 );
                    }


                    if(!empty($mailing))
                    {

		    	$mailing->originalId = $originalMailingID;

		    	//to get the issue number
		        $query = "SELECT COUNT(*) FROM #__jnews_mailings";
                        $query .= " WHERE `published` != -1 AND `mailing_type`=7 AND delay=" . (int)$originalMailingID;
                        $db->setQuery($query);
                        $currentList = $db->loadResult();

		        $mailing->delay = $originalMailingID;	// we use the delay column to store the mailing ID of the smart-newsletter
		        $mailing->issue_nb = $currentList+1;
		        $mailing->published = 1;
		        $mailing->send_date = time();
                        $mailing->id = 0;

				//replace the smartnewsletter with the {content} tag
		        $mailing->htmlcontent = str_replace($smartnewsletter_or_smartk2, $smartNews , $mailing->htmlcontent );

		        if ( !empty($mailing->textonly) )
                        {
		            $mailing->textonly = str_replace($smartnewsletter_or_smartk2, $smartNews , $mailing->textonly);
		            $mailing->textonly = str_replace(array('<br>', '<br/>', '<br />', '<br >','<BR >', '<BR>', '<BR/>', '<BR />', '</p>', '</P>', '<p />', '<p/>', '<P />', '<P/>'), "\n", $mailing->textonly);
		        }

                return $newmailing = $mailing;

                    }
            }
            else
            {

			// no SMART NEWSLETTER tag required
			$mailing = jNews_Mailing::getOneMailingSmart( $originalMailingID, 0 );

			if ( ! empty($mailing) )
                        {
                                $mailing->originalId = $originalMailingID;

                                //to get the issue number
                                $query = "SELECT COUNT(*) FROM #__jnews_mailings";
                                $query .= " WHERE `published` != -1 AND `mailing_type`=7 AND delay=" . (int)$originalMailingID;
                                $db->setQuery($query);
                                $currentList = $db->loadResult();

                                $mailing->delay = $originalMailingID;	// we use the delay column to store the mailing ID of the smart-newsletter
                                $mailing->issue_nb = $currentList+1;
                                $mailing->published = 1;
                                $mailing->send_date = time();
				$mailing->id = 0;

			}

			return $newmailing = $mailing;

            }
        }
/**
	 * function to insert the mailing in the queue
	 * @param - just added $lastDate to save in the queue to be be able to retrieve articles from the last Date
	 * */
	private static function insertSmartMailing( $mailing, $lastDate ){
		if (empty($mailing)) return false;
                if (isset($mailing->notfindarticle) && $mailing->notfindarticle) return false;

		$db = JFactory::getDBO();
		$originalMailingID = $mailing->originalId;

                $newMailingID = jNews_Mailing::insertMailingData( $mailing );

                if ($newMailingID)
                {
//		if ( !empty($newMailingID) ) {
			$query = 'SELECT `list_id` FROM `#__jnews_listmailings` WHERE `mailing_id`=' . (int)$originalMailingID ;
			$db->setQuery($query);
			$loadResultArray = $db->loadObjectList();
			$existingListIDA = jnews::convertObjectList2Array( $loadResultArray );

			if ( empty($existingListIDA) ) return false;

			$query = 'INSERT IGNORE INTO `#__jnews_listmailings` (`list_id`,`mailing_id`) VALUES ('.jnews::implode( ',' . (int)$newMailingID . '),(', $existingListIDA) .',' . (int)$newMailingID . ')';
			$db->setQuery( $query );
			$db->query();

			//we set the queue and insert type 1
			$query = 'INSERT IGNORE INTO `#__jnews_queue` (`subscriber_id`,`type` , `mailing_id`, `issue_nb`,`send_date`, `suspend` , `delay`, `acc_level`, `published`, `priority`, `attempt`,`params`)';
			$query.= '( SELECT A.`subscriber_id`,';
			$query.= '1,';
			$query.= intval($newMailingID) . ',';
			$query.= '0,';
			$query .= (int)$mailing->send_date .',';
			$query.=  '0,';
			$query.= (int)$lastDate.',';//'0,';//we will save here the lastDate, we will need the lastDate in getting the latest articles from flexicontent
			$query.= '29,';
			$query.= '2,';
			$query.= '1,';
			$query.= '0,';
			$query.= 'A.`params`';
			$query.=' FROM `#__jnews_listssubscribers` AS A ';
			$query.=' LEFT JOIN `#__jnews_subscribers` AS B ON A.`subscriber_id`=B.`id` ';
			$query.=' WHERE A.`list_id` IN ('. jnews::implode(',',$existingListIDA) . ')';
			$query.=' AND A.`unsubscribe`=0';
			$query.=' AND B.`confirmed`=1)';

			$db->setQuery($query);
			$db->query();
                        //create letter with type = 99 for report to admin
                        jNews_Autonews::createReportToADmin($originalMailingID, $mailing->send_date + 60);
            	}

		return true;

	}

        public static function createReportToADmin($originalMailingID, $time)
        {
            jNews_Queue::insertReportInQueue($originalMailingID, $time);
        }


/**
 *
 * convert time in Joomla article time format
 * @param int $time
 * @param int $delay
 */
	public static function getDBDate( $time=0, $delay=0 ) {
		if(empty($time)) $time = time();
		$time = $time - date('Z');	// to adjust to the server time zone
		return @date( 'Y-m-d H:i:s',$time + $delay*60 );
	}


     public static function edit($listEdit, $lists, $show) {
		$mainframe = JFactory::getApplication();
			$db = JFactory::getDBO();
			JHTML::_('behavior.calendar');

		if (empty($listEdit->cat_id)) {
			$listEdit->cat_id= '0:0';
		}
	?><fieldset class="jnewscss jnewshead">

	<table cellspacing="0" border="0" cellspacing="0">
		<tbody>
		<tr>
		<td valign="top">
	<table class="jnewstable" cellspacing="1" border="0">
		<tbody>
		<tr>
			<td width="110px" class="key">
				<span class="editlinktip">
				<?php
					$tip = _JNEWS_INFO_LIST_SUBJET ;
					$title = _JNEWS_SUBJECT;
					echo jNews_Tools::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php
				 	$text = str_replace('"', '&quot;' , $listEdit->subject);
				 	if (function_exists('htmlspecialchars_decode')) {
				 		$text = htmlspecialchars_decode( $text , ENT_NOQUOTES);
				 	} elseif (function_exists('html_entity_decode')) {
				 		$text = html_entity_decode( $text , ENT_NOQUOTES);
				 	}
				 	$fieldsize = $mainframe->isAdmin() ? '50' : '25';
					echo ' <input type="text" name="subject" class="inputbox" size="'.$fieldsize.'" maxlength="64" value="' .  $text  .'" />' ;
				 ?>
			</td>
		</tr>
		<?php if ($show['hide']) {?>
		<tr>
			<td width="80" class="key">
				<span class="editlinktip">
				<?php
					$tip = _JNEWS_INFO_MAILING_VISIBLE;
					$title = _JNEWS_VISIBLE_FRONT;
					echo jNews_Tools::toolTip( $tip, '', 280, 'tooltip.png',  $title, '', 0 );
				?>
				</span>
			</td>
			<td><?php echo $lists['visible']; ?></td>
		</tr>
		<?php } ?>
		<?php
				 $javascript = "function updateEditor(htmlvalue){";
				 $javascript .= 'if(htmlvalue == \'0\'){window.document.getElementById("htmlfieldset").style.display = \'none\'}else{window.document.getElementById("htmlfieldset").style.display = \'block\'}';
				 $javascript .= '}';
	             $javascript .='window.addEvent(\'load\', function(){ updateEditor('.$listEdit->html.'); });';
	           	 $script = "function setHiddenValue(catid,notifyid,delaymax,tag_count,smartdate){
								var jnewscatid =$('cat_id'); jnewscatid.value = catid;
								var jnewsnotifyid =$('notify_id'); jnewsnotifyid.value = notifyid;
								var jnewsdelaymax =$('delay_max'); jnewsdelaymax.value = delaymax;
								var jnewssmartdate =$('smart_date'); jnewssmartdate.value = smartdate;
								var jnewstagcount =$('tag_count'); jnewstagcount.value = jnewstagcount.value+tag_count;
	           	 			}";

	             $doc = JFactory::getDocument();
	             $doc->addScriptDeclaration($javascript.$script);
				?>
				<tr>
					<td width="185" class="key">
						<span class="editlinktip">
						<?php
							$tip = _JNEWS_INFO_LIST_HTML;
							$title = _JNEWS_HTML_MAILING;
							echo jNews_Tools::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
						?>
					</td>
					<td>
						<?php echo $lists['html_mailings'];?>
					</td>
				</tr>
		</tbody>
	</table>
</td>
<td valign="top">
	<table>
		<tbody>
				<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _JNEWS_AUTONEWS_STARTDATE_TIPS;
					$title = _JNEWS_AUTONEWS_STARTDATE;
					echo jNews_Tools::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php

			      	if ( empty($listEdit->start_date) ) {
			      		if (!isset($doc)) $doc = JFactory::getDocument();
				       	$doc->addStyleSheet(JNEWS_URL_INCLUDES.'calendar2/css/calendar.css');
				      	$doc->addScript(JNEWS_URL_INCLUDES.'calendar2/js/calendar.js');
				      	?>
						<input id="acaCalendar" type="text" value="<?php if( !empty($listEdit->start_date)) { echo date( 'Y-m-d H:i' ,jnews::getNow( 0, true, $listEdit->start_date ) ); } else { echo date( 'Y-m-d H:i', jnews::getNow( 0, true ) ); } ?>" readonly name="start_date">
						<input title="<?php echo _JNEWS_DATETIME; ?>" type="button" class="calendarDash" value="" onclick="displayCalendar(document.getElementById('acaCalendar'),'yyyy-mm-dd hh:ii',this,true)">
						<?php
			      	} else {
			      		$listEdit->start_date = date('Y-m-d H:i',jnews::getNow( 0, true, $listEdit->start_date ) );
						echo $listEdit->start_date;
						echo '<input type="hidden" id="start_date" name="start_date" value="' . $listEdit->start_date . '" />';
			      	}
				?>

			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					echo jNews_Tools::toolTip( _JNEWS_AUTONEWS_NEXT_GEN_TIPS, '', 280, 'tooltip.png', _JNEWS_AUTONEWS_NEXT_GEN, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php
				if ( empty($listEdit->next_date) ) {
					$listEdit->next_date = date('Y-m-d H:i', jnews::getNow( 0, true ) + 1500 );	// so the preview works fine
					echo '<input class="inputbox" type="text" name="next_date" id="next_date" size="24" maxlength="22" value="' . $listEdit->next_date . '" />';
				} else {
					$listEdit->next_date = date('Y-m-d H:i',jnews::getNow( 0, true, $listEdit->next_date ) );
					echo $listEdit->next_date;
					echo '<input type="hidden" id="next_date" name="next_date" value="' . $listEdit->next_date . '" />';
				}
				?>

			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _JNEWS_AUTONEWS_FREQ_TIPS;
					$title = _JNEWS_AUTONEWS_FREQ;
					echo jNews_Tools::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['delay_min'];?>
			</td>
		</tr>
		</tbody>
	</table>
</td>
</tr>
</tbody>
</table>
	</fieldset>
		<input type="hidden" id="cat_id" name="cat_id" value="<?php echo $lists['catid']; ?>" />
		<input type="hidden" id="notify_id" name="notify_id" value="<?php echo $lists['notify_id']; ?>" />
		<input type="hidden" id="delay_max" name="delay_max" value="<?php echo $lists['delay_max']; ?>" />
		<input type="hidden" id="smart_date" name="smart_date" value="<?php echo $lists['smart_date']; ?>" />
		<input type="hidden" id="tag_count" name="tag_count" value="" />
	<?php

	}

	public static  function selectCat($mailing){
		$js = "function insertTagHidden(tag){
					var form = document.adminForm;
					if(!form){
						form = document.mosForm;
					}
					var contentcatid = form.autocontenttag.value;
					var contentdelay = 0;
					var contentnotify = 0;
					var tagcount = 1;
					for( i = 0; i < form.smart_date.length; i++ ){
						if(form.smart_date[i].checked == true)
						smartdate = form.smart_date[i].value;
					}
					for( i = 0; i < form.delay_max.length; i++ ){
						if(form.delay_max[i].checked == true)
						contentdelay = form.delay_max[i].value;
					}
					for( x = 0; x < form.notify_id.length; x++ ){
						if(form.notify_id[x].checked == true)
						contentnotify = form.notify_id[x].value;
					}
					if(contentcatid == ''){
	           	 		alert('"._JNEWS_TAGSMART_ALERT_SELECT."');
					}else{
						window.top.setHiddenValue(contentcatid,contentnotify,contentdelay,tagcount,smartdate);
						var tagcountValue = window.top.$('tag_count').value;

						if ( tagcountValue < 2) {";
				if( version_compare(JVERSION,'1.6.0','<') ){//1.5
					$js .= " if(window.top.insertTag(tag)){window.top.document.getElementById('sbox-window').close();}";
				}else if(version_compare(JVERSION,'3.0.0','<')){
                                        $js .= ' if(window.top.insertTag(tag)) {window.parent.SqueezeBox.close();}';
                                }else {$js .= ' if(window.top.insertTag(tag)) {
                                          var need_click = jQuery(window.top.document).find("div.modal-backdrop");
                    if(need_click.length == 0) window.parent.SqueezeBox.close();
                    else    jQuery(window.top.document).find("div.modal-backdrop").click();}';
                                }
		$js .= "}else {";
				if( version_compare(JVERSION,'1.6.0','<') ){//1.5
					$js .= " window.top.document.getElementById('sbox-window').close();";
                                }else if(version_compare(JVERSION,'3.0.0','<')){
					$js .=  " window.parent.SqueezeBox.close();";
				}
                                else {
                                    $js .= ' var need_click = jQuery(window.top.document).find("div.modal-backdrop");
						                    if(need_click.length == 0) window.parent.SqueezeBox.close();
						                    else    jQuery(window.top.document).find("div.modal-backdrop").click();';
                                }
		$js .= "}
					}
				}";

		$doc = JFactory::getDocument();
		$doc->addScriptDeclaration($js);
		//if(!empty($mailing->cat_id))$mailing->cat_id = base64_decode($mailing->cat_id);
		$mailing->cat_id= (!empty($mailing->cat_id))? base64_decode($mailing->cat_id): '0:0';
			$db = JFactory::getDBO();
			if(version_compare(JVERSION,'1.6.0','<')){ 
				$query = "SELECT s.id as secid, s.title, c.id as catid, c.title as name"
				. "\n FROM #__categories as c LEFT JOIN #__sections AS s on c.section = s.id"
				. "\n WHERE s.id > 0 ORDER BY s.ordering, c.ordering";
			}else{
				$query = "SELECT c.id as catid, c.title as name"
				. "\n FROM #__categories as c"
				. "\n WHERE c.extension = 'com_content'  ORDER BY c.lft ASC";
			}
			$db->setQuery( $query );
			$allCats = $db->loadObjectList();

			$order[0] = _JNEWS_TAGPICKLIST_CREATED;
			$order[1] = _JNEWS_TAGPICKLIST_TITLE;
			$order[2] = _JNEWS_TAGPICKLIST_Order;

			$joomOrder = array();
			foreach($order as $key => $oneOrder){
				$joomOrder[] = jnews::HTML_SelectOption(  $key, $oneOrder );
			}
			if( !isset($lists['notify_id']) ) $lists['notify_id'] = null;
			$lists['notify_id'] = jnews::HTML_RadioList($joomOrder,'notify_id', 'class="inputbox"','value','text', ( isset( $mailing->notify_id) ) ? $mailing->notify_id : 0);
			$jour[] = jnews::HTML_SelectOption(  '0', _JNEWS_FULL_ARTICLE );
			$jour[] = jnews::HTML_SelectOption(  '1', _JNEWS_INTRO_ONLY );
			$jour[] = jnews::HTML_SelectOption(  '2', _JNEWS_TITLE_ONLY );
			$lists['delay_max'] = jnews::HTML_RadioList($jour,'delay_max', 'class="inputbox"', 'value', 'text', ( isset( $mailing->delay_max ) ) ? $mailing->delay_max : 1);

			$dateType[] = jnews::HTML_SelectOption(  '0', _JNEWS_AUTONEWS_DATE_CREATED );
			$dateType[] = jnews::HTML_SelectOption(  '1', _JNEWS_AUTONEWS_DATE_MODIFIED );
			$dateType[] = jnews::HTML_SelectOption(  '2', _JNEWS_AUTONEWS_DATE_PUBLISHUP );

			$lists['smart_date'] = jnews::HTML_RadioList($dateType,'smart_date', 'class="inputbox"', 'value', 'text', ( isset( $mailing->smart_date ) ) ? $mailing->smart_date : 0);

	?>
<style type="text/css">
table.smartcontent {
	border: 1px solid #D5D5D5;
	background-color: #F6F6F6;
	width: 100%;
	margin-bottom: 10px;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	padding: 5px;
}
table.smartcontent td.key {
	background-color: #f6f6f6;
	text-align: left;
	width: 140px;
	color: #666;
	font-weight: bold;
	border-bottom: 1px solid #e9e9e9;
	border-right: 1px solid #e9e9e9;
}

table.autocontentlist{
	width:100%;border-spacing:1px;background-color:#fff;color:#666;
}
table.autocontentlist td,table.autocontentlist th{
	padding:4px;
}
table.autocontentlist thead th{
	text-align:center;color:#FFF;border-bottom:1px solid #999;border-left:1px solid #fff;
}
table.autocontentlist thead a:hover{
	text-decoration:none;
}table.autocontentlist thead a{
	color:#FFF;
}table.autocontentlist thead th img{
	vertical-align:middle;
}
table.autocontentlist tbody tr{
	text-align:left;
}
table.autocontentlist tbody tr.rowSection td,table.autocontentlist tbody tr.rowSection:hover td{
	background-color:#8addf1;
}
table.autocontentlist tbody tr.row0:hover td,table.autocontentlist tbody tr.row1:hover td{
	background-color:#ff9;
}
table.autocontentlist tbody tr td{
	height:25px;background:#fff;border:1px solid #fff;
}
table.autocontentlist tbody tr.row1 td{
	background:#fff;border-top:1px solid #FFF;
}
table.autocontentlist tfoot tr{
	text-align:center;color:#333;
}
table.autocontentlist tfoot td,table.autocontentlist tfoot th{
	background-color:#fff;border-top:1px solid #999;text-align:center;
}
table.autocontentlist td.order{
	text-align:center;
}
table.autocontentlist td.order span{
	float:left;display:block;width:20px;text-align:center;
}
table.autocontentlist thead th{
	background-repeat:repeat-x;
	background-color:#069;
}

table.autocontentlist tbody tr.row0 td{
	background:#f4f4ff;
}
table.autocontentlist tbody tr.row0:hover td,table.autocontentlist tbody tr.row1:hover td{
	background-color:#CFF;
}

table.autocontentlist tbody tr.rowSelected td,table.autocontentlist tbody tr.rowSelected:hover td{
	background-color:#87c331;
	font-weight: bold;
}

table.autocontentlist tbody tr td.colSelected,table.autocontentlist tbody tr td.colSelected:hover{
	background-color:#87c331;
	font-weight: bold;
	color: #FFF;
}

table.autocontentlist tbody tr.rowSelected,table.autocontentlist tbody tr.rowSelected:hover{
	background-color:#87c331;
	font-weight: bold;
	color: #FFF;
}

input.inserttag {
	height: 50px;
	font-size: 1.2em;
	cursor: pointer;
}
</style>
<form name="adminForm" method="post" action="index.php" id="adminForm">
<div id="element-box">
<div class="t">
	<div class="t">
		<div class="t"></div>
	</div>
</div>
<div class="m">
<table class="smartcontent">
	<tbody>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _JNEWS_TAGPICKLIST_ORDERINGTIP;
					$title = _JNEWS_TAGPICKLIST_ORDERING;
					echo jNews_Tools::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['notify_id']; ?>
			</td>
			<td rowspan="2">
			<input onclick="insertTagHidden('[SMARTNEWSLETTER]')" class="inserttag" type="button" label="Insert Tag" name="Insert Tag" value="<?php echo _JNEWS_TAG_INSERT_TAG; ?>" />
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _JNEWS_AUTONEWS_TYPE_TIPS;
					$title = _JNEWS_AUTONEWS_TYPE;
					echo jNews_Tools::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['delay_max']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _JNEWS_AUTONEWS_DATE_TIPS;
					$title = _JNEWS_AUTONEWS_DATE;
					echo jNews_Tools::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['smart_date']; ?>
			</td>
		</tr>
		<tr>
		<td width="185" class="key">
			<span class="editlinktip">
				Tag
			</span>
		</td>
		<td style="vertical-align: top;">
				<!--  <input type="text" onchange="setCaptionTags();" size="60px" name="jnewstagcaption"> -->
				<input type="text" size="60px" name="contenttag">
		</td>
	</tr>
	</tbody>
</table>
	<input type="hidden" size="50px" label="Insert Tag" name="autocontenttag" value="<?php echo $mailing->cat_id;?>"/>
<div id="element-box">
<div class="t">
	<div class="t">
		<div class="t"></div>
	</div>
</div>
<div class="m">
<script type="text/javascript">
<!--
 function inArray(needle, haystack) {
	var length = haystack.length;
	for(var i = 0; i < length; i++) {
		if(haystack[i] == needle) return true;
	}
	return false;
}
function insertSecCat(secid, catid){
	var form = document.adminForm;
	if(!form){
		form = document.mosForm;
	}
	form.contenttag.value = '[SMARTNEWSLETTER]';
	//all section and catergory
	if (catid ==0 && secid == 0){
		if($('autocontentSec'+secid+'Cat'+catid).className == ''){
			form.autocontenttag.value = secid+':'+catid;
			$('autocontentSec'+secid+'Cat'+catid).className = 'rowSelected';
			//we need to select also the columns in that row
			<?php
			$prevSecID0 = 0;
			foreach($allCats as $meow0){
				if(empty($meow0->secid)) $meow0->secid = 0;
				if ($prevSecID0 != $meow0->secid){
					?>
						$('autocontentSec<?php echo $meow0->secid;?>Cat0').className = 'rowSelected';
					<?php
				}
			?>
			$('autocontentSec<?php echo $meow0->secid;?>Cat<?php echo $meow0->catid;?>').className = 'colSelected';
			<?php
				$prevSecID0 = $meow0->secid;
			}
			?>
		}else{
			form.autocontenttag.value = '';
			$('autocontentSec'+secid+'Cat'+catid).className = '';
			<?php
			$prevSecID1 = 0;
			foreach($allCats as $meow1){
				if ($prevSecID1 != $meow1->secid){
					?>
						$('autocontentSec<?php echo $meow1->secid;?>Cat0').className = 'rowSection';
					<?php
				}
			?>
			$('autocontentSec<?php echo $meow1->secid;?>Cat<?php echo $meow1->catid;?>').className = '';
			<?php
				$prevSecID1 = $meow1->secid;
			}
			?>
		}
	}else{
		SecCatArray = form.autocontenttag.value.split(',');
		$('autocontentSec0Cat0').className = '';
		//all category in a section
		if (catid ==0 && secid != 0){
			if($('autocontentSec'+secid+'Cat'+catid).className == 'rowSection'){
				if (inArray(secid+':'+catid, SecCatArray)){
				//alert('true');
					form.autocontenttag.value = form.autocontenttag.value;
				}else{
				//alert('false');
					if(form.autocontenttag.value == ''){
					//alert('empty');
						form.autocontenttag.value = secid+':'+catid;
					}else{
						form.autocontenttag.value = form.autocontenttag.value+','+secid+':'+catid;
					}
				}

				$('autocontentSec'+secid+'Cat'+catid).className = 'rowSelected';
				//we need to select also the columns in that row
				<?php
				foreach($allCats as $meow2){
					if(empty($meow2->secid)) $meow2->secid = 0;
				?>
				if (secid==<?php echo $meow2->secid;?>){
					$('autocontentSec<?php echo $meow2->secid;?>Cat<?php echo $meow2->catid;?>').className = 'colSelected';
				}
				<?php
				}
				?>
			}else{
				if (inArray(secid+':'+catid, SecCatArray)){
				//alert('true');
					//we need remove the id in the array
					SecCatArray.splice(SecCatArray.indexOf(secid+':'+catid), 1);
					form.autocontenttag.value = SecCatArray.join(',') ;
				}else{
				//alert('false');
					if(form.autocontenttag.value == ''){
						form.autocontenttag.value = secid+':'+catid;
					}else{
						form.autocontenttag.value = form.autocontenttag.value+','+secid+':'+catid;
					}
				}
				$('autocontentSec'+secid+'Cat'+catid).className = 'rowSection';
				<?php
				foreach($allCats as $meow3){
				?>
				if (secid==<?php echo $meow3->secid;?>){
					$('autocontentSec<?php echo $meow3->secid;?>Cat<?php echo $meow3->catid;?>').className = '';
				}
				<?php
				}
				?>
			}
		}else{
			$('autocontentSec0Cat0').className = '';
			$('autocontentSec'+secid+'Cat0').className = 'rowSection';
			if($('autocontentSec'+secid+'Cat'+catid).className == 'colSelected'){
				$('autocontentSec'+secid+'Cat'+catid).className = '';
				if (inArray(secid+':'+catid, SecCatArray)){
				//alert('true');
					//we need remove the id in the array
					SecCatArray.splice(SecCatArray.indexOf(secid+':'+catid), 1);
					form.autocontenttag.value = SecCatArray.join(',') ;
				}else{
				//alert('false');
					if(form.autocontenttag.value == ''){
						form.autocontenttag.value = secid+':'+catid;
					}else{
						form.autocontenttag.value = form.autocontenttag.value+','+secid+':'+catid;
					}
				}

			}else{
				$('autocontentSec'+secid+'Cat'+catid).className = 'colSelected';
				if (inArray(secid+':'+catid, SecCatArray)){
				//alert('true');
					form.autocontenttag.value = form.autocontenttag.value;
				}else{
				//alert('false');
					if(form.autocontenttag.value == ''){
						form.autocontenttag.value = secid+':'+catid;
					}else{
						form.autocontenttag.value = form.autocontenttag.value+','+secid+':'+catid;
					}
				}

			}
		}
	}
}
//-->
</script>
<table class="autocontentlist" cellpadding="0" cellspacing="0">
	<tbody>
		<thead>
			<tr>
				<?php if(version_compare(JVERSION,'1.6.0','<')){  ?>
					<th width="50%" class="title">
						<?php echo _JNEWS_TAG_ARTICLESECTION; ?>
					</th>
				<?php } ?>

				<th width="50%" class="title">
					<?php echo _JNEWS_TAG_ARTICLECATEGORY; ?>
				</th>
			</tr>
		</thead>
	<?php
	$checkSecCat = explode(',', $mailing->cat_id);
	$SecAllA = array();
	if (in_array('0:0', $checkSecCat) && !empty($checkSecCat)){
		$selectedRow = true;
	}else{
		$selectedRow = false;
			foreach ($checkSecCat as $oneSecCat){
				$oneSecCatA = explode(':', trim($oneSecCat));
				//search for selectall section
				if ( empty($oneSecCatA[1]) || $oneSecCatA[1] == '0' ){
					$SecAllA[]=$oneSecCatA[0];
				}
			}
	}

	$allClass = $selectedRow ? 'rowSelected' : '';
	$html = '';

	if(version_compare(JVERSION,'1.6.0','<')){ 
		$html .= '<tr id="autocontentSec0Cat0" class="'.$allClass.'" style="cursor:pointer;" onclick="insertSecCat(0, 0)" ><td nowrap="nowrap" align="center" colspan="2"><strong>'._JNEWS_TAGCAPTION_ALLSECCAT.'</strong></td></tr>';
	}else{
		$html .= '<tr id="autocontentSec0Cat0" class="'.$allClass.'" style="cursor:pointer;" onclick="insertSecCat(0, 0)" ><td nowrap="nowrap" align="center" colspan="2"><strong>'._JNEWS_TAGCAPTION_ALLCAT.'</strong></td></tr>';
	}

	$k = 0;
	$prevSecId = 0;

	foreach($allCats as $oneCat){
		if(empty($oneCat->secid)) $oneCat->secid = 0;
		if($prevSecId != $oneCat->secid){
			$rowClass = in_array($oneCat->secid,$SecAllA) ? 'rowSelected' : 'rowSection';
			$html .= '<tr id="autocontentSec'.$oneCat->secid.'Cat0" class="'.$rowClass.'" style="cursor:pointer;" onclick="insertSecCat('.$oneCat->secid.', 0)" ><td>'.$oneCat->title.'</td><td nowrap="nowrap" align="center">'._JNEWS_TAGCAPTION_ALL.'</td></tr>';
			$prevSecId = $oneCat->secid;
		}
		$catsecid = $oneCat->secid.':'.$oneCat->catid;
		$colClass = in_array($catsecid,$checkSecCat) ? 'colSelected' : '';

		if(version_compare(JVERSION,'1.6.0','<')){ 
			$html .= '<tr style="cursor:pointer" class="row'.$k.'" onclick="insertSecCat('.$oneCat->secid.', '.$oneCat->catid.')" ><td></td><td id="autocontentSec'.$oneCat->secid.'Cat'.$oneCat->catid.'" nowrap="nowrap" class="'.$colClass.'">'.$oneCat->name.'</td></tr>';
		}else{
			$html .= '<tr style="cursor:pointer" class="row'.$k.'" onclick="insertSecCat(0, '.$oneCat->catid.')" ><td id="autocontentSec'.$oneCat->secid.'Cat'.$oneCat->catid.'" nowrap="nowrap" class="'.$colClass.'">'.$oneCat->name.'</td></tr>';
		}

		$k = 1-$k;
	}
	echo $html;
	?>
	</tbody>
</table>
</div>
<div class="b">
	<div class="b">
		<div class="b"></div>
	</div>
</div>
</div>
</div>
<div class="b">
	<div class="b">
		<div class="b"></div>
	</div>
</div>
</div>
</form>
	<?php
	}





 public static  function selectCatK2($mailing){
		$js = "function insertTagHidden(tag){
					var form = document.adminForm;
					if(!form){
						form = document.mosForm;
					}
					var contentcatid = form.autocontenttag.value;
					var contentdelay = 0;
					var contentnotify = 0;
					var tagcount = 1;
					for( i = 0; i < form.smart_date.length; i++ ){
						if(form.smart_date[i].checked == true)
						smartdate = form.smart_date[i].value;
					}
					for( i = 0; i < form.delay_max.length; i++ ){
						if(form.delay_max[i].checked == true)
						contentdelay = form.delay_max[i].value;
					}
					for( x = 0; x < form.notify_id.length; x++ ){
						if(form.notify_id[x].checked == true)
						contentnotify = form.notify_id[x].value;
					}
					if(contentcatid == ''){
	           	 		alert('"._JNEWS_TAGSMART_ALERT_SELECT."');
					}else{
						window.top.setHiddenValue(contentcatid,contentnotify,contentdelay,tagcount,smartdate);
						var tagcountValue = window.top.$('tag_count').value;

						if ( tagcountValue < 2) {";
				if( version_compare(JVERSION,'1.6.0','<') ){//1.5
					$js .= " if(window.top.insertTag(tag)){window.top.document.getElementById('sbox-window').close();}";
				}else if(version_compare(JVERSION,'3.0.0','<')){
                                        $js .= ' if(window.top.insertTag(tag)) {window.parent.SqueezeBox.close();}';
                                }else {$js .= ' if(window.top.insertTag(tag)) {
                                          var need_click = jQuery(window.top.document).find("div.modal-backdrop");
                    if(need_click.length == 0) window.parent.SqueezeBox.close();
                    else    jQuery(window.top.document).find("div.modal-backdrop").click();}';
                                }
		$js .= "}else {";
				if( version_compare(JVERSION,'1.6.0','<') ){//1.5
					$js .= " window.top.document.getElementById('sbox-window').close();";
                                }else if(version_compare(JVERSION,'3.0.0','<')){
					$js .=  " window.parent.SqueezeBox.close();";
				}
                                else {
                                    $js .= '  var need_click = jQuery(window.top.document).find("div.modal-backdrop");
						                    if(need_click.length == 0) window.parent.SqueezeBox.close();
						                    else    jQuery(window.top.document).find("div.modal-backdrop").click();';
                                }
		$js .= "}
					}
				}";

		$doc = JFactory::getDocument();
		$doc->addScriptDeclaration($js);
		//if(!empty($mailing->cat_id))$mailing->cat_id = base64_decode($mailing->cat_id);
		$mailing->cat_id= (!empty($mailing->cat_id))? base64_decode($mailing->cat_id): '0:0';
			$db = JFactory::getDBO();
			if(version_compare(JVERSION,'1.6.0','<')){ 
				$query = "SELECT s.id as secid, s.title, c.id as catid, c.title as name"
				. "\n FROM #__categories as c LEFT JOIN #__sections AS s on c.section = s.id"
				. "\n WHERE s.id > 0 ORDER BY s.ordering, c.ordering";
			}else{

				$query = "SELECT c.id as catid, c.name as name"
				. "\n FROM #__k2_categories as c WHERE c.published=1 AND c.trash = 0 "
				. "\n  ORDER BY c.id ASC";
			}
			$db->setQuery( $query );
			$allCats = $db->loadObjectList();

        		$order[0] = _JNEWS_TAGPICKLIST_CREATED;
			$order[1] = _JNEWS_TAGPICKLIST_TITLE;
			$order[2] = _JNEWS_TAGPICKLIST_Order;

			$joomOrder = array();
			foreach($order as $key => $oneOrder){
				$joomOrder[] = jnews::HTML_SelectOption(  $key, $oneOrder );
			}
			if( !isset($lists['notify_id']) ) $lists['notify_id'] = null;
			$lists['notify_id'] = jnews::HTML_RadioList($joomOrder,'notify_id', 'class="inputbox"','value','text', ( isset( $mailing->notify_id) ) ? $mailing->notify_id : 0);
			$jour[] = jnews::HTML_SelectOption(  '0', _JNEWS_FULL_ARTICLE );
			$jour[] = jnews::HTML_SelectOption(  '1', _JNEWS_INTRO_ONLY );
			$jour[] = jnews::HTML_SelectOption(  '2', _JNEWS_TITLE_ONLY );
			$lists['delay_max'] = jnews::HTML_RadioList($jour,'delay_max', 'class="inputbox"', 'value', 'text', ( isset( $mailing->delay_max ) ) ? $mailing->delay_max : 1);

			$dateType[] = jnews::HTML_SelectOption(  '0', _JNEWS_AUTONEWS_DATE_CREATED );
			$dateType[] = jnews::HTML_SelectOption(  '1', _JNEWS_AUTONEWS_DATE_MODIFIED );
			$dateType[] = jnews::HTML_SelectOption(  '2', _JNEWS_AUTONEWS_DATE_PUBLISHUP );

			$lists['smart_date'] = jnews::HTML_RadioList($dateType,'smart_date', 'class="inputbox"', 'value', 'text', ( isset( $mailing->smart_date ) ) ? $mailing->smart_date : 0);

	?>
<style type="text/css">
table.smartcontent {
	border: 1px solid #D5D5D5;
	background-color: #F6F6F6;
	width: 100%;
	margin-bottom: 10px;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	padding: 5px;
}
table.smartcontent td.key {
	background-color: #f6f6f6;
	text-align: left;
	width: 140px;
	color: #666;
	font-weight: bold;
	border-bottom: 1px solid #e9e9e9;
	border-right: 1px solid #e9e9e9;
}

table.autocontentlist{
	width:100%;border-spacing:1px;background-color:#fff;color:#666;
}
table.autocontentlist td,table.autocontentlist th{
	padding:4px;
}
table.autocontentlist thead th{
	text-align:center;color:#FFF;border-bottom:1px solid #999;border-left:1px solid #fff;
}
table.autocontentlist thead a:hover{
	text-decoration:none;
}table.autocontentlist thead a{
	color:#FFF;
}table.autocontentlist thead th img{
	vertical-align:middle;
}
table.autocontentlist tbody tr{
	text-align:left;
}
table.autocontentlist tbody tr.rowSection td,table.autocontentlist tbody tr.rowSection:hover td{
	background-color:#8addf1;
}
table.autocontentlist tbody tr.row0:hover td,table.autocontentlist tbody tr.row1:hover td{
	background-color:#ff9;
}
table.autocontentlist tbody tr td{
	height:25px;background:#fff;border:1px solid #fff;
}
table.autocontentlist tbody tr.row1 td{
	background:#fff;border-top:1px solid #FFF;
}
table.autocontentlist tfoot tr{
	text-align:center;color:#333;
}
table.autocontentlist tfoot td,table.autocontentlist tfoot th{
	background-color:#fff;border-top:1px solid #999;text-align:center;
}
table.autocontentlist td.order{
	text-align:center;
}
table.autocontentlist td.order span{
	float:left;display:block;width:20px;text-align:center;
}
table.autocontentlist thead th{
	background-repeat:repeat-x;
	background-color:#069;
}

table.autocontentlist tbody tr.row0 td{
	background:#f4f4ff;
}
table.autocontentlist tbody tr.row0:hover td,table.autocontentlist tbody tr.row1:hover td{
	background-color:#CFF;
}

table.autocontentlist tbody tr.rowSelected td,table.autocontentlist tbody tr.rowSelected:hover td{
	background-color:#87c331;
	font-weight: bold;
}

table.autocontentlist tbody tr td.colSelected,table.autocontentlist tbody tr td.colSelected:hover{
	background-color:#87c331;
	font-weight: bold;
	color: #FFF;
}

table.autocontentlist tbody tr.rowSelected,table.autocontentlist tbody tr.rowSelected:hover{
	background-color:#87c331;
	font-weight: bold;
	color: #FFF;
}

input.inserttag {
	height: 50px;
	font-size: 1.2em;
	cursor: pointer;
}
</style>
<form name="adminForm" method="post" action="index.php" id="adminForm">
<div id="element-box">
<div class="t">
	<div class="t">
		<div class="t"></div>
	</div>
</div>
<div class="m">
<table class="smartcontent">
	<tbody>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _JNEWS_TAGPICKLIST_ORDERINGTIP;
					$title = _JNEWS_TAGPICKLIST_ORDERING;
					echo jNews_Tools::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['notify_id']; ?>
			</td>
			<td rowspan="2">
			<input onclick="insertTagHidden('[SMARTK2]')" class="inserttag" type="button" label="Insert Tag" name="Insert Tag" value="<?php echo _JNEWS_TAG_INSERT_TAG; ?>" />
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _JNEWS_AUTONEWS_TYPE_TIPS;
					$title = _JNEWS_AUTONEWS_TYPE;
					echo jNews_Tools::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['delay_max']; ?>
			</td>
		</tr>
		<tr>
			<td width="185" class="key">
				<span class="editlinktip">
				<?php
					$tip = _JNEWS_AUTONEWS_DATE_TIPS;
					$title = _JNEWS_AUTONEWS_DATE;
					echo jNews_Tools::toolTip( $tip, '', 280, 'tooltip.png', $title, '', 0 );
				?>
				</span>
			</td>
			<td>
				<?php echo $lists['smart_date']; ?>
			</td>
		</tr>
		<tr>
		<td width="185" class="key">
			<span class="editlinktip">
				Tag
			</span>
		</td>
		<td style="vertical-align: top;">
				<!--  <input type="text" onchange="setCaptionTags();" size="60px" name="jnewstagcaption"> -->
				<input type="text" size="60px" name="contenttag">
		</td>
	</tr>
	</tbody>
</table>
	<input type="hidden" size="50px" label="Insert Tag" name="autocontenttag" value="<?php echo $mailing->cat_id;?>"/>
<div id="element-box">
<div class="t">
	<div class="t">
		<div class="t"></div>
	</div>
</div>
<div class="m">
<script type="text/javascript">
<!--
 function inArray(needle, haystack) {
	var length = haystack.length;
	for(var i = 0; i < length; i++) {
		if(haystack[i] == needle) return true;
	}
	return false;
}
function insertSecCat(secid, catid){
	var form = document.adminForm;
	if(!form){
		form = document.mosForm;
	}
	form.contenttag.value = '[SMARTK2]';
	//all section and catergory
	if (catid ==0 && secid == 0){
		if($('autocontentSec'+secid+'Cat'+catid).className == ''){
			form.autocontenttag.value = secid+':'+catid;
			$('autocontentSec'+secid+'Cat'+catid).className = 'rowSelected';
			//we need to select also the columns in that row
			<?php
			$prevSecID0 = 0;
			foreach($allCats as $meow0){
				if(empty($meow0->secid)) $meow0->secid = 0;
				if ($prevSecID0 != $meow0->secid){
					?>
						$('autocontentSec<?php echo $meow0->secid;?>Cat0').className = 'rowSelected';
					<?php
				}
			?>
			$('autocontentSec<?php echo $meow0->secid;?>Cat<?php echo $meow0->catid;?>').className = 'colSelected';
			<?php
				$prevSecID0 = $meow0->secid;
			}
			?>
		}else{
			form.autocontenttag.value = '';
			$('autocontentSec'+secid+'Cat'+catid).className = '';
			<?php
			$prevSecID1 = 0;
			foreach($allCats as $meow1){
				if ($prevSecID1 != $meow1->secid){
					?>
						$('autocontentSec<?php echo $meow1->secid;?>Cat0').className = 'rowSection';
					<?php
				}
			?>
			$('autocontentSec<?php echo $meow1->secid;?>Cat<?php echo $meow1->catid;?>').className = '';
			<?php
				$prevSecID1 = $meow1->secid;
			}
			?>
		}
	}else{
		SecCatArray = form.autocontenttag.value.split(',');
		$('autocontentSec0Cat0').className = '';
		//all category in a section
		if (catid ==0 && secid != 0){
			if($('autocontentSec'+secid+'Cat'+catid).className == 'rowSection'){
				if (inArray(secid+':'+catid, SecCatArray)){
				//alert('true');
					form.autocontenttag.value = form.autocontenttag.value;
				}else{
				//alert('false');
					if(form.autocontenttag.value == ''){
					//alert('empty');
						form.autocontenttag.value = secid+':'+catid;
					}else{
						form.autocontenttag.value = form.autocontenttag.value+','+secid+':'+catid;
					}
				}

				$('autocontentSec'+secid+'Cat'+catid).className = 'rowSelected';
				//we need to select also the columns in that row
				<?php
				foreach($allCats as $meow2){
					if(empty($meow2->secid)) $meow2->secid = 0;
				?>
				if (secid==<?php echo $meow2->secid;?>){
					$('autocontentSec<?php echo $meow2->secid;?>Cat<?php echo $meow2->catid;?>').className = 'colSelected';
				}
				<?php
				}
				?>
			}else{
				if (inArray(secid+':'+catid, SecCatArray)){
				//alert('true');
					//we need remove the id in the array
					SecCatArray.splice(SecCatArray.indexOf(secid+':'+catid), 1);
					form.autocontenttag.value = SecCatArray.join(',') ;
				}else{
				//alert('false');
					if(form.autocontenttag.value == ''){
						form.autocontenttag.value = secid+':'+catid;
					}else{
						form.autocontenttag.value = form.autocontenttag.value+','+secid+':'+catid;
					}
				}
				$('autocontentSec'+secid+'Cat'+catid).className = 'rowSection';
				<?php
				foreach($allCats as $meow3){
				?>
				if (secid==<?php echo $meow3->secid;?>){
					$('autocontentSec<?php echo $meow3->secid;?>Cat<?php echo $meow3->catid;?>').className = '';
				}
				<?php
				}
				?>
			}
		}else{
			$('autocontentSec0Cat0').className = '';
			$('autocontentSec'+secid+'Cat0').className = 'rowSection';
			if($('autocontentSec'+secid+'Cat'+catid).className == 'colSelected'){
				$('autocontentSec'+secid+'Cat'+catid).className = '';
				if (inArray(secid+':'+catid, SecCatArray)){
				//alert('true');
					//we need remove the id in the array
					SecCatArray.splice(SecCatArray.indexOf(secid+':'+catid), 1);
					form.autocontenttag.value = SecCatArray.join(',') ;
				}else{
				//alert('false');
					if(form.autocontenttag.value == ''){
						form.autocontenttag.value = secid+':'+catid;
					}else{
						form.autocontenttag.value = form.autocontenttag.value+','+secid+':'+catid;
					}
				}

			}else{
				$('autocontentSec'+secid+'Cat'+catid).className = 'colSelected';
				if (inArray(secid+':'+catid, SecCatArray)){
				//alert('true');
					form.autocontenttag.value = form.autocontenttag.value;
				}else{
				//alert('false');
					if(form.autocontenttag.value == ''){
						form.autocontenttag.value = secid+':'+catid;
					}else{
						form.autocontenttag.value = form.autocontenttag.value+','+secid+':'+catid;
					}
				}

			}
		}
	}
}
//-->
</script>
<table class="autocontentlist" cellpadding="0" cellspacing="0">
	<tbody>
		<thead>
			<tr>
				<?php if(version_compare(JVERSION,'1.6.0','<')){  ?>
					<th width="50%" class="title">
						<?php echo _JNEWS_TAG_ARTICLESECTION; ?>
					</th>
				<?php } ?>

				<th width="50%" class="title">
					<?php echo _JNEWS_TAG_ARTICLECATEGORY; ?>
				</th>
			</tr>
		</thead>
	<?php
	$checkSecCat = explode(',', $mailing->cat_id);
	$SecAllA = array();
	if (in_array('0:0', $checkSecCat) && !empty($checkSecCat)){
		$selectedRow = true;
	}else{
		$selectedRow = false;
			foreach ($checkSecCat as $oneSecCat){
				$oneSecCatA = explode(':', trim($oneSecCat));
				//search for selectall section
				if ( empty($oneSecCatA[1]) || $oneSecCatA[1] == '0' ){
					$SecAllA[]=$oneSecCatA[0];
				}
			}
	}

	$allClass = $selectedRow ? 'rowSelected' : '';
	$html = '';

	if(version_compare(JVERSION,'1.6.0','<')){ 
		$html .= '<tr id="autocontentSec0Cat0" class="'.$allClass.'" style="cursor:pointer;" onclick="insertSecCat(0, 0)" ><td nowrap="nowrap" align="center" colspan="2"><strong>'._JNEWS_TAGCAPTION_ALLSECCAT.'</strong></td></tr>';
	}else{
		$html .= '<tr id="autocontentSec0Cat0" class="'.$allClass.'" style="cursor:pointer;" onclick="insertSecCat(0, 0)" ><td nowrap="nowrap" align="center" colspan="2"><strong>'._JNEWS_TAGCAPTION_ALLCAT.'</strong></td></tr>';
	}

	$k = 0;
	$prevSecId = 0;

	foreach($allCats as $oneCat){
		if(empty($oneCat->secid)) $oneCat->secid = 0;
		if($prevSecId != $oneCat->secid){
			$rowClass = in_array($oneCat->secid,$SecAllA) ? 'rowSelected' : 'rowSection';
			$html .= '<tr id="autocontentSec'.$oneCat->secid.'Cat0" class="'.$rowClass.'" style="cursor:pointer;" onclick="insertSecCat('.$oneCat->secid.', 0)" ><td>'.$oneCat->title.'</td><td nowrap="nowrap" align="center">'._JNEWS_TAGCAPTION_ALL.'</td></tr>';
			$prevSecId = $oneCat->secid;
		}
		$catsecid = $oneCat->secid.':'.$oneCat->catid;
		$colClass = in_array($catsecid,$checkSecCat) ? 'colSelected' : '';

		if(version_compare(JVERSION,'1.6.0','<')){ 
			$html .= '<tr style="cursor:pointer" class="row'.$k.'" onclick="insertSecCat('.$oneCat->secid.', '.$oneCat->catid.')" ><td></td><td id="autocontentSec'.$oneCat->secid.'Cat'.$oneCat->catid.'" nowrap="nowrap" class="'.$colClass.'">'.$oneCat->name.'</td></tr>';
		}else{
			$html .= '<tr style="cursor:pointer" class="row'.$k.'" onclick="insertSecCat(0, '.$oneCat->catid.')" ><td id="autocontentSec'.$oneCat->secid.'Cat'.$oneCat->catid.'" nowrap="nowrap" class="'.$colClass.'">'.$oneCat->name.'</td></tr>';
		}

		$k = 1-$k;
	}
	echo $html;
	?>
	</tbody>
</table>
</div>
<div class="b">
	<div class="b">
		<div class="b"></div>
	</div>
</div>
</div>
</div>
<div class="b">
	<div class="b">
		<div class="b"></div>
	</div>
</div>
</div>
</form>
	<?php
	}

 }

