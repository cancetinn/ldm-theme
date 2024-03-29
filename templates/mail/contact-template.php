<?php
/**
 * Arina Digital
 *
 **/

defined('ABSPATH') || exit; // Exit if accessed directly

$args = isset($args) && is_array($args) ? $args : [];

$name = $args['name'] ?? '';
$phone = $args['phone'] ?? '';
$email = $args['email'] ?? '';

$the_title = $args['thetitle'] ?? '';
$the_permalink = $args['thepermalink'] ?? '';

?>
<table style="font-family:'Poppins',sans-serif;" border="0" cellpadding="0" cellspacing="0" width="100%">
    <thead>
    <tr>
        <table align="center" border="0" cellspacing="30" cellpadding="30" width="640" bgcolor="#0A0A0A">
            <tr>
                <th colspan="2" align="center">
                    <img width="400" src="https://i.imgur.com/nI41CLt.png">
                </th>
            </tr>
        </table>
        <table align="center" border="0" cellspacing="0" cellpadding="0" width="640" style="margin-bottom:10px">
            <tr>
                <th colspan="2" align="center">
                    <h2>
                        You have a new Tournament Form notification!
                    </h2>
                </th>
            </tr>
        </table>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <table align="center" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td bgcolor="#f4f4f4" style="padding:20px;">
                        <table border="0" cellspacing="0" cellpadding="0" width="600">
                            <tr>
                                <td align="left" style="padding:10px 30px;font-size:16px" bgcolor="#ffffff">
                                    <p><strong>Your Name</strong> : <?php echo $name; ?></p>
                                    <p><strong>Email</strong> : <?php echo $email; ?></p>

                                    <?php if (!empty($name2)): ?>
                                        <p><strong>Your Name</strong> : <?php echo $name2; ?></p>
                                    <?php endif; ?>

                                    <?php if (!empty($email2)): ?>
                                        <p><strong>Email</strong> : <?php echo $email2; ?></p>
                                    <?php endif; ?>
                                    <p><strong>Pick Games</strong> : <?php echo $pickgames; ?></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </tbody>
</table>
