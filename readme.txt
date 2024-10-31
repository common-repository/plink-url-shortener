=== Plink URL Shortener ===
Contributors: AliSaleem252, zinger252, TheseTemplates, PersianLink
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=alisaleem252%40gmail%2ecom&lc=US&item_name=Refli&item_number=refli&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHostedGuest
Tags: short url, short, url, url shorten, shorten url, shortener, url shortener, url shortening, urls, links, tinyurl, twitter, microblogging, کوتاه کننده لینک, لینک, آدرس اینترنتی
Requires at least: 3.1
Tested up to: 4.7.2
Stable tag: trunk
License: GPLv3

Automatic wordpress link shortener, shortens posts, pages, categories, affiliate links, shorten external links or any URL via plink.ir

== Description ==
<p>** NOW WITH CLICK STATS FOR EACH POST AND ALL SHORTLINKS **</p>

This plugin adds ability to instantly create short link for your post, pages, categories, archieves, users, tags, custom taxonomies or custom post types or anything then stores it
in the database, to make it easier for users to recall and share it with friends and readers, it can also be used to hide your referrer links by simply placing plink short codes to shorten any external link in post.
<p>
To Show the Short link of current page or post use the following shortcode on post, page or sidebar widget:
</p>
<p>
[plink-url]
</p>
<p>
To quickly shorten any External URL within post use the following short code:
</p>
Example: taking google.com as extrnal link, then
<p>
[plink-url u="http://google.com"]
</p>
<strong>Plugin homepage:</strong>
http://blog.plink.ir/wordpress-shorten-url-plugin/

For support use WordPress.org or this link:
http://blog.plink.ir/wordpress-shorten-url-plugin/

<strong>Advance users only:</strong>
<p>
In your single.php or single-custom.php file place:
</p>
<pre>&quot;Shortlink: &lt;?php echo plink_show_url() ?&gt;&quot;</pre>
After &lt;?php the_content(); ?&gt;
to automatically show post shortlink to your visitors for everypost.
or you can use plink_show_url() anywhere in your template to print the shortlink.


<strong>Report links</strong>

<p>Instantly report any suspicious, spam, malware link to plink directly for removal <a href="http://plink.ir/abuse">Plink.ir/abuse</a></p>
<p>We use Google Safe Browsing API to detect links with malware, so this is 100% safe</p>

Get Shortend! Thousands of Unique Custom Shortlinks are available Get them before someone does.
Thanks!

== Installation ==
<p>Manual</p>
1. Upload the `plink-url-shortener` folder to `/wp-content/plugins/`.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. In the blog post edit window using Button "Get shortlink" to get short link of this post.
<p>Automatic</p>
1. Goto Dasboard Plugin click 'Add New' search for 'Plink URL Shortener' .
2. Click Install.
3. Activate Plugin.


== Screenshots ==

1. Settings
2. The Get Shortlink button in Post Editor
3. Show Shortlink & Social Sharing Buttons
4. Statistics

== Changelog ==

= 1.0 =


== Frequently Asked Questions ==

= How do I use the plink_show_url() function? =
This function can be used in your theme files. For example, we echo plink_show_url() in post.php and this will show "http://plink.ir/123".

= How to use shortcode? =
In your post editor placing [plink-url] will show your current post short link.

= How to shorten External links in the posts? =
External links can be shorten using shortcode such as [plink-url u="http://external.link"].

= How to shorten All External links in the page? =
Right now this feature is not available but javascript plugins will be available soon.

= How to create custom shortlink? =
This feature is not avialable yet in the plugin but this can be done using API http://plink.ir/developer

== Upgrade Notice ==
= None. =
