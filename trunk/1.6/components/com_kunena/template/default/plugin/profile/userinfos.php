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
**/

defined( '_JEXEC' ) or die();

?>
<div class="k_bt_cvr1">
<div class="k_bt_cvr2">
<div class="k_bt_cvr3">
<div class="k_bt_cvr4">
<div class="k_bt_cvr5">
<table class = "kblocktable " id="kuserinfo" border = "0" cellspacing = "0" cellpadding = "0" width="100%">
    <thead>
        <tr>
            <th>
                <div class = "ktitle_cover km">
                    <span class="ktitle kl"> <?php echo $msg_html->username; ?>  <?php echo _KUNENA_USERPROFILE_PROFILE; ?></span>
                </div>
            </th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td class = "kprofileinfo" align="center">
                <div class = "k-usrprofile-misc">
                    <span class = "view-username"> <?php echo $msg_html->username; ?></span> <?php  if ( $kunena_config->userlist_usertype ) { ?><span class = "msgusertype">(<?php echo $msg_html->usertype; ?>)</span><?php } ?>

                    <br/> <?php echo $msg_html->avatar; ?>

                        <div class = "viewcover">
                        <?php
                            if (isset($msg_html->userrank))
                                echo $msg_html->userrank;
                        ?>
                        </div>

                        <div class = "viewcover">
                        <?php
                            if (isset($msg_html->userrankimg))
                                echo $msg_html->userrankimg;
                        ?>
                        </div>
						<div class="viewcover">
						<?php echo _KUNENA_USERPROFILE_PROFILEHITS; ?>:
						<?php echo $msg_html->userhits; ?>
						</div>
                    <?php
                        if (isset($msg_html->posts))
                            echo $msg_html->posts;
                    ?>

                    <?php
                        if (isset($msg_html->points))
                            echo $msg_html->points;
                    ?>

                    <?php
                        if (isset($msg_html->icq))
                            echo $msg_html->icq;
                    ?>

                    <?php echo $msg_html->online; ?>

                    <?php
                        if (isset($msg_html->pms))
                            echo $msg_html->pms;
                    ?>

                    <?php
                        if (isset($msg_html->icq))
                            echo $msg_html->icq;
                    ?>

                    <?php
                        if (isset($msg_html->msn))
                            echo $msg_html->msn;
                    ?>

                    <?php
                        if (isset($msg_html->yahoo))
                            echo $msg_html->yahoo;
                    ?>

                    <?php
                        if (isset($msg_html->regdate))
                            echo "<br />Join Date: " . strip_tags($msg_html->date) . "<br />";
                    ?>

                    <?php
                        if (isset($msg_html->loc))
                            echo "Location: $msg_html->loc<br />";
                    ?>
                </div>

                <span class = "msgkarma">

            <?php
                if (isset($msg_html->karma))
                    echo $msg_html->karma . '&nbsp;&nbsp;' . $msg_html->karmaplus . ' ' . $msg_html->karmaminus;
                else
                    echo '&nbsp;';
            ?></span>
            </td>
        </tr>
    </tbody>
</table>

</div>
</div>
</div>
</div>
</div>
