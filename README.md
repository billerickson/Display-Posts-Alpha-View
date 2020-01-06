# Display Posts - Alpha View

**Contributors:** billerickson  
**Tags:** shortcode, pages, posts, page, query, display, list,
**Requires at least:** 3.0  
**Tested up to:** 5.1  
**Stable tag:** 1.0.0  
**License:** GPLv2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html

## Description

[Display Posts](https://displayposts.com) is the simplest way to query and display content in WordPress.

```
[display-posts alpha_view="true"]
```


![screenshot](http://f.cl.ly/items/3D2Y2E3P3b0H2p2l3y0U/Screen+Shot+2019-04-28+at+7.23.53+AM.png)

This plugin extends Display Posts by letting you display an alphabetical listing of your content, broken down by letter. You can use all of the [Display Posts parameters](https://displayposts.com/docs/parameters/) to customize the query, other than `orderby` and `order` which are automatically set to sort alphabetically, and `posts_per_page` which is set to all posts.

Use the `alpha_view` parameter to display the alphabetical listing. You can also add an optional `title` to appear above the listing.

## Filters

If you're a developer, you can use the following filters to customize the markup:

* `display_posts_alpha_view_heading_tag` - The heading tag used for date headings. Default is h4.
* `display_posts_alpha_view_heading_class` - The class added to the heading tag. Default is .display-posts-date.
* `display_posts_alpha_view_query_args` - Customize the query arguments when alpha_view is active
