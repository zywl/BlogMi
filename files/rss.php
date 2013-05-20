<?php header("Content-Type: text/xml"); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; echo "\n"; ?>
<rss version="2.0">
<channel>
  <title><?php mc_site_name(); ?></title>
  <link><?php mc_site_link(); ?></link>
  <description><![CDATA[<?php mc_site_desc(); ?>]]></description>
  <language>zh_CN</language>
  <generator>by BlogMi</generator>
<?php while (mc_next_post()) { ?>
    <item>
      <title><?php echo htmlspecialchars($mc_post['title']); ?></title>
      <link><?php mc_post_link(); ?></link>
      <pubDate><?php mc_the_date(); ?> <?php mc_the_time(); ?></pubDate>
      <description><![CDATA[<?php mc_the_content();?>]]></description>
      <author><?php mc_nick_name(); ?></author>
      <guid><?php mc_post_link(); ?></guid>
      </item>
<?php } ?>
</channel>
</rss>