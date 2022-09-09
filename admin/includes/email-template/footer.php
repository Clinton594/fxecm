<table style="width:100%;max-width:620px;margin:0 auto;">
    <tbody>
        <tr>
            <td style="text-align: center; padding:25px 20px 0;">
                <p style="font-size: 13px;">Copyright © <?= date("Y") ?> <?= $post->name ?> | <?= $post->address ?>. All rights reserved.</p>
                <ul style="margin: 10px -4px 0;padding: 0;">
                    <?php
                    if (!empty($post->branches)) {
                        foreach ($post->branches as $branch) { ?>
                            <li style="display: inline-block; list-style: none; padding: 4px;">
                                <a href="<?= $branch->desc ?>"><img style="width: 30px" src="<?= $branch->src ?>" alt="<?= $branch->title ?>"></a>
                            </li>
                    <?php }
                    } ?>
                </ul>
                <p style="padding-top: 15px; font-size: 12px;">This email was sent to you, <?= $post->to_name ?> by <?= $post->from_name ?> from <a style="color: #6576ff; text-decoration:none;" href="<?= dirname($post->site) ?> "><?= $post->name ?> </a>. To stop getting these email updates, unsubscribe from <a href="<?= dirname($post->site) ?>">Our website</a>.
            </td>
        </tr>
    </tbody>
</table>