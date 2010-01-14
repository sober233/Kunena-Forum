<?php
/**
* @version $Id$
* Kunena Component
* @package Kunena
*
* @Copyright (C) 2008 - 2009 Kunena Team All rights reserved
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @link http://www.kunena.com
*
* Based on FireBoard Component
* @Copyright (C) 2006 - 2007 Best Of Joomla All rights reserved
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @link http://www.bestofjoomla.com
*
* Based on Joomlaboard Component
* @copyright (C) 2000 - 2004 TSMF / Jan de Graaff / All Rights Reserved
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @author TSMF & Jan de Graaff
**/
defined( '_JEXEC' ) or die();


global $total, $limitstart, $limit;
global $kunena_icons;

$kunena_db 		=& JFactory::getDBO();
$kunena_session =& CKunenaSession::getInstance();

$userid 		= JRequest::getInt('userid', 0);

?>
<div class="k_bt_cvr1">
<div class="k_bt_cvr2">
<div class="k_bt_cvr3">
<div class="k_bt_cvr4">
<div class="k_bt_cvr5">
<table class = "kblocktable " id="kuserprfmsg" border = "0" cellspacing = "0" cellpadding = "0" width="100%">
    <thead>
        <tr>
            <th colspan = "6" align="left">
                <div class = "ktitle_cover  km">
                    <span class="ktitle kl"><?php echo _KUNENA_USERPROFILE_MESSAGES; ?></span>
                </div>

                <img id = "BoxSwitch_kuserprofile__kuserprofile_tbody" class = "hideshow" src = "<?php echo KUNENA_URLIMAGESPATH . 'shrink.gif' ; ?>" alt = ""/>
            </th>
        </tr>
    </thead>

    <tbody id = "kuserprofile_tbody">
        <tr  class = "ksth ks">
            <th class = "th-1 ksectiontableheader" align="center" width="1%">&nbsp;

            </th>

            <th class = "th-2 ksectiontableheader"  align="left" width="44%"><?php echo _KUNENA_USERPROFILE_TOPICS; ?>
            </th>

            <th class = "th-3 ksectiontableheader" align="left" width="30%"><?php echo _KUNENA_USERPROFILE_CATEGORIES; ?>
            </th>

            <th class = "th-4 ksectiontableheader" align="center" width="5%"><?php echo _KUNENA_USERPROFILE_HITS; ?>
            </th>

            <th class = "th-5 ksectiontableheader"  align="left" width="20%"><?php echo _KUNENA_USERPROFILE_DATE; ?>
            </th>

            <th class = "th-6 ksectiontableheader" align="center" width="1%">&nbsp;

            </th>
        </tr>

        <?php
        // Emotions
        $topic_emoticons = array ();
        $topic_emoticons[0] = KUNENA_URLEMOTIONSPATH . 'default.gif';
        $topic_emoticons[1] = KUNENA_URLEMOTIONSPATH . 'exclam.gif';
        $topic_emoticons[2] = KUNENA_URLEMOTIONSPATH . 'question.gif';
        $topic_emoticons[3] = KUNENA_URLEMOTIONSPATH . 'arrow.gif';
        $topic_emoticons[4] = KUNENA_URLEMOTIONSPATH . 'love.gif';
        $topic_emoticons[5] = KUNENA_URLEMOTIONSPATH . 'grin.gif';
        $topic_emoticons[6] = KUNENA_URLEMOTIONSPATH . 'shock.gif';
        $topic_emoticons[7] = KUNENA_URLEMOTIONSPATH . 'smile.gif';

        //determine visitors allowable threads based on session
        //find group id
        $pageperlistlm = 15;
        $limit = JRequest::getInt('limit', $pageperlistlm);
        $limitstart = JRequest::getInt('limitstart', 0);

        $query = "SELECT gid FROM #__users WHERE id='{$kunena_my->id}'";
        $kunena_db->setQuery($query);
        $dse_groupid = $kunena_db->loadObjectList();
        	check_dberror("Unable to load usergroup ids.");

        if (count($dse_groupid)) {
            $group_id = $dse_groupid[0]->gid;
        }
        else {
            $group_id = 0;
        }

        $query = "SELECT COUNT(*) FROM #__fb_messages WHERE hold='0' AND userid='{$userid}' AND catid IN ($kunena_session->allowed)";
        $kunena_db->setQuery($query);
        $total = count($kunena_db->loadObjectList());
        	check_dberror("Unable to load messages.");

        if ($total <= $limit) {
            $limitstart = 0;
        }

        $query
            = "SELECT a.*, b.id AS category, b.name AS catname, c.hits AS threadhits FROM #__fb_messages AS a, #__fb_categories AS b, #__fb_messages AS c, #__fb_messages_text AS d"
            ." WHERE a.catid=b.id AND a.thread=c.id AND a.id=d.mesid AND a.hold='0' AND a.userid='{$userid}' AND a.catid IN ($kunena_session->allowed) ORDER BY time DESC";
        $kunena_db->setQuery($query, $limitstart, $limit);
        $items = $kunena_db->loadObjectList();
        	check_dberror("Unable to load messages.");

        jimport('joomla.html.pagination');
        $pageNav = new JPagination($total, $limitstart, $limit);

        if (count($items) > 0)
        {
            $tabclass = array
            (
                "sectiontableentry1",
                "sectiontableentry2"
            );

            $k = 0;

            foreach ($items AS $item)
            {
                $k = 1 - $k;

                if (!ISSET($item->created))
                    $item->created = "";

                $fbURL = JRoute::_("index.php?option=com_kunena&amp;func=view".KUNENA_COMPONENT_ITEMID_SUFFIX."&amp;catid=" . $item->catid . "&amp;id=" . $item->id . "#" . $item->id);

                $fbCatURL = JRoute::_("index.php?option=com_kunena".KUNENA_COMPONENT_ITEMID_SUFFIX."&amp;func=showcat&amp;catid=" . $item->catid);
        ?>

            <tr class = "k<?php echo $tabclass[$k]; ?> ">
                <td class = "td-1  km"  align="center"><?php echo "<img src=\"" . $topic_emoticons[$item->topic_emoticon] . "\" alt=\"emo\" />"; ?>
                </td>

                <td class = "td-2  km"  align="left">

                        <a  class="k-topic-title km"  href = "<?php echo $fbURL; ?>"> <?php echo kunena_htmlspecialchars(stripslashes ($item->subject)); ?> </a>

                </td>

                <td class = "td-3 km" align="left">

                        <a  class="k-topic-cat km" href = "<?php echo $fbCatURL; ?>"> <?php echo kunena_htmlspecialchars(stripslashes($item->catname)); ?></a>

                </td>

                <td class = "td-4 km" align="center"><?php echo $item->threadhits; ?>
                </td>

                <td class = "td-5  ks" align="left">
                  <div class="k-latest-subject-date ks">
<?php echo '' . date(_DATETIME, $item->time) . ''; ?>
                  </div>
                </td>

                <td class = "td-6 km" align="center">
                    <a href = "<?php echo $fbURL; ?>"> <?php
    echo isset($kunena_icons['latestpost']) ? '<img src="'
             . KUNENA_URLICONSPATH . $kunena_icons['latestpost'] . '" border="0" alt="' . _SHOW_LAST . '" title="' . _SHOW_LAST . '" />' : '  <img src="' . KUNENA_URLEMOTIONSPATH . 'icon_newest_reply.gif" border="0"   alt="' . _SHOW_LAST . '" />'; ?> </a>
                </td>
            </tr>

        <?php
            }
        }
        else
        {
        ?>

            <tr>
                <td colspan = "6" class = "kprofile-bottomnav" align="center">
                    <br/>

                    <b><?php echo _KUNENA_USERPROFILE_NOFORUMPOSTS; ?></b>

                    <br/>

                    <br/>
                </td>
            </tr>

        <?php
        }
        ?>

        <tr>
            <td colspan = "6" class = "kprofile-bottomnav km" align="center">

                <?php
                // TODO: fxstein - Need to perform SEO cleanup
                echo $pageNav->getPagesLinks("index.php?option=com_kunena&amp;func=fbprofile&amp;task=showprf&amp;userid=$userid".KUNENA_COMPONENT_ITEMID_SUFFIX);
                ?>
<?php
echo $pageNav->getLimitBox("index.php?option=com_kunena&amp;func=fbprofile&amp;task=showprf&amp;userid=$userid" . KUNENA_COMPONENT_ITEMID_SUFFIX);
?>
                <br/>
<?php echo $pageNav->getPagesCounter(); ?>
            </td>
        </tr>
    </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
